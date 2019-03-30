@extends('organizer.game.base')

@section('game-content')
    <div class="container">
        @foreach($game->tickets as $ticket)
            <button type="button" class="btn @if($ticket->is_sold) btn-success @elseif(!$ticket->is_active) btn-danger @else btn-primary @endif btn-primary" data-toggle="modal" data-target="#exampleModal{{$ticket->id}}">
                {{$loop->index+1}}
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Manage Tickets {{$loop->index+1}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="@if($ticket->is_sold) # @else {{ route('organizer.game.dashboard.tickets.update',$ticket) }} @endif">
                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">Tickets Title</label>
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$ticket->title}}" required autofocus @if($ticket->is_sold) disabled @endif>
                                    </div>
                                </div>
                                {{--<div class="form-group row">--}}
                                    {{--<label for="title" class="col-md-4 col-form-label text-md-right">Tickets Status</label>--}}
                                    {{--<div class="col-md-6">--}}
                                            {{--@if($ticket->is_sold)--}}
                                                {{--<button type="button" class="btn btn-secondary disabled">Sold </button>--}}
                                            {{--@elseif(!$ticket->is_active)--}}
                                                {{--<button type="button" class="btn btn-danger disabled">Disabled </button>--}}
                                            {{--@else--}}
                                                {{--<button type="button" class="btn btn-primary disabled" disabled>Waiting for sell </button>--}}
                                            {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">Ticket Price</label>
                                    <div class="col-md-6">
                                        <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $ticket->price}}" required autofocus @if($ticket->is_sold) disabled @endif>
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        @if($ticket->is_sold)

                                        @else
                                            <button type="submit" class="btn btn-primary">
                                                Update Tickets
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>

                        </div>
                        @if($ticket->is_sold)
                            <button type="button" class="btn btn-secondary disabled">Sold Out</button>
                        @elseif($ticket->is_active)
                            <a class="btn btn-warning" href="{{route('organizer.game.dashboard.tickets.disable',$ticket)}}" role="button">Disable This Ticket</a>
                            <a class="btn btn-danger" href="{{route('organizer.game.dashboard.tickets.delete',$ticket)}}" role="button">Delete</a>
                        @else
                            <a class="btn btn-success" href="{{route('organizer.game.dashboard.tickets.enable',$ticket)}}" role="button">Enable This Ticket</a>
                            <a class="btn btn-danger" href="{{route('organizer.game.dashboard.tickets.delete',$ticket)}}" role="button">Delete</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Button trigger modal -->

@endsection