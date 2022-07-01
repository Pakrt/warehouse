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
              <div class="col-md-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{ $sumItem }}</h3>

                    <p>Item yang Terdaftar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-cube"></i>
                  </div>
                  <a href="{{ route('item.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-md-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $sumRack }}</h3>

                    <p>Rak yang Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-grid"></i>
                  </div>
                  <a href="{{ route('stock.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-md-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{ $sumUser }}</h3>

                    <p>User yang Terdaftar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                  </div>
                  <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              {{-- <div class="col-lg-3 col-6">
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
              </div> --}}
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
                        <h5 class="text-center">
                        <strong>Kapasitas Rak Penyimpanan</strong>
                        </h5>

                        @foreach ($rack as $rack => $racks)
                        @php
                            $sumLoad = 0;
                            $sumWidth = 0;
                        @endphp
                        <div class="progress-group">
                            Rak {{ $racks->name }} - {{ $racks->area }}
                            @foreach ($rackDt as $as => $sd)
                            @if ($sd->rack_id == $racks->id)
                                @php
                                    $sumLoad += $sd->is_load;
                                    $sumWidth = ($sumLoad / $racks->qty)*100;
                                @endphp
                            @endif
                            @if ($sumWidth < 40 && $sumWidth >= 0)
                                @php
                                    $bg = "bg-info";
                                @endphp
                            @elseif ($sumWidth > 40 && $sumWidth < 70)
                                @php
                                    $bg = "bg-warning";
                                @endphp
                            @elseif ($sumWidth > 70)
                              @php
                                  $bg = "bg-danger";
                              @endphp
                            @endif
                            @endforeach
                            <span class="float-right"><b>{{ $sumLoad }}</b>/{{ $racks->qty }}</span>
                            <div class="progress progress-sm">
                              <div class="progress-bar {{ $bg }}" style="width: {{ $sumWidth }}%"></div>
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
