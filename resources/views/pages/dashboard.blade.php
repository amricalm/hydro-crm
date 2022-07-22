@extends('templates.index')
@include('templates.komponen.chart')
@section('body')
<!-- Page -->
<div class="page">
    <div class="page-main">
        @include('templates.menu')
        <!-- App-Content -->
        <div class="app-content main-content">
            <div class="side-app">
                @include('templates.navbar')
                <!--Page header-->
                    <div class="page-header">
                        <div class="page-leftheader">
                            <h4 class="page-title mb-0 text-primary">{{ $judul }}</h4>
                        </div>
                        <div class="page-rightheader">

                        </div>
                    </div>
                    <!--End Page header-->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <form>
                            <div class="form-group row row-sm">
                                <label class="col-md-2 form-label">Tanggal</label>
                                <div class="col-md-3">
                                    <input type="date" name="tglDr" id="tglDr" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $startDate }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="tglSd" id="tglSd" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $endDate }}">
                                </div>
                            </div>
                            @if ($roleName == 'ADMIN')
                                <div class="form-group row row-sm mb-0">
                                    <label class="col-md-2 form-label">Sales</label>
                                    <div class="col-md-6">
                                        <select name="salesId" id="salesId" class="form-select form-control form-control-sm  mb-2" tabindex="10">
                                            <option value="">-- Pilih Sales --</option>
                                            @foreach($sales as $item)
                                                <option value="{{$item->id}}" {{ $item->id == $salesId ? 'selected' : ''  }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row row-sm">
                                    <div class="col-md-8 text-right">
                                    <button class="btn btn-sm btn-primary"><i class="fe fe-search"></i>Tampil</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <!-- Row-1 -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Key Performance Indicator</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        @foreach ($actionKpi as $action)
                                        <div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
                                            <div class="card overflow-hidden dash1-card border-0 dash4">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-12">
                                                            <div class="">
                                                                <div class="fs-14 font-weight-normal text-center">{{ $action->name }}</div>
                                                                @if ($salesId!='')
                                                                    @php $hasil = 0; @endphp
                                                                    @foreach ($capaian as $result)
                                                                        @if ($action->id == $result->id)
                                                                            @php $hasil = $result->result; break; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                <h2 class="mb-2 number-font carn1 font-weight-bold text-center">{{ $hasil ?? '-' }}</h2>
                                                                <div class="text-center">
                                                                    @for ($i = 0; $i < count($target); $i++)
                                                                        @if ($target[$i]->action_id == $action->id)
                                                                            / {{ $target[$i]->target }}
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-6 my-auto mx-auto">
                                                            <div class="mx-auto text-right">
                                                                <div id="spark1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row-1 -->

                    <!--Row-->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Laporan Harian ({{ $startDate }} s/d {{ $endDate }})</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th class="fw-bold">No</th>
                                                    <th class="fw-bold">Nama Aksi</th>
                                                    @foreach ($time as $rows)
                                                        <th class="text-center fw-bold">{{ $rows->name }}</th>
                                                    @endforeach
                                                    <th class="text-center fw-bold">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp
                                                @foreach ($actionDaily as $k=>$v)
                                                    <tr>
                                                        <td>{{ ($i+1) }}</td>
                                                        <td>{{ $v->name }}</td>
                                                        @if ($salesId!='')
                                                        @php $total = 0; @endphp
                                                        @endif
                                                        @foreach ($time as $a=>$b)
                                                        @if ($salesId!='')
                                                        @php $tampil = 0; @endphp
                                                            @foreach($daiylReport as $t=>$u)
                                                                @php
                                                                $hour = substr($b->name,0,2);
                                                                if($u->id == $v->id && $hour == $u->hour)
                                                                {
                                                                    $tampil = $u->results;
                                                                    break;
                                                                }
                                                                @endphp
                                                            @endforeach
                                                        @php $total+= $tampil; @endphp
                                                        @endif
                                                        <td class="text-center">{{ $tampil ?? '-' }}</td>
                                                        @endforeach
                                                        <td class="text-center fw-bold">{{ $total ?? '-' }}</td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>

</script>
@endsection
