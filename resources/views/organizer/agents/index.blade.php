@extends('organizer.base')

@section('content')

    <div class="container-fluid">
        <div class="bd-example">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('organizer.agent.invite')}}">Add New</a>
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
                            <th>Earnings</th>
                            <th>Status</th>
                            <th>Commission</th>
                            <th>Manage</th>

                        </thead>
                        <tbody>
                        @foreach(\Auth::user()->organizers[0]->agents as $agent)
                            <tr id="1">
                                <td><a href="">{{$agent->id}}</a></td>
                                <td>{{$agent->name}}</td>
                                <td>
                                    ${{$agent->total_sales}}
                                </td>
                                <td>
                                   ${{$agent->earnings}}
                                </td>
                                <td>
                                    @if($agent->is_active) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Disabled</span> @endif
                                </td>
                                <td>
                                    {{$agent->commission}}%
                                </td>
                                <td class="">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_agent{{$agent->id}}">
                                        Manage
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_agent{{$agent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$agent->name}} - Manage</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('organizer.agent.update.commission',$agent) }}">
                                        <div class="modal-body">
                                            @csrf

                                            <div class="form-group row">

                                                <div class="input-group row">
                                                    <label for="commission" class="col-md-4 col-form-label text-md-right">Commission</label>
                                                    <input type="number" name="commission" value="{{$agent->commission}}" class="form-control">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Commission</button>
                                            <a class="btn @if($agent->is_active) btn-danger @else btn-success @endif" href="@if($agent->is_active) {{route('organizer.agent.deactivate',$agent)}} @else {{route('organizer.agent.approve',$agent)}} @endif" role="button">@if($agent->is_active) Disable This Operator @else Active This Operator @endif</a>
                                        </div>
                                        </form>
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