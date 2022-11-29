<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;

class ProductController extends Controller
{
    public function index(){
           $product = Product::all();   

          $Image = Image:: get();
 
              
        return view("welcome",compact("product", "Image"));
    }
    public function store_product(Request $request ){ 

        $request->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|numeric',
            'product_description' => 'required',
            'product_img' =>  'required', 
        ]);

        $product = New Product; 
        $product->product_name = $request->product_name;
        $product->product_number = $request->product_number;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price; 
        $product->product_quantity = $request->product_quantity;
        $product->product_description = $request->product_description;  
        $product->save();
         $productId =  $product->id;
        $product = $request->file('product_img');
        if($request->file('product_img')){

       
       foreach($product as $productSubImage){
           $subImageName =$productSubImage->getClientOriginalName();
           $subImageDirectory = 'product_img/';
           $productSubImage->move($subImageDirectory,$subImageName);
           $subImageUrl =$subImageDirectory.$subImageName;

           $subImage = new Image();
           $subImage->product_id =$productId;
           $subImage->product_img = $subImageUrl;
           $subImage->save();
       } 
    }
  
        return back()->with('store_product', 'Product Added Successfully');
     
    }
    public function update_product(Request $request ){  
        $request->validate([
            'product_name' => 'required',
            'product_category' => 'required',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|numeric',
            'product_description' => 'required', 
        ]);

        $product = Product::find($request->product_id); 
        $product->product_name = $request->product_name;
        $product->product_number = $request->product_number;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price; 
        $product->product_quantity = $request->product_quantity;
        $product->product_description = $request->product_description;  
        $product->Update();

        $productId =  $product->id; 
        $product = $request->file('product_img');
        if($request->file('product_img')){
       foreach($product as $productSubImage){
           $subImageName =$productSubImage->getClientOriginalName();
           $subImageDirectory = 'product_img/';
           $productSubImage->move($subImageDirectory,$subImageName);
           $subImageUrl =$subImageDirectory.$subImageName;

           $subImage = new Image();
           $subImage->product_id =$productId;
           $subImage->product_img = $subImageUrl;
           $subImage->save();
       } }
  
        return back()->with('update_product', 'Product Update Succsessfully');
     
    }
     
    
    public function product_delete($id ){
        $product = Product::find($id);
        
        $product->delete();
        return back()->with('product_delete', 'Product Deleted Succsessfully');
    }
    public function img(Request $request){
          
        $img = Image::find($request->id)->delete();
        return response()->json(['success'=>'Product Deleted Succsessfully.']);
    }
    public function fetchImg(Request $request){
        
        $data["images"] = Image::where("product_id",$request->id)->get();
        return response()->json($data);
  }
  public function delete_permanently(){
     Product::whereNotNull('deleted_at')->forceDelete();
    return "All softDeletes Are Deleted Permanently";
  }
}