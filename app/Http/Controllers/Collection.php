<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class Collection extends Controller
{
    //

    public function indexCollection(){
//        $numbers = [1,2,3,4,5];
//        $col = collect($numbers);
//        return $col->avg();

//        $name = collect(['name' , 'age']);
//        $result = $name ->combine(['Ali','20']);
//        return $result;


//        $age = collect([1,2,3,4,5]);
//        return $age -> count();

//        $age = collect([1,2,3,3,4,5,5]);
//        return $age -> countBy();

        $age = collect([1,2,3,3,4,5,5]);
        return $age -> duplicates();


        //important methods
        /// - each     -can remove ,add ,...
        /// - filter
        /// - search
        /// - transform

    }


    public function complex(){
        $categories = Category::get();
        // return $categories;
        $categories ->each(function ($category){
//            unset($category -> translation_lang);  //unset --> remove key
//            unset($category -> translation_of);
//            $category -> name = 'Rabie';
//            return $category;

        });

        return$categories;
    }

    public function complexFilter(){ // return one key with value in array of object
        $categories = Category::get();
        $categories = collect($categories);
        $result = $categories -> filter(function ($value ,  $key){
            return $value['translation_lang'] == 'ar';
        });

       // return $result;  return key , value
        // - all convert to array
       return array_values($result ->all());
    }

    public function complexTransform(){ // used in ex , Sending Api
        $categories = Category::get();
        $categories = collect($categories);
        $result = $categories -> transform(function ($value ,  $key){
           // return 'name is ' . $value['name'];

            $data = [];
            $data['name'] = $value['name'];
            $data['age'] = 30;
            return $data;
        });

        return ($result);
    }
}

