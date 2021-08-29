@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Profile') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="main-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                                    {{-- <img src="{{ Storage::url($profile->image) }}" alt="Admin" class="rounded-circle" width="150"> --}}
                                    <div class="mt-3">
                                        <h4>{{ $profile->name }}</h4>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                            </div>
                            
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <form action="{{ route('user.update-profile', $profile->id) }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="name" class="mb-0 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $profile->name }}" required  autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="name" class="mb-0 col-form-label text-md-right">{{ __('Email') }}</label>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $profile->email }}" required>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="name" class="mb-0 col-form-label text-md-right">{{ __('Role') }}</label>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <input id="role" type="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $profile->is_admin == 1 ? 'Admin' : 'Editor' }}" disabled>

                                                    @error('role')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary float-end">{{ __('Update') }}</button>
                                                    <a href="{{ route('user.profile') }}" class="btn btn-danger float-end mx-2">Cancel</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
