@extends('layouts.app')

@section('header')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                        <form class="mb-o">
                            <input class="form-control" placeholder="Search Operator Name" type="text" name="operator">
                        </form>
                </div>

                <div class="card-body">
                        <nav class="nav flex-md-column">
                            <a href="#" class="nav-link">El Gordo</a>
                            <a href="#" class="nav-link">France Loto</a>
                            <a href="#" class="nav-link">Mega Sena</a>
                            <a href="#" class="nav-link">Oz Lotto</a>
                            <a href="#" class="nav-link">SuperEnaLotto</a>
                            <a href="#" class="nav-link">SuperEna Max</a>
                        </nav>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link  active " href="">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="">New</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="">Old</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-items-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">Operator</th>
                                            <th scope="col">Available</th>
                                            <th scope="col">End</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($games as $game)

                                                <tr class="bg-white">
                                                    <th scope="row" class="w-35">
                                                        <a style="border-bottom:none" class="media align-items-center">
                                                            <img style="max-height: 60px" alt="Image" src="{{asset('images/'.$game->organizer->logo)}}" class="avatar rounded mr-3">
                                                            <div class="media-body">
                                                                <span class="h6 mb-0">{{$game->title}}</span>
                                                            </div>
                                                        </a>
                                                    </th>
                                                    <td class="w-40">
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width:{{(5*100)/$game->tickets->count()}}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{date('jS F h:m:s', strtotime($game->end_at))}}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="{{route('games.show',$game)}}" role="button">Check Tickets</a>
                                                    </td>

                                                </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end of col-->
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
