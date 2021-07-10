<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sales;
use App\Models\SalesDetail;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sales::orderBy("date", "desc")->get();
        foreach($sales as $val){
            $val->customer = $val->customer;
            $val->sales_detail = $val->salesDetail;
        }
        $res = [
            "status" => "success",
            "message" => "Get Sales list success",
            "response" => $sales
        ];

        return response($res);
    }
    public function detail($id)
    {
        $sales = Sales::find($id);
        if($sales == null)
            throw new \ModelNotFoundException("Sales not found.");
        else {
            $sales->customer = $sales->customer;
            $sales->sales_detail = $sales->salesDetail;
            $res = [
                "status" => "success",
                "message" => "Get Sales success",
                "response" => $sales
            ];
        }

        return response($res);
    }
    public function create(Request $request)
    {
        try{
            \DB::beginTransaction();
            $valid_arr = [
                "name" => "required",
                "phone" => "required|numeric|unique:App\Models\Sales,phone",
                "address" => "required",
                //"foo.*.id" => "distinct"
                //"foo.*.id" => "unique"
            ];
            $valid = Validator::make($request->all(), $valid_arr);
            if ($valid->fails())
                throw new \ValidationException($valid);

            $sales = Sales::create([
                "phone" => $request->phone,
                "name" => $request->name,
                "address" => $request->address
            ]);
            $res = [
                "status" => "success",
                "message" => "Create Sales success",
                "response" => $sales
            ];
            return response($res);
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
