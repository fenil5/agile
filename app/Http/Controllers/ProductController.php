<?php

namespace App\Http\Controllers;
use App\Color;
use App\Product;
use Illuminate\Http\Request;
use DB;
use Storage;
class ProductController extends Controller
{
    //
    public function add_product(){
        $Color=Color::get();
        return view('/add_product')->with(['Color'=>$Color]);;
        
    }
    public function add_product_ajax(Request $request){
         // print_r($request->json); die;
          $foldername="images";
          foreach($request->json as $key=>$file){  
            Product::insert( [
                'Name'=>  $file['name'],
                'Color'=>  $file['color'],
                'Description'=>  $file['description'],
            ]);
            $id=DB::getPdo()->lastInsertId();
           
             
            $rand = rand();
            $image_parts = explode(";base64,", $file['image']);
            $image_type_aux = explode("image/", $image_parts[0]);

            $image_type = $image_type_aux[1];
            $image = base64_decode($image_parts[1]);

            $name = $rand . '_image_' . time() . "." . $image_type;
            $filePath =  $foldername . "/" . $name;
            Storage::disk('local')->put($filePath, $image);
            
            Product::where('id', $id)->update(['Image' => $name]);
            
        }
        return 1;
    }
}
