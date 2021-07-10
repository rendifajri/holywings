<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::orderBy("code")->get();
        $res = [
            "status" => "success",
            "message" => "Get Item list success",
            "response" => $item
        ];

        return response($res);
    }
    public function detail($id)
    {
        $item = Item::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Item not found.");
        else {
            $res = [
                "status" => "success",
                "message" => "Get Item success",
                "response" => $item
            ];
        }

        return response($res);
    }
    public function create(Request $request)
    {
        $valid_arr = [
            "code" => "required|unique:App\Models\Item,code",
            "name" => "required",
            "price" => "required|integer"
        ];
        $valid = Validator::make($request->all(), $valid_arr);
        if ($valid->fails())
            throw new \ValidationException($valid);

        $item = Item::create([
            "code" => $request->code,
            "name" => $request->name,
            "price" => $request->price
        ]);
        $res = [
            "status" => "success",
            "message" => "Create Item success",
            "response" => $item
        ];
        return response($res);
    }
    public function update(Request $request, $id)
    {
        $valid_arr = [
            "code" => "required|unique:App\Models\Item,code,{$id},id",
            "name" => "required",
            "price" => "required|integer"
        ];
        $valid = Validator::make($request->all(), $valid_arr);
        if ($valid->fails())
            throw new \ValidationException($valid);

        $item = Item::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Item not found.");
        else{
            $item->update([
                "code" => $request->code,
                "name" => $request->name,
                "price" => $request->price
            ]);
            $res = [
                "status" => "success",
                "message" => "Update Item success",
                "response" => $item
            ];
        }
        return response($res);
    }
    public function delete($id)
    {
        $item = Item::find($id);
        if($item == null)
            throw new \ModelNotFoundException("Item not found.");
        else {
            $item->delete();
            $res = [
                "status" => "success",
                "message" => "Delete Item success",
                "response" => $item
            ];
        }

        return response($res);
    }
}
