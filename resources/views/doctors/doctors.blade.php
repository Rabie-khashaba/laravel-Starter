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
                   <th scope="col">{{__('messages.gender')}}</th>
                   <th scope="col">{{__('messages.operations')}}</th>

               </tr>
               </thead>
               <tbody>
               @if(isset($doctors) && $doctors -> count() > 0)
                   @foreach($doctors as $doctor)
                       <tr>
                           <th scope="row">{{$doctor ->id}}</th>
                           <td>{{$doctor ->name}}</td>
                           <td>{!!$doctor ->title!!}</td>
                           <td>{!!$doctor ->gender!!}</td>
                           <td>
                               <a href="#" class="btn btn-danger">{{__('messages.delete')}}</a>
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
