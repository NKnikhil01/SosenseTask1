@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editor\'s Dashboard') }}</div>
                {{-- <div class="card-header">'s Dashboard</div> --}}

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <img src="{{asset('images/employee.webp')}}" class="card-img-top" alt="Employee" style="width: 18rem;">
                    <div class="card-title"><h4>Welcome {{ Auth::user()->name }}</h4></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
