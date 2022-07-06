@extends('layouts.template')
@section('tittlePage', 'Crew')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Master Crew</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="card-header">
    <button type="button" class="btn btn-sm bg-gradient-info" data-toggle="modal" data-target="#modal-lg">
        <i class="fas fa-plus-circle"></i> Tambah Data
      </button>
  </div>
  <!-- /.card-header -->
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
                  <b>Position</b> <a class="float-right">{{ $user->roles->name }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                </li>
              </ul>
              @if (Auth::user()->role_id == 1 )
              <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                @method('delete')
                @csrf
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                <button type="submit" class="btn btn-danger float-right"
                  onclick="return confirm('Anda akan menghapus data master !!')">
                  <i class="fas fa-trash"></i></button>
              </form>
              @endif
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
@include('master.user.create')
