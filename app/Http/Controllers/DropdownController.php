<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DropdownController extends Controller
{
    //
    public function index()
    {
        // Fetch dropdown values from the payment_per_months table using the DB facade
        $dropdownValues = DB::table('payment_per_months')->select('value', 'id')->get();

        // Return the dropdown values as JSON response
        return response()->json([
            'data' => $dropdownValues,
            'status code' => 200
        ]);
    }

    public function PaymentSchedule()
    {
        // Fetch data from the payment_schedules table using the DB facade and pluck only id and value columns
        $paymentSchedules = DB::table('payment_schedules')->select('value', 'id')->get();

        // Return the data as JSON response
        return response()->json([
            'data' => $paymentSchedules,
            'status_code' => 200
        ]);
    }
    public function payment_types(){
        $paymentTypes = DB::table('payment_types')->select('value', 'id')->get();

        return response()->json(['data' => $paymentTypes, 'status_code' => 200]);
    }
    public function categories()
    {
        $categories = DB::table('categories')->select('value', 'id')->get();

       

        return response()->json(['data' => $categories, 'status_code' => 200]);
    }
    public function subCategories()
    {
        $subcategories = DB::table('sub_categories')->select('id', 'category_id', 'value')->get();
    

        return response()->json(['data' => $subcategories, 'status_code' => 200]);
    }
    public function paymentPurposes()
    {
        $paymentPurposes = DB::table('payment_purposes')->select('value', 'id')->get();

       

        return response()->json(['data' => $paymentPurposes, 'status_code' => 200]);
    }
    public function currencies()
    {
        $currencies = DB::table('currencies')->select('id', 'code', 'name')->get();
        

        return response()->json(['data' => $currencies, 'status_code' => 200]);
    }
    public function fundSources()
    {
        $fundSources = DB::table('funds_sources')->select('value', 'id')->get();

        return response()->json(['data' => $fundSources, 'status_code' => 200]);
    }
    public function priceRanges()
    {
        $priceRanges = DB::table('price_ranges')->select('value', 'id')->get();

        

        return response()->json(['data' => $priceRanges, 'status_code' => 200]);
    }
    public function countries()
    {
        $countries = DB::table('countries')->select('name', 'id')->get();

       
        return response()->json(['data' => $countries, 'status_code' => 200]);
    }
    public function mediums()
    {
        $mediums = DB::table('mediums')->select('value', 'id')->get();

      

        return response()->json(['data' => $mediums, 'status_code' => 200]);
    }

    public function BasedSubCategories($category_id)
    {
        $subcategories = DB::table('sub_categories')
        ->where('category_id', $category_id)->select('id','value')
        ->get();


        return response()->json(['data' => $subcategories, 'status_code' => 200]);
    }
    public function getAllPhoneCode()
    {
        $phone_code = DB::table('phone_country_codes')->select('phone_country_code')->get();


        return response()->json(['data' => $phone_code, 'status_code' => 200]);
    }
    public function getCurrencyCode(){
        $currencyCode = DB::table('currencies')->select('code')->get();

        
        return response()->json(['data' => $currencyCode, 'status_code' => 200]);
    }
}
