@extends('agent.settings')
@section('settings-content')
    <form method="POST" action="{{route('agent.settings.payment.update')}}">
        @csrf


        <div class="form-group row">
            <label for="bank" class="col-md-4 col-form-label text-md-right">My Bank Account Details</label>

            <div class="col-md-6">
                <div class="input-group">
                    <textarea class="form-control" name="bank" rows="7" aria-label="With textarea">{{$agent->bank}}</textarea>
                </div>
            </div>
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success btn-block">
                    Update
                </button>
            </div>
        </div>

    </form>
@endsection