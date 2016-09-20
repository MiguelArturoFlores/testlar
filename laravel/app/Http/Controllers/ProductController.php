<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

use testmiguel\Http\Requests;

use testmiguel\Product;
use testmiguel\ProductImage;

use Auth;

class ProductController extends Controller
{
 
 	public function index(Request $request){
 		
 		return view('uploadProduct');
 	}

 	public function uploadProduct(Request $request){

 		$file = $request->file('image');
   
            //Display File Name
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';
         
            //Display File Extension
            echo 'File Extension: '.$file->getClientOriginalExtension();
            echo '<br>';
         
            //Display File Real Path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';
         
            //Display File Size
            echo 'File Size: '.$file->getSize();
            echo '<br>';
         
            //Display File Mime Type
            echo 'File Mime Type: '.$file->getMimeType();
         
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();

            //update product image
            $product->image = $product->id . '.' . $file->getClientOriginalExtension();
            $product->save();

            $imageProduct = new ProductImage();
            $imageProduct->extension = $file->getClientOriginalExtension();
            $imageProduct->product_id = $product->id;
            $imageProduct->save();

            //Move Uploaded File
            $destinationPath = 'uploads';
            $file->move($destinationPath,$product->image);

            //$product = Product::where('id','=',$product->id)->first();
      
            foreach ($product->images as $img){
                  echo '<br>';
                  echo $img->id . ' ' . $img->extension;
            }

 	}
}
