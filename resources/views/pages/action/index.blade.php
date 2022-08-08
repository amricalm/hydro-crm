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
                                    <label class="col-md-2 form-label">Kategori Aksi</label>
                                    <div class="col-md-4">
                                        <select name="category" id="cb-category" class="form-select form-control form-control-sm mb-2" tabindex="10">
                                            <option value="">-- Pilih Kategori Aksi --</option>
                                            <option value="999">-- Pilih Semua Kategori Aksi --</option>
                                            @foreach($category as $item)
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
                                                        <label class="col-md-3 form-label">Kategori Aksi</label>
                                                        <div class="col-md-9">
                                                            <select name="category" id="cb-category" class="form-select form-control form-control-sm mb-2" tabindex="10">
                                                                <option value="">-- Pilih Kategori Aksi --</option>
                                                                @foreach($category as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Kode Aksi</label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="tx-code" name="code" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Nama Aksi</label>
                                                        <div class="col-md-9" id="div-id">
                                                            <input type="text" id="tx-name" name="name" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Bobot(%)</label>
                                                        <div class="col-md-9">
                                                            <input type="number" min="0" max="100" id="tx-weight" name="weight" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Target/Bln</label>
                                                        <div class="col-md-9">
                                                            <input type="number" id="tx-target" name="target" autocomplete="off" class="form-control form-control-sm mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row row-sm mb-0">
                                                        <label class="col-md-3 form-label">Keterangan</label>
                                                        <div class="col-md-9">
                                                            <textarea type="text" id="tx-desc" name="desc" autocomplete="off" class="form-control form-control-sm mb-2"></textarea>
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
        loadData(1, $('#cb-category').val());

        $('#tx-name').on('change', function(){
            var el = $(this);
            $.ajax({
                url:"{{ route('action.isExist') }}",
                method:"POST",
                data:{name:el.val()},
                success:function(data){
                    if(data==='true'){
                        alert('Nama Aksi telah ada.');
                        el.val('');
                        el.focus();
                    }
                }
            });
        });

        $(document).on('click', '.halaman', function(){
           var page = $(this).attr("id");
           var category = $('#cb-category').val();
           loadData(page,category);
        });

        $('#tampil').click(function () {
           var category = $('#cb-category').val();
           loadData(1,category);
        });

        $('#createNew').click(function(){
            mode = 'TAMBAH';
            $('#add-modal').show();
        });

        $(document).on('click','.btn-edit',function(){
            mode = 'EDIT';
            var id = $(this).closest('tr').find('input').val();
            $.ajax({
                url:"{{ route('action.get') }}",
                method:"POST",
                data:{id:id.trim()},
                success:function(data){
                    var obj = data[0];
                    var input = document.createElement("input");
                    input.setAttribute("type", "hidden");
                    input.setAttribute("name", "id");
                    input.setAttribute("value", obj.id);
                    document.getElementById("div-id").appendChild(input);
                    $('#cb-category option[value="'+obj.category_id+'"]').attr("selected", "selected");
                    $('#tx-code').val(obj.code);
                    $('#tx-name').val(obj.name);
                    $('#tx-weight').val(obj.weight);
                    $('#tx-target').val(obj.target);
                    $('#tx-desc').val(obj.desc);
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
            $('#tx-name').focus();
        });

        $('#btn-close').click(function () {
            $('#add-modal').hide();
            var frm = document.querySelector("#trn");
            frm.reset();
            $('#cb-category option').removeAttr("selected", "selected");
            var category = $('#cb-category').val();
            loadData(1,category);
        });

        $('#batal').click(function () {
            mode = 'TAMBAH';
            var frm = document.querySelector("#trn");
            frm.reset();
            $('#cb-category option').removeAttr("selected", "selected");
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
                url: "{{ url('aksi/validation') }}",
                type: "POST",
                data: {name:name},
                dataType: "json",
                success: function (respon) {
                    if($.isEmptyObject(respon.error)) {
                        $.ajax({
                            data: obj,
                            url:  "{{ route('action.save') }}",
                            type: "POST",
                            success: function(msg) {
                                if (msg.IsSuccess){
                                    alert('Sukses.');
                                    $('#trn').trigger("reset");
                                    $('#cb-category option').removeAttr("selected", "selected");
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

function loadData(page,category){
    $.ajax({
        url:"{{ route('action.getTabel') }}",
        method:"POST",
        data:{page:page, category:category},
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
                url:"{{route('action.delete') }}",
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
