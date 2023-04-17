@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="title mb-5">
            {{__('messages.hospital')}}
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.Name hospitals')}}</th>
                <th scope="col">{{__('messages.Address hospitals')}}</th>
                <th scope="col">{{__('messages.operations')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($hospitals) && $hospitals -> count() > 0)
                @foreach($hospitals as $hospital)
                    <tr>
                        <th scope="row">{{$hospital ->id}}</th>
                        <td>{{$hospital ->name}}</td>
                        <td>{!!$hospital ->address!!}</td>
                        <td>
                            <a href="{{route('hospitals.doctors',$hospital -> id)}}" class="btn btn-success">{{__('messages.doctors show')}}</a>
                            <a href="#" class="btn btn-danger">{{__('messages.delete')}}</a>
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
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

