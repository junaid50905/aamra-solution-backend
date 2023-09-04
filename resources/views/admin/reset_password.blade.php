@extends('admin.master')


@section('main-panel')
    <div class="row">
        <div class="col-md-12">
            <h2>Reset user password</h2>

            <div class="reset_form w-25 p-3 bordered">
                <form action="{{ route('reset', $reset_user->id) }}" method="POST">
                    @csrf
                    <input type="password" name="password" class="form-control bg-light">
                    <button type="submit" class="btn btn-success mt-2">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
