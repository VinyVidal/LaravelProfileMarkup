{{--
    Profile Page Template View
--}}

{{--                   PARAMETERS 
    string @user -> Logged User
--}}

@extends('templates/master')

@section('title')
    @yield('title')
@endsection

@section('content')
    
    @include('navbar', ['username' => Auth::user()->username  ?? null , 'useravatar' => Auth::user()->photo  ?? null ])
      <div class="container my-3">
          <div class="row">
            <div class="col">
              @if (session('message'))
                  <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
            </div>
          </div>
          <div class="row">
              <div class="col-md mt-3 mt-md-0 bg-light p-0 rounded">
                  @yield('inner-content')
              </div><!-- col -->
          </div><!-- row -->
      </div><!-- container -->
@endsection

@section('additional-js')
    <script src="{{ asset('js/profile-pic.js') }}"></script>
    <script src="{{ asset('js/file-input.js') }}"></script>
    @if (Route::currentRouteName() != 'user.profile')
      <script src="{{ asset('js/scrollToElement.js') }}"></script>
    @endif
@endsection