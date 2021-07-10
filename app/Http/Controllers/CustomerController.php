<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $item = Customer::orderBy("name")->get();
        $res = [
            "status" => "success",
            "message" => "Get Customer list success",
            "response" => $item
        ];

        return response($res);
    }
    public function detail($id)
    {
        $item = Customer::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Customer not found.");
        else {
            $res = [
                "status" => "success",
                "message" => "Get Customer success",
                "response" => $item
            ];
        }

        return response($res);
    }
    public function create(Request $request)
    {
        $valid_arr = [
            "name" => "required",
            "phone" => "required|numeric|unique:App\Models\Customer,phone",
            "address" => "required"
        ];
        $valid = Validator::make($request->all(), $valid_arr);
        if ($valid->fails())
            throw new \ValidationException($valid);

        $item = Customer::create([
            "phone" => $request->phone,
            "name" => $request->name,
            "address" => $request->address
        ]);
        $res = [
            "status" => "success",
            "message" => "Create Customer success",
            "response" => $item
        ];
        return response($res);
    }
    public function update(Request $request, $id)
    {
        $valid_arr = [
            "name" => "required",
            "phone" => "required|numeric|unique:App\Models\Customer,phone,{$id},id",
            "address" => "required"
        ];
        $valid = Validator::make($request->all(), $valid_arr);
        if ($valid->fails())
            throw new \ValidationException($valid);

        $item = Customer::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Customer not found.");
        else{
            $item->update([
                "phone" => $request->phone,
                "name" => $request->name,
                "address" => $request->address
            ]);
            $res = [
                "status" => "success",
                "message" => "Update Customer success",
                "response" => $item
            ];
        }
        return response($res);
    }
    public function delete($id)
    {
        $item = Customer::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Customer not found.");
        else {
            $item->delete();
            $res = [
                "status" => "success",
                "message" => "Delete Customer success",
                "response" => $item
            ];
        }

        return response($res);
    }
}
