<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Offers</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    </head>
    <body>


        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach

                </ul>

                </div>
            </div>
        </nav>


        <div class = 'container mt-5'>
            <div>
                <h1>{{__('messages.Add New Offers')}}</h1>
            </div>

            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
            @endif
            {{--<form method = "POST" action = "{{url('offers/store')}}"> url (without name())--}}
            <form method = "POST" action="{{route('offers.store')}}" enctype="multipart/form-data">

            <!-- To protect if method post  (middleware)-->
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <!-- or -->
            @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Image')}}</label>
                    <input type="file" class="form-control" name="image" aria-describedby="emailHelp">
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name ar')}}">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" name="name_en" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name en')}}">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label" >{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price" placeholder ="{{__('messages.Enter Price')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" placeholder ="{{__('messages.Enter details ar')}}">
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                    <input type="text" class="form-control" name="details_en" placeholder ="{{__('messages.Enter details en')}}">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{__('messages.Submit')}}</button>
            </form>
        </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
