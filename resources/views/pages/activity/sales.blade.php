@extends('templates.index')
@include('templates.komponen.sweetalert')
@section('body')
<!---Global-loader-->

<!--- End Global-loader-->
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
                        <h4 class="page-title mb-0 text-primary">Daftar {{ $judul }}</h4>
                    </div>
                    <div class="page-rightheader">
                        <div class="btn-list">
                            <button class="btn btn-sm btn-success" id="btnExport"><i class="fa fa-file-excel-o"></i> Download</button>
                            <a href="{{ route('activity.create') }}" id="createNew" class="btn btn-outline-primary" ><i class="fe fe-plus-square"></i> Tambah</a>
                        </div>
                    </div>
                </div>
                <!--End Page header-->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body py-4">
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
                                        <button class="btn btn-sm btn-primary" id="tampil"><i class="fe fe-search"></i> Tampil</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" id="tbl">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
        </div>
    </div>
</div>
<!-- End Page -->

@endsection
@section('footer')
<?php
    use App\Http\Controllers\MProgramController;
?>
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ajaxStart(function() {
		    $("#ajax-loading").show();
	    });

        $(document).ajaxStop(function() {
            $("#ajax-loading").hide();
        });

        loadData(1,$('#tglDr').val(), $('#tglSd').val(), $('#salesId').val());

        $(document).on('click', '.halaman', function(){
           var page = $(this).attr("id");
           var tglDr = $('#tglDr').val();
           var tglSd = $('#tglSd').val();
           var salesId = $('#salesId').val();
           loadData(page,tglDr,tglSd,salesId);
        });

        $('#tampil').click(function () {
           var tglDr = $('#tglDr').val();
           var tglSd = $('#tglSd').val();
           var salesId = $('#salesId').val();
           loadData(1,tglDr,tglSd,salesId);
        });

        $('#btnExport').on('click',function(){
            exportReportDtl($('#salesId').val(), $('#tglDr').val(), $('#tglSd').val());
        });

        $(document).on('click','.btn-edit',function(){
            var id = $(this).closest('tr').find('input').val();
            var url = '{{ url('aktivitas/create') }}?id='+id;
            $.ajax({
                url:"{{ url('aktivitas/create') }}",
                method:"GET",
                data:{id:id.trim()},
                success:function(data){
                    window.location = url;
                }
            })
            $('#ajax-loading').show();
            setTimeout(() => {$('#add-modal').show();$('#ajax-loading').hide();}, 1500);

        });

        $(document).on('click','.btn-delete',function(){
            var id = $(this).closest('tr').find('input').val();
            checkdelete(id.trim(),$(this));
        });
    });


function loadData(page,tglDr,tglSd,salesId){
    $.ajax({
        url:"{{ url('aktivitas/getTabel') }}",
        method:"POST",
        data:{page:page, tglDr:tglDr, tglSd:tglSd, salesId:salesId},
        success:function(data){
            $('#tbl').html(data);
        }
    })
}

function checkdelete(id,el)
{
    Swal.fire({
        title: 'Yakin?',
        text: "Anda yakin ingin menghapus data ini?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                url:"{{route('activity.delete') }}",
                method:"POST",
                data:{id:id},
                success:function(data){
                    if(data.Message=='Sukses')
                    {
                        el.closest('tr').remove();
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            }).done(function(view) {
                    //window.location.reload();
            });

        }
    })
}

function exportReportDtl(salesId,startDate,endDate)
{
    var url = '{{ url('aktivitas/export-report-dtl') }}?tglDr='+startDate+'&tglSd='+endDate+'&salesId='+salesId;
    $.get(url,function(data){
        window.open(url, '_blank');
    });
}

</script>
@endsection
