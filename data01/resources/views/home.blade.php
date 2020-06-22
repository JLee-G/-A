@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body" align="center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="GET" action="{{ route('modify') }}">
                        <input size="55" class="form-control @error('name_v') is-invalid @enderror" type="text" name="name_v" value="" placeholder="{{ __('change Name') }}"  autocomplete="off">
                        
                        @error('name_v')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <input size="55" class="form-control @error('password_v') is-invalid @enderror" type="password" name="password_v" value="" placeholder="{{ __('change Password') }}"  autocomplete="off">
                        
                        @error('password_v')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <br/>
                        <button type="submit" class="btn btn-primary">{{ __('modify') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
