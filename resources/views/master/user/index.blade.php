@extends('layouts.template')
@section('tittlePage', 'Crew')
@section('tittleContent', 'Crew')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Master Crew</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
      @foreach ($user as $user)
      <div class="col-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset('template') }}/dist/img/user4-128x128.jpg"
                     alt="User profile picture">
              </div>
              <h3 class="profile-username text-center">{{ $user->name }}</h3>
              <p class="text-muted text-center">&#64;{{ $user->username }}</p>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Position</b> <a class="float-right">{{ $user->role_id }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="float-right">XXxxXX</a>
                </li>
              </ul>
              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
      @endforeach
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@include('master.unit.create')
