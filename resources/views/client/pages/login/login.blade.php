@extends('client.layout.layout')
@section('content')

<div class="container d-flex justify-content-center align-items-center border ">
    <h4 class="text-center">login</h4>
    <div class="">
        @auth
        <a href="{{route('dangxuat')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Dang xuat</a>
        <form id="logout-form" action="{{route('dangxuat')}}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
    @guest
    <form class="col-6 m-5 " method="POST"  action="{{route('dangnhap')}}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email">
          @error('email')
            <span class="text-danger">
                {{$message}}
                </span>
        @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endguest
    </div>
</div>
@endsection