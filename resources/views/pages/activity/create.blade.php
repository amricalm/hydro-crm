@extends('templates.minimalist.index')
@include('templates.komponen.sweetalert')
@section('body')
<!-- Page -->
<div class="page">
    <div class="page-main">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <a href="{{ url('aktivitas') }}"><button type="button" class="btn btn-outline-warning position-relative"><i class="fe fe-arrow-left"></i></button></a>
                        <h4 class="col-md-2 page-title text-primary">{{ $judul }}</h4>
                        <div class="col-md-8 text-center">
                            <div id="jam" class="page-title text-primary">0</div>
                        </div>
                        <div class="float-right col-md-2 text-center">
                            <button type="button" class="btn btn-outline-danger position-relative btn-batal" id="batal"><i class="fe fe-slash"></i>
                                Batal</button>
                            <button type="button" class="btn btn-blue position-relative btn-simpan" data-adnmode="ADD"><i class="fe fe-save"></i>
                                Simpan</button>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row row-sm">
                            <div class="col-lg-12 col-md-12">
                                <form class="" id="trn">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Jenis Aksi</label>
                                                <div class="col-md-5">
                                                    <select name="category" id="category" class="form-select form-control  form-control-sm  mb-2" tabindex="10">
                                                        @foreach($category as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    {{-- <button class="btn btn-sm btn-gray btn-block" id="createNew"><i class="fe fe-plus"></i> Tambah Pelanggan</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <form id="frmsearch">
                                                <div class="form-group row row-sm mb-0">
                                                    <label class="col-md-3 form-label">Cari</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="search" id="txtSearch" autocomplete="off" class="form-control  form-control-sm  mb-2" placeholder="Cari Nama, Hp, Alamat, Email, FB, IG" tabindex="13">
                                                    </div>
                                                    <div class="col-md-1 text-right">
                                                        <button class="btn btn-sm btn-info" id="btnSearch"><i class="fe fe-search"></i> Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <hr class="border-info mt-4 mb-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Tanggal</label>
                                                <div class="col-md-5" id="activityEdit">
                                                    <input type="date" name="date" id="date" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $date }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="time" name="time" id="time" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $time }}">
                                                </div>
                                            </div>
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Nama Pelanggan</label>
                                                <div class="col-md-9">
                                                    <select name="customer" id="customer" class="form-select form-control form-control-sm mb-2" tabindex="10">
                                                        <option value="">-- Pilih Pelanggan --</option>
                                                        @foreach($customer as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">HP</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="hp" id="hp" autocomplete="off" class="form-control  form-control-sm  mb-2" tabindex="13">
                                                </div>
                                            </div>
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Alamat</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" name="address" id="address" rows="2" autocomplete="off" class="form-control  form-control-sm  mb-2" tabindex="13"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Email</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="email" id="email" autocomplete="off" class="form-control  form-control-sm  mb-2" tabindex="13">
                                                </div>
                                            </div>
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Facebook</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="facebook" id="facebook" autocomplete="off" class="form-control  form-control-sm  mb-2" tabindex="13">
                                                </div>
                                            </div>
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Instagram</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="instagram" id="instagram" autocomplete="off" class="form-control  form-control-sm  mb-2" tabindex="13">
                                                </div>
                                            </div>
                                            <div class="form-group row row-sm mb-0">
                                                <label class="col-md-3 form-label">Riwayat</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" name="history" id="history" rows="2" autocomplete="off" class="form-control  form-control-sm  mb-2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="border-info mt-4 mb-4">
                                    <table class="table-sm table-condensed table-bordered small fw-bold" id="tbl-transaksi">
                                        <thead>
                                            <tr>
                                                <th style="width:24%;">Aksi</th>
                                                <th style="width:24%;">Keterangan Aksi</th>
                                                <th style="width:24%;">Respon</th>
                                                <th style="width:24%;">Keterangan Respon</th>
                                                <th colspan="2" style="width:4%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr_clone mh-100">
                                                <td>
                                                    <select name="action" id="action" class="form-select form-control form-control-sm mb-2 cbo-action" tabindex="10">
                                                        <option value="" disabled>--- Pilih Aksi ---</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea type="text" name="action_desc" id="action_desc" rows="1" autocomplete="off" class="form-control form-control-sm mb-2 action_desc" tabindex="13"></textarea>
                                                </td>
                                                <td class="text-right">
                                                    <select name="response" id="response" class="form-select form-control form-control-sm mb-2 cbo-response" tabindex="10">
                                                        <option value="" disabled>--- Pilih Respon ---</option>
                                                    </select>
                                                </td>
                                                <td class="text-right">
                                                    <textarea type="text" name="response_desc" id="response_desc" rows="1" autocomplete="off" class="form-control form-control-sm mb-2 response_desc" tabindex="13"></textarea>
                                                </td>
                                                <td colspan="2"><button class="btn btn-block btn-blue" id="tambah-baris" ><i class="fe fe-plus"></i></td>
                                                {{-- <td><button class="btn btn-block btn-danger btn-sm hapus-baris" id="hapus-baris" ><i class="fe fe-x"></i></button></td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </form><!-- END Form -->
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <form id="trnadd">
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
                                                        <label class="col-md-3 form-label">Sales Owner</label>
                                                        <div class="col-md-9">
                                                            <select name="sales" id="cb-sales" class="form-select form-control form-control-sm mb-2" tabindex="10">
                                                                @if($roleName == 'ADMIN')
                                                                <option value="">-- Pilih Sales --</option>
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
@endsection
@section('footer')
    <script type="text/javascript">
        var mode = '';
        var modeEdit = '';
        var idTabel = "tbl-transaksi";
        var barisAktifIndex = -1;
        var idxKolomAksi = 0; var idxKolomAksiDesc = 1;
        var idxKolomRespon = 2; var idxKolomResponDesc = 3;
        var idxKolomEdit = 4; var idxKolomHapus = 5;

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const activityId = urlParams.get('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            mode = 'TAMBAH';
            $(document).ajaxStart(function() {
                $("#ajax-loading").show();
            });

            $(document).ajaxStop(function() {
                $("#ajax-loading").hide();
            });

            function currentTime() {
                var date = new Date(); /* creating object of Date class */
                var hour = date.getHours();
                var min = date.getMinutes();
                var sec = date.getSeconds();
                hour = updateTime(hour);
                min = updateTime(min);
                sec = updateTime(sec);
                document.getElementById("jam").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
                var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
            }
            function updateTime(k) {
                if (k < 10) {
                    return "0" + k;
                }
                else {
                    return k;
                }
            }
            currentTime();

            $('#btnSearch').on('click',function(){
                search($('#txtSearch').val());
            });

            $('#category').on("change",function(){
                getByCategoryAction($(this).val());
            });
            $('#category').trigger('change');

            $('#customer').on("change",function(){
                getCustomer($(this).val());
            });

            var tbl;
            setTabel(idTabel);

            $('#tambah-baris').click(function () {
                tbl = document.getElementById(idTabel);
                var dataBtn = '';

                var tbodi = tbl.getElementsByTagName('tbody')[0];
                var barisBody = tbodi.getElementsByTagName('tr');
                var row = tbodi.insertRow(barisBody.length - 1);

                setBarisBaru(row);
                var cEdit = row.insertCell(idxKolomEdit);
                var cHapus = row.insertCell(idxKolomHapus);

                //------------------------------------------------------------------------------------------------------
                cEdit.style.textAlign = "center";
                cHapus.style.textAlign = "center";

                var btnEdit = document.createElement("a");
                btnEdit.href = "#";
                btnEdit.addEventListener("click", function (e) {
                    e.preventDefault();
                    btnEditEventListener(this);
                });

                var imgEdit = document.createElement("i");
                imgEdit.setAttribute('class', 'fa fa-pencil text-success fa-lg');
                btnEdit.setAttribute('data-btn', 'EDIT');
                btnEdit.appendChild(imgEdit);
                cEdit.appendChild(btnEdit);

                var btnHapus = document.createElement("a");
                btnHapus.href = "#";
                btnHapus.addEventListener("click", function (e) {
                    e.preventDefault();
                    btnHapusEventListener(this);
                });
                var imgHapus = document.createElement("i");
                imgHapus.setAttribute('class', 'fa fa-close text-danger fa-lg');
                btnHapus.appendChild(imgHapus);
                cHapus.appendChild(btnHapus);

                $('#action').focus();
            });

            if (activityId)
            {
                $.ajax({
                    url:'{{ url('aktivitas/create') }}?id='+activityId,
                    method:"POST",
                    data:{id:activityId},
                    success: function (data) {
                        if (data.IsSuccess) {
                            var Obj = data.Obj;
                            mode = 'TAMBAH';
                            modeEdit = 'EDIT';
                            var activity = Obj.activity;
                            getCustomer(activity.customer_id);
                            getDetail(Obj.activityDtl);

                            //Membuat input hidden activityid
                            var input = document.createElement("input");
                            input.setAttribute("type", "hidden");
                            input.setAttribute("id", "activity");
                            input.setAttribute("name", "activity");
                            input.setAttribute("value", activityId);
                            document.getElementById("activityEdit").appendChild(input);
                        }
                        else {
                            showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                        }
                    }
                })
            }
        });

        function getDetail(dataDtl) {
            tbl = document.getElementById(idTabel);
            var dataBtn = '';

            $.each(dataDtl, function(key, value) {
                var tbodi = tbl.getElementsByTagName('tbody')[0];
                var barisBody = tbodi.getElementsByTagName('tr');
                var row = tbodi.insertRow(barisBody.length - 1);

                setBarisEdit(row, value);

                var cEdit = row.insertCell(idxKolomEdit);
                var cHapus = row.insertCell(idxKolomHapus);
                //------------------------------------------------------------------------------------------------------
                cEdit.style.textAlign = "center";
                cHapus.style.textAlign = "center";

                var btnEdit = document.createElement("a");
                btnEdit.href = "#";
                btnEdit.addEventListener("click", function (e) {
                    e.preventDefault();
                    btnEditEventListener(this);
                });

                var imgEdit = document.createElement("i");
                imgEdit.setAttribute('class', 'fa fa-pencil text-success fa-lg');
                btnEdit.setAttribute('data-btn', 'EDIT');
                btnEdit.setAttribute('baris', key+1);
                btnEdit.appendChild(imgEdit);
                cEdit.appendChild(btnEdit);

                var btnHapus = document.createElement("a");
                btnHapus.href = "#";
                btnHapus.addEventListener("click", function (e) {
                    e.preventDefault();
                    btnHapusEventListener(this);
                });
                var imgHapus = document.createElement("i");
                imgHapus.setAttribute('class', 'fa fa-close text-danger fa-lg');
                btnHapus.appendChild(imgHapus);
                cHapus.appendChild(btnHapus);
            });
            $('#action').focus();
        }

        $('#batal').click(function () {
            mode = 'TAMBAH';
            $('#customer').val('');
            $('#hp').val('');
            $('#address').val('');
            $('#email').val('');
            $('#facebook').val('');
            $('#instagram').val('');
            $('#history').val('');
        });

        $('#createNew').click(function(){
            $('#add-modal').show();
        });

        function getByCategoryAction(id)
        {
            var action = '@Model.action';
            var response = '@Model.response';
            $.ajax({
                url: "{{ url('aktivitas/getByCategoryAction') }}",
                type: "POST",
                data: {'id' :id},
                dataType: "json",
                success: function (respon) {
                    var act = respon.action;
                    var res = respon.response;
                    $('#action').find('option').not(':first').remove();
                    $('#response').find('option').not(':first').remove();
                    if (respon.success) {
                        $.each(act,function(index,value){
                            $('#action').append('<option value="'+value.name+'">'+value.name+'</option>');
                        });
                        $.each(res,function(index,value){
                            $('#response').append('<option value="'+value.name+'">'+value.name+'</option>');
                        });
                        $('#action').val(action);
                        $('#response').val(response);
                    }
                    else {
                        showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                    }
                }
            });
        }

        function getCustomer(id)
        {
            if(id.toString().trim()=='')
            {
                $('#customer').val('');
                $('#hp').val('');
                $('#address').val('');
                $('#email').val('');
                $('#facebook').val('');
                $('#instagram').val('');
                $('#history').val('');
                return false;
            }

            var urlAksi = "{{ url('aktivitas/getCustomer') }}";
            $.ajax({
                url: urlAksi,
                type: "POST",
                data: {'id' :id},
                success: function (respon) {
                    if (respon.IsSuccess) {
                        var Obj = respon.Obj;
                        if(respon.ID !="")
                        {
                            $('#customer').val(Obj.id);
                            $('#hp').val(Obj.hp);
                            $('#address').val(Obj.address);
                            $('#email').val(Obj.email);
                            $('#facebook').val(Obj.facebook);
                            $('#instagram').val(Obj.instagram);
                            $('#history').val(Obj.history);
                            $('#customer').focus();
                        }
                    }
                    else {
                        showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                    }
                }
            });
        }

        function btnEditEventListener(src)
        {
            var el = null;
            var kolom = null;

            var dataBtn = '';
            var tbl = document.getElementById(idTabel);
            if (mode == 'TAMBAH') {
                setKolomBtnOk_Batal(src);
                setBarisAktif(src.parentElement.parentElement);

                mode = 'EDIT';
            } else {
                //NON AKTIF Baris AKTIF SEBELUMNYA -----------------------------------
                dataBtn = src.getAttribute('data-btn');

                var kolomIdx = src.parentElement.cellIndex;
                kolom = tbl.rows[barisAktifIndex].cells.item(kolomIdx);
                el = kolom.firstChild;

                setKolomBtnEdit_Hapus(el);

                if (dataBtn == 'EDIT') {
                    setBarisKeNilaiOriginal(tbl.rows[barisAktifIndex]);

                } else if (dataBtn == 'OK') {
                    setBarisUpdateNilai(tbl.rows[barisAktifIndex]);
                }
            }


            barisAktifIndex = src.parentElement.parentElement.rowIndex;


            if (mode == "EDIT" && dataBtn == "EDIT") {
                // --- BARIS AKTIF SIAP EDIT --------------------------
                setKolomBtnOk_Batal(src);
                setBarisAktif(src.parentElement.parentElement);
                mode = 'EDIT';
            }
            else if (dataBtn == "OK") {
                mode = 'TAMBAH';
                tbl.rows[tbl.rows.length - 2].style.display = "table-row";
            }
        }

        function setBarisAktif(baris) {
            kolom = baris.cells[idxKolomAksi];
            var act = $(kolom).children('.kd-act').val();
            kolom.innerHTML = setAction() + '<input type="hidden" class="kd-act" ori-value="' + act + '" name="kd-act[]" value="' +act + '"/>';

            cboEditAction = $('#entri-edit-action').combobox().data('combobox');
            cboEditAction.select();
            cboEditAction.$element.val(act).trigger('change');
            cboEditAction.$target.val(act).trigger('change');
            cboEditAction.$source.val(act).trigger('change');
            cboEditAction.selected=true;

            kolom = baris.cells[idxKolomRespon];
            var res = $(kolom).children('.kd-res').val();
            kolom.innerHTML = setResponse() + '<input type="hidden" class="kd-res" ori-text="'+res+'"  ori-value="' + res + '" name="kd-prj[]" value="' +res+ '"/>';

            cboEditRes = $('#entri-edit-response').combobox().data('combobox');;
            cboEditRes.select();
            cboEditRes.$element.val(res).trigger('change');
            cboEditRes.$target.val(res).trigger('change');
            cboEditRes.$source.val(res).trigger('change');
            cboEditRes.selected=true;


            kolom = baris.cells[idxKolomAksiDesc];
            var actDesc = $(kolom).children('.kd-act-desc').val();
            kolom.innerHTML = '<textarea type="text" class="form-control input-sm entri-edit-action-desc" rows="1" tabindex = "104" name="action_desc" original-value="' + actDesc + '">' + actDesc + '</textarea>';

            kolom = baris.cells[idxKolomResponDesc];
            var resDesc = $(kolom).children('.kd-res-desc').val();
            kolom.innerHTML = '<textarea type="text" class="form-control input-sm entri-edit-response-desc" rows="1" tabindex = "104" name="response_desc" original-value="' + resDesc + '">' + resDesc + '</textarea>';
        }

        function setKolomBtnOk_Batal(elSource) {
            var el;
            elSource.setAttribute('data-btn', 'OK');
            el = elSource.firstChild;
            el.setAttribute('class', 'fa fa-check text-success fa-lg');

            el = elSource.parentElement.parentElement.cells.item(idxKolomHapus);
            el = el.getElementsByTagName('i')[0];
            el.setAttribute('class', 'fa fa-undo text-dangers fa-lg');
        }

        function setKolomBtnEdit_Hapus(elSource) {
            var el;

            el = elSource.parentElement.parentElement.cells.item(idxKolomEdit);
            el = el.getElementsByTagName("i")[0];
            el.setAttribute('class', 'fa fa-pencil text-success fa-lg');

            el = elSource.parentElement.parentElement.cells.item(idxKolomHapus);
            el = el.getElementsByTagName("i")[0];
            el.setAttribute('class', 'fa fa-close text-danger fa-lg');
        }

        function setBarisBaru(baris) {
            var cAksi       = baris.insertCell(idxKolomAksi);
            var cAksiDesc   = baris.insertCell(idxKolomAksiDesc);
            var cRespon     = baris.insertCell(idxKolomRespon);
            var cResponDesc = baris.insertCell(idxKolomResponDesc);

            cAksi.innerHTML         = '<span>'+ document.getElementsByName('action')[0].value + '</span><input type="hidden" class="kd-act" name="action-id[]" value="' +document.getElementsByName('action')[0].value + '"/>';
            cAksiDesc.innerHTML     = '<span>'+ document.getElementsByName('action_desc')[0].value + '</span><input type="hidden" class="kd-act-desc" name="action-id-desc[]" value="' +document.getElementsByName('action_desc')[0].value + '"/>';
            cRespon.innerHTML       = '<span>'+ document.getElementsByName('response')[0].value + '</span><input type="hidden" class="kd-res" name="response-id[]" value="' +document.getElementsByName('response')[0].value + '"/>'
            cResponDesc.innerHTML   = '<span>'+ document.getElementsByName('response_desc')[0].value + '</span><input type="hidden" class="kd-res-desc" name="response-id-desc[]" value="' +document.getElementsByName('response_desc')[0].value + '"/>';

            document.getElementsByName('action')[0].value ="";
            document.getElementById('action_desc').value = "";
            document.getElementsByName('response')[0].value ="";
            document.getElementById('response_desc').value = "";
        }

        function setBarisEdit(baris, dataDtl) {
            var cAksi       = baris.insertCell(idxKolomAksi);
            var cAksiDesc   = baris.insertCell(idxKolomAksiDesc);
            var cRespon     = baris.insertCell(idxKolomRespon);
            var cResponDesc = baris.insertCell(idxKolomResponDesc);

            document.getElementsByName('action')[0].value = dataDtl.action_name;
            document.getElementById('action_desc').value = dataDtl.action_desc;
            document.getElementsByName('response')[0].value = dataDtl.response_name;
            document.getElementById('response_desc').value = dataDtl.response_desc;

            cAksi.innerHTML         = '<span>'+ document.getElementsByName('action')[0].value + '</span><input type="hidden" class="kd-act" ori-value="' +document.getElementsByName('action')[0].value+ '" name="action-id[]" value="' +document.getElementsByName('action')[0].value+ '"/>';
            cAksiDesc.innerHTML     = '<span>'+ document.getElementsByName('action_desc')[0].value + '</span><input type="hidden" class="kd-act-desc" original-value="' +document.getElementsByName('action_desc')[0].value+ '" name="action-id[]" name="action-id-desc[]" value="' +document.getElementsByName('action_desc')[0].value + '"/>';
            cRespon.innerHTML       = '<span>'+ document.getElementsByName('response')[0].value + '</span><input type="hidden" class="kd-res" ori-value="' +document.getElementsByName('response')[0].value+ '" name="action-id[]" name="response-id[]" value="' +document.getElementsByName('response')[0].value + '"/>'
            cResponDesc.innerHTML   = '<span>'+ document.getElementsByName('response_desc')[0].value + '</span><input type="hidden" class="kd-res-desc" original-value="' +document.getElementsByName('response_desc')[0].value+ '" name="action-id[]" name="response-id-desc[]" value="' +document.getElementsByName('response_desc')[0].value + '"/>';

            document.getElementsByName('action')[0].value ="";
            document.getElementById('action_desc').value = "";
            document.getElementsByName('response')[0].value ="";
            document.getElementById('response_desc').value = "";
        }

        function btnHapusEventListener(src)
        {
            var baris;

            if (mode == 'TAMBAH') {
                tbl.deleteRow(src.parentElement.parentElement.rowIndex);
            } else {
                //-------- MODE EDIT -----------------------------------

                setBarisKeNilaiOriginal(src.parentElement.parentElement);

                el = src.parentElement.parentElement.cells.item(idxKolomEdit).getElementsByTagName('a')[0];
                setKolomBtnEdit_Hapus(el);

                mode = 'TAMBAH';
                tbl.rows[tbl.rows.length - 2].style.display = "table-row"
                //=== END MODE EDIT =============================================================
            }
        }

        function setAction()
        {
            var ori = $(".kd-act").attr("ori-value");
            var str = `<select class="form-select form-control form-control-sm mb-2 cbo-action" name="entri-edit-action" id="entri-edit-action">
                        <option value=""></option>
                        @foreach($action as $rows)
                            <option value="{{$rows->name}}">{{$rows->name}}</option>
                        @endforeach
                    </select>`;
            return str;
        }

        function setResponse()
        {
            var ori = $(".kd-res").attr("ori-value");
            var str = `<select class="form-select form-control form-control-sm mb-2 cbo-response" name="entri-edit-response" id="entri-edit-response">
                        <option value=""></option>
                        @foreach($response as $rows)
                            <option value="{{$rows->name}}">{{$rows->name}}</option>
                        @endforeach
                    </select>`;
            return str;
        }

        function setTabel(idTbl) {
            tbl = document.getElementById(idTbl);
        }

        function setBarisUpdateNilai(baris)
        {
            kolom = baris.cells.item(idxKolomAksi);
            var act = $(kolom).children('.cbo-action').val();
            kolom.innerHTML =  '<span>'+ act + '</span><input type="hidden" class="kd-act" name="action-id[]" value="' + act + '"/>';

            kolom = baris.cells.item(idxKolomRespon);
            var res = $(kolom).children('.cbo-response').val();
            kolom.innerHTML =  '<span>'+ res + '</span><input type="hidden" class="kd-res" name="response-id[]" value="' + res + '"/>';

            kolom = baris.cells.item(idxKolomAksiDesc);
            el = kolom.firstChild;
            var actDesc = el.value;
            kolom.innerHTML = '<span>'+ actDesc + '</span><textarea style="display:none;" class="kd-act-desc" name="action-id-desc[]" style="display:none;">' + actDesc + '</textarea>';

            kolom = baris.cells.item(idxKolomResponDesc);
            el = kolom.firstChild;
            var resDesc = el.value;
            kolom.innerHTML = '<span>'+ resDesc + '</span><textarea class="kd-res-desc" name="response-id-desc[]" style="display:none;">' + resDesc + '</textarea>';
        }

        function setBarisKeNilaiOriginal(baris)
        {
            kolom = baris.cells.item(idxKolomAksi);
            var act = $(kolom).children('.kd-act').attr('ori-value');
            kolom.innerHTML = '<span>'+ act + '</span><input type="hidden" class="kd-act" name="action-id[]" value="' +act+ '"/>';

            kolom = baris.cells.item(idxKolomRespon);
            var res = $(kolom).children('.kd-res').attr('ori-value');
            kolom.innerHTML = '<span>'+ res + '</span><input type="hidden" class="kd-res" name="response-id[]" value="' +res+ '"/>';

            kolom = baris.cells.item(idxKolomAksiDesc);
            el = kolom.firstChild;
            actDesc = el.getAttribute('original-value');
            var actDesc = actDesc;
            kolom.innerHTML = '<span>'+ actDesc + '</span><textarea style="display:none;" class="kd-act-desc" name="action-id-desc[]" style="display:none;">' + actDesc + '</textarea>';

            kolom = baris.cells.item(idxKolomResponDesc);
            el = kolom.firstChild;
            resDesc = el.getAttribute('original-value');
            var resDesc = resDesc;
            kolom.innerHTML = '<span>'+ resDesc + '</span><textarea class="kd-res-desc" name="response-id-desc[]" style="display:none;">' + resDesc + '</textarea>';
        }

        function search(search)
        {
            if(search=='' || search==' ')
            {
                alert('Pencarian tidak boleh kosong');
                return;
            }

            $("#ajax-loading").show();
            $('#btnSearch').html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;&nbsp;Sedang mencari');
            $('#btnSearch').attr('disabled',true);
            $.post('{{ url('aktivitas/search') }}',{_token:'{{ csrf_token() }}',search:search},function(data){
                $('#btnSearch').html('<i class="fe fe-search"></i>&nbsp; Cari');
                $('#btnSearch').removeAttr('disabled');
                $("#ajax-loading").hide();
                if(data!='')
                {
                    datas = JSON.parse(data);
                    resultSearch = datas.resultSearch;
                    var $el = $("#customer");
                    $el.empty();
                    $el.append('<option value="">--- Pilih Pelanggan ---</option>');
                    $.each(resultSearch,function(index,value){
                        $el.append('<option value="'+value.id+'">'+value.name+'</option>');
                    })
                }
                else
                {
                    alert('Pencarian tidak ditemukan');
                    return;
                }
            })
        }

        $('.btn-simpan').click(function (e) {
            e.preventDefault();
            var tbl = document.getElementById('tbl-transaksi');
            var action = "", response="", actionDesc = "", responseDesc="", kolomPrj, kolomProgram,
                dtlID = 0;

            var date = $('#date').val(),
                time = $('#time').val(),
                customer = parseInt($('#customer').val()),
                hp = $('#hp').val(),
                address = $('#address').val(),
                email = $('#email').val(),
                facebook = $('#facebook').val(),
                instagram = $('#instagram').val(),
                history = $('#history').val();

            //--------- Validasi ---------------------------------------------//
            const frm = new FormData(document.querySelector("#trn"));
            const obj = Object.fromEntries(frm.entries());
            obj.mode = mode;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('aktivitas/validation') }}",
                type: "POST",
                data: {customer:customer, hp:hp},
                dataType: "json",
                success: function (respon) {
                    if($.isEmptyObject(respon.error)) {
                        const o = [{modeEdit:modeEdit, activityId:activityId, date:date, time:time, customer:customer, hp:hp, address:address, email:email, facebook:facebook, instagram:instagram, history:history}];

                        baris = tbl.tBodies[0].getElementsByTagName('tr');
                        rowCount = 0;
                        for (i = 0; i < baris.length - 1; i++)
                        {
                            actionColumn    = baris.item(i).cells.item(idxKolomAksi);
                            action          = $(actionColumn).children(':input').val();
                            responseColumn  = baris.item(i).cells.item(idxKolomRespon);
                            response        = $(responseColumn).children(':input').val();
                            actionDescColumn= baris.item(i).cells.item(idxKolomAksiDesc);
                            actionDesc          = $(actionDescColumn).children(':input').val();
                            responseDescColumn  = baris.item(i).cells.item(idxKolomResponDesc);
                            responseDesc        = $(responseDescColumn).children(':input').val();


                            var btn = baris.item(i).cells.item(idxKolomEdit).firstChild.getAttribute('data-btn');
                            // if(btn.toString().trim().toUpperCase()=="OK")
                            // {
                            //     showAlert('warning','','Detail Aksi Belum Lengkap.');
                            //     return false;
                            // }

                            const dtl = [{action:action, response:response, actionDesc:actionDesc, responseDesc:responseDesc}];
                            o.push(dtl);
                        }

                        if(action == '')
                        {
                            showAlert('warning','','Detail Aksi Tidak Ada.');
                            return false;
                        }

                        $('.btn-simpan').prop('disabled', true);
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ url('aktivitas/save') }}",
                            type: "POST",
                            data: JSON.stringify(o),
                            dataType: "json",
                            contentType: "application/json; charset=utf-8",
                            success: function (respon) {
                                if (respon.IsSuccess)
                                {
                                    showAlert('success','',respon.Message);
                                    if(respon.Mode=="EDIT") {
                                        window.location = "{{ url('aktivitas') }}";
                                    } else {
                                        window.location.reload();
                                        $('.btn-simpan').prop('disabled', false);
                                    }
                                }
                                else {
                                    showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                                }
                            }, error: function(respon) {
                                console.log('Error:', respon);
                            }
                        });
                    } else {
                        showAlert('warning','','Data Belum Lengkap.');
                    }
                }
            });
            //--------------------------------------------
        });
    </script>
@endsection
