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
                            {{-- <a href="javascript:void(0)" id="import" class="btn btn-sm btn-secondary"><i class="fe fe-download"></i> Impor dari Excel</a> --}}
                            <button class="btn btn-sm btn-success" id="btnExport"><i class="fa fa-file-excel-o"></i> Download</button>
                            <a href="javascript:void(0)" id="createNew" class="btn btn-outline-primary" ><i class="fe fe-plus-square"></i> Tambah</a>
                        </div>
                    </div>
                </div>
                <!--End Page header-->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body py-4">
                                <div class="form-group row row-sm mb-0">
                                    <label class="col-md-1 form-label">CRO</label>
                                    <div class="col-md-4">
                                        <select name="sales" id="cb-sales" class="form-select form-control form-control-sm mb-2" tabindex="10">
                                            @if($roleName == 'ADMIN')
                                            <option value="">-- Pilih CRO --</option>
                                            <option value="999">-- Pilih Semua CRO --</option>
                                            @endif
                                            @foreach($karyawan as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-md-1 form-label">Status</label>
                                    <div class="col-md-2">
                                        <select name="status" id="pilih-status" class="form-select form-control form-control-sm mb-2" tabindex="1">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="tampil" class="btn btn-sm btn-primary"><i class="fe fe-search"></i>Tampil</button>
                                    </div>
                                </div>
                                <div class="form-group row row-sm mb-0">
                                    <label class="col-md-1 form-label">Cari</label>
                                    <div class="col-md-7">
                                        <input type="text" id="tx-search" name="search" autocomplete="off" class="form-control form-control-sm mb-2">
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

<!--#region --- Modal -------------------------------->
<div class="modal" tabindex="-1" id="add-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen bwa-modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="page-title text-primary">{{ $judul }}</h4>
            <div class="float-right">
                <button type="button" class="btn btn-outline-primary position-relative" id="save" tabindex="-1"><i class="fe fe-save"></i>
                    Simpan</button>
                <button type="button" class="btn btn-outline-danger position-relative" id="batal"><i class="fe fe-slash"></i>
                        Batal</button>
                <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
        </div>
        <div class="modal-body bwa-modal_body">
            <div class="bwa-modal-container">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-lg-6 col-md-12">
                                        <form class="" id='trn'>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Nama Lengkap</label>
                                                        <div class="col-md-9" id="div-id">
                                                            <input type="text" id="tx-name" name="name" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Alamat</label>
                                                        <div class="col-md-9">
                                                            <textarea type="text" id="tx-address" name="address" autocomplete="off" class="form-control form-control-sm mb-2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">HP</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="tx-hp" name="hp" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Email</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="tx-email" name="email" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Facebook</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="tx-facebook" name="facebook" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Instagram</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="tx-instagram" name="instagram" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Jenis/Tipe Produk</label>
                                                        <div class="col-md-9">
                                                            <textarea id="tx-history" rows="4" name="history" autocomplete="off" class="form-control form-control-sm mb-2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">CRO Owner</label>
                                                        <div class="col-md-9">
                                                            <select name="sales" id="cb-sales" class="form-select form-control form-control-sm mb-2" tabindex="10">
                                                                @if($roleName == 'ADMIN')
                                                                <option value="">-- Pilih CRO --</option>
                                                                @endif
                                                                @foreach($karyawan as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">
                                                        </label>
                                                        <div class="col-md-9 col-auto">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="chk-aktif" name="aktif" tabindex="19">
                                                                <span class="custom-control-label">Tidak Aktif</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form><!-- END Form -->
                                    </div>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
</div>
<!--#endregion === Modal=== -->
<!-- Modal -->
<div class="modal" tabindex="-1" id="modalImport" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen bwa-modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="page-title text-primary">Import Pelanggan</h4>
            <div class="float-right">
                <button type="button" class="btn btn-outline-primary position-relative" id="btnProses" tabindex="-1"><i class="fe fe-save"></i>
                    Simpan</button>
                <button type="button" class="btn btn-outline-danger position-relative" id="batalImport"><i class="fe fe-slash"></i>
                        Batal</button>
                <button type="button" id="btn-close-import" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
        </div>
        <div class="modal-body bwa-modal_body">
            <div class="bwa-modal-container">
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row row-sm">
                                    <div class="col-lg-6 col-md-12">
                                        <form id="frmImpor">
                                            <div class="card">
                                                <div class="card-body">
                                                    <ol>
                                                        <li>
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <label for="files">Download Daftar Karyawan</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <a href="{{ url('karyawan/export') }}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-file-download"></i> Download</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <label for="files">Download Template Pelanggan</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <a href="{{ url('pelanggan/export') }}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-file-download"></i> Download</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <label for="files">Buka file <b>Pelanggan.xlsx</b></label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <label>Isi <b>DATA PELANGGAN</b> secara lengkap</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Isi <b>PERIODE</b> dengan format 4 digit tahun dan 2 digit bulan. Contoh : <b>202208</b></label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label>Isi <b>ID SALES OWNER</b> yang didapat dari file <b>Daftar Karyawan.xlsx</b> yang sudah didownload</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label><b>Save As</b> data yang sudah sesuai Fieldnya dengan nama file yang memudahkan Anda.</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <img src="{{ asset('uploads/import_pelanggan.jpg') }}" alt="ilustrasi" width="100%">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="files">Upload Filenya disini</label>
                                                                        <input type="file" class="form-control-file" name="file" id="file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row p-2">
                                                                <div class="col-md-12">
                                                                    <label>Klik Tombol <b>Simpan</b> kanan diatas. Lalu tunggu sampai ada notifikasi berhasil.</label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </form><!-- END Form -->
                                    </div>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer')
<script type="text/javascript">

    var mode = 'TAMBAH';

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
        loadData(1,$('#pilih-status').val(), $('#cb-sales').val(), $('#tx-search').val());

        $('#tx-name').on('change', function(){
            var el = $(this);
            $.ajax({
                url:"{{ route('customer.isExist') }}",
                method:"POST",
                data:{name:el.val()},
                success:function(data){
                    if(data==='true'){
                        alert('Nama Pelanggan telah ada.');
                        el.val('');
                        el.focus();
                    }
                }
            });
        });

        $(document).on('click', '.halaman', function(){
           var page = $(this).attr("id");
           var status = $('#pilih-status').val();
           var employe = $('#cb-sales').val();
           var search = $('#tx-search').val();
           loadData(page,status,employe,search);
        });

        $('#tampil').click(function () {
           var status = $('#pilih-status').val();
           var employe = $('#cb-sales').val();
           var search = $('#tx-search').val();
           loadData(1,status,employe,search);
        });

        $('#btnExport').on('click',function(){
            exportListCustomer($('#pilih-status').val(), $('#cb-sales').val(), $('#tx-search').val());
        });

        $('#createNew').click(function(){
            mode = 'TAMBAH';
            $('#add-modal').show();
        });

        $('#import').click(function(){
            $('#modalImport').show();
        });

        $(document).on('click','.btn-edit',function(){
            mode = 'EDIT';
            var id = $(this).closest('tr').find('input').val();
            $.ajax({
                url:"{{ route('customer.get') }}",
                method:"POST",
                data:{id:id.trim()},
                success:function(data){
                    var obj = data[0];
                    var input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "id");
                    input.setAttribute("value", obj.id);
                    document.getElementById("div-id").appendChild(input);
                    $('#tx-name').val(obj.name);
                    $('#tx-address').val(obj.address);
                    $('#tx-hp').val(obj.hp);
                    $('#tx-email').val(obj.email);
                    $('#tx-facebook').val(obj.facebook);
                    $('#tx-instagram').val(obj.instagram);
                    $('#tx-history').val(obj.history);
                    $('#cb-sales option[value="'+obj.eid+'"]').attr("selected", "selected");
                    $('#chk-aktif').prop('checked', !(Boolean(obj.status)));
                }
            })
            $('#ajax-loading').show();
            setTimeout(() => {$('#add-modal').show();$('#ajax-loading').hide();}, 1500);

        });

        $(document).on('click','.btn-delete',function(){
            var customer_id = $(this).closest('tr').find('#customer_id').val();
            var sales_id = $(this).closest('tr').find('#sales_id').val();
            checkdelete(customer_id.trim(),sales_id.trim(),$(this));
        });

        $('#add-modal').on('shown.bs.modal', function (e) {
            //AktivasiTab();
            $('#tx-name').focus();
        });

        $('#btn-close').click(function () {
            $('#add-modal').hide();
            var frm = document.querySelector("#trn");
            frm.reset();
            $('#cb-sales option').removeAttr("selected", "selected");
            var status = $('#pilih-status').val();
            var employe = $('#cb-sales').val();
            var search = $('#tx-search').val();
            loadData(1,status,employe,search);
        });

        $('#btn-close-import').click(function () {
            $('#modalImport').hide();
            var status = $('#pilih-status').val();
            var employe = $('#cb-sales').val();
            var search = $('#tx-search').val();
            loadData(1,status,employe,search);
        });

        $('#batal').click(function () {
            mode = 'TAMBAH';
            var frm = document.querySelector("#trn");
            frm.reset();
            $('#cb-sales option').removeAttr("selected", "selected");
        });

        $('#batalImport').click(function () {
            var frm = document.querySelector("#frmImpor");
            frm.reset();
        });

        $('#save').click(function(e) {
            e.preventDefault();
            var el = $(this);
            el.html('...');

            var kirim = true;
            const frm = new FormData(document.querySelector("#trn"));
            const obj = Object.fromEntries(frm.entries());
            var name = $('#tx-name').val();
            obj.mode = mode;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('pelanggan/validation') }}",
                type: "POST",
                data: {name:name},
                dataType: "json",
                success: function (respon) {
                    if($.isEmptyObject(respon.error)) {
                        $.ajax({
                            data: obj,
                            url:  "{{ route('customer.save') }}",
                            type: "POST",
                            success: function(msg) {
                                if (msg.IsSuccess){
                                    const myJSON = JSON.stringify(msg.Obj);
                                    let obj = JSON.parse(myJSON);
                                    alert('Sukses.');
                                    $('#trn').trigger("reset");
                                    $('#cb-sales option').removeAttr("selected", "selected");
                                    if(obj[0] == 'EDIT') {
                                        $('#add-modal').hide();
                                        window.location.reload();
                                    }
                                }else{
                                    alert(msg.Message)
                                }
                            },
                            error: function(msg) {
                                console.log('Error:', msg);
                            }
                        }).done(function(msg){
                            el.html('Simpan');
                            el.removeAttr('disabled');
                        });
                    } else {
                        alert('Data Belum Lengkap.');
                        el.html('Simpan');
                        el.removeAttr('disabled');
                    }
                }
            });
        });

        $('#btnProses').on('click',function(){
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append("_token","{{ csrf_token() }}");
            $.ajax({
                url: '{{ route('customer.upload') }}',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                    success: function(response){
                        if(response=='Berhasil'){
                            alert('Sukses.');
                            window.location.reload();
                        }else{
                            alert('Gagal.');
                        }
                    },
            });

        });

        $('.select2').select2();
    });


function loadData(page,status,employe,search){
    $.ajax({
        url:"{{ route('pelanggan.getTabel') }}",
        method:"POST",
        data:{page:page, status:status, employe:employe, search:search},
        success:function(data){
            $('#tbl').html(data);
        }
    })
}

function checkdelete(customer_id,sales_id,el)
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
                url:"{{route('customer.delete') }}",
                method:"POST",
                data:{customer_id:customer_id,sales_id:sales_id},
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

function exportListCustomer(status,salesId,search)
{
    var url = '{{ url('pelanggan/export-list-customer') }}?salesId='+salesId+'&status='+status+'&search='+search;
    $.get(url,function(data){
        window.open(url, '_blank');
    });
}

</script>
@endsection
