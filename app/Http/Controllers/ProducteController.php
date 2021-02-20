<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\Response as FacadeResponse;

class ProducteController extends Controller
{
    //
    public $stat;
    public $code;
    public $messages = array();
    public function getAllProduct() {
      	$product = Products::paginate(5)->toJson(JSON_PRETTY_PRINT);
    	return response($product, 200);
    }

    public function createProduct(Request $request) {
        $validator = Validator::make($request->json()->all(), [
            'product_name' => 'required',
            'product_description' => 'required',
            'categorie' => 'required',
            'status' => 'required',

        ]);
		if($validator->fails()){
    		return FacadeResponse::json(
    			[
        			"message" => $validator->errors()->getMessages()
    			], 400
    		);
        } else {
			$Product = new Products;
		    $Product->product_name = $request->product_name;
		    $Product->product_description = $request->product_description;
		    $Product->categorie = $request->categorie;
		    $Product->status = $request->status;
		    $Product->save();
		    return response()->json([
        		"message" => "Categorie record created"
    		], 201);
		}
	}

    public function getProduct($id) {
      // logic to get a Product record goes here
      if (Products::where('id', $id)->exists()) {
        $Product = Products::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($Product, 200);
      } else {
        return response()->json([
          "message" => "Product not found"
        ], 404);
      }
    }

    public function getProductCategorie($categorie_name){
	  // logic to get a Product record goes here
      if (Products::where('categorie', $categorie_name)->exists()) {
        $Product = Products::where('categorie', $categorie_name)->get()->toJson(JSON_PRETTY_PRINT);
        return response($Product, 200);
      } else {
        return response()->json([
          "message" => "Product not found"
        ], 404);
      }
    }

    public function getProductNameSearch($product_name) {
      // logic to get a categorie record goes here
      if (Products::where('product_name', $product_name)->exists()) {
        $categorie = Products::where('product_name', $product_name)->get()->toJson(JSON_PRETTY_PRINT);
        return response($categorie, 200);
      } else {
        return response()->json([
          "message" => "Product not found"
        ], 404);
      }
    }

    public function updateProduct(Request $request, $id) {
      // logic to update a Product record goes here
    	$validator = Validator::make($request->json()->all(), [
            'product_name' => 'required',
            'product_description' => 'required',
            'categorie' => 'required',
            'status' => 'required',

        ]);
		if($validator->fails()){
    		return FacadeResponse::json(
    			[
        			"message" => $validator->errors()->getMessages()
    			], 400
    		);
        } else {
		    if (Products::where('id', $id)->exists()) {
		        $Product = Products::find($id);
		        $Product->product_name = is_null($request->product_name) ? $Product->product_name : $request->product_name;
		        $Product->product_description = is_null($request->product_description) ? $Product->product_description : $request->product_description;
		        $Product->categorie = is_null($request->categorie) ? $Product->categorie : $request->categorie;
		        $Product->status = is_null($request->status) ? $Product->status : $request->status;
		        $Product->save();

		        return response()->json([
		            "message" => "records updated successfully"
		        ], 200);
		    } else {
		        return response()->json([
		            "message" => "Product not found"
		        ], 404);
	        }
	    }
    }

    public function deleteProduct($id) {
      // logic to delete a Product record goes here
    	if(Products::where('id', $id)->exists()) {
        $Product = Products::find($id);
        $Product->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Product not found"
        ], 404);
      }
    }
}
