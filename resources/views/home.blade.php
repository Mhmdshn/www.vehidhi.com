@extends('layouts.app')
@section('content')
<h1>hi</h1>
    <h1>Home : {{ Auth::user()->name }}</h1>
@endsection