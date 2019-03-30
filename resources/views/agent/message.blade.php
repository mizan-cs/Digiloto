@extends('agent.inbox')
@section('messages')
    <div class="card">
        <div class="card-header">
            @if($room->sender->id == Auth::user()->id)
                {{$room->receiver->name}}
            @else
                {{$room->sender->name}}
            @endif
        </div>
        <div style="height: 300px" class="card-body">
            @foreach($room->messages as $message)
                <div class="alert @if($message->user->id == Auth::user()->id) alert-primary @else alert-success @endif " role="alert">
                    <span data-notify="title"><strong>{{$message->user->name}}</strong></span>
                    <span data-notify="message">
                        {{$message->message}}
                    </span>
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <form method="post" action="{{route('agent.message.send',$room)}}">
                @csrf
                <textarea style="width: 100%" placeholder="Type Here.." name="message" id="" required></textarea>
                <button type="submit" class="btn btn-primary btn-block">Send</button>
            </form>
        </div>
    </div>
@endsection