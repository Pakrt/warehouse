@extends('layouts.template')
@section('tittlePage', 'Stok Barang')
@section('tittleContent', '')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Stock</li>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="col-md-12 col-sm-12">
        <div class="card card-warning card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                @foreach ($rack as $rack)
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-one-{{ $rack->id }}-tab" data-toggle="pill" href="#custom-tabs-one-{{ $rack->id }}" role="tab">Rak {{ $rack->name }}</a>
                </li>
                @endforeach
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                @foreach ($rack2 as $rack2)
                <div class="tab-pane fade show @if ($rack2->id  == 2)
                active
                @endif" id="custom-tabs-one-{{ $rack2->id }}" role="tabpanel" aria-labelledby="custom-tabs-one-{{ $rack2->id }}-tab">
                    <div class="row">
                      <table width="100%">
                        @foreach ($rackDt as $index => $as)
                            @if ($as->rack_id == $rack2->id)
                              @if ( ($index+6) % 6 == 0)
                                <td>
                                  <td class="{{$index+1}}" >
                                    @endif
                                    <div class="info-box">
                                          <span class="info-box-icon @if ($as->is_load == 0) bg-info @else bg-danger  @endif "><i class="fas fa-box"></i></span>  
                                          <div class="info-box-content">
                                            {{-- <p>   --}}
                                            @if ($as->is_load == 1)
                                              <span class="info-box-text">{{ $as->item_qty }} CT</span>
                                              <span class="info-box-text">{{ $as->code }}</span>
                                            @else
                                              <span class="info-box-number"></span>
                                            @endif 
                                            {{-- </p> --}}
                                              <span class="info-box-text">{{ $rack2->name }} - {{ $as->number }}</span>
                                            
                                          </div>
                                    </div>
                                  @if ( ($index+1) % 6 == 0)
                                    </td >
                                  </td> 
                              @endif
                            @endif
                        @endforeach
                      </table>
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
