<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app_bootstrap.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--This is the admin template css--}}
    <link rel="stylesheet" href="{{asset('css/lib/lobipanel/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/separate/vendor/lobipanel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/jqueryui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/separate/pages/widgets.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/landing/landing-page.min.css')}}">
    @yield('header')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="max-height: 30px" src="https://www.digilotto.co.uk/img/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="{{route('games')}}" class="nav-link active">Play Game</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if(Auth::user()->is_operator)
                                        <a class="dropdown-item" href="{{route('user.dashboard.base')}}">Operator Dashboard</a>
                                    @endif

                                    @if(Auth::user()->is_agent)
                                        <a class="dropdown-item" href="{{route('user.dashboard.base')}}">Agent Dashboard</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main style="padding: -0px;" class="py-1">
            @yield('content')
        </main>
    </div>

    {{--Admin Template Javascripts--}}
    <script src="{{asset('js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/lib/popper/popper.min.js')}}"></script>
    <script src="{{asset('js/lib/tether/tether.min.js')}}"></script>
    {{--<script src="{{asset('js/lib/bootstrap/bootstrap.min.js')}}"></script>--}}
    <script src="{{asset('js/plugins.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/lib/jqueryui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/lib/lobipanel/lobipanel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(document).ready(function() {
            $('.panel').each(function () {
                try {
                    $(this).lobiPanel({
                        sortable: true
                    }).on('dragged.lobiPanel', function(ev, lobiPanel){
                        $('.dahsboard-column').matchHeight();
                    });
                } catch (err) {}
            });

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Day');
                dataTable.addColumn('number', 'Values');
                // A column for custom tooltip content
                dataTable.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
                dataTable.addRows([
                    ['MON',  130, ' '],
                    ['TUE',  130, '130'],
                    ['WED',  180, '180'],
                    ['THU',  175, '175'],
                    ['FRI',  200, '200'],
                    ['SAT',  170, '170'],
                    ['SUN',  250, '250'],
                    ['MON',  220, '220'],
                    ['TUE',  220, ' ']
                ]);

                var options = {
                    height: 314,
                    legend: 'none',
                    areaOpacity: 0.18,
                    axisTitlesPosition: 'out',
                    hAxis: {
                        title: '',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        textPosition: 'out'
                    },
                    vAxis: {
                        minValue: 0,
                        textPosition: 'out',
                        textStyle: {
                            color: '#fff',
                            fontName: 'Proxima Nova',
                            fontSize: 11,
                            bold: true,
                            italic: false
                        },
                        baselineColor: '#16b4fc',
                        ticks: [0,25,50,75,100,125,150,175,200,225,250,275,300,325,350],
                        gridlines: {
                            color: '#1ba0fc',
                            count: 15
                        }
                    },
                    lineWidth: 2,
                    colors: ['#fff'],
                    curveType: 'function',
                    pointSize: 5,
                    pointShapeType: 'circle',
                    pointFillColor: '#f00',
                    backgroundColor: {
                        fill: '#008ffb',
                        strokeWidth: 0,
                    },
                    chartArea:{
                        left:0,
                        top:0,
                        width:'100%',
                        height:'100%'
                    },
                    fontSize: 11,
                    fontName: 'Proxima Nova',
                    tooltip: {
                        trigger: 'selection',
                        isHtml: true
                    }
                };

                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                chart.draw(dataTable, options);
            }
            $(window).resize(function(){
                drawChart();
                setTimeout(function(){
                }, 1000);
            });
        });
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    {{--Admin Template Javascripts--}}
@yield('footer')
</body>
</html>
