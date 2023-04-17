@extends('layouts.app')
@section('content')


    <div class="alert alert-success" id="delete_msg" style="display: none">
        تم الحذف بنجاح
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.Offer details')}}</th>
            <th scope="col">{{__('messages.Offer Image')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>
                @foreach($offers as $offer)
                    <tr class="offerRow{{$offer -> id}}">
                        <th scope="row">{{$offer -> id}}</th>
                        <td>{{$offer -> name}}</td>
                        <td>{{$offer -> price}}</td>
                        <td>{{$offer -> details}}</td>
                        <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->image)}}"></td>
                        <td>
                            <a href="{{url('ajax-offers/edit/'.$offer -> id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
                            <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>
                            <a href="" offer_id="{{$offer -> id}}"  class="delete_btn btn btn-danger"> {{__('messages.deleteAjax')}}</a>
                            <a href="{{route('ajax.offers.edit' , $offer -> id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
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


@section('script')
    <script>
        $(document).on('click','.delete_btn',function (e){
            e.preventDefault();

            //enctype: 'multipart/form-data',  //to upload image and file

            //get attribute of delete_btn  to get id
            var offer_id = $(this).attr('offer_id');

            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{route('ajax.offer.delete')}}',
                data: {
                    '_token' : "{{csrf_token()}}",
                    'id' : offer_id,
                },
                success: function(data) {
                    if(data.status === true){
                        $("#delete_msg").show();
                    }
                    //class of row (offerRow+ id)
                    $('.offerRow'+data.id).remove();

                },error:function(reject){
                    if(reject.status === false){

                    }
                }
            });

        })




    </script>
@stop
