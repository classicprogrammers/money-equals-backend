<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Notifications\VerifyEmail;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => ['required', 'in:2,4'],
            // Add more validation rules as needed
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status_code' => 422], 422);
        }

        // Create the user
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'active';
        if ($request->role != null) {
            $user->role = $request->role;
        }
        // Assign parent_id or client_id if needed

        // Save the user to the database
        $user->save();
        // $user->sendEmailVerificationNotification();
        // // Generate API token for the user
        $token = $user->createToken('API Token')->plainTextToken;
        if ($request->role == '2') {
            // // Return the API token
            return response()->json(['token' => $token, 'status_code' => 200], 201);
        }else{
            return response()->json(['message' => 'Registered User Successfully. Please verify your email', 'status_code' => 200], 201);
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Add a condition to check if the user status is active
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['message' => 'User email not found', 'status code' => 404], 404);
        }
        
        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Incorrect password', 'status code' => 401], 401);
        }
        
        if ($user->status !== 'active') {
            return response()->json(['message' => 'User account is not active', 'status code' => 401], 401);
        }
        if (!$user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is not verified', 'status code' => 401], 401);
        }
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal Access Token')->plainTextToken;
    
            return response()->json(['token' => $token,'message' => 'Logged In Successfully' ,'status code' => 200,'user' => $user], 200);
        }
    
        return response()->json(['message' => 'Invalid email or password', 'status code' => 401], 401);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
