<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Deal;
use App\Models\ClientPermission;
use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ClientFxRequirement;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        foreach ($beneficiaries as $benefiar) {
            $country = DB::table('countries')->where('id', '=', $benefiar->country_id)->first();
            $benefiar->country = $country->name;
            $currency = DB::table('currencies')->where('id', '=', $benefiar->currency_id)->first();
            $benefiar->currency = $currency->code;
        }
        return response()->json([
            'data' => $beneficiaries,
            'status_code' => 200
        ]);
    }

    public function update(Request $request, $id)
    {
        // Find the beneficiary by ID
        $beneficiary = Beneficiary::findOrFail($id);
        $user = Auth::user();

        if ($beneficiary->full_name == null) {

            $validator = Validator::make($request->all(), [
                'beneficiary_address' => 'required|string',
                'iban_account_no' => 'required|string',
                'business_name' => 'required | string'
                // Add more validation rules as needed
            ]);

            // Return validation errors if any
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status_code' => 422], 422);
            }
            $beneficiary->update([
                'client_id' => $user->id, // Assuming you're using authentication
                'country_id' => $request->country_id,
                'currency_id' => $request->currency_id,
                'business_name' => $request->business_name,
                'beneficiary_address' => $request->beneficiary_address,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                'iban_account_no' => $request->iban_account_no,
                'default_payment_reference' => $request->default_payment_reference,
            ]);
        } elseif ($beneficiary->business_name == null) {

            $validator = Validator::make($request->all(), [
                'beneficiary_address' => 'required|string',
                'iban_account_no' => 'required|string',
                'full_name' => 'required | string'
                // Add more validation rules as needed
            ]);

            // Return validation errors if any
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'status_code' => 422], 422);
            }
            $beneficiary->update([
                'client_id' => $user->id, // Assuming you're using authentication
                'country_id' => $request->country_id,
                'currency_id' => $request->currency_id,
                'full_name' => $request->full_name,
                'beneficiary_address' => $request->beneficiary_address,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                'iban_account_no' => $request->iban_account_no,
                'default_payment_reference' => $request->default_payment_reference,
            ]);
        }

        return response()->json(['message' => 'Beneficiary updated successfully', 'data' => $beneficiary, 'status code' => 201], 201);
    }

    public function addBeneficiaryIndividual(Request $request)
    {


        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'beneficiary_address' => 'required|string',
            'iban_account_no' => 'required|string',
            'full_name' => 'required | string'
            // Add more validation rules as needed
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status_code' => 422], 422);
        }


        $user = Auth::user();
        $client = Client::where('id', '=', $user->client_id)->first();
        // $phoneCode = $request->input('phone_code');
        // $contactNo = $request->input('contact_no');
        // $phoneNumber = null;
        // if($phoneCode != null && $contactNo != null){
        //     $phoneNumber = $phoneCode . $contactNo;
        // }
        // Concatenate phone_code and contact_no

        // Create beneficiary
        $beneficiary = Beneficiary::create([
            'client_id' => $client->id, // Assuming you're using authentication
            'country_id' => $request->country_id,
            'currency_id' => $request->currency_id,
            'full_name' => $request->full_name,
            'beneficiary_address' => $request->beneficiary_address,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'iban_account_no' => $request->iban_account_no,
            'default_payment_reference' => $request->default_payment_reference,
            'swift_code'  => $request->swift_code
        ]);

        return response()->json(['message' => 'Beneficiary added successfully', 'data' => $beneficiary, 'status code' => 201], 201);
    }
    public function addBeneficiaryBusiness(Request $request)
    {


        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'beneficiary_address' => 'required|string',
            'iban_account_no' => 'required|string',
            'business_name' => 'required | string'
            // Add more validation rules as needed
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status_code' => 422], 422);
        }


        $user = Auth::user();
        $client = Client::where('id', '=', $user->client_id)->first();
        // Create beneficiary
        //   dd($request->swift_code);
        $beneficiary = Beneficiary::create([
            'client_id' => $client->id, // Assuming you're using authentication
            'country_id' => $request->country_id,
            'currency_id' => $request->currency_id,
            'business_name' => $request->business_name,
            'beneficiary_address' => $request->beneficiary_address,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'iban_account_no' => $request->iban_account_no,
            'default_payment_reference' => $request->default_payment_reference,
            'swift_code'  => $request->swift_code,
        ]);

        return response()->json(['message' => 'Beneficiary added successfully', 'data' => $beneficiary, 'status code' => 201], 201);
    }

    public function destroy($id)
    {
        // Find the beneficiary by ID
        $beneficiary = Beneficiary::findOrFail($id);

        // Delete the beneficiary
        $beneficiary->delete();

        // Return response indicating success
        return response()->json(['message' => 'Beneficiary deleted successfully', 'status code' => 200]);
    }

    public function searchBeneficiary(Request $request)
    {
        // Retrieve search parameters from request
        $name = $request->input('beneficiary_name');
        $countryId = $request->input('country_id');
        $currencyId = $request->input('currency_id');

        $query = Beneficiary::query();

        // Apply filters based on search parameters
        if ($name) {
            $query->where(function ($query) use ($name) {
                $query->where('full_name', 'like', "%$name%")
                    ->orWhere('business_name', 'like', "%$name%");
            });
        }

        if ($countryId) {
            $query->where('country_id', $countryId);
        }

        if ($currencyId) {
            $query->where('currency_id', $currencyId);
        }

        // Get the results
        $beneficiaries = $query->get();
        foreach ($beneficiaries as $benefiar) {
            $country = DB::table('countries')->where('id', '=', $benefiar->country_id)->first();
            $currency = DB::table('currencies')->where('id', '=', $benefiar->currency_id)->first();

            $benefiar->country = $country->name;
            $benefiar->currency = $currency->code;
        }

        if ($beneficiaries->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            return response()->json(['data' => $beneficiaries, 'status_code' => 200]);
        }
    }
    public function clientTransection()
    {
        // Get the authenticated client
        $client = Auth::user(); // Assuming the authenticated user is a client

        // Retrieve all deals associated with the client
        $deals  = Deal::where('client_id', '=', $client->parent_id)->get();

        foreach ($deals as $deal) {
            $beneficiaries = Beneficiary::where('id', '=', $deal->beneficiary_id)->count();
            $deal->beneficiary = $beneficiaries;
        }
        // Return the deals as JSON response
        if ($deals->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            return response()->json(['data' => $deals, 'status_code' => 200]);
        }
        return response()->json(['data' => $deals, 'status_code' => 200]);
    }
    public function clientProfile()
    {
        $user = Auth::user();
        $profile  = Client::where('id', '=', $user->parent_id)->first();
        $country = DB::table('countries')->where('id', '=', $profile->country_id)->first();
        $profile->country = $country->name;
        return response()->json(['data' => $profile, 'status_code' => 200]);
    }
    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status_code' => 422], 422);
        }
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 422);
        }
        if ($request->new_password == null) {
            return response()->json(['error' => 'New password is required'], 422);
        }
        if ($request->confirm_password == null) {
            return response()->json(['error' => 'confirm password is required'], 422);
        }
        if ($request->new_password !== $request->confirm_password) {
            // Custom error response if new_password and confirm_password do not match
            return response()->json(['error' => 'New password and confirm password do not match'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function allDealsHistory(Request $request)
    {
        $client = Auth::user();

        // Set default page size if not provided in the request
        $perPage = $request->input('per_page', 10);

        // Retrieve deals associated with the logged-in client paginated
        $dealHistory = Deal::where('client_id', $client->parent_id)->paginate($perPage);
        foreach ($dealHistory as $deal) {
            $beneficiaries = Beneficiary::where('id', '=', $deal->beneficiary_id)->count();
            $deal->beneficiary = $beneficiaries;
        }

        return response()->json(['data' => $dealHistory, 'status_code' => 200]);
    }
    public function searchDealsHistory(Request $request)
    {
        $currency = $request->input('purchase_currency');
        $dealNo = $request->input('deal_no');
        $startFrom = $request->input('start_from');
        $endTo = $request->input('end_to');

        $user = Auth::user();
        $query = Deal::where('client_id', $user->parent_id);

        if ($request->has('deal_no')) {
            $query->where('id', $dealNo);
        }


        if ($request->has('purchase_currency')) {
            $query->where('buy_amount', $currency);
        }

        if ($request->has('start_from')) {
            $query->where('created_at', '>=', $startFrom);
        }

        if ($request->has('end_to')) {
            $query->where('created_at', '<=', $endTo);
        }

        $deals = $query->get();

        if ($deals->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            return response()->json(['data' => $deals, 'status_code' => 200]);
        }
    }
    public function searchPaymentsHistory(Request $request)
    {
        // Retrieve search parameters from request
        $name = $request->input('beneficiary_name');
        $countryId = $request->input('country_id');
        $currencyId = $request->input('currency_id');
        $user = Auth::user();

        $query = Beneficiary::query()->where('client_id', '=', $user->parent_id);;

        // Apply filters based on search parameters
        if ($name) {
            $query->where(function ($query) use ($name) {
                $query->where('full_name', 'like', "%$name%")
                    ->orWhere('business_name', 'like', "%$name%");
            });
        }

        if ($countryId) {
            $query->where('country_id', $countryId);
        }

        if ($currencyId) {
            $query->where('currency_id', $currencyId);
        }

        // Get the results
        $beneficiaries = $query->get();
        foreach ($beneficiaries as $benefiar) {
            $country = DB::table('countries')->where('id', '=', $benefiar->country_id)->first();
            $currency = DB::table('currencies')->where('id', '=', $benefiar->currency_id)->first();

            $benefiar->country = $country->name;
            $benefiar->currency = $currency->code;
        }

        if ($beneficiaries->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            return response()->json(['data' => $beneficiaries, 'status_code' => 200]);
        }
    }

    public function allPaymentsHistory()
    {
        $user = Auth::user();
        $beneficiaries = Beneficiary::where('client_id', '=', $user->parent_id)->paginate(10);
        foreach ($beneficiaries as $benefiar) {
            $country = DB::table('countries')->where('id', '=', $benefiar->country_id)->first();
            $benefiar->country = $country->name;
            $currency = DB::table('currencies')->where('id', '=', $benefiar->currency_id)->first();
            $benefiar->currency = $currency->code;
        }
        return response()->json([
            'data' => $beneficiaries,
            'status_code' => 200
        ]);
    }
    public function dealsDetail($id)
    {
        $deal = Deal::find($id);
        $beneficiaries = [];

        $client = Client::where('id', '=', $deal->client_id)->first();
        $deal->client_name = $client->first_name . ' ' . $client->last_name;
        $beneficary = Beneficiary::where('id', '=', $deal->beneficiary_id)->first();
        if ($beneficary->full_name === null) {
            $deal->beneficiary_name = $beneficary->business_name;
        } else if ($beneficary->business_name === null) {
            $deal->beneficiary_name = $beneficary->full_name;
        }
        $country = DB::table('countries')->where('id', '=', $beneficary->country_id)->first();
        $deal->beneficiary_country = $country->name;
        $deal->beneficiary_date = $beneficary->created_at->format('Y-h-m');





        if (!$deal) {
            return response()->json(['error' => 'Deal not found'], 404);
        }

        return response()->json(['deal' => $deal, 'status code' => 201]);
    }
    public function wallet($client_id)
    {
        $wallets = DB::table(
            'wallets'
        )->where('client_id', $client_id)->get();

        return response()->json(['wallets' => $wallets], 200);
    }
    public function beneficiariesClientDropdown($id)
    {
        $beneficiaries = Beneficiary::select('id', 'full_name', 'business_name')->where('client_id', '=', $id)->get();
        // Iterate through each beneficiary to check and modify the names
        foreach ($beneficiaries as $beneficiary) {
            if (!$beneficiary->full_name) {
                // If full_name is null, set it to business_name
                $beneficiary->name = $beneficiary->business_name;
            } elseif (!$beneficiary->business_name) {
                // If business_name is null, set it to full_name
                $beneficiary->name = $beneficiary->full_name;
            }
            unset($beneficiary->full_name);
            unset($beneficiary->business_name);
        }
        return response()->json(['beneficiaries' => $beneficiaries, 'status_code' => 200]);
    }
    public function makeMultipleDeals(Request $request)
    {


        $loggedIn = Auth::user();
        $client = Client::findOrFail($loggedIn->parent_id);
        

        // Loop through each deal in the request and create a new Deal model
        foreach ($request->all() as $dealData) {
            $deal = new Deal([
                'beneficiary_id' => $dealData['beneficiary_id'],
                'total_payable_amount' => $dealData['total_payable_amount'],
                'amount_currency' => $dealData['amount_currency'],
                'payment_reference' => $dealData['payment_reference'],
                'suggested_exchange_rate' => $dealData['exchange_rate'],
                'total_fees' => $dealData['fees'],
                'unique_identifier' => $dealData['unique_identifier']
              
            ]);

            // Save the deal for the current client
            $client->deals()->save($deal);
        }

        return response()->json(['message' => 'Deals added successfully'], 201);
    }
    public function getAuthorizedUser()
    {

        $user = Auth::user();
        $clientId = $user->parent_id;
        
        $authorizedUsers = User::select('id', DB::raw("CONCAT(firstname, ' ', lastname) AS name"))
                       ->where('parent_id', null)
                       ->where('client_id', $clientId)
                       ->get();
                       

        return response()->json(['users' => $authorizedUsers,'status code' => 200], 200);
    }
    public function clientPermission(Request $request){
                // Create client permission
                
                $user = Auth::user();
                $clientId = $user->parent_id;
                $userCount = ClientPermission::where('granted_user_id','=', $request->user_id)->count();
                if($userCount > 0){
                        $permission = ClientPermission::where('granted_user_id','=', $request->user_id)->first();
                        $permission->client_id = $clientId;
                        $permission->online_access = $request->input('online_access', false);
                        $permission->rates = $request->input('rates', false);
                        $permission->deal_booking = $request->input('deal_booking', false);
                        $permission->user_type = $request->input('user_type');
                }else{
                    $permission = new ClientPermission();
                    $permission->client_id = $clientId;
                    $permission->granted_user_id = $request->user_id;
                    $permission->online_access = $request->input('online_access', false);
                    $permission->rates = $request->input('rates', false);
                    $permission->deal_booking = $request->input('deal_booking', false);
                    $permission->user_type = $request->input('user_type');
                }
               
                $permission->save();
        
                return response()->json(['message' => 'Permission added successfully'], 201);
    }
}
