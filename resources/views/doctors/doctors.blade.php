@extends('layouts.app')
@section('content')


    <div class="container">
       <div class="title mb-5">
           <h1>{{__('messages.doctors show')}}</h1>

           <table class="table">
               <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">{{__('messages.Name doctor')}}</th>
                   <th scope="col">{{__('messages.Address doctor')}}</th>
                   <th scope="col">{{__('messages.operations')}}</th>

               </tr>
               </thead>
               <tbody>
               @if(isset($doctors) && $doctors -> count() > 0 )
                   @foreach($doctors as $doctor)
                       <tr>
                           <th scope="row">{{$doctor ->id}}</th>
                           <td>{{$doctor ->name}}</td>
                           <td>{{$doctor ->title}}</td>
                           <td>
                               <a href="{{route('doctor.services',$doctor -> id)}}" class="btn btn-success">{{__('messages.services')}}</a>
                           </td>
                       </tr>
                   @endforeach
               @endif

               </tbody>
           </table>


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

