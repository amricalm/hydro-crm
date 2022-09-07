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
                            <a href="{{ url('penjualan/create') }}" class="btn btn-outline-primary" ><i class="fe fe-plus-square"></i> Tambah</a>
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
                                    <label class="col-md-1 form-label">Tanggal</label>
                                    <div class="col-md-3">
                                        <input type="date" name="tglDr" id="tglDr" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $startDate }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" name="tglSd" id="tglSd" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $endDate }}">
                                    </div>
                                </div>
                                <div class="form-group row row-sm mb-0">
                                    <label class="col-md-1 form-label">CRO</label>
                                    <div class="col-md-6">
                                        <select name="sales" id="cb-sales" class="form-select form-control form-control-sm mb-2">
                                            @if($roleName == 'ADMIN')
                                            <option value="">-- Pilih CRO --</option>
                                            @endif
                                            @foreach($karyawan as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="tampil" class="btn btn-sm btn-primary"><i class="fe fe-search"></i>Tampil</button>
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
                                                        <label class="col-md-3 form-label">Tanggal</label>
                                                        <div class="col-md-9" id="div-id">
                                                            <input type="date" name="date" id="tx-date" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $date }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Pelanggan</label>
                                                        <div class="col-md-9" id="tx-customer-id">
                                                            <input type="text" id="tx-customer" name="customer" autocomplete="off" class="form-control form-control-sm mb-2">
                                                            {{-- <select name="customer" id="cb-customer" class="form-select form-control form-control-sm mb-2"> --}}
                                                                {{-- @if($roleName == 'ADMIN') --}}
                                                                {{-- <option value="">-- Pilih CRO --</option> --}}
                                                                {{-- @endif --}}
                                                                {{-- @foreach($customer as $item) --}}
                                                                {{-- <option value="{{$item->id}}">{{$item->name}}</option> --}}
                                                                {{-- @endforeach --}}
                                                            {{-- </select> --}}
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
                                                        <label class="col-md-3 form-label">Produk</label>
                                                        <div class="col-md-9">
                                                            <select name="product" id="cb-product" class="form-select form-control form-control-sm mb-2">
                                                                @if($roleName == 'ADMIN')
                                                                <option value="">-- Pilih CRO --</option>
                                                                @endif
                                                                @foreach($product as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Teknisi</label>
                                                        <div class="col-md-9">
                                                            <select name="technician" id="cb-technician" class="form-select form-control form-control-sm mb-2">
                                                                @if($roleName == 'ADMIN')
                                                                <option value="">-- Pilih Teknisi --</option>
                                                                @endif
                                                                @foreach($karyawan as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">CRO</label>
                                                        <div class="col-md-9">
                                                            <select name="sales" id="cbe-sales" class="form-select form-control form-control-sm mb-2">
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
                                                        <label class="col-md-3 form-label">Keterangan</label>
                                                        <div class="col-md-9">
                                                            <textarea type="text" id="tx-desc" name="desc" autocomplete="off" class="form-control form-control-sm mb-2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Harga</label>
                                                        <div class="col-md-9">
                                                            <input type="number" id="tx-amount" name="amount" autocomplete="off" class="form-control form-control-sm mb-2 text-right">
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
        loadData(1,$('#tglDr').val(),$('#tglSd').val(),$('#cb-sales').val());

        $(document).on('click', '.halaman', function(){
           var page = $(this).attr("id");
           var tglDr = $('#tglDr').val();
           var tglSd = $('#tglSd').val();
           var employe = $('#cb-sales').val();
           loadData(page,tglDr,tglSd,employe);
        });

        $('#tampil').click(function () {
           var tglDr = $('#tglDr').val();
           var tglSd = $('#tglSd').val();
           var employe = $('#cb-sales').val();
           loadData(1,tglDr,tglSd,employe);
        });

        $('#createNew').click(function(){
            mode = 'TAMBAH';
            $('#add-modal').show();
        });

        $(document).on('click','.btn-edit',function(){
            mode = 'EDIT';
            var id = $(this).closest('tr').find('input').val();
            $.ajax({
                url:"{{ route('saleing.get') }}",
                method:"POST",
                data:{id:id.trim()},
                success:function(data){
                    var obj = data[0];
                    var input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "id");
                    input.setAttribute("value", obj.id);
                    document.getElementById("div-id").appendChild(input);
                    var now = new Date(obj.date);
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var date = now.getFullYear()+"-"+(month)+"-"+(day);
                    console.log(obj.sales_id);
                    $('#tx-date').val(date);
                    // $('#cb-customer option[value="'+obj.customer_id+'"]').attr("selected", "selected");
                    var cusid = document.createElement("input");
                    cusid.setAttribute("type", "hidden");
                    cusid.setAttribute("name", "customer_id");
                    cusid.setAttribute("value", obj.customer_id);
                    document.getElementById("tx-customer-id").appendChild(cusid);
                    $('#tx-customer').val(obj.customer_name);
                    $("#tx-customer").prop('disabled', true);
                    $('#tx-address').val(obj.address);
                    $("#tx-address").prop('disabled', true);
                    $('#tx-hp').val(obj.hp);
                    $("#tx-hp").prop('disabled', true);
                    $('#tx-email').val(obj.email);
                    $("#tx-email").prop('disabled', true);
                    $('#tx-facebook').val(obj.facebook);
                    $("#tx-facebook").prop('disabled', true);
                    $('#tx-instagram').val(obj.instagram);
                    $("#tx-instagram").prop('disabled', true);
                    $('#cb-product option[value="'+obj.product_id+'"]').attr("selected", "selected");
                    $('#cb-technician option[value="'+obj.technician_id+'"]').attr("selected", "selected");
                    $('#cbe-sales option[value="'+obj.sales_id+'"]').attr("selected", "selected");
                    $('#tx-desc').val(obj.desc);
                    $('#tx-amount').val(obj.amount);
                }
            })
            $('#ajax-loading').show();
            setTimeout(() => {$('#add-modal').show();$('#ajax-loading').hide();}, 1500);

        });

        $(document).on('click','.btn-delete',function(){
            var id = $(this).closest('tr').find('input').val();
            checkdelete(id.trim(),$(this));
        });

        $('#add-modal').on('shown.bs.modal', function (e) {
            //AktivasiTab();
            // $('#cb-customer').focus();
            $('#tx-customer').focus();
        });

        $('#btn-close').click(function () {
            $('#add-modal').hide();
            var frm = document.querySelector("#trn");
            frm.reset();
            // $('#cb-customer option').removeAttr("selected", "selected");
            $('#cb-product option').removeAttr("selected", "selected");
            $('#cb-technician option').removeAttr("selected", "selected");
            $('#cbe-sales option').removeAttr("selected", "selected");
            var tglDr = $('#tglDr').val();
            var tglSd = $('#tglSd').val();
            var employe = $('#cb-sales').val();
            loadData(1,tglDr,tglSd,employe);
        });

        $('#btn-close-import').click(function () {
            $('#modalImport').hide();
            var tglDr = $('#tglDr').val();
            var tglSd = $('#tglSd').val();
            var employe = $('#cb-sales').val();
            loadData(1,tglDr,tglSd,employe);
        });

        $('#batal').click(function () {
            mode = 'TAMBAH';
            var frm = document.querySelector("#trn");
            frm.reset();
            // $('#cb-customer option').removeAttr("selected", "selected");
            $('#cb-product option').removeAttr("selected", "selected");
            $('#cb-technician option').removeAttr("selected", "selected");
            $('#cbe-sales option').removeAttr("selected", "selected");
        });

        $('#save').click(function(e) {
            e.preventDefault();
            var el = $(this);
            el.html('...');

            var kirim = true;
            const frm = new FormData(document.querySelector("#trn"));
            const obj = Object.fromEntries(frm.entries());
            var name = $('#tx-customer').val();//$('#cb-customer').val();
            obj.mode = mode;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('penjualan/validation') }}",
                type: "POST",
                data: {name:name},
                dataType: "json",
                success: function (respon) {
                    if($.isEmptyObject(respon.error)) {
                        $.ajax({
                            data: obj,
                            url:  "{{ route('saleing.save') }}",
                            type: "POST",
                            success: function(msg) {
                                if (msg.IsSuccess){
                                    console.log(msg.Obj);
                                    alert('Sukses.');
                                    $('#trn').trigger("reset");
                                    // $('#cb-customer option').removeAttr("selected", "selected");
                                    $('#cb-product option').removeAttr("selected", "selected");
                                    $('#cb-technician option').removeAttr("selected", "selected");
                                    $('#cbe-sales option').removeAttr("selected", "selected");
                                    if(msg.Obj == 'EDIT') {
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

        $('.select2').select2();
    });

function loadData(page,tglDr,tglSd,employe){
    $.ajax({
        url:"{{ route('saleing.getTabel') }}",
        method:"POST",
        data:{page:page, tglDr:tglDr, tglSd:tglSd, employe:employe},
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
                url:"{{route('saleing.delete') }}",
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

</script>
@endsection
