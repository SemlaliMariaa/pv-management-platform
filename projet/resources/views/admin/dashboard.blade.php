@extends('layouts.app')
@section('content')
<h1>hey admin</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

<a href="{{route('admin.pendingUsers')}}">showusers</a>
@endsection