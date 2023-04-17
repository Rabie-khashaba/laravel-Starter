<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use LaravelLocalization;

class OfferController extends Controller
{


    use OfferTraits;

    public function create(){
        return view('AjaxOffers.create');
    }

    public function store(OfferRequest $request){

        $file_name = $this -> saveImage($request -> image , 'images/offers');


        // insert request value to database
        $offer = Offer::create([
            'image' => $file_name,
            'name_ar' => $request ->name_ar,
            'name_en' => $request ->name_en,
            'price' => $request ->price,
            'details_ar' => $request ->details_ar,
            'details_en' => $request ->details_en,
        ]);

        // return message to success or Error
        if($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);
        else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ',
            ]);
    }


    public function all(){
        $offers = Offer::select(
            'id',
            'image',
            'name_' . LaravelLocalization::getCurrentLocale() . " as name",
            'price',
            'details_' . LaravelLocalization::getCurrentLocale() . " as details",
        )->get();

        return view('AjaxOffers.all' , compact('offers'));
    }

    //Request Contain all data from ajax (_token , id) in variable named #request down
    public function delete(Request $request){

        //check if offer id exists
        $offer = Offer::find($request -> id);  // Offer::where('id', $offer_id)-> first();
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ',
            ]);
        }
        //if exist
        $offer -> delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' => $request -> id,
        ]);

    }


    public function edit(Request $request){

        //search in given table id only
         $offer = Offer::find($request -> offer_id);  // get all the data (related to --> id)

         if(!$offer){
             return response()->json([
                 'status' => false,
                 'msg' => 'هذا العرض غير موجود',
             ]);
         }

        $offer = Offer::select(
            'id',
            'image',
            'name_ar',
            'name_en',
            'price',
            'details_ar',
            'details_en',
        )->find($request -> offer_id);

        return view('AjaxOffers.edit' , compact('offer'));
    }


    public function update(Request $request){

        //return $request;
        //check if exist data
        $offer = Offer::find($request -> offer_id);
        if(!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'لم يتم التعديل',
            ]);
        }

        $offer -> update($request -> all());
        return response()->json([
            'status' => true,
            'msg' => ' تم التعديل بنجاح',
        ]);

    }


}
