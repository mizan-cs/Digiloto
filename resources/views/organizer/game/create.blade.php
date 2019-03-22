@extends('organizer.base')

@section('content')

    <div class="container-fluid">
        <div class="bd-example">
            <div class="card text-center">
                <div class="card-header">
                    <div class="card-title">Create New Game</div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('organizer.game.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Game Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

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
                                <input id="total_tickets" type="number" class="form-control{{ $errors->has('total_tickets') ? ' is-invalid' : '' }}" name="total_tickets" value="{{ old('total_tickets') }}" required>
                                @if ($errors->has('total_tickets'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_tickets') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Tickets Price (USD)$</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required>
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_at" class="col-md-4 col-form-label text-md-right">Start Selling at</label>

                            <div class="col-md-6">

                                <input id="start_at" type="datetime-local" class="form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}" name="start_at" value="{{ old('start_at') }}" required>
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
                                <input id="end_at" type="datetime-local" class="form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}" name="end_at" value="{{ old('end_at') }}" required>
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
                                <textarea id="rules" rows="6" class="form-control{{ $errors->has('rules') ? ' is-invalid' : '' }}" name="rules" value="{{ old('rules') }}" required></textarea>
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
                                    Create New Game
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div><!--.container-fluid-->
@endsection