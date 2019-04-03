@extends('organizer.base')

@section('content')

    @if (!$game->is_active)
        <div class="alert alert-warning text-center" role="alert">
            This game is not active now. <a href="{{route('organizer.game.active',$game)}}" class="alert-link">Click here to active.</a>
        </div>
    @else
        <div class="alert alert-success text-center" role="alert">
            This game is active now. <a href="{{route('organizer.game.deactivate',$game)}}" class="alert-link">Click here to deactivate.</a>
        </div>
    @endif
    <div class="container-fluid">
        <div class="bd-example">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link @if($sub_tab == 'games-dashboard') active @endif" href="{{route('organizer.game.dashboard',$game)}}">@lang('tickets_admin.dashboard')</a>
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