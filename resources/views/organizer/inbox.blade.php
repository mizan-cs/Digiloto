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
                            <ul style="min-height:100%;max-height: 380px; margin-bottom: 10px; overflow: scroll; -webkit-overflow-scrolling: touch;" class="list-group">
                                @foreach($rooms as $room)
                                    <a href="{{route('organizer.message.show',$room)}}">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            @if($room->sender->id == Auth::user()->id)
                                                {{$room->receiver->name}}
                                            @else
                                                {{$room->sender->name}}
                                            @endif

                                            {{--@if($room->unseen_messages->count())--}}
                                            {{--<span class="badge badge-primary badge-pill">14</span>--}}
                                            {{--@else--}}
                                            {{--<span class="badge badge-primary badge-pill">14</span>--}}
                                            {{--@endif--}}
                                        </li>
                                    </a>
                                @endforeach

                            </ul>
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