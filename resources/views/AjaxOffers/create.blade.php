@extends('layouts.app');


@section('content')
    <div class = 'container mt-5'>
        <div>
            <h1>{{__('messages.Add New Offers')}}</h1>
        </div>

        <div class="alert alert-success" id="success_msg" style="display: none">
            تم الحفظ بنجاح
        </div>



        {{--<form method = "POST" action = "{{url('offers/store')}}"> url (without name())--}}
        <form method = "POST" id="offerForm" action="" enctype="multipart/form-data">

            <!-- To protect if method post  (middleware)-->
            {{-- <input name="_token" value="{{csrf_token()}}"> --}}
            <!-- or -->
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Image')}}</label>
                <input type="file" class="form-control" name="image" aria-describedby="emailHelp">

                <small id="image_error" class="form-text text-danger"></small>

            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                <input type="text" class="form-control" name="name_ar" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name ar')}}">

                <small id="name_ar_error" class="form-text text-danger"></small>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                <input type="text" class="form-control" name="name_en" aria-describedby="emailHelp" placeholder ="{{__('messages.Enter Name en')}}">

                <small id="name_en_error" class="form-text text-danger"></small>

            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" >{{__('messages.Offer Price')}}</label>
                <input type="text" class="form-control" name="price" placeholder ="{{__('messages.Enter Price')}}">

                <small id="price_error" class="form-text text-danger"></small>

            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" class="form-control" name="details_ar" placeholder ="{{__('messages.Enter details ar')}}">

                <small id="details_ar_error" class="form-text text-danger"></small>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" class="form-control" name="details_en" placeholder ="{{__('messages.Enter details en')}}">

                <small id="details_en_error" class="form-text text-danger"></small>

            </div>

            <button id="save_offer" class="btn btn-primary">{{__('messages.Submit')}}</button>
        </form>
    </div>
    @stop


@section('script')
    <script>
        $(document).on('click','#save_offer',function (e){
            e.preventDefault();



            {{--{--}}
            {{--    '_token' : "{{csrf_token()}}",--}}
            {{--    //'image' : $("input[name = 'image']").val(),--}}
            {{--    'name_ar' : $("input[name = 'name_ar']").val(),--}}
            {{--    'name_en' : $("input[name = 'name_en']").val(),--}}
            {{--    'price' : $("input[name = 'price']").val(),--}}
            {{--    'details_ar' : $("input[name = 'details_ar']").val(),--}}
            {{--    'details_en' : $("input[name = 'details_en']").val(),--}}
            {{--}--}}



            //enctype: 'multipart/form-data',  //to upload image and file

            //reset fields
            $('#image_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');

            //using FormData instead of using fields by name (Up)
            let formDate = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{route('ajax.offer.store')}}',
                data: formDate,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if(data.status === true){
                        $("#success_msg").show();
                    }
                },error:function(reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        })




    </script>
    @stop
