<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ClientFxRequirement;
class AdminController extends Controller
{
    //
    public function search(Request $request)
    {

        // Retrieve search parameters from the request
        $firstName = $request->input('name');
        $id = $request->input('id');
        $phoneNo = $request->input('phone_no');
        $email = $request->input('email');
        $registeredFrom = $request->input('registered_from');
        $registeredTo = $request->input('registered_to');
        if ($registeredFrom !== null && $registeredTo === null) {
            $registeredTo = Carbon::now();
        }
        // Query to search clients
        // Case 1
        if ($firstName !== null && $id !== null && $phoneNo !== null && $email !== null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 2
        if ($firstName !== null && $id !== null && $phoneNo !== null && $email === null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 3
        if ($firstName !== null && $id !== null && $phoneNo === null && $email !== null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('email', $email)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 4
        if ($firstName !== null && $id !== null && $phoneNo === null && $email === null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 5
        if ($firstName !== null && $id === null && $phoneNo !== null && $email !== null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
                
        }

        // Case 6
        if ($firstName !== null && $id === null && $phoneNo !== null && $email === null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('phone_no', $phoneNo)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 7
        if ($firstName !== null && $id === null && $phoneNo === null && $email !== null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->where('email', $email)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 8
        if ($firstName !== null && $id === null && $phoneNo === null && $email === null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('first_name', $firstName)
                ->get();
            }else{
                $results = Client::where('first_name', $firstName)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 9
        if ($firstName === null && $id !== null && $phoneNo !== null && $email !== null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->get();
            }else{
                $results = Client::where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 10
        if ($firstName === null && $id !== null && $phoneNo !== null && $email === null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('id', $id)
                ->where('phone_no', $phoneNo)
                ->get();
            }else{
                $results = Client::where('id', $id)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 11
        if ($firstName === null && $id !== null && $phoneNo === null && $email !== null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('id', $id)
                ->where('email', $email)
                ->get();
            }else{
                $results = Client::where('id', $id)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }

        // Case 12
        if ($firstName === null && $id !== null && $phoneNo === null && $email === null) {
            if ($registeredFrom === null && $registeredTo === null) {
            $results = Client::where('id', $id)
                ->get();
            }else{
                $results = Client::where('id', $id)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
            }
        }



        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found','status_code' => 404], 404);
        }


        return response()->json(['data' => $results, 'status_code' => 200]);
    }
    public function index()
    {
        $clients = Client::all();
        $data = [];

        foreach ($clients as $client) {
            $user = User::where('parent_id', $client->id)
                        ->orWhere('client_id', $client->id)
                        ->first();
        
            // Assign status to client
       
            $contactCount = User::whereNull('parent_id')
            ->where('client_id', $client->id)
            ->count();
            $beneficiariesCount = Beneficiary::where('client_id', $client->id)->count();
            // Push client data to the array
            $data[] = [
                'client_code ' => $client->id,
                'status' => $user->status,
                'client_name' => $client->first_name.' '.$client->last_name,
                'no_of_contact' => $contactCount,
                'phone_no' => $client->phone_no,
                'spot' => null,
                'forward'=> null,
                'beneficiary' => $beneficiariesCount,
                'spot trading' =>null,
                'forward trading' => null,
                'kyc status' => null,
                'customer type' => 'Business',
                'registered on' => $client->created_at,
           

            ];
        }
        
        // Return response with the data
        return response()->json(['data' => $data, 'status_code' => 200]);
    }
    public function show($id)
    {

        $client = Client::findOrFail($id);
        if ($client) {
            $paymentType = $paymentType = DB::table('payment_types')->where('id', $client->payment_type_id)->first();
            $client->payment_type = $paymentType->value;
            $category = DB::table('categories')->where('id', $client->category_id)->first();
            $client->category = $category->value;
            $subCategory = DB::table('sub_categories')->where('id', $client->subcategory_id)->first();
            $client->subcategory = $subCategory->value;
            $Fx_requirement = ClientFxRequirement::where('client_id', '=', $client->id)->first();

            $paymentPerMonth = DB::table('payment_per_months')->where('id', $Fx_requirement->payment_per_month_id)->first();
            $client->payment_per_month = $paymentPerMonth->value;
            $paymentSchedule = DB::table('payment_schedules')->where('id', $Fx_requirement->payment_schedule_id)->first();
            $client->payment_schedule = $paymentSchedule->value;

            $priceRange = DB::table('price_ranges')->where('id', $Fx_requirement->price_range_id)->first();
            $client->price_range = $priceRange->value;

            $medium = DB::table('mediums')->where('id', $Fx_requirement->medium_id)->first();
            $client->medium = $medium->value;




            $makingPayments = DB::table('client_fx_requirement_countries_making_payment')
                ->where('client_fx_requirement_id', $Fx_requirement->id)
                ->get();
            $country = [];
            foreach ($makingPayments as $payment) {
                $allCountry = DB::table('countries')->where('id', $payment->country_id)->value('name');
                $country[] = $allCountry;
            }

            $client->makingPaymentsCountry = $country;
        }
        $receivingPayments = DB::table('client_fx_requirement_countries_receiving_payment')
            ->where('client_fx_requirement_id', $Fx_requirement->id)
            ->get();

        $receiveCountry = [];

        foreach ($receivingPayments as $payment) {
            $allCountryReceive = DB::table('countries')->where('id', $payment->country_id)->value('name');
            $receiveCountry[] = $allCountryReceive;
        }

        $client->receivingPaymentsCountry = $receiveCountry;

        $fundSources = DB::table('client_fx_requirement_fund_source')
            ->where('client_fx_requirement_id', $Fx_requirement->id)
            ->get();

        $fundSourcesData = [];

        foreach ($fundSources as $source) {
            $sourceName = DB::table('funds_sources')->where('id', $source->fund_source_id)->value('value');
            $fundSourcesData[] = $sourceName;
        }

        $client->fundSources = $fundSourcesData;

        $paymentPurposes = DB::table('client_fx_requirement_payment_purpose')
            ->where('client_fx_requirement_id', $Fx_requirement->id)
            ->get();

        $paymentPurposesData = [];

        foreach ($paymentPurposes as $purpose) {
            $purposeName = DB::table('payment_purposes')->where('id', $purpose->payment_purpose_id)->value('value');
            $paymentPurposesData[] = $purposeName;
        }

        $client->paymentPurposes = $paymentPurposesData;


        $clientData[] = $client;
        unset($clientData['category_id'], $clientData['payment_type_id'], $clientData['subcategory_id']); // Remove the specified fields from the array
       
        return response()->json(['data' => $clientData, 'status_code' => 200], 200);
    }
}
