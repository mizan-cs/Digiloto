@extends('organizer.base')

@section('content')

    <div class="container-fluid">
        <div class="bd-example">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">All Games</a>
                        </li>

                    </ul>
                </div>
                <div class="card-body">
                    <table id="table-edit" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="1">
                                #
                            </th>
                            <th>Name</th>
                            <th>Sell</th>
                            <th>Available</th>
                            <th>Amount</th>
                            <th width="120">Sell end</th>
                            <th>dashboard</th>

                        </thead>
                        <tbody>
                        @foreach($games as $game)
                            <tr id="1">
                                <td><a href="">{{$game->id}}</a></td>
                                <td>{{$game->title}}</td>
                                <td width="150">
                                    <div class="progress-with-amount">
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-success" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="progress-with-amount-number">0%</div>
                                    </div>
                                </td>
                                <td class="table-icon-cell">0</td>
                                <td class="table-icon-cell">{{$game->total_tickets}}</td>
                                <td class="table-date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($game->end_at))->diffForHumans()}}</td>
                                <td class="">
                                    <a class="btn btn-primary btn-sm" href="{{route('organizer.game.dashboard',$game)}}" role="button">dashboard</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div><!--.container-fluid-->
@endsection