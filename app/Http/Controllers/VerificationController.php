<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Password;
class VerificationController extends Controller
{
    //
    public function verifyEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Assuming you have a method to send the email verification notification
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email verification sent']);
    }
    public function verify(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            return response()->json(['message' => 'Invalid verification link'], 403);
        }
        if (! URL::hasValidSignature($request)) {
            return response()->json(['message' => 'Invalid verification link'], 403);
        }
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified'], 400);
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return response()->json(['message' => 'Email successfully verified'], 200);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email Not Valid'], 404);
        }
        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
                    ? response()->json(['message' => 'Reset link sent to your email'], 200)
                    : response()->json(['message' => 'Unable to send reset link'], 400);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
                    ? response()->json(['message' => 'Password reset successfully'], 200)
                    : response()->json(['message' => 'Unable to reset password'], 400);
    }

    public function showResetForm(Request $request, $token)
    {
        // return view('auth.passwords.reset')->with(
        //     ['token' => $token, 'email' => $request->email]
        // );
        return response()->json( ['token' => $token, 'email' => $request->email], 200);
    }
}