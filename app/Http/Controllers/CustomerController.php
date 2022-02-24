<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $customers = Customer::all();
        if($request->has('raw')) return $customers;
        return response($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate($this->getValidationRules());

        $newCustomer = Customer::create($request->all());

        if($newCustomer) return response($newCustomer,201);

        return response(json_encode(["message"=>"Couldn't create new customer",500]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request = NULL)
    {
        //
        $customer = Customer::find($id);
        if(!$customer){
            return response(json_encode(["message"=>"Invalid Customer Id"]),400);
        }

        if(isset($request) && $request->has('raw')) return $customer;

        return response($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validation = $request->validate($this->getValidationRules());

        $customer = Customer::find($id);

        if(!$customer) 
        {
            if($request->has('raw')) return false;
            return response(json_encode(["message"=>"Invalid customer id"]),400);
        }

        $saveResult = $customer->update($request->all());

        if($saveResult) {
            if($request->has('raw')) return true;
            return response(json_encode(["message" => "Customer updated successfully"]),200);
        }

        if($request->has('raw')) return false;
        return response(json_encode(["message" => "Something went wrong"]),500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //

        $deleteResponse = Customer::destroy($id);

        if($deleteResponse){
            if($request->has('raw')) return true;
             return response(json_encode(["message"=>"Customer record deleted"]),200);
        }

        if($request->has('raw')) return false;
        return response(json_encode(["message"=>"Something went wrong"]),500);
    }

    public function getValidationRules(){
        return [
            'name' => 'required|string',
            'dob' => 'required|date',
            'company' => 'required|string'
        ];
    }
}
