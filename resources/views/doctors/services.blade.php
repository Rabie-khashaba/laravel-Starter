@extends('layouts.app')
@section('content')


    <div class="container">
       <div class="title mb-5">
           <h1>{{__('messages.services')}}</h1>

           <table class="table">
               <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">{{__('messages.services doctor')}}</th>

               </tr>
               </thead>
               <tbody>
               @if(isset($services) && $services -> count() > 0 )
                   @foreach($services as $service)
                       <tr>
                           <th scope="row">{{$service ->id}}</th>
                           <td>{{$service ->name}}</td>
                       </tr>
                   @endforeach
               @endif

               </tbody>
           </table>

           <form method = "POST" action="{{route('save.doctors.services')}}">

               @csrf

               <div class="mb-3">
                   <label for="exampleInputEmail1" class="form-label">{{__('messages.choose doctor')}}</label>
                   <select class="form-control mt-2" name="doctor_id">
                           @foreach($doctors as $doctor)
                               <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                           @endforeach
                   </select>
               </div>

               <div class="mb-3">
                   <label for="exampleInputEmail1" class="form-label">{{__('messages.choose services')}}</label>
                   <select class="form-control mt-2" name="servicesIds[]" multiple>
                           @foreach($allServices as $allService)
                               <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                           @endforeach
                   </select>
               </div>


               <button type="submit" class="btn btn-primary">{{__('messages.Submit')}}</button>
           </form>


       </div>
    </div>

@stop

@section('contentLangs')

    <ul class="navbar-nav mr-auto">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="nav-item active">
                <a class="nav-link"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                    <span class="sr-only">(current)</span></a>
            </li>
        @endforeach
    </ul>
@stop

