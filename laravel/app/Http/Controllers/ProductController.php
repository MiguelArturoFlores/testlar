<?php

namespace testmiguel\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use testmiguel\Http\Requests;
use testmiguel\Product;
use testmiguel\ProductImage;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        return view('uploadProduct');
    }

    public function productUserList(Request $request)
    {
        $products = Product::paginate(30);
        //$orders = DB::table('storeorder')->paginate(2);
        //var_dump($orders);
        $products = $this->calculatePercentageDiscount($products);
        $products = $this->createProductViewList($products);
        return view('productListView', ['productList' => $products]);
    }

    public function detailPromotionProduct(Request $request, $productId)
    {
        if ($productId == '') {
            //TODO return errow view
            echo 'invalid';
            return;
        }
        $product = Product::where('id', $productId)->first();
        if ($product == '') {
            //TODO return errow view
            echo 'invalid';
            return;
        }

        $product->discountPercentage = number_format($product->discount * 100 / $product->price, 1);
        return view('product/productPromotionDetail', ['product' => $product]);
    }

    public function detailProduct(Request $request, $productId)
    {
        if ($productId == '') {
            //TODO return errow view
            echo 'invalid';
            return;
        }
        $product = Product::where('id', $productId)->first();
        if ($product == '') {
            //TODO return errow view
            echo 'invalid';
            return;
        }

        $product->discountPercentage = number_format($product->discount * 100 / $product->price, 1);
        return view('product/productDetail', ['product' => $product]);

    }

    private function calculatePercentageDiscount($productList)
    {
        foreach ($productList as $value) {
            $value->discountPercentage = round($value->discount * 100 / $value->price, 1);
        }

        return $productList;
    }

    private function createProductViewList($productList)
    {
        //$productImagePath = 'http://localhost/store/images/products/';
        $columnNumber = 4;
        $i = 0;
        $j = 0;
        $array = array();
        $innerArray = array();
        foreach ($productList as $value) {
            //$value->image = $productImagePath . $value->image;
            $innerArray[$i] = $value;
            $i++;
            if ($i >= $columnNumber) {
                $i = 0;
                $array[$j] = $innerArray;
                $innerArray = array();
                $j++;
            }
        }
        if ($i > 0) {
            $array[$j] = $innerArray;
        }
        return $array;
    }

    public function uploadProduct(Request $request)
    {

        $file = $request->file('image');

        //Display File Name
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: ' . $file->getMimeType();

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        //TODO take this value from the server
        $product->small_description = $product->description;
        $product->discount = 0;
        $product->has_discount = 0;
        $product->is_new = 0;
        //TODO ---------------------------------
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
        $file->move($destinationPath, $product->image);

        //$product = Product::where('id','=',$product->id)->first();

        foreach ($product->images as $img) {
            echo '<br>';
            echo $img->id . ' ' . $img->extension;
        }
    }
}
