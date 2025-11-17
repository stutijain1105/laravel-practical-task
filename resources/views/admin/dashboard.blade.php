@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow p-4">
        <h2 class="text-center">Welcome Admin Dashboard</h2>

        <form action="{{ route('admin.logout') }}" method="POST" class="text-center mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">
                Logout
            </button>
        </form>

        <p class="mt-3 text-center text-muted">
            You are logged in as Admin.
        </p>
    </div>

</div>
@endsection
