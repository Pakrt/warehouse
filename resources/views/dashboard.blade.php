@extends('layouts.template')
@section('tittlePage', 'Dashboard')
@section('tittleContent', 'Ini Dashboard')
@section('breadcrumb')
    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fab fa-bitbucket"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Barang</span>
                      <span class="info-box-number">{{ $sumItem }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fab fa-bitbucket"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Rak Penyimpanan</span>
                      <span class="info-box-number">{{ $sumRack }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fab fa-bitbucket"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Stock Barang</span>
                      <span class="info-box-number">1000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="info-box">
                @foreach ($rack as $rack)
                <span class="info-box-icon bg-success"><i class="fab fa-bitbucket"></i></span>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
