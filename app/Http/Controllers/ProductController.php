<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=products::all();
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $input =$request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'detail'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['please verify your input'], 400);
        }
        else{
            products::create([
                'name'=>$request->name,
                'detail'=>$request->detail,
            ]);
            return response()->json(['product created successfully'], 200);
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input =$request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'detail'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['please verify your input'], 400);
        }
        else{
            products::create([
                'name'=>$request->name,
                'detail'=>$request->detail,
            ]);
            return response()->json(['product created successfully'], 200);
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
        $product=products::find($id);
        if(is_null($product)){
            return response()->json('product not found', 200);
        }else{
            return response()->json([$product], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $product)
    {
        $data = $request->all();
        $product -> name=$data['name'];
        $product ->detail=$data['detail'];
        $product->save();
        return response()->json('product updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(products $product)
    {
        //$id= $request->id;
       // $product=products::find($id);
        $product->delete();
        return response()->json('deleted :)', 200);
        }
}
