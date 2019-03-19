@extends('organizer.base')

@section('content')

    <div class="container-fluid">
        <div class="bd-example">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link @if($sub_tab == 'games-dashboard') active @endif" href="{{route('organizer.game.dashboard',$game)}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($sub_tab == 'games-tickets') active @endif" href="{{route('organizer.game.dashboard.tickets',$game)}}">Game Tickets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($sub_tab == 'games-settings') active @endif" href="{{route('organizer.game.settings',$game)}}">Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @yield('game-content')
                </div>
            </div>
        </div>

    </div>
@endsection