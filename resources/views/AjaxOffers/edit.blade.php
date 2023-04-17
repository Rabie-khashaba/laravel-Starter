@extends('layouts.app')

@section('content')
    <div class = 'container mt-5'>
        <div>
            <h1>{{__('messages.edit New Offers')}}</h1>
        </div>

        <div class="alert alert-success" id="update_msg" style="display: none">
            تم التعديل بنجاح
        </div>


        <form id="offerFormUpdate" method="POST" action= "">

            <!-- To protect if method post  (middleware)-->
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <!-- or -->
            @csrf

            <input type="text"  style="display: none" class="form-control" name="offer_id" value="{{$offer -> id}}" aria-describedby="emailHelp" placeholder ="{{__('messages.offer id')}}">


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Image')}}</label>
                <input type="file" class="form-control" name="image" value="{{$offer -> image}}" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name ar')}}">
                @error('image')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name ar')}}">
                @error('name_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name en')}}">
                @error('name_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" >{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" name="price" value="{{$offer -> price}}" placeholder ="{{__('messages.Enter Price')}}">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control" name="details_ar" value="{{$offer -> details_ar}}" placeholder ="{{__('messages.Enter details ar')}}">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}"  placeholder ="{{__('messages.Enter details en')}}">
                @error('details_en')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="update-offer" class="btn btn-primary">{{__('messages.Submit')}}</button>
        </form>
    </div>
@stop



@section('script')
    <script>
        $(document).on('click','#update-offer',function (e){
            e.preventDefault();

            //using FormData instead of using fields by name (Up)
            let formDate = new FormData($('#offerFormUpdate')[0]);

            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{route('ajax.offers.update')}}',
                data: formDate,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if(data.status === true){
                        $("#update_msg").show();
                    }
                },error:function(reject){
                    if(reject.status === false){
                        alert(reject.msg);
                    }
                }
            });
        })




    </script>
@stop


