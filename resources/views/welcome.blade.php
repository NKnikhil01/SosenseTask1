@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <img src="{{asset('images/employee.webp')}}" class="card-img-top" alt="Employee" style="width: 18rem;">
                </div>
                <div class="card-body">
                    <h2 class="text-center">Welcome to the Laravel 8</h2> <br>
                    <h4 class="text-center">Admin Pannel Task</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
