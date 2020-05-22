{{--
    Template for "logged out" pages, authentication pages (login, register, forgot password, etc)
--}}

@extends('templates.master')

@section('title')
    @yield('title')
@endsection

@section('content')
    <div class="text-center">
            <img class="img size-logo" src="{{ asset('img/logo.png') }}">
            <div class="auth-container mx-auto py-5 px-3 px-sm-5 border border-main border-wide rounded bg-main text-main">
            @yield('inner.content')
            </div>
    </div>
@endsection