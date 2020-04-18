{{--
    Template for "logged out" pages, authentication pages (login, register, forgot password, etc)
--}}

@extends('templates.master')

@section('title')
    @yield('title')
@endsection

@section('content')
<div class="container h-100">
        <div class="row align-items-center h-100">     
            <div class="col-md-6 m-0 mx-md-auto">
                <div class="text-center">
                    <img class="img size-logo" src="{{ asset('img/logo.png') }}">
                </div> 
                <div class="border border-main border-wide rounded p-md-5 p-3 bg-main text-main">
                    @yield('inner.content')
                </div>
            </div>
        </div>
    </div>
@endsection