<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{

    ///////////////////// one to one /////////////
    public function hasOneRelations(){
        //get Row id = 26 in Table user
        // /App\Models\User::where(id , 26)-> first();
        //or

        //$user = User::find(26);

        // to return two table together
        $user = User::with(['Phone' => function($q){
            $q -> select('code','phone','user_id');
        }])->find(26);

        //return $user -> phone;


        //return  $user-> phone->code;
        return $user -> name;
       return response()->json($user);
    }

    public function hasOneRelationsReverse(){
        //$phone = Phone::find(1);
        //return  $phone ->user;  // return user of this phone
        // make some attributes visible
            //$phone ->makeVisible(['user_id']);
        // make some attributes hidden
            //$phone ->makeHidden(['code']);

        // to return two relations (user , phones)
            $phone = Phone::with(['User' => function($q){
                $q ->select('id' , 'name' , 'email');
            }])->find(1);
        return response()->json($phone);

    }

    public function getUserHasPhone(){
        $user = User::whereHas('phone')->get();  // phone is method in User Table
        return $user;
    }

    public function getUserNotHasPhone(){
        $user = User::whereDoesntHave('phone')->get();
        return $user;
    }

    public function getUserHasPhoneWithCondition(){
        $user = User::whereHas('phone' ,function($q){
            $q -> where('code' , '02'); // return user where his phone is (02)
        })->get();  // phone is method in User Table
        return $user;
    }
    //////////////// End one to one //////////////////


    //////// start one to many ///////////////////////

    public function getHospitalDoctors(){
        $hospital = Hospital::find(1); // Hospital::where(id , 26)-> first();    or // Hospital::first();
       // return $hospital->doctors; // return hospital's doctors

        //$hospital = Hospital::with('doctors')->find(1); //select all the data

        //return response()->json($hospital); // all data
       // return $hospital -> name ;   // hospital name


//        $hospital = Hospital::with(['doctors' => function ($q){
//            $q ->where('id' , 1);
//        }])->find(1); // return doctor where id  = 1



        $hospital = Hospital::with('doctors')->find(1);

        $doctors = $hospital ->doctors;

        foreach ($doctors as $doctor){
            echo $doctor ->name . '<br>';
        } // return doctors name


        // get hospital by doctors

        $doctor = Doctor::find(3);

        return $doctor->hospital ->name;



    }
    public function getHospitalData(){

        $hospitals = Hospital::select('id' ,'name', 'address')->get();

        //return response()->json($hospitals);
        return view('doctors.hospitals' , compact('hospitals'));

    }

    public function  hospitalDoctors($hospital_id){
        $hospital = Hospital::with('doctors')->find($hospital_id);
        $doctors = $hospital -> doctors;


        return view('doctors.doctors' , compact('doctors'));
    }


    public function getHospitalHasDoctors(){
        $hospitals = Hospital::whereHas('doctors')->get();
        return response() -> json($hospitals);
    }

    public function getHospitalHasDoctorsMale(){
        //$hospitals = Hospital::whereHas('doctors', function($q){ // get first one just
        $hospitals = Hospital::with('doctors')->whereHas('doctors', function($q){ // get all doctors male and his hospital
            $q -> where('gender' , 'male');
        })->get();
        return response() -> json($hospitals);
    }

    public function getHospitalNotHasDoctors(){
         return Hospital::whereDoesntHave('doctors')->get();

    }

    //delete hospital with its doctors
    public function deleteHospital($hospital_id){

        // findOrFail(id) ===> check in DB and if not found return error 404
        $hospital = Hospital::find($hospital_id);

        if(!$hospital)
            return abort('404');

        $hospital -> doctors() -> delete();
        $hospital -> delete();

        return redirect()->route('hospitals.all');

    }
    //////// End one to many ///////////////////////


    //////// Start many to many ///////////////////////

    public  function getDoctorServices(){
//        $doctor =  Doctor::find(3);
//        return $doctor->services;

        $doctor =  Doctor::with('services')->find(3);
        $services = $doctor -> services;

        foreach ($services as $service){
            echo $service-> name .'<br>';
        }

    }


    public function getDoctorByServices(){

        $services = Service::with(['doctors'=>function($q){
            $q -> select('doctors.id','name','title');
        }])->find(1);

        return $services;
        //return $services -> doctors; // all data of doctors

    }

    // services of doctor in view
    public function doctorServicesView($doctor_id){
        $doctor = Doctor::with('services')->find($doctor_id);

        $services = $doctor -> services;

        $doctors = Doctor::select('id' , 'name' )->get();
        $allServices = Service::select('id' , 'name' )->get();

        return view('doctors.services',compact('services' ,'doctors' , 'allServices'));
    }


    //save services to doctors

    public function saveServicesToDoctor(Request $request){


        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor)
            return abort('404');
        $doctor ->services()-> attach($request -> servicesIds);  // many to many insert to database
        return 'Success';
    }
    //////// End many to many ///////////////////////
}
