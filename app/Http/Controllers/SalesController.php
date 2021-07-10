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
            $val->total = $val->salesDetail->sum("sub_total");
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
            $sales->total = $sales->salesDetail->sum("sub_total");
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
                "customer_id" => "required|exists:App\Models\Customer,id",
                "date" => "required|date_format:Y-m-d H:i:s",
                "detail.*.item_id" => "required|exists:App\Models\Item,id|distinct",
                "detail.*.qty" => "required|integer",
                "detail.*.price" => "required|integer"
            ];
            $valid = Validator::make($request->all(), $valid_arr);
            if ($valid->fails())
                throw new \ValidationException($valid);

            $sales = Sales::create([
                "customer_id" => $request->customer_id,
                "date" => $request->date
            ]);
            $sales_detail = [];
            foreach($request->detail as $val){
                $sales_detail[] = SalesDetail::create([
                    "sales_id" => $sales->id,
                    "item_id" => $val['item_id'],
                    "qty" => $val['qty'],
                    "price" => $val['price']
                ]);
            }
            $sales->sales_detail = $sales_detail;
            $res = [
                "status" => "success",
                "message" => "Create Sales success",
                "response" => $sales
            ];
            \DB::commit();
            return response($res);
        } catch (\Throwable $e) {
            \DB::rollback();
            throw $e;
        }
    }
}
