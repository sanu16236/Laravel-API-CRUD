<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\FlareClient\Api;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $response = APIHelpers::createAPIResponse(false,200,"",$products);
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product_save = $product->save();
        if($product_save){
            $response = APIHelpers::createAPIResponse(false,200,'Product Added Successfully','');
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Product Not Added','');
        }
        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $response = APIHelpers::createAPIResponse(false,200,'',$product);
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product_update = $product->save();
        if($product_update){
            $response = APIHelpers::createAPIResponse(false,200,'Product updated Successfully','');
        }else{
            $response = APIHelpers::createAPIResponse(true,400,'Product Not updated','');
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p_found = $product = Product::find($id);
        if($p_found){
            $product_delete = $product->delete();
            if($product_delete){
                $response = APIHelpers::createAPIResponse(false,200,'Product deleted successfully','');

            }else{
                $response = APIHelpers::createAPIResponse(true,400,'Product not deleted','');
            }
        }else{
            $response = APIHelpers::createAPIResponse(true,404,"data not found",'');
        }

        return $response;
    }
}
