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
                        <a href="{{ url('penjualan') }}"><button type="button" class="btn btn-outline-warning position-relative"><i class="fe fe-arrow-left"></i></button></a>
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
                                            <form id="frmsearch">
                                                <div class="form-group row row-sm mb-0">
                                                    <label class="col-md-3 form-label">Cari</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="search" id="txtSearch" autocomplete="off" class="form-control  form-control-sm  mb-2" placeholder="Cari Nama, Hp, Alamat, Email, FB, IG" tabindex="13">
                                                    </div>
                                                    <div class="col-md-1 text-right">
                                                        <button class="btn btn-sm btn-primary" id="btnSearch"><i class="fe fe-search"></i> Cari</button>
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
                                                <div class="col-md-5">
                                                    <input type="date" name="date" id="date" autocomplete="off" class="form-control  form-control-sm  mb-2" value="{{ $date }}">
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
                                                    <textarea type="text" name="history" id="history" rows="2" autocomplete="off" class="form-control  form-control-sm  mb-2" disabled></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="border-info mt-4 mb-4">
                                    <table class="table-sm table-condensed table-bordered small fw-bold" id="tbl-transaksi">
                                        <thead>
                                            <tr>
                                                <th style="width:24%;">Produk</th>
                                                <th style="width:20%;">Teknisi</th>
                                                <th style="width:20%;">CRO</th>
                                                <th style="width:20%;">Keterangan</th>
                                                <th style="width:12%;">Harga</th>
                                                <th colspan="2" style="width:4%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr_clone mh-100">
                                                <td>
                                                    <select name="product" id="product" class="form-select form-control form-control-sm mb-2 cbo-product" tabindex="10">
                                                        <option value="">--- Pilih Produk ---</option>
                                                        @foreach($product as $item)
                                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="technician" id="technician" class="form-select form-control form-control-sm mb-2 cbo-technician" tabindex="10">
                                                        <option value="">--- Pilih Teknisi ---</option>
                                                        @foreach($technician as $item)
                                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-right">
                                                    <select name="sales" id="sales" class="form-select form-control form-control-sm mb-2 cbo-sales" tabindex="10">
                                                        <option value="">--- Pilih CRO ---</option>
                                                        @foreach($sales as $item)
                                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-right">
                                                    <textarea type="text" name="desc" id="desc" rows="1" autocomplete="off" class="form-control form-control-sm mb-2 desc" tabindex="13"></textarea>
                                                </td>
                                                <td class="text-right">
                                                    <input type="text" name="amount" id="amount" rows="1" autocomplete="off" class="form-control form-control-sm mb-2 amount" tabindex="13" />
                                                </td>
                                                <td colspan="2"><button class="btn btn-block btn-blue" id="tambah-baris" ><i class="fe fe-plus"></i></td>
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
@endsection
@section('footer')
    <script type="text/javascript">
        var mode = 'TAMBAH';
        var idTabel = "tbl-transaksi";
        var idxKolomProduct = 0; var idxKolomTechnician = 1;
        var idxKolomSales = 2; var idxKolomDesc = 3;
        var idxKolomAmont = 4; var idxKolomEdit = 5;
        var idxKolomHapus = 6;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
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

                $('#product').focus();
            });
        });

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

            var urlAksi = "{{ url('penjualan/getCustomer') }}";
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
            kolom = baris.cells[idxKolomProduct];
            var pro = $(kolom).children('.kd-pro').val();
            kolom.innerHTML = setProduct() + '<input type="hidden" class="kd-pro" ori-value="' + pro + '" name="kd-pro[]" value="' +pro+ '"/>';

            cboEditAction = $('#entri-edit-product').combobox().data('combobox');
            cboEditAction.select();
            cboEditAction.$element.val(pro).trigger('change');
            cboEditAction.$target.val(pro).trigger('change');
            cboEditAction.$source.val(pro).trigger('change');
            cboEditAction.selected=true;

            kolom = baris.cells[idxKolomTechnician];
            var tec = $(kolom).children('.kd-tec').val();
            kolom.innerHTML = setTechnician() + '<input type="hidden" class="kd-tec" ori-text="'+tec+'"  ori-value="' + tec + '" name="kd-tec[]" value="' +tec+ '"/>';

            cboEditRes = $('#entri-edit-technician').combobox().data('combobox');;
            cboEditRes.select();
            cboEditRes.$element.val(tec).trigger('change');
            cboEditRes.$target.val(tec).trigger('change');
            cboEditRes.$source.val(tec).trigger('change');
            cboEditRes.selected=true;

            kolom = baris.cells[idxKolomSales];
            var sal = $(kolom).children('.kd-sal').val();
            kolom.innerHTML = setSales() + '<input type="hidden" class="kd-sal" ori-text="'+sal+'"  ori-value="' + sal + '" name="kd-sal[]" value="' +sal+ '"/>';

            cboEditRes = $('#entri-edit-sales').combobox().data('combobox');;
            cboEditRes.select();
            cboEditRes.$element.val(sal).trigger('change');
            cboEditRes.$target.val(sal).trigger('change');
            cboEditRes.$source.val(sal).trigger('change');
            cboEditRes.selected=true;

            kolom = baris.cells[idxKolomDesc];
            var desc = $(kolom).children('.kd-desc').val();
            kolom.innerHTML = '<textarea type="text" class="form-control input-sm entri-edit-desc" rows="1" tabindex = "104" name="desc" original-value="' + desc + '">' + desc + '</textarea>';

            kolom = baris.cells[idxKolomAmont];
            var amo = $(kolom).children('.kd-amount').val();
            kolom.innerHTML = '<input type="text" class="form-control input-sm entri-edit-amount" tabindex = "104" name="amount" ori-value="' + amo + '" value="' +amo+ '"/>';
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
            var cProduct    = baris.insertCell(idxKolomProduct);
            var cTechnician = baris.insertCell(idxKolomTechnician);
            var cSales      = baris.insertCell(idxKolomSales);
            var cDesc       = baris.insertCell(idxKolomDesc);
            var cAmount     = baris.insertCell(idxKolomAmont);

            cProduct.innerHTML      = '<span>'+ document.getElementsByName('product')[0].value + '</span><input type="hidden" class="kd-pro" name="product-id[]" value="' +document.getElementsByName('product')[0].value + '"/>';
            cTechnician.innerHTML   = '<span>'+ document.getElementsByName('technician')[0].value + '</span><input type="hidden" class="kd-tec" name="technician-id[]" value="' +document.getElementsByName('technician')[0].value + '"/>';
            cSales.innerHTML        = '<span>'+ document.getElementsByName('sales')[0].value + '</span><input type="hidden" class="kd-sal" name="sales-id[]" value="' +document.getElementsByName('sales')[0].value + '"/>'
            cDesc.innerHTML         = '<span>'+ document.getElementsByName('desc')[0].value + '</span><input type="hidden" class="kd-desc" name="desc-id[]" value="' +document.getElementsByName('desc')[0].value + '"/>';
            cAmount.innerHTML       = '<span>'+ document.getElementsByName('amount')[0].value + '</span><input type="hidden" class="kd-amount" name="amount-id[]" value="' +document.getElementsByName('amount')[0].value + '"/>';

            document.getElementsByName('product')[0].value ="";
            document.getElementById('technician').value = "";
            document.getElementsByName('sales')[0].value ="";
            document.getElementById('desc').value = "";
            document.getElementById('amount').value = "";
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

        function setProduct()
        {
            var ori = $(".kd-pro").attr("ori-value");
            var str = `<select class="form-select form-control form-control-sm mb-2 cbo-product" name="entri-edit-product" id="entri-edit-product">
                        <option value=""></option>
                        @foreach($product as $rows)
                            <option value="{{$rows->name}}">{{$rows->name}}</option>
                        @endforeach
                    </select>`;
            return str;
        }

        function setTechnician()
        {
            var ori = $(".kd-tec").attr("ori-value");
            var str = `<select class="form-select form-control form-control-sm mb-2 cbo-technician" name="entri-edit-technician" id="entri-edit-technician">
                        <option value=""></option>
                        @foreach($technician as $rows)
                            <option value="{{$rows->name}}">{{$rows->name}}</option>
                        @endforeach
                    </select>`;
            return str;
        }

        function setSales()
        {
            var ori = $(".kd-sal").attr("ori-value");
            var str = `<select class="form-select form-control form-control-sm mb-2 cbo-sales" name="entri-edit-sales" id="entri-edit-sales">
                        <option value=""></option>
                        @foreach($sales as $rows)
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
            kolom = baris.cells.item(idxKolomProduct);
            var pro = $(kolom).children('.cbo-product').val();
            kolom.innerHTML =  '<span>'+ pro + '</span><input type="hidden" class="kd-pro" name="product-id[]" value="' + pro + '"/>';

            kolom = baris.cells.item(idxKolomTechnician);
            var tec = $(kolom).children('.cbo-technician').val();
            kolom.innerHTML =  '<span>'+ tec + '</span><input type="hidden" class="kd-tec" name="technician-id[]" value="' + tec + '"/>';

            kolom = baris.cells.item(idxKolomSales);
            var sal = $(kolom).children('.cbo-sales').val();
            kolom.innerHTML =  '<span>'+ sal + '</span><input type="hidden" class="kd-sal" name="sales-id[]" value="' + sal + '"/>';

            kolom = baris.cells.item(idxKolomDesc);
            el = kolom.firstChild;
            var desc = el.value;
            kolom.innerHTML = '<span>'+ desc + '</span><textarea class="kd-desc" name="desc-id[]" style="display:none;">' + desc + '</textarea>';

            kolom = baris.cells.item(idxKolomAmont);
            el = kolom.firstChild;
            var amo = el.value;
            kolom.innerHTML = '<span>'+ amo + '</span><input type="hidden" class="kd-amount" name="amount-id[]" value="' + amo + '"/>';
        }

        function setBarisKeNilaiOriginal(baris)
        {
            kolom = baris.cells.item(idxKolomProduct);
            var pro = $(kolom).children('.kd-pro').attr('ori-value');
            kolom.innerHTML = '<span>'+ pro + '</span><input type="hidden" class="kd-pro" name="product-id[]" value="' +pro+ '"/>';

            kolom = baris.cells.item(idxKolomTechnician);
            var tec = $(kolom).children('.kd-tec').attr('ori-value');
            kolom.innerHTML = '<span>'+ tec + '</span><input type="hidden" class="kd-tec" name="technician-id[]" value="' +tec+ '"/>';

            kolom = baris.cells.item(idxKolomSales);
            var sal = $(kolom).children('.kd-sal').attr('ori-value');
            kolom.innerHTML = '<span>'+ sal + '</span><input type="hidden" class="kd-sal" name="sales-id[]" value="' +sal+ '"/>';

            kolom = baris.cells.item(idxKolomDesc);
            el = kolom.firstChild;
            desc = el.getAttribute('original-value');
            var desc = desc;
            kolom.innerHTML = '<span>'+ desc + '</span><textarea class="kd-desc" name="desc-id[]" style="display:none;">' + desc + '</textarea>';

            kolom = baris.cells.item(idxKolomAmont);
            el = kolom.firstChild;
            amo = el.getAttribute('original-value');
            var amo = amo;
            kolom.innerHTML = '<span>'+ amo + '</span><input type="hidden" class="kd-amount" name="amount-id[]" value="' + amo + '"/>';
        }

        $('#btnSearch').on('click',function(){
            search();
        });

        function search()
        {
            search  = $('#txtSearch').val();
            if(search=='' || search==' ')
            {
                alert('Pencarian tidak boleh kosong');
                return;
            }

            $("#ajax-loading").show();
            $('#btnSearch').html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;&nbsp;Sedang mencari');
            $('#btnSearch').attr('disabled',true);
            $.post('{{ url('penjualan/search') }}',{_token:'{{ csrf_token() }}',search:search},function(data){
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
            var product = "", technician="", sales = "", desc="", amount=0, dtlID = 0;

            var modeEdit = 'Edit',
                date = $('#date').val(),
                customer = parseInt($('#customer').val()),
                hp = $('#hp').val(),
                address = $('#address').val(),
                email = $('#email').val(),
                facebook = $('#facebook').val(),
                instagram = $('#instagram').val();

            //--------- Validasi ---------------------------------------------//
            const frm = new FormData(document.querySelector("#trn"));
            const obj = Object.fromEntries(frm.entries());
            obj.mode = mode;

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('penjualan/validationCustomer') }}",
                type: "POST",
                data: {customer:customer, hp:hp},
                dataType: "json",
                success: function (respon) {
                    if($.isEmptyObject(respon.error)) {
                        const o = [{ModeEdit:modeEdit , customer:customer, hp:hp, address:address, email:email, facebook:facebook, instagram:instagram}];

                        baris = tbl.tBodies[0].getElementsByTagName('tr');
                        rowCount = 0;
                        for (i = 0; i < baris.length - 1; i++)
                        {
                            productColumn       = baris.item(i).cells.item(idxKolomProduct);
                            product             = $(productColumn).children(':input').val();
                            technicianColumn    = baris.item(i).cells.item(idxKolomTechnician);
                            technician          = $(technicianColumn).children(':input').val();
                            salesColumn         = baris.item(i).cells.item(idxKolomSales);
                            sales               = $(salesColumn).children(':input').val();
                            descColumn          = baris.item(i).cells.item(idxKolomDesc);
                            desc                = $(descColumn).children(':input').val();
                            amountColumn        = baris.item(i).cells.item(idxKolomAmont);
                            amount              = $(amountColumn).children(':input').val();


                            var btn = baris.item(i).cells.item(idxKolomEdit).firstChild.getAttribute('data-btn');
                            // if(btn.toString().trim().toUpperCase()=="OK")
                            // {
                            //     showAlert('warning','','Detail Pembelian Belum Lengkap.');
                            //     return false;
                            // }

                            const dtl = [{dtlID:dtlID, customer:customer, date:date, product:product, technician:technician, sales:sales, desc:desc, amount:amount}];
                            o.push(dtl);
                            console.log(o);
                        }

                        if(product == '')
                        {
                            showAlert('warning','','Detail Aksi Tidak Ada.');
                            return false;
                        }

                        $('.btn-simpan').prop('disabled', true);
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ url('penjualan/saveSaleing') }}",
                            type: "POST",
                            data: JSON.stringify(o),
                            dataType: "json",
                            contentType: "application/json; charset=utf-8",
                            success: function (respon) {
                                if (respon.IsSuccess)
                                {
                                    showAlert('success','',respon.Message);
                                    window.location.reload();
                                    $('.btn-simpan').prop('disabled', false);
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
