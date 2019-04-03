@extends('organizer.base')

@section('content')
    <div class="container-fluid">
        <div class="bd-example">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inbox</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <div style="min-height: 400px" class="row p-0">
                        <div class="col-md-4 mr-0 pr-0">
                            <div  style="max-height: 475px; min-height: 480px;overflow: scroll" class="nav flex-column nav-pills p-0 text-center" id="v-pills-tab" aria-orientation="vertical">
                                @foreach($rooms as $room)
                                    <a style="border-radius: 0" class="nav-link @if($room->id == $current->id) active @endif mb-2" href="{{route('organizer.message.show',$room)}}" role="tab">
                                        @if($room->sender->id == Auth::user()->id)
                                            {{$room->receiver->name}}
                                        @else
                                            {{$room->sender->name}}
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-8 ml-0 pl-0 border-left-0">
                            @yield('messages')

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection