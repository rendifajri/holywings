<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $item = Promo::orderBy("code")->get();
        $res = [
            "status" => "success",
            "message" => "Get Promo list success",
            "response" => $item
        ];

        return response($res);
    }
    public function detail($id)
    {
        $item = Promo::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Promo not found.");
        else {
            $res = [
                "status" => "success",
                "message" => "Get Promo success",
                "response" => $item
            ];
        }

        return response($res);
    }
    public function create(Request $request)
    {
        $valid_arr = [
            "code" => "required|unique:App\Models\Promo,code",
            "name" => "required",
            "discount_percent" => "required|integer|min:1|max:100",
            "min_amount" => "required|integer",
            "status" => "required|integer|in:1,0",
        ];
        $valid = Validator::make($request->all(), $valid_arr);
        if ($valid->fails())
            throw new \ValidationException($valid);

        $item = Promo::create([
            "code" => $request->code,
            "name" => $request->name,
            "discount_percent" => $request->discount_percent,
            "min_amount" => $request->min_amount,
            "status" => $request->status
        ]);
        $res = [
            "status" => "success",
            "message" => "Create Promo success",
            "response" => $item
        ];
        return response($res);
    }
    public function update(Request $request, $id)
    {
        $valid_arr = [
            "code" => "required|unique:App\Models\Promo,code,{$id},id",
            "name" => "required",
            "discount_percent" => "required|integer|min:1|max:100",
            "min_amount" => "required|integer",
            "status" => "required|integer|in:1,0",
        ];
        $valid = Validator::make($request->all(), $valid_arr);
        if ($valid->fails())
            throw new \ValidationException($valid);

        $item = Promo::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Promo not found.");
        else{
            $item->update([
                "code" => $request->code,
                "name" => $request->name,
                "price" => $request->price,
                "discount_percent" => $request->discount_percent,
                "min_amount" => $request->min_amount,
                "status" => $request->status
            ]);
            $res = [
                "status" => "success",
                "message" => "Update Promo success",
                "response" => $item
            ];
        }
        return response($res);
    }
    public function delete($id)
    {
        $item = Promo::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Promo not found.");
        else {
            $item->delete();
            $res = [
                "status" => "success",
                "message" => "Delete Promo success",
                "response" => $item
            ];
        }

        return response($res);
    }
}
