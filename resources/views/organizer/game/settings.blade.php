@extends('organizer.game.base')

@section('game-content')
    <div class="row">
        <div class="col-lg-4">
            <section class="card">
                <header class="card-header">
                    Activation
                </header>
                <div class="card-block">
                    <a class="btn btn-primary" href="#" role="button">Active Games</a>
                    <br>
                    <a class="btn btn-primary mt-2" href="#" role="button">Disable all tickets</a>
                </div>
            </section>
        </div>
        <div class="col-lg-8">
            <section class="card">
                <header class="card-header">
                    General Settings
                </header>
                <div class="card-block p-0">
                    <form method="POST" action="{{ route('organizer.game.update',$game) }}" class="mt-2 mb-2">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Game Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $game->title }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_tickets" class="col-md-4 col-form-label text-md-right">Tickets Amount</label>

                            <div class="col-md-6">
                                <input id="total_tickets" type="number" class="form-control{{ $errors->has('total_tickets') ? ' is-invalid' : '' }}" name="total_tickets" value="{{ $game->total_tickets }}" required>
                                @if ($errors->has('total_tickets'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_tickets') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_at" class="col-md-4 col-form-label text-md-right">Start Selling at</label>

                            <div class="col-md-6">

                                <input id="start_at" type="datetime" class="form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}" name="start_at" value="{{ $game->start_at }}" required>
                                @if ($errors->has('start_at'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_at" class="col-md-4 col-form-label text-md-right">End Selling at</label>

                            <div class="col-md-6">
                                <input id="end_at" type="datetime" class="form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}" name="end_at" value="{{ $game->end_at }}" required>
                                @if ($errors->has('end_at'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rules" class="col-md-4 col-form-label text-md-right">Game Rules</label>

                            <div class="col-md-6">
                                <textarea id="rules" rows="6" class="form-control{{ $errors->has('rules') ? ' is-invalid' : '' }}" name="rules" value="{{ $game->rules }}" required>{{$game->rules}}</textarea>
                                @if ($errors->has('rules'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rules') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="organizer" class="col-md-4 col-form-label text-md-right">Host by</label>
                            <div class="col-md-6">
                                <input id="organizer" type="text" class="form-control" name="organizer" value="{{$organizer->title}}" required disabled>
                                @if ($errors->has('rules'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rules') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
@endsection