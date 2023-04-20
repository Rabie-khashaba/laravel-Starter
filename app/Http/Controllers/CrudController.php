<?php

namespace App\Http\Controllers;


use App\Events\VideoViewer;
use App\Models\User;
use App\Models\Video;
use App\Scopes\OfferScopes;
use App\Traits\OfferTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Offer;
use App\Http\Requests\OfferRequest;
use LaravelLocalization;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    //contain method (save image)
    use OfferTraits;

    public function getOffer(){
        //return "Hello Fillable";
        // get all the colums in the table offer

        //return Offer::get();
        //to get specific column by select
        return Offer::select('id' , 'name')->get();
    }

    //function to store static value in model Offer

    // public function store(){
    //     // create ==> (insert by model)
    //     Offer::create([
    //         'name' => 'Rabie',
    //         'price' => '6000',
    //         'details' => 'Offer details',

    //     ]);
    // }

    public function create(){
        return view('offers/create');
    }


    public function store(OfferRequest $request){

        //Validate request before inserd to database
            //make([all the data],[ validation rule],[Messages])

       // $rules = $this -> getrules();
        //$messages = $this ->getMessages();
        //$validator = Validator::make($request->all(),$rules,$messages);
        // if($validator ->fails()){
        //     //return $validator ->errors() -> first();
        //     //withErrors -> contain validator
        //     //withInputs -> contain inputs (name , price , ....)
        //     return redirect()->back()->withErrors($validator)->withInputs($request->all());
        // }




        //save photo in folder in laravel

//        $file_extension = $request -> image -> getClientOriginalExtension();
//        $file_name = time().'.'.$file_extension;
//        $path = 'images/offers';
//        $request -> image -> move($path , $file_name);


         // SaveImage == > from Traits Directly
        $file_name = $this -> saveImage($request -> image , 'images/offers');


        // insert request value to database
        Offer::create([
            'image' => $file_name,
            'name_ar' => $request ->name_ar,
            'name_en' => $request ->name_en,
            'price' => $request ->price,
            'details_ar' => $request ->details_ar,
            'details_en' => $request ->details_en,
        ]);

        //With() --> laravel token key (success) in session that moved butween pages
        return redirect()->back()->with(['success' => 'Saved successfully']);
        //return "Saved successfully.";
    }





    // this in Folder Traits ---> OfferTraits

//    protected function saveImage($image , $folder){
//        $file_extension = $image -> getClientOriginalExtension();
//        $file_name = time().'.'.$file_extension;
//        $path = $folder;
//        $image -> move($path , $file_name);
//
//        return $file_name ;
//
//    }






    // protected function getrules(){
    //     return $rules = [
    //         'name' => 'required|max:100|unique:offers,name',
    //         'price' => 'required|numeric',
    //         'details' => 'required',
    //     ];
    // }






    // protected function getMessages(){
    //     return $messages = [
    //         //static message

    //         // 'name.required' => 'Name Is Required',
    //         // 'name.max' =>'Name length Should Not Exceed 255 Character',
    //         // 'name.unique' => 'Name Is Exist Before',
    //         // 'price.required' => 'Price Is Required',
    //         // 'price.numeric' => 'Price Should be Numeric Only',
    //         // 'details.required' => 'Details Is Required',


    //         //Dynamic message accoording to language

    //         'name.required' =>__('messages.offer name required'),
    //         'name.max' =>__('messages.offer name max 100'),
    //         'name.unique' =>__('messages.offer name unique'),
    //         'price.required' =>__('messages.offer price required'),
    //         'price.numeric' =>__('messages.offer price numeric'),
    //         'details.required' =>__('messages.offer details required'),

    //     ];
    // }



    public function getAllOffers(){
        //LaravelLocalization::getCurrentLocale()    --> current language
//        $offers = Offer::select(
//            'id',
//            'image',
//            'price',
//            'name_' . LaravelLocalization::getCurrentLocale() . " as name",
//            'details_' . LaravelLocalization::getCurrentLocale() . " as details",
//
//        )->get(); //return collection of all result


        ############## paginate Result
        $offers = Offer::select(
            'id',
            'image',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . " as name",
            'details_' . LaravelLocalization::getCurrentLocale() . " as details",

        )->paginate(PAGINATION_COUNT);
        //return $offers;

        //return view('offers.all',compact('offers'));

        return view('offers.pagination',compact('offers'));


    }


    public function editOffer($offer_id){

        //Offer::findOrFail($offer_id); // to find and check if id exist , if not exist return error
        //return $offer_id;

        //search in given table id only
        // $offer = Offer::find($offer_id);  // get all the data (related to --> id)

        // if(!$offer){
        //     return redirect()->back();
        // }

        $offer = Offer::select(
            'id',
            'name_ar',
            'name_en',
            'details_ar',
            'details_en',
            'price',
            )->find($offer_id);
        //blade
        return view('offers/edit' , compact('offer'));

    }



    public function updateOffer(OfferRequest $request ,$offer_id){
        //validation
            //OfferRequest $request   (done)

        //check if exist data
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect() -> back();  // stay in last position
        }

        //update
        //Offer::update([
            // 'name_ar' => $request -> name_ar,
            // 'name_en' => $request -> name_en,
        //])

            //or
        $offer -> update($request -> all());
        return  redirect()-> back()->with(['success' => "Updated successfully"]);  //session

    }

    public function  delete($offer_id){

            //check if offer id exists
            $offer = Offer::find($offer_id);  // Offer::where('id', $offer_id)-> first();
            if(!$offer){
                return redirect()->back()->with(['error' => __('messages.offer not exist')]);
            }

            //if exist
            $offer -> delete();
            return  redirect()->route('offers.all')->with(['success' => __('messages.offer is deleted')]);

    }


    public function getVideo(){

       // $user = User::select('name')->get();

        $video = Video::first(); // get first video (table) from DB

        event(new VideoViewer($video));    //fire event
        return view('video') -> with('video' , $video);

    }



    /// inActive Offers

    public function getAllInactiveOffers(){
        // where  whereNull whereNotNull whereIn
        //Offer::whereNotNull('details_ar') -> get();

        //return Offer::inactive()->get(); // where('status' , 0);

        //return Offer::inValid()->get(); // where('status',0)->whereNull('details_ar');

        //                           global scope
        //return  $inactiveOffers = Offer::get();  //all inactive offers

        // how to  remove global scope

        return $offer  = Offer::withoutGlobalScope(OfferScopes::class)->get();
    }


}








