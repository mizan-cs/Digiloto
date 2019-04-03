@extends('layouts.app')

@section('header')
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <link rel="stylesheet" href="{{asset('css/lib/multipicker/multipicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/separate/vendor/multipicker.min.css')}}">
@endsection

@section('content')
    <div class="container">

            <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_TkVNLwlHUaeKg8uUEzZJcSPw006C1Txz1x"
                    data-amount="999"
                    data-name="Mizanur Rahman"
                    data-description="Example charge"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto">
            </script>


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="container text-center">
                            <img style="max-height: 80px" src="{{asset('images/'.$game->organizer->logo)}}" alt="">
                            <h1 class="jumbotron-heading">{{$game->organizer->title}}</h1>
                            <p>
                                <a href="#" class="btn btn-primary my-2">Go To Operator Page</a>
                            </p>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>Game: {{$game->title}}</h1>
                            <p>Rouls: {{$game->rules}}</p>

                            <div class="row justify-content-md-center">
                                <div class="col-md-8 text-center">
                                    <div class="card mb-4 shadow-sm">
                                        <form method="post" action="{{route('order.create')}}">
                                            @csrf
                                            <div class="card-body">
                                                <div class="btn-group pr-0" data-toggle="buttons">
                                                    <div class="row justify-content-md-center">
                                                        @foreach($game->tickets as $ticket)
                                                            <div class="col-md-1 p-0 mt-2 ml-2">
                                                                <label id="ticket{{$ticket->id}}" class="btn @if($ticket->is_sold) btn-success @elseif(!$ticket->is_active) btn-danger @else btn-secondary @endif  ml-0">
                                                                    <input class="ticket_button" name="tickets[]" value="{{$ticket->id}}" id="ticket{{$ticket->id}}" type="checkbox" autocomplete="off" @if($ticket->is_sold) disabled @endif @if(!$ticket->is_active) disabled @endif> {{$loop->index + 1}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="refer" value="{{$ref}}">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-success btn-block">Next</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header text-center">
                                            Summary
                                        </div>
                                        <form action="">
                                            <div class="card-body">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="Price" aria-label="" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">1 ticket</span>
                                                        <span class="input-group-text">${{$game->tickets[0]->price}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<div class="card-footer">--}}
                                                {{----}}
                                            {{--</div>--}}
                                        </form>
                                        <script>
                                            // function Clicked() {
                                            //     console.log('Mizan');
                                            // }
                                            // var tickets = document.querySelector('[type="checkbox"]');
                                            //
                                            // for (i=0; i<=tickets.length; i++)
                                            // {
                                            //     tickets[i].addEventListener("change", function (evt) {
                                            //         alert('OK');
                                            //     });
                                            // }
                                        </script>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="btn-group pr-3" data-toggle="buttons">--}}
        {{--<label class="btn btn-secondary ml-2">--}}
            {{--<input type="checkbox" checked="" autocomplete="off" hidden> 1--}}
        {{--</label>--}}
        {{--<label class="btn btn-secondary ml-2">--}}
            {{--<input type="checkbox" autocomplete="off" hidden> 2--}}
        {{--</label>--}}
        {{--<label class="btn btn-secondary ml-2">--}}
            {{--<input type="checkbox" autocomplete="off" hidden> 3--}}
        {{--</label>--}}
    {{--</div>--}}
@endsection

@section('footer')
    <script src="{{asset('js/lib/multipicker/multipicker.min.js')}}"></script>
    <script>
        $(function() {
            $("#days").multiPicker({ selector : "li" });
            $("#days-no-border").multiPicker({ selector : "li" });
            $("#days-single").multiPicker({
                selector : "li",
                isSingle : true
            });
            $("#days-single-no-border").multiPicker({
                selector : "li",
                isSingle : true
            });
            $("#days-prepopulated").multiPicker({
                selector : "li",
                prePopulate : ["Tuesday", "Friday"],
                valueSource : "data-value"
            });
            $("#days-prepopulated-no-border").multiPicker({
                selector : "li",
                prePopulate : ["Tuesday", "Friday"],
                valueSource : "data-value"
            });
            $("#days-vertical").multiPicker({
                selector   : "span",
                cssOptions : {
                    vertical: true
                }
            });
            $("#days-vertical-no-border").multiPicker({
                selector   : "span",
                cssOptions : {
                    vertical: true
                }
            });
            $("#months").multiPicker({
                selector    : "checkbox",
                prePopulate : "1", // array or single value
                isSingle	: true,
                cssOptions 	: {
                    size	  : "large", // small, medium or large, default medium
                    element	  : {
                        "font-size"   : "11px",
                        "color" 	  : "#3a3a3a",
                        "font-weight" : "bold"
                    },
                    selected: {
                        "border-color" : "#ff4c4c",
                        "font-size"    : "14px"
                    },
                    picker: {
                        "border-color" : "#ff4c4c"
                    }
                }
            });
            $("#months-no-border").multiPicker({
                selector    : "checkbox",
                prePopulate : "1", // array or single value
                isSingle	: true,
                cssOptions 	: {
                    size	  : "large", // small, medium or large, default medium
                    element	  : {
                        "font-size"   : "11px",
                        "color" 	  : "#3a3a3a",
                        "font-weight" : "bold"
                    },
                    selected: {
                        "border-color" : "#ff4c4c",
                        "font-size"    : "14px"
                    },
                    picker: {
                        "border-color" : "#ff4c4c"
                    }
                }
            });
            $("#languages").multiPicker({
                selector	: "radio"
            });
            $("#languages-no-border").multiPicker({
                selector	: "radio"
            });
            $("#programming-languages").multiPicker({
                selector	: "checkbox",
                cssOptions : {
                    size 	  : "large"
                }
            });
            $("#programming-languages-no-border").multiPicker({
                selector	: "checkbox",
                cssOptions : {
                    size 	  : "large"
                }
            });
        });
    </script>


@endsection
