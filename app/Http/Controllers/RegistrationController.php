<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientFxRequirement;
use App\Models\ClientFxRequirementCountryReceivingPayment;
use App\Models\ClientFxRequirementCountryMakingPayment;
use App\Models\ClientFxRequirementPaymentPurpose;
use App\Models\ClientFxRequirementFundSource;
use App\Models\ClientFxRequirementCurrency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function register(Request $request)
    {
         
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            // Add more validation rules as needed
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status_code' => 422], 422);
        }

        // Create the user
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'inactive';
        if($request->role != null){
            $user->role = $request->role ;
        }
        // Assign parent_id or client_id if needed

        // Save the user to the database
        $user->save();

        // // Generate API token for the user
        $token = $user->createToken('API Token')->plainTextToken;

        // // Return the API token
        return response()->json(['token' => $token,'status_code' => 200], 201);
    }
    public function registerBusiness(Request $request)
    {
 
        $user = Auth::user();
        if ($user == null) {
            return response()->json(['message' => 'verify the user first then proceed'], 200);
        }

     
        $client = Client::find($user->parent_id);

        // Check if client exists
        if ($client) {

            // Update client attributes
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->dob = $request->dob;
            $client->phone_no = $request->phone_no;
            $client->postcode = $request->postcode;
            $client->email = $request->email;
            $client->address = $request->address;
            $client->business_name = $request->business_name;
            $client->registration_no = $request->registration_no;
            $client->country = $request->country;
            $client->post_code = $request->post_code;
            $client->payment_type_id = $request->payment_type_id;
            $client->category_id = $request->category_id;
            $client->subcategory_id = $request->subcategory_id;
            $client->business_address = $request->business_address;
            $client->website = $request->website;
            $client->business_phone_no = $request->business_phone_no;

            // Save the updated client to the database
            $client->save();
            $clientFxRequirement = ClientFxRequirement::Where('client_id', '=', $client->id)->first();
            $clientFxRequirement->payment_per_month_id = $request->payment_per_month_id;
            $clientFxRequirement->payment_schedule_id = $request->payment_schedule_id;
            $clientFxRequirement->price_range_id = $request->price_range_id;
            $clientFxRequirement->medium_id = $request->medium_id;
            $clientFxRequirement->save();
        } else {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'dob' => 'required|date',
                'phone_no' => 'required|string',
                'postcode' => 'required|string',
                'email' => 'required|email|unique:clients',
                'address' => 'required|string',
                'business_name' => 'required|string',
                'registration_no' => 'nullable|string',
                'country' => 'required|string',
                'post_code' => 'required|string',
                'business_address' => 'required|string',
                'website' => 'nullable|url',
                'business_phone_no' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(),'status_code' => 422], 422);
            }
            $client = new Client();
            $client->first_name = $request->first_name;
            $client->last_name = $request->last_name;
            $client->dob = $request->dob;
            $client->phone_no = $request->phone_no;
            $client->postcode = $request->postcode;
            $client->email = $request->email;
            $client->address = $request->address;
            $client->business_name = $request->business_name;
            $client->registration_no = $request->registration_no;
            $client->country = $request->country;
            $client->post_code = $request->post_code;
            $client->payment_type_id = $request->payment_type_id;
            $client->category_id = $request->category_id;
            $client->subcategory_id = $request->subcategory_id;
            $client->business_address = $request->business_address;
            $client->website = $request->website;
            $client->business_phone_no = $request->business_phone_no;
            // Set default values for other fields or leave them blank

            // Save the client to the database
            $client->save();
            $clientFxRequirement = new ClientFxRequirement();

            // Assign values from the request to the model
            $clientFxRequirement->client_id = $client->id;
            $clientFxRequirement->payment_per_month_id = $request->payment_per_month_id;
            $clientFxRequirement->payment_schedule_id = $request->payment_schedule_id;
            $clientFxRequirement->price_range_id = $request->price_range_id;
            $clientFxRequirement->medium_id = $request->medium_id;
            $clientFxRequirement->save();
        }

        // Create or update the user based on the authenticated user's ID
        // Create or update the user


        // Update existing user

        $user->email = $user->email; // Replace $newEmail with the new email value
        $user->password = $user->password; // Replace $newPassword with the new password value
        $user->parent_id = $client->id;
        $user->client_id = $client->id;
        $user->status = $user->status; // Replace $newStatus with the new status value
        // Assign other fields to update here

        $user->save();

        $data = $request->all();
        $clientFxRequirementId = $clientFxRequirement->id;
        // Delete existing records for countries receiving payment
        ClientFxRequirementCountryReceivingPayment::where('client_fx_requirement_id', $clientFxRequirementId)->delete();

        if (isset($data['countries_receiving_payment']) && is_array($data['countries_receiving_payment'])) {
            foreach ($data['countries_receiving_payment'] as $country_id) {
                // Create a new instance of ClientFxRequirementCountryReceivingPayment
                $countryReceivingPayment = new ClientFxRequirementCountryReceivingPayment();

                // Set the client_fx_requirement_id and country_id
                $countryReceivingPayment->client_fx_requirement_id = $clientFxRequirementId;
                $countryReceivingPayment->country_id = $country_id;

                // Save the record to the database
                $countryReceivingPayment->save();
            }
        }

        // Delete existing records for countries making payment
        ClientFxRequirementCountryMakingPayment::where('client_fx_requirement_id', $clientFxRequirementId)->delete();

        // Now, insert the new set of records for countries making payment
        if (isset($data['countries_making_payment']) && is_array($data['countries_making_payment'])) {
            foreach ($data['countries_making_payment'] as $country_id) {
                // Create a new instance of ClientFxRequirementCountryMakingPayment
                $countryMakingPayment = new ClientFxRequirementCountryMakingPayment();

                // Set the client_fx_requirement_id and country_id
                $countryMakingPayment->client_fx_requirement_id = $clientFxRequirementId;
                $countryMakingPayment->country_id = $country_id;

                // Save the record to the database
                $countryMakingPayment->save();
            }
        }

        // Delete existing records for payment purpose
        ClientFxRequirementPaymentPurpose::where('client_fx_requirement_id', $clientFxRequirementId)->delete();

        // Now, insert the new set of records for payment purpose
        if (isset($data['payment_purpose']) && is_array($data['payment_purpose'])) {
            foreach ($data['payment_purpose'] as $purpose_id) {
                // Create a new instance of ClientFxRequirementPaymentPurpose
                $paymentPurpose = new ClientFxRequirementPaymentPurpose();

                // Set the client_fx_requirement_id and purpose_id
                $paymentPurpose->client_fx_requirement_id = $clientFxRequirementId;
                $paymentPurpose->payment_purpose_id = $purpose_id;

                // Save the record to the database
                $paymentPurpose->save();
            }
        }


        // Delete existing records for fund sources
        ClientFxRequirementFundSource::where('client_fx_requirement_id', $clientFxRequirementId)->delete();

        // Now, insert the new set of records for fund sources
        if (isset($data['fund_source']) && is_array($data['fund_source'])) {
            foreach ($data['fund_source'] as $source) {
                // Create a new instance of ClientFxRequirementFundSource
                $fundSource = new ClientFxRequirementFundSource();

                // Set the client_fx_requirement_id and source
                $fundSource->client_fx_requirement_id = $clientFxRequirementId;
                $fundSource->fund_source_id = $source;

                // Save the record to the database
                $fundSource->save();
            }
        }

           // Delete existing records for payment purpose
           ClientFxRequirementCurrency::where('client_fx_requirement_id', $clientFxRequirementId)->delete();
         
           // Now, insert the new set of records for payment purpose
           if (isset($data['currency_dealing']) && is_array($data['currency_dealing'])) {
           
               foreach ($data['currency_dealing'] as $currency_id) {
                   // Create a new instance of ClientFxRequirementPaymentPurpose
                   $currency = new ClientFxRequirementCurrency();
   
                   // Set the client_fx_requirement_id and purpose_id
                   $currency->client_fx_requirement_id = $clientFxRequirementId;
                   $currency->currency_id = $currency_id;
   
                   // Save the record to the database
                   $currency->save();
               }
           }

        if (!empty($data['authorized_contacts'])) {
        // Loop through the array of authorized contacts and append each contact to the array
        foreach ($data['authorized_contacts'] as $contact) {
            // Check if the email exists in the database
            $existingUser = User::where('email', $contact['email'])->first();

            if ($existingUser) {
                // If the email exists, check if it belongs to the current client
                if ($existingUser->client_id === $client->id) {

                    // If the email belongs to the current client, update the user
                    $existingUser->firstname = $contact['first_name'];
                    $existingUser->lastname = $contact['last_name'];
                    $existingUser->dob = $contact['dob'];
                    $existingUser->phone_no = $contact['phone_no'];
                    $existingUser->postcode = $contact['postcode'];
                    $existingUser->address = $contact['address'];
                    $existingUser->country = $contact['country'];
                    $user->role = '3';

                    // Assign missing fields accordingly
                    $existingUser->save();
                } else {
                    // If the email belongs to another client, show a proper message
                    // You can add your message handling logic here
                    return response()->json([
                        'message' => 'The authorized user with same email already exist',
                        'data' => $existingUser,
                        'status_code' => 422

                    ], 200);
                }
            } else {
                // If the email doesn't exist, create a new user
                $user = new User();
                $user->client_id = $client->id;
                $user->email = $contact['email'];
                $user->firstname = $contact['first_name'];
                $user->lastname = $contact['last_name'];
                $user->password = bcrypt(Str::random(8));
                $user->status = 'active';
                $user->dob = $contact['dob'];
                $user->phone_no = $contact['phone_no'];
                $user->postcode = $contact['postcode'];
                $user->address = $contact['address'];
                $user->country = $contact['country'];
                $user->role = '3';
                // Assign missing fields accordingly

                $user->save();
            }
        }
    }



        // Generate token for the updated or created user
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        //Return the token in the response
        return response()->json(['message' => 'Client Registered successfully',
        'token' => $token,
        'status_code' => 200
    ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out','status code' => 200]);
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
