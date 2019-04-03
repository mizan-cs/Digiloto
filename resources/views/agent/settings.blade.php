@extends('agent.base')

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link @if($sub_tab == 'basic') active @endif" href="{{route('agent.settings')}}">Basic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($sub_tab == 'payment') active @endif " href="{{route('agent.settings.payment')}}">Payment</a>
                        </li>
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="#">Media</a>--}}
                        {{--</li>--}}

                    </ul>
                </div>
                <div class="card-body">
                    @yield('settings-content')
                </div>
            </div>
        </div>
    </div><!--.container-fluid-->
    </div>
@endsection