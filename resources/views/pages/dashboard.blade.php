@extends('templates.index')
@include('templates.komponen.chart')
@include('templates.komponen.livewire')
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
                    {{-- <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Aktivitas Sales Per Bulan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <livewire:activity-chart-mounthly></livewire:activity-chart-mounthly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- End Row-1 -->

                    <!-- Row-1 -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Key Performance Indicator ({{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }})</h3>
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
                                                                <div class="fs-14 font-weight-normal text-center">{{ $action->name ?? '-' }}</div>
                                                                <h2 class="mb-2 number-font carn1 font-weight-bold text-center">{{ $action->result ?? '-' }}</h2>
                                                                <div class="text-center">/ {{ $action->target ?? '-' }}</div>
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
                                    <h3 class="card-title">Laporan Harian ({{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }})</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered card-table table-vcenter text-nowrap" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th class="fw-bold">No</th>
                                                    <th class="fw-bold">Nama Aksi</th>
                                                    @foreach (range($timeRange['min'], $timeRange['max']) as $rows)
                                                        <th class="text-center fw-bold">{{ $rows }}:00</th>
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
                                                        @foreach (range($timeRange['min'], $timeRange['max']) as $hour)
                                                            @if ($salesId!='')
                                                                @php $tampil = 0; @endphp
                                                                    @foreach($dailyReport as $t=>$u)
                                                                        @php
                                                                        if($u->action_id == $v->id && $hour == $u->hour)
                                                                        {
                                                                            $tampil = $u->result;
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
    var act = <?php json_encode($actionDaily) ?>;
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
