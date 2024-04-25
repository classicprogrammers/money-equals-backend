<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ClientFxRequirement;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class ClientController extends Controller
{
    public function index() {
        $beneficiaries = Beneficiary::all();
    
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

       if($beneficiary->full_name == null){

        $validator = Validator::make($request->all(), [
            'beneficiary_address' => 'required|string',
            'iban_account_no' => 'required|string',
            'business_name' => 'required | string'
            // Add more validation rules as needed
        ]);
    
        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status_code' => 422], 422);
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
       

       }elseif($beneficiary->business_name == null){

        $validator = Validator::make($request->all(), [
            'beneficiary_address' => 'required|string',
            'iban_account_no' => 'required|string',
            'full_name' => 'required | string'
            // Add more validation rules as needed
        ]);
    
        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status_code' => 422], 422);
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

       return response()->json(['message' => 'Beneficiary updated successfully', 'data' => $beneficiary ,'status code' => 201], 201);
    }

   public function addBeneficiaryIndividual(Request $request){
    
 
     // Validate the incoming request data
     $validator = Validator::make($request->all(), [
        'beneficiary_address' => 'required|string',
        'iban_account_no' => 'required|string',
        'full_name' => 'required | string'
        // Add more validation rules as needed
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors(),'status_code' => 422], 422);
    }


    $user = Auth::user();
    $client = Client::where('id' ,'=',$user->client_id)->first();
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
    ]);

    return response()->json(['message' => 'Beneficiary added successfully', 'data' => $beneficiary ,'status code' => 201], 201);
   }
   public function addBeneficiaryBusiness(Request $request){
    
 
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
       'beneficiary_address' => 'required|string',
       'iban_account_no' => 'required|string',
       'business_name' => 'required | string'
       // Add more validation rules as needed
   ]);

   // Return validation errors if any
   if ($validator->fails()) {
       return response()->json(['errors' => $validator->errors(),'status_code' => 422], 422);
   }


   $user = Auth::user();
   $client = Client::where('id' ,'=',$user->client_id)->first();
   // Create beneficiary
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
   ]);

   return response()->json(['message' => 'Beneficiary added successfully', 'data' => $beneficiary ,'status code' => 201], 201);
  }
   
  public function destroy($id)
    {
        // Find the beneficiary by ID
        $beneficiary = Beneficiary::findOrFail($id);

        // Delete the beneficiary
        $beneficiary->delete();

        // Return response indicating success
        return response()->json(['message' => 'Beneficiary deleted successfully','status code' => 200]);
    }

    public function searchBeneficiary(Request $request){
           // Retrieve search parameters from request
           $name = $request->input('beneficiary_name');
           $countryId = $request->input('country_id');
           $currencyId = $request->input('currency_id');

           $query = Beneficiary::query();

        // Apply filters based on search parameters
        if ($name) {
            $query->where('full_name', 'like', "%$name%");
        }

        if ($countryId) {
            $query->where('country_id', $countryId);
        }

        if ($currencyId) {
            $query->where('currency_id', $currencyId);
        }

        // Get the results
        $beneficiaries = $query->get();
        foreach($beneficiaries as $benefiar){
            $country = DB::table('countries')->where('id','=',$benefiar->country_id)->first();
            $currency = DB::table('currencies')->where('id','=',$benefiar->currency_id)->first();
           
            $benefiar->country = $country->name;
            $benefiar->currency = $currency->code;
        }

        if ($beneficiaries->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        }else{
            return response()->json(['data' => $beneficiaries, 'status_code' => 200]);
        }
    }
    public function clientTransection(){
        
    {
        // Get the authenticated client
        $client = Auth::user(); // Assuming the authenticated user is a client

        // Retrieve all deals associated with the client
        $deals  = Deal::where('client_id','=', $client->id)->get();
        foreach($deals as $deal){
           $beneficiaries = Beneficiary::where('id' ,'=', $deal->beneficiary_id )->count();
           $deal->beneficiary = $beneficiaries;
        }
        // Return the deals as JSON response
        return response()->json(['data' => $deals, 'status_code' => 200]);
    }
    }
}
