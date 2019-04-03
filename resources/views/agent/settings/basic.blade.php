@extends('agent.settings')
@section('settings-content')
    <form method="POST" action="">
        @csrf

        <div class="form-group row">
            <label for="token" class="col-md-4 col-form-label text-md-right">Token</label>

            <div class="col-md-6">
                <input id="token" type="text" class="form-control" value="{{ $agent->token  }}" required disabled>
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Your Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $agent->user->name  }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label text-md-right">Agent Title</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $agent->name }}" required autofocus>

                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
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
@endsection