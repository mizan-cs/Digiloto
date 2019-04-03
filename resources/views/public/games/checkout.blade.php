@extends('layouts.app')

@section('header')
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{asset('css/lib/multipicker/multipicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/separate/vendor/multipicker.min.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="card card-lg w-100">
                        <form method="post" action="{{route('order.complete',$data)}}">
                            @csrf
                            <input type="hidden" name="refer" value="{{$data['refer']}}">
                            <div class="row no-gutters justify-content-between card-header">
                                <!--end of col-->
                                <div class="col-auto">
                                    <img style="max-height: 80px" alt="Image" src="{{asset('images/'.$game->organizer->logo)}}" class="avatar rounded avatar-lg">
                                </div>
                                <h1>{{$game->organizer->title}}</h1>
                                <!--end of col-->
                            </div>
                            <!--end of row-->
                            <div class="card-body">

                            </div>
                            <div class="card-body pt-0">
                                <table class="table text-right">
                                    <thead class="bg-secondary">
                                    <tr>
                                        <th scope="col">Game</th>
                                        <th scope="col" class="text-right">Ticket Number</th>
                                        <th scope="col" class="text-right">Rate</th>
                                        <th scope="col" class="text-right">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['tickets'] as $ticket)
                                        <tr>
                                            <th scope="row">
                                                {{$ticket->game->title}}
                                            </th>
                                            <td>
                                                {{$ticket->number}}
                                            </td>
                                            <td>{{$ticket->price}}$</td>
                                            <td>{{$ticket->price}}$</td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!--end of card body-->
                            <div class="card-footer">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <small>Payment by:
                                            <br>{{\Auth::user()->email}}
                                        </small>
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto text-right">
                                        <span class="h3">Total: {{$total}}$</span>
                                    </div>
                                    <!--end of col-->
                                </div>


                                <div class="stripe-button-container">
                                    <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_TkVNLwlHUaeKg8uUEzZJcSPw006C1Txz1x"
                                            data-amount="{{$total * 100}}"
                                            data-name="{{Auth::user()->name}}"
                                            data-email="{{Auth::user()->email}}"
                                            data-image="{{asset('images/'.$game->organizer->logo)}}"
                                            data-locale="auto"
                                            data-notrack>
                                    </script>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end of col-->
            </div>
            <!--end of row-->
        </div>
    </div>

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
