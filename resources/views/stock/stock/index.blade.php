@extends('layouts.template')
@section('tittlePage', 'Barang Masuk')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Stock</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      {{-- <div class="card">
        <div class="card-body">
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card --> --}}
      <div class="col-md-12 col-sm-12">
        <div class="card card-warning card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                @foreach ($rack as $rack)
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-{{ $rack->id }}-tab" data-toggle="pill" href="#custom-tabs-one-{{ $rack->id }}" role="tab">Rak {{ $rack->name }}</a>
                </li>
                @endforeach
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                @foreach ($rack2 as $rack2)
                <div class="tab-pane fade show" id="custom-tabs-one-{{ $rack2->id }}" role="tabpanel" aria-labelledby="custom-tabs-one-{{ $rack2->id }}-tab">
                    <div class="row">
                        @foreach ($rackDt as $as)
                            @if ($as->rack_id == $rack2->id)
                                <div class="col-md-2 col-sm-6 col-12">
                                    @if ($as->is_load == 1)
                                        <div class="info-box">
                                            <span class="info-box-icon bg-danger"><i class="fas fa-box"></i></span>  
                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ $rack2->name }} - {{ $as->number }}</span>
                                                {{-- <span class="info-box-text">{{ $as->qty }} CT</span> --}}
                                                <span class="info-box-number">{{ $as->qty }} CT - {{ $as->code }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    @else
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>  
                                            <div class="info-box-content">
                                            <span class="info-box-text">{{ $rack2->name }} - {{ $as->number }}</span>
                                            <span class="info-box-number"></span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    @endif
                                </div>
                                <!-- /.col -->
                            @endif
                        @endforeach
                    </div>
                    <!-- /.row -->
                </div>
                @endforeach
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
