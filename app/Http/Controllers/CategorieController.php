<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\Response as FacadeResponse;

class CategorieController extends Controller
{
    //
    public function getAllCategorie() {
      	$categorie = Categories::paginate(5)->toJson(JSON_PRETTY_PRINT);
    	return response($categorie, 200);
    }

    public function createCategorie(Request $request) {
      // logic to create a categorie record goes here
    	$validator = Validator::make($request->json()->all(), [
            'categorie_name' => 'required',
            'categorie_parent' => 'required',
            'status' => 'required',

        ]);
		if($validator->fails()){
    		return FacadeResponse::json(
    			[
        			"message" => $validator->errors()->getMessages()
    			], 400
    		);
        } else {
	    	$categorie = new Categories;
		    $categorie->categorie_name = $request->categorie_name;
		    $categorie->categorie_parent = $request->categorie_parent;
		    $categorie->status = $request->status;
		    $categorie->save();

	    return response()->json([
	        	"message" => "Categorie record created"
	    	], 201);
		}
    }

    public function getCategorie($id) {
      // logic to get a categorie record goes here
    	if (Categories::where('id', $id)->exists()) {
        $categorie = Categories::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($categorie, 200);
      } else {
        return response()->json([
          "message" => "Categories not found"
        ], 404);
      }
    }
    public function getCategorieNameSearch($categorie_name) {
      // logic to get a categorie record goes here
      if (Categories::where('categorie_name', $categorie_name)->exists()) {
        $categorie = Categories::where('categorie_name', $categorie_name)->get()->toJson(JSON_PRETTY_PRINT);
        return response($categorie, 200);
      } else {
        return response()->json([
          "message" => "Categories not found"
        ], 404);
      }
    }

    public function updateCategorie(Request $request, $id) {
      // logic to update a categorie record goes here
    	$validator = Validator::make($request->json()->all(), [
            'categorie_name' => 'required',
            'categorie_parent' => 'required',
            'status' => 'required',

        ]);
		if($validator->fails()){
    		return FacadeResponse::json(
    			[
        			"message" => $validator->errors()->getMessages()
    			], 400
    		);
        } else {
		    if (Categories::where('id', $id)->exists()) {
		        $categorie = Categories::find($id);
		        $categorie->categorie_name = is_null($request->categorie_name) ? $categorie->categorie_name : $request->categorie_name;
		        $categorie->categorie_parent = is_null($request->categorie_parent) ? $categorie->categorie_parent : $request->categorie_parent;
		        $categorie->status = is_null($request->status) ? $categorie->status : $request->status;
		        $categorie->save();

		        return response()->json([
		            "message" => "records updated successfully"
		        ], 200);
		    } else {
		        return response()->json([
		            "message" => "Categories not found"
		        ], 404);
	        }
	    }
    }

    public function deleteCategorie($id) {
      // logic to delete a categorie record goes here
    	if(Categories::where('id', $id)->exists()) {
        $categorie = Categories::find($id);
        $categorie->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Categories not found"
        ], 404);
      }
    }
}
