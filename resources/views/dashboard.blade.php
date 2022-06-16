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
                    <h3>150</h3>

                    <p>Data Item</p>
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
                    <h3>53</h3>

                    <p>Data Rak</p>
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
                    <h3>44</h3>

                    <p>Data User</p>
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

            {{-- <div class="card">
                <div class="card-body"> --}}
                    <div class="row">
                        @foreach ($rack as $rack)
                        <div class="col-md-3">
                            <div class="info-box">
                                {{-- <span class="info-box-icon bg-info"><i class="fab fa-bitbucket"></i></span> --}}
                                <span class="info-box-icon bg-info"><h3>{{ $rack->name}}</h3></span>
                                <div class="info-box-content">
                                  <span class="info-box-text">Rak {{ $rack->name }} | {{ $rack->area }}</span>
                                  <span class="info-box-number">10/{{ $rack->qty }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        @endforeach
                    </div>
                {{-- </div>
            </div> --}}
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <p class="text-center">
                        <strong>Goal Completion</strong>
                        </p>

                        <div class="progress-group">
                        Add Products to Cart
                        <span class="float-right"><b>160</b>/200</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                        </div>
                        </div>
                        <!-- /.progress-group -->

                        <div class="progress-group">
                        Complete Purchase
                        <span class="float-right"><b>310</b>/400</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" style="width: 75%"></div>
                        </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                        <span class="progress-text">Visit Premium Page</span>
                        <span class="float-right"><b>480</b>/800</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                        Send Inquiries
                        <span class="float-right"><b>250</b>/500</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" style="width: 50%"></div>
                        </div>
                        </div>
                        <!-- /.progress-group -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
