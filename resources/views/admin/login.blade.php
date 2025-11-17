@extends('layouts.app')

@section('content')
<div class="card col-md-6 mx-auto">

    <div class="card-header bg-dark text-white">
        Admin Login
        <a href="{{ url('/') }}" style="float:right; color:white;">Back</a>
    </div>

    <div class="card-body">

        @if (session('error'))
            <div style="color:red; font-weight:bold;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div style="color:green;">{{ session('success') }}</div>
        @endif


        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <button class="btn btn-dark">Login</button>
        </form>

    </div>
</div>
@endsection
