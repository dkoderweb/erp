<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view("welcome",compact("product"));
    }
    public function store_product(Request $request ){ 
        $product = New Product; 
        $product->product_name = $request->product_name;
        $product->product_number = $request->product_number;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price; 
        $product->product_quantity = $request->product_quantity;
        $product->product_description = $request->product_description;  

        if($request->hasFile('product_img'))
        {
            $names = [];
            foreach($request->file('product_img') as $product_img)
            {
                $destinationPath = 'product_img/';
                $filename = $product_img->getClientOriginalName();
                $product_img->move($destinationPath, $filename);
                array_push($names, $filename);          
        
            }
            $product->product_img = json_encode($names);
        }
        $product->save();
  
        return back()->with('success', 'Data Your files has been successfully added');
     
    }
    public function update_product(Request $request ){ 
        $product = Product::find($request->product_id); 
        $product->product_name = $request->product_name;
        $product->product_number = $request->product_number;
        $product->product_category = $request->product_category;
        $product->product_price = $request->product_price; 
        $product->product_quantity = $request->product_quantity;
        $product->product_description = $request->product_description;  

        if($request->hasFile('product_img'))
        {
            $names = [];
            foreach($request->file('product_img') as $product_img)
            {
                $destinationPath = 'product_img/';
                $filename = $product_img->getClientOriginalName();
                $product_img->move($destinationPath, $filename);
                array_push($names, $filename);          
        
            }
            $product->product_img = json_encode($names);
        }
        $product->Update();
  
        return back()->with('success', 'Data Your files has been successfully added');
     
    }
    public function product_delete($id ){
        $product = Product::find($id);
        
        $product->delete();
        return back()->with('success', 'Data Your files has been successfully added');
    }
}
