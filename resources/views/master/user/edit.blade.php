@extends('layouts.template')
@section('tittlePage', 'Edit Crew')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item">Master Crew</li>
    <li class="breadcrumb-item active">Edit Master Crew</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-5">
          <!-- Profile Image -->
          <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
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
                  <b>Position</b> 
                  <a class="float-right">
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="1">Admin</option>
                        <option value="2">Operator</option>
                    </select>
                  </a>
                </li>
                <li class="list-group-item">
                    <b>Name</b> <a class="float-right"><input class="form-control" name="name" type="text" value="{{ $user->name }}"></a>
                  </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right"><input class="form-control" name="email" type="email" value="{{ $user->email }}"></a>
                </li>
                <li class="list-group-item">
                  <b>Username</b> <a class="float-right"><input class="form-control" name="username" type="text" value="{{ $user->username }}"></a>
                </li>
              </ul>
                <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Anda akan mengedit data master !!')">
                  Simpan Data
                </button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </form>
      </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@include('master.user.create')
