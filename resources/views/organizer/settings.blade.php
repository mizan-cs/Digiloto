@extends('organizer.base')

@section('content')
@if($organizer)
<div class="container-fluid">
    <div class="col-md-12">
        <form method="POST" action="{{route('organizer.update')}}" enctype="multipart/form-data">
           @csrf
           <div class="row">
            <div class=" col-md-4 ">
                <h3 class="h3">{{ $organizer->logo ? 'Change Logo' : 'Add Logo' }}</h3>
                <img class="img-thumbnail" src="{{$organizer->logo ? asset('images/'.$organizer->logo) : 'https://via.placeholder.com/200'}} " style="height: 200px !important;width:100% !important " alt="Card image cap">

                <input type="file" class="" value="{{$organizer->logo}}" name="logo">

            </div>
            <div class="col-md-8">
                <h3  class="h3">{{ $organizer->banner ? 'Change Banner' : 'Add Banner' }}</h3>
                <img class="img-thumbnail img-fluid" style="height: 200px !important;width:100% !important " src="{{$organizer->banner ? asset('images/'.$organizer->banner) : 'https://via.placeholder.com/400X200'}}" alt="Card image cap">
                <input type="file" class="" value="{{$organizer->banner}}" name="banner">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="title">Change Title</label>
                    <input type="text" class="form-control" value="{{$organizer->title}}" name="title">
                </div>

                <div class="form-group">
                    <label for="title">Change Email</label>
                    <input type="email" class="form-control" value="{{$organizer->email}}" name="email">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="title">Change Details</label>
                    <textarea name="details" id=""  cols="80" rows="5">{{$organizer->details}}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-info">Update</button>
        </form>
    </div>
</div><!--.container-fluid-->
</div>
@endif
@endsection