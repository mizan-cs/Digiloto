@extends('agent.base')
@section('content')
    <div class="container-fluid">
        <div class="bd-example">
            <div class="card text-center">
                <div class="card-header">
                    Games Available
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
                            <th>Promote</th>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gamemodal{{$game->id}}">
                                        Get My Link
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="gamemodal{{$game->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$game->title}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <input type="text" value="{{$agent->getMyLink($game)}}" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div><!--.container-fluid-->
@endsection