@extends('layouts.template')
@section('tittlePage', 'Dashboard')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $sumItem }}</h3>

                    <p>Item yang Terdaftar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-cube"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $sumRack }}</h3>

                    <p>Rak yang Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-grid"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $sumUser }}</h3>

                    <p>User yang Terdaftar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>65</h3>

                    <p>XX xx XX</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <p class="text-center">
                        <strong>Kapasitas Rak Penyimpanan</strong>
                        </p>

                        @foreach ($rack as $rack => $racks)
                        @foreach ($racks->rackDt as $rackDt)

                        @php
                            $load[] = $rackDt->is_load > 0;
                            $sumLoad = count($load);
                        @endphp
                        @endforeach

                        <div class="progress-group">
                            Rak {{ $racks->name }} - {{ $racks->area }}
                            <span class="float-right"><b>{{ $sumLoad }}</b>/{{ $racks->qty }}</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-random" style="width: 80%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
