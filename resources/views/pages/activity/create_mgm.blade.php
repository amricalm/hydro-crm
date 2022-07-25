@extends('templates.minimalist.index')
@include('templates.komponen.sweetalert')
@section('body')
<!-- Page -->
<div class="page">
    <div class="page-main">
        <div class="page-header">
            <h4 class="col-md-3 page-title text-primary">{{ $judul }}&nbsp;&nbsp;{{ date('d-m-Y') }}</h4>
            <div class="col-md-6 text-center page-title text-primary">
                <div id="jam">0</div>
            </div>
            <div class="float-right col-md-3 text-right">
                <button type="button" class="btn btn-outline-danger position-relative btn-batal" id="Batal"><i class="fe fe-slash"></i>
                    Batal</button>
                <button type="button" class="btn btn-blue position-relative btn-simpan" data-adnmode="ADD"><i class="fe fe-save"></i>
                    Simpan</button>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light mb-0">
                    <div class="card-body">
                        <div class="row row-sm">
                            <form id="trn" class="form-horizontal">
                                <div class="row border pt-2 pb-2">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group row row-sm mb-1">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-4 fs-11 text-right fw-bold">Cari Nama</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="cr-email" id="cr-email" class="form-control  form-control-sm" autocomplete="off" tabindex="20">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <input type="hidden" id="tr-id" value="0" />
                                                <input type="hidden" id="link-idbukubank" value="" />
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Cari HP</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="cr-hp" id="cr-hp" class="form-control  form-control-sm" autocomplete="off" tabindex="18">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-4 fs-11 text-right fw-bold">Cari Email</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="cr-email" id="cr-email" class="form-control  form-control-sm" autocomplete="off" tabindex="20">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-info m-0">
                                <div class="row pt-2 pb-2">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group row row-sm mb-1">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Nm Pelanggan</label>
                                                    <div class="form-group row row-sm mb-0 align-items-center">
                                                        <label class="col-md-3 fs-11 text-right fw-bold">Sales</label>
                                                        <div class="col-md-9">
                                                            <select name="NmDonatur" id="NmDonatur" class="form-select form-control form-control-sm mb-1" data-val="true" data-val-required="Harus Diisi" tabindex="14">
                                                                <option value="0">---</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Hp</label>
                                                    <div class="col-md-7">
                                                        <input type="text" name="NmWakif" id="NmWakif" class="form-control  form-control-sm  mb-1" data-val="true" data-val-required="Harus Diisi" autocomplete="off" tabindex="24">
                                                    </div>
                                                </div>
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Alamat</label>
                                                    <div class="col-md-7">
                                                        <textarea name="Alamat" id="Alamat" rows="2" class="form-control" autocomplete="off" tabindex="26"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Email</label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="Kota" id="Kota" class="form-control form-control-sm mb-1" autocomplete="off" tabindex="27">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="Pos" id="Pos" class="form-control form-control-sm mb-1" autocomplete="off" tabindex="28">
                                                    </div>
                                                </div>
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Facebook</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="Telp" id="Telp" class="form-control form-control-sm mb-1" autocomplete="off" tabindex="30">
                                                    </div>
                                                </div>
                                                <div class="form-group row row-sm mb-0 align-items-center">
                                                    <label class="col-md-3 fs-11 text-right fw-bold">Instagram</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="Telp" id="Telp" class="form-control form-control-sm mb-1" autocomplete="off" tabindex="30">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TABEL TRANSAKSI -->
                        <hr class="border-info m-0">
                        <div class="row pt-2 pb-2">
                            <div class="col-md-12">
                                <table class="table-sm table-condensed table-bordered small fw-bold" id="tbl-transaksi">
                                    <thead>
                                        <tr>
                                            <th style="width:20%;">Program</th>
                                            <th style="width:30%;">Project</th>
                                            <th style="width:10%;" class=" text-right">Qty</th>
                                            <th style="width:15%;" class=" text-right">Dana</th>
                                            <th style="width:15%;" class=" text-right">Jumlah</th>
                                            <th colspan="2" style="width:10%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="tr_clone mh-100">
                                            <td>
                                                <select class="form-control input-sm entri cbo-program combobox" name="entri-program" id="entri-program" tabindex="40">
                                                    <option></option>

                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm entri cbo-prj combobox" name="entri-prj" id="entri-prj" tabindex="42">
                                                    <option value=""></option>

                                                </select>
                                            </td>
                                            <td class="text-right"><input id="entri-qty" value="1" class="form-control input-sm text-right" type="text" tabindex="23"></td>
                                            <td class="text-right"><input id="entri-dana" class="form-control input-sm angka text-right entri-dana" type="text" tabindex="24"></td>
                                            <td class="text-right angka" id="entri-jmh">0</td>

                                            <td colspan="2"><button class="btn btn-block btn-blue" id="tambah-baris" >Tambah</td>
                                            {{-- <td><button class="btn btn-block btn-danger btn-sm hapus-baris" id="hapus-baris" ><i class="fe fe-x"></i></button></td> --}}
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="align-right" style="text-align:right;font-weight:bold">TOTAL TRANSFER</td>
                                            <td class="align-right angka" style="text-align:right;font-weight:bold" id="total-transfer">0</td>
                                            <td class="align-right" style="text-align:right;font-weight:bold" colspan="2">TOTAL</td>
                                            <td class="align-right angka" style="text-align:right;font-weight:bold" id="td-total">0</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="align-right" style="text-align:right;font-weight:bold" colspan="4">Biaya Bank</td>
                                            <td class="align-right angka" style="text-align:right;font-weight:bold" id="td-biaya-bank"><input id="biaya-bank" name="Biaya Bank" tabindex="50" value="0"  class="form-control input-sm angka text-right entri" type="text" tabindex="50"></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-lookup" tabindex="-1" class="modal" aria-modal="true" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:800px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00a65a;;color:white;padding-bottom:12px;padding-top:12px;">
                <h4 class="modal-title small">Pilih Donatur</h4>
                <button type="button" id="btn-close" class="btn-close" aria-label="Close">x</button>
            </div>
            <div class="modal-body small">
                <div class="row" style=" padding-bottom:2px;">
                    <form id="modal-form" action="/Donasi/Create" method="post">
                        <input name="__RequestVerificationToken" type="hidden" value="pePQGhP9lp5BjUHKDWDBjL0cLGV0CAYmre0U-Y_wGiwdXC3v1iic7iw8QpbA3BmpGT_ZlufJBKzbav2ZozzLQkAlcv1aUvCu9vQu66ZSgLE1" />
                        <div class="form-horizontal form-group-sm">
                            <div class="form-group row row-sm mb-0 align-items-center">
                                <label class="control-label col-md-3 fs-11 text-right fw-bold" for="Nama_Donatur" style="padding-left:0px;padding-right:0px">Nama Donatur</label>
                                <div class="col-md-4">
                                    <input class="form-control form-control-sm  mb-1" id="filter-nm" name="filter-nm" type="text" value="" />
                                </div>
                                <div class="col-md-2">
                                    <a href="#" class="btn bg-green btn-sm" id="tampil-lookup"><i class="fa fa-search" style="margin-right:5px"></i>Tampil</a>
                                </div>
                            </div>
                            <div class="form-group row row-sm mb-0 align-items-center">
                                <label class="control-label col-md-3 fs-11 text-right fw-bold" for="Kode_Donatur">Kode Donatur</label>
                                <div class="col-sm-4">
                                    <input class="form-control form-control-sm  mb-1" id="filter-kd" name="filter-kd" type="text" value="" />
                                </div>
                            </div>
                            <div class="form-group row row-sm mb-0 align-items-center">
                                <label class="control-label col-md-3 fs-11 text-right fw-bold" for="HP">HP Pendaftar</label>
                                <div class="col-md-4">
                                    <input class="form-control form-control-sm  mb-1" id="filter-hp" name="filter-hp" type="text" value="" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="wadah-donatur">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<!-- End Page -->
@endsection
@section('footer')
    <script type="text/javascript">
        // shortcut.add("F12",function() {
        //     SimpanDonasi();
        // });

        var idTabel = "tbl-transaksi";
        var idxKolomProgram = 0;var idxKolomPrj = 1;
        var idxKolomQty = 2;  var idxKolomDana = 3; var idxKolomJmh = 4;
        var idxKolomEdit = 5; var idxKolomHapus =6;
        var baseUrl = '@Url.Content("~/")';

        var mode = '';
        var barisAktifIndex = -1;
        var cboProgram; var cboPrj; var cboEditProgram;var cboEditPrj;
        var pelangganArray = [];

        //new getKdProgram
        // var programArr = [];
        // foreach(var item in(ViewBag.ProgramList2))
        // {
        //     @:programArr.push({kdProgram: '@item.Key.Trim()', dana:@item.Value  });
        // }

        $(document).ready(function () {
            console.log('siap...');
            $('#AlurKerja').focus();
            $('.combobox').combobox();
            mode = 'TAMBAH';
            var i = 1;

            $("#entri-program").on("change", function () {
                var o = GetInArray($(this).val());
                if(o!=null || o!=undefined){
                    $('#entri-dana').val(AdnFormatNum(o.dana));
                }
                else
                {
                    $('.entri-dana').val(0);
                }
            });

            //======= Digunakan tapi belum di konversi ===============//
            // if (ViewBag.ModeEdit == "EDIT")
            // {
            //     $(document).delegate(".btn-edit","click",function(){
            //         btnEditEventListener(this);
            //     });

            //     $(document).delegate(".btn-hapus","click",function(){
            //         btnHapusEventListener(this);
            //     });
            // }

            //$('.angka').autoNumeric('init', { aSep: '.', aDec: ',', vMin: "0", vMax: '999999999' });

            // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            // $('[data-mask]').inputmask()


            // $('input[type="checkbox"].flat-red').iCheck({
            //     checkboxClass: 'icheckbox_flat-red',
            //     radioClass   : 'iradio_flat-red'
            // })
            //======= Akhir Digunakan tapi belum di konversi ===============//

            //----------------------------------------

            cboProgram = $('#entri-program').combobox().data('combobox');
            cboPrj = $('#entri-prj').combobox().data('combobox');



            //----------------------------------------------
            $('#entri-qty,#entri-dana').on("change",function(){
                setJumlah();
            });

            $('#cr-hp').on("change",function(){
                $('#cr-email').val('');
                getDonatur($(this).val());
            });

            $('#cr-email').on("change",function(){
                $('#cr-hp').val('');
                getDonaturByEmail($(this).val());
            });

            $('#NoKwitansi').on("change",function(){
                CekNoKwitansi($(this).val());
            });

            $('#KdCabang').on("change",function(){
                getJaringan($(this).val());
            });

            $('#KdCabang').trigger('change');

            $(document).delegate(".entri-edit-qty,.entri-edit-dana","change",function(){
                var baris = this.parentElement.parentElement;
                setJumlahEdit(baris);
            });

            $(document).delegate(".cbo-edit-program","change",function(){
                var o = GetInArray($(this).val());
                if(o!=null || o!=undefined){
                    $('.entri-edit-dana').val(AdnFormatNum(o.dana));
                }
                else
                {
                    $('.entri-edit-dana').val(0);
                }
            });

            var tbl;
            setTabel(idTabel);
            setSubTotal();

            $('#tambah-baris').click(function () {
                if (isValid())
                {
                    return false;
                }

                tbl = document.getElementById(idTabel);
                var jmhBaris = tbl.rows.length;
                var dataBtn = '';

                var tbodi = tbl.getElementsByTagName('tbody')[0];
                var barisBody = tbodi.getElementsByTagName('tr');
                var row = tbodi.insertRow(barisBody.length - 1);

                // $("#entri-program").selectedIndex = -1;

                setBarisBaru(row); // masalah
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

                $('.cbo-program').focus();

            });

        });//document

        function btnEditEventListener(src)
        {

            var el = null;
            var kolom = null;

            var dataBtn = '';
            var tbl = document.getElementById(idTabel);
            if (mode == 'TAMBAH') {

                tbl.rows[tbl.rows.length - 2].style.display = "none";

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

        function btnHapusEventListener(src)
        {
            var baris;
            //var dataBtn = '';

            if (mode == 'TAMBAH') {
                tbl.deleteRow(src.parentElement.parentElement.rowIndex);
                setSubTotal();
            } else {
                //-------- MODE EDIT -----------------------------------

                setBarisKeNilaiOriginal(src.parentElement.parentElement);

                el = src.parentElement.parentElement.cells.item(idxKolomEdit).getElementsByTagName('a')[0];
                setKolomBtnEdit_Hapus(el);

                mode = 'TAMBAH';
                //dataBtn = '';
                tbl.rows[tbl.rows.length - 2].style.display = "table-row"
                //=== END MODE EDIT =============================================================
            }
        }

        function GetInArray(id) {
            for (var i = 0, len = programArr.length; i < len; i++) {
                if (programArr[i].kdProgram == id)
                    return programArr[i];
            }
            return null;
        }

        function setKolomBtnOk_Batal(elSource) {
            //elSource = btnEdit;
            var el;
            elSource.setAttribute('data-btn', 'OK');
            el = elSource.firstChild;
            el.setAttribute('class', 'fa fa-check text-success fa-lg');

            el = elSource.parentElement.parentElement.cells.item(idxKolomHapus);
            el = el.getElementsByTagName('i')[0];
            el.setAttribute('class', 'fa fa-undo text-dangers fa-lg');
        }

        function setKolomBtnEdit_Hapus(elSource) {
            //elSource = btnEdit;
            var el;

            el = elSource.parentElement.parentElement.cells.item(idxKolomEdit);
            el = el.getElementsByTagName("i")[0];
            el.setAttribute('class', 'fa fa-pencil text-success fa-lg');

            el = elSource.parentElement.parentElement.cells.item(idxKolomHapus);
            el = el.getElementsByTagName("i")[0];
            el.setAttribute('class', 'fa fa-close text-danger fa-lg');
        }

        function setBarisAktif(baris) {

            kolom = baris.cells[idxKolomProgram];
            var prg = $(kolom).children('.kd-prg').val(); //kolom.firstChild.innerHTML;
            //kolom.innerHTML = '<input class="form-control input-sm entri-edit-program" name="entri-edit-program" type="text" placeholder="Kode Program"  tabindex="100" original-value="' + prg + '" value="' + prg + '"> \
            //    <input type="hidden" class="kd-prg" name="kd-prg[]" value="' +prg + '"/>'

            kolom.innerHTML =setProgram() + '<input type="hidden" class="kd-prg" ori-value="' + prg + '" name="kd-prg[]" value="' +prg + '"/>';

            cboEditProgram = $('#entri-edit-program').combobox().data('combobox'); //curiga
            cboEditProgram.select();
            cboEditProgram.$element.val(prg).trigger('change');
            cboEditProgram.$target.val(prg).trigger('change');
            cboEditProgram.$source.val(prg).trigger('change');
            cboEditProgram.selected=true;



            kolom = baris.cells[idxKolomPrj];
            var prj =$(kolom).children(":first").text();; //kolom.firstChild.innerHTML;
            var kdPrj = $(kolom).children('.kd-prj').val();//kolom.childNodes[1].value;
            //kolom.innerHTML = '<input class="form-control input-sm entri-edit-prj"  name="entri-edit-prj" type="text" placeholder="Nama Project" tabindex="110" original-value="' + prj + '" value="' + prj + '"> \
            //    <input type="hidden" class="kd-prj" name="kd-prj[]" value="' +kdPrj + '"/>';

            kolom.innerHTML =setProject() + '<input type="hidden" class="kd-prj" ori-text="'+prj+'"  ori-value="' + kdPrj + '" name="kd-prj[]" value="' +kdPrj + '"/>';
            cboEditPrj = $('#entri-edit-prj').combobox().data('combobox');
            cboEditPrj.select();
            cboEditPrj.$element.val(prj).trigger('change');
            cboEditPrj.$target.val(kdPrj).trigger('change');
            cboEditPrj.$source.val(kdPrj).trigger('change');
            cboEditPrj.selected=true;


            kolom = baris.cells[idxKolomQty];
            var qty = kolom.innerHTML.replace('.', '');
            kolom.innerHTML = '<input type="text" class="form-control input-sm angka text-right entri-edit-qty" tabindex = "104" name="qty" original-value="' + qty + '" value="' + qty + '">';

            kolom = baris.cells[idxKolomDana];
            var dana =  AdnToNum(kolom.innerHTML);//kolom.innerHTML.replace('.', '');
            kolom.innerHTML = '<input type="text" class="form-control input-sm angka text-right entri-edit-dana" tabindex = "106" name="dana" original-value="' + dana + '" value="' + dana + '">';
            //$('.angka').autoNumeric('init', { aSep: '.', aDec: ',', vMin: "0", vMax: '999999999' });
        }

        function setBarisKeNilaiOriginal(baris) {

            kolom = baris.cells.item(idxKolomProgram);
            //el = kolom.firstChild;
            // var nilai = $(kolom).children('.kd-prg').attr('ori-value');// el.getAttribute('original-value');
            var nilai = $(kolom).children('.kd-prg').attr('ori-value');// el.getAttribute('original-value');
            kolom.innerHTML = '<span>'+ nilai + '</span><input type="hidden" class="kd-prg" name="program-id[]" value="' +nilai+ '"/>';

            kolom = baris.cells.item(idxKolomPrj);
            var nilai = $(kolom).children('.kd-prj').attr('ori-value');// el.getAttribute('original-value');
            var txt = $(kolom).children('.kd-prj').attr('ori-text');
            kolom.innerHTML = '<span>'+ txt + '</span><input type="hidden" class="kd-prj" name="project-id[]" value="' +nilai + '"/>';


            kolom = baris.cells.item(idxKolomQty);
            el = kolom.firstChild;
            var nilai = el.getAttribute('original-value');
            var qty = nilai;
            kolom.innerHTML = AdnFormatNum(nilai);

            kolom = baris.cells.item(idxKolomDana);
            el = kolom.firstChild;
            nilai = el.getAttribute('original-value');
            var dana = nilai;
            kolom.innerHTML = AdnFormatNum(nilai);

            kolom = baris.cells.item(idxKolomJmh);
            kolom.innerHTML = AdnNumToString(AdnToNum(qty) * (AdnToNum(dana)));
        }

        function setBarisUpdateNilai(baris) {

            kolom = baris.cells.item(idxKolomProgram);
            var prg = $(kolom).children('.cbo-program').val();
            kolom.innerHTML =  '<span>'+ prg + '</span><input type="hidden" class="kd-prg" name="program-id[]" value="' +prg + '"/>';

            kolom = baris.cells.item(idxKolomPrj);
            var prj =$(kolom).children(":first").text();
            var kdPrj = $(kolom).children('.cbo-prj').val();
            kolom.innerHTML =  '<span>'+ $('.cbo-prj').val() + '</span><input class="kd-prj" type="hidden" name="kd-prj[]" value="' + kdPrj + '"/>';

            kolom = baris.cells.item(idxKolomQty);
            el = kolom.firstChild;
            var qty = el.value;
            kolom.innerHTML = AdnFormatNum(el.value);

            kolom = baris.cells.item(idxKolomDana);
            el = kolom.firstChild;
            var dana = el.value;
            kolom.innerHTML = AdnFormatNum(el.value);

            kolom = baris.cells.item(idxKolomJmh);
            kolom.innerHTML = AdnNumToString(AdnToNum(qty) * (AdnToNum(dana)));

            setSubTotal();
        }

        function setBarisBaru(baris) {

            var cProgram = baris.insertCell(0);
            var cPrj = baris.insertCell(1);
            var cQty = baris.insertCell(idxKolomQty);
            var cDana = baris.insertCell(idxKolomDana);
            var cJmh = baris.insertCell(idxKolomJmh);

            var textPrj = $('.cbo-prj').val();
            cProgram.innerHTML ='<span>'+ document.getElementsByName('entri-program')[0].value + '</span><input type="hidden" class="kd-prg" name="program-id[]" value="' +document.getElementsByName('entri-program')[0].value + '"/>';
            cPrj.innerHTML = '<span>'+  textPrj + '</span><input type="hidden" class="kd-prj" name="kd-prj[]" value="' +document.getElementsByName('entri-prj')[0].value + '"/>'

            cQty.innerHTML = AdnFormatNum(document.getElementById('entri-qty').value);
            cDana.innerHTML = AdnFormatNum(document.getElementById('entri-dana').value);
            cJmh.innerHTML = AdnNumToString(AdnToNum(cQty.innerHTML) * (AdnToNum(cDana.innerHTML)));


            cQty.style.textAlign = "right";
            cDana.style.textAlign = "right";
            cJmh.style.textAlign = "right";

            // cboProgram.clear();
            // cboPrj.clear();

            //document.getElementsByName('entri-program')[0].value ="";
            //document.getElementsByName('entri-prj')[0].value ="";
            document.getElementById('entri-qty').value = 1;
            document.getElementById('entri-dana').value = 0;
            document.getElementById('entri-jmh').innerHTML = "0";

            setSubTotal(document.getElementById('tbl-transaksi'));

        }

        function setTabel(idTbl) {
            tbl = document.getElementById(idTbl);
        }

        function setSubTotal() {

            var subTotal = 0;
            var jmh = 0;
            var tbl = document.getElementById('tbl-transaksi');
            baris = tbl.tBodies[0].getElementsByTagName('tr');
            rowCount = 0;
            for (i = 0; i < baris.length - 1; i++) {
                jmh = baris.item(i).cells.item(idxKolomJmh).innerHTML;
                subTotal = subTotal + AdnToNum(jmh);
            }

            var num = AdnNumToString(subTotal);
            num = subTotal;
            document.getElementById('td-total').innerHTML = AdnNumToString( subTotal );

        }

        function setJumlah() {
            var jmh = 0;

            var qty = document.getElementById('entri-qty').value;
            var dana = document.getElementById('entri-dana').value;

            jmh = AdnToNum(qty) * AdnToNum(dana);

            var num = AdnNumToString(jmh);
            document.getElementById('entri-jmh').innerHTML = num;
        }

        function setJumlahEdit(baris) {

            kolom = baris.cells.item(idxKolomQty);
            el = kolom.firstChild;
            var qty = el.value;

            kolom = baris.cells.item(idxKolomDana);
            el = kolom.firstChild;
            var dana = el.value;

            kolom = baris.cells.item(idxKolomJmh);
            kolom.innerHTML = AdnNumToString(AdnToNum(qty) * (AdnToNum(dana)));
        }

        function isValid()
        {
            var sProgram = document.getElementById('entri-program').value;
            var nQty = document.getElementById('entri-qty').value;
            var nDana = document.getElementById('entri-dana').value;

            if (sProgram.trim() =='' ||  AdnToNum(nQty) ==0 || AdnToNum(nDana)==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function getDonatur(noHp)
        {
            if(noHp.toString().trim()=='')
            {
                $('#cr-email').val('');

                $('#pelanggan-id').val('');
                $('#kd-pelanggan').val('');
                $('#NmDonatur').val('');
                $('#Alamat').val('');
                $('#Kota').val('');
                $('#Pos').val('');
                $('#Propinsi').val('0');
                $('#Telp').val('');
                $('#Hp').val('');
                $('#Email').val('');
                $('#NmWakif').val('');
                return false;
            }

            var urlAksi = "{{ url('donasi/cariNoHp') }}";
            $.ajax({
                url: urlAksi,
                type: "POST",
                data: {'NoHp' :noHp},
                success: function (respon) {
                    if (respon.IsSuccess) {
                        var Obj = respon.Obj;
                        console.log(Obj);
                        if(respon.ID !="" )
                        {
                            $('#pelanggan-id').val(Obj.id);
                            $('#kd-pelanggan').val(Obj.kd_pelanggan);
                            $('#NmDonatur').val(Obj.nm_lengkap);
                            $('#Alamat').val(Obj.alamat);
                            $('#Kota').val(Obj.kota);
                            $('#Pos').val(Obj.pos);
                            Obj.propinsi== null || Obj.propinsi.toString().trim()=='' ? $('#Propinsi').val('0'):$('#Propinsi').val(Obj.propinsi);
                            $('#Telp').val(Obj.telp);
                            $('#Hp').val(Obj.hp);
                            $('#Email').val(Obj.email);

                            $('#NmDonatur').focus();
                        }
                        else
                        {
                            //Donatur Baru
                            $('#pelanggan-id').val('');
                            $('#kd-pelanggan').val('');
                            $('#NmDonatur').val('');
                            $('#Alamat').val('');
                            $('#Kota').val('');
                            $('#Pos').val('');
                            $('#Propinsi').val('0');
                            $('#Telp').val('');
                            $('#Hp').val(noHp);
                            $('#Email').val('');
                            $('#NmWakif').val('');
                        }
                    }
                    else {
                        showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                    }
                }
            });
        }//GetDonaturByHp

        function getDonaturByEmail(email)
        {
            if(email.toString().trim()=='')
            {
                $('#cr-hp').val('');

                $('#pelanggan-id').val('');
                $('#kd-pelanggan').val('');
                $('#NmDonatur').val('');
                $('#Alamat').val('');
                $('#Kota').val('');
                $('#Pos').val('');
                $('#Propinsi').val('0');
                $('#Telp').val('');
                $('#Hp').val('');
                $('#Email').val('');
                $('#NmWakif').val('');
                return false;
            }

            var urlAksi = "{{ url('donasi/cariEmail') }}";
            $.ajax({
                url: urlAksi,
                type: "POST",
                data: {'Email' :email},
                success: function (respon) {
                    if (respon.IsSuccess) {
                        var Obj = respon.Obj;
                        if(respon.ID !="" )
                        {
                            $('#pelanggan-id').val(Obj.id);
                            $('#kd-pelanggan').val(Obj.kd_pelanggan);
                            $('#NmDonatur').val(Obj.nm_lengkap);
                            $('#Alamat').val(Obj.alamat);
                            $('#Kota').val(Obj.kota);
                            $('#Pos').val(Obj.pos);
                            Obj.propinsi== null || Obj.propinsi.toString().trim()=='' ? $('#Propinsi').val('0'):$('#Propinsi').val(Obj.propinsi);
                            $('#Telp').val(Obj.telp);
                            $('#Hp').val(Obj.hp);
                            $('#Email').val(Obj.email);
                            $('#NmDonatur').focus();
                        }
                        else
                        {
                            //Donatur Baru
                            $('#pelanggan-id').val('');
                            $('#kd-pelanggan').val('');
                            $('#NmDonatur').val('');
                            $('#Alamat').val('');
                            $('#Kota').val('');
                            $('#Pos').val('');
                            $('#Propinsi').val('0');
                            $('#Telp').val('');
                            $('#Hp').val('');
                            $('#Email').val(email);
                            $('#NmWakif').val('');
                        }
                    }
                    else {
                        showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                    }
                }
            });
        }//GetDonaturByEmail

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getJaringan(id)
        {
            var KdAgen = '@Model.KdAgen';
            $.ajax({
                url: "{{ url('jaringan/getByCabang') }}",
                type: "POST",
                data: {'id' :id},
                dataType: "json",
                success: function (respon) {
                    var lst = respon.data;
                    $('#KdAgen').empty();
                    if (respon.success) {
                        $('#KdAgen').append('<option value="">--- Pilih Salah Satu Jaringan ---</option>');
                        $.each(lst,function(){
                            $('#KdAgen').append('<option value='+this.kd_agen+'>'+this.nm_agen+'</option>');
                        });
                        $('#KdAgen').val(KdAgen);
                    }
                    else {
                        showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                    }
                }
            });
        }

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
    </script>

    <script>
        $(document).ready(function () {
            $('.btn-simpan').click(function (e) {
                e.preventDefault();
                SimpanDonasi();
            });
            $('.btn-batal').click(function(e){
                e.preventDefault();
                window.location = '@Url.RouteUrl("Default", new { controller = "Donasi", action = "Create" , id=""})';
            });
            $('#KdCabang').find('option[value="1"]').prop('selected',true);

            var eltgl =  document.getElementById('tgl');
            var momentFormat = 'DD/MM/YYYY';
            var momentMask = IMask(eltgl, {
                mask: Date,
                pattern: momentFormat,
                lazy: false,
                min: new Date(1970, 0, 1),
                max: new Date(2030, 0, 1),

                format: function (date) {
                    return moment(date).format(momentFormat);
                },
                parse: function (str) {
                    return moment(str, momentFormat);
                },

                blocks: {
                    YYYY: {
                    mask: IMask.MaskedRange,
                    from: 1970,
                    to: 2030
                    },
                    MM: {
                    mask: IMask.MaskedRange,
                    from: 1,
                    to: 12
                    },
                    DD: {
                    mask: IMask.MaskedRange,
                    from: 1,
                    to: 31
                    },
                    HH: {mask: IMask.MaskedRange,from: 0,to: 23},
                    mm: {mask: IMask.MaskedRange,from: 0,to: 59 }
                }
            });

            var eltgl =  document.getElementById('tgl-setor');
            var momentFormat = 'DD/MM/YYYY';
            var momentMask = IMask(eltgl, {
                mask: Date,
                pattern: momentFormat,
                lazy: false,
                min: new Date(1970, 0, 1),
                max: new Date(2030, 0, 1),

                format: function (date) {
                    return moment(date).format(momentFormat);
                },
                parse: function (str) {
                    return moment(str, momentFormat);
                },

                blocks: {
                    YYYY: {
                    mask: IMask.MaskedRange,
                    from: 1970,
                    to: 2030
                    },
                    MM: {
                    mask: IMask.MaskedRange,
                    from: 1,
                    to: 12
                    },
                    DD: {
                    mask: IMask.MaskedRange,
                    from: 1,
                    to: 31
                    },
                    HH: {mask: IMask.MaskedRange,from: 0,to: 23},
                    mm: {mask: IMask.MaskedRange,from: 0,to: 59 }
                }
            });
        });

        function SimpanDonasi()
        {
            var tbl = document.getElementById('tbl-transaksi');
            var qty = 0,
                dana = 0,
                jmh = 0,
                kdProgram = "",kdProject="", kolomPrj, kolomProgram,
                dtlID = 0;

            var modeEdit = 'Edit',
                alurKerja = $('#AlurKerja').val(),
                donasiID = $('#tr-id').val(),
                idBukuBank = $('#link-idbukubank').val(),
                noKwitansi = $('#NoKwitansi').val(),
                kdKas = $('#KdKas').val(),
                kdAgen = $('#KdAgen').val(),
                kdSales = $('#KdSales').val(),
                kdCabang = $('#KdCabang').val(),
                tgl = $('#tgl').val(), tglSetor = $('#tgl-setor').val(),
                sah = $('#sah').is(":checked"),
                biayaBank =  $('#biaya-bank').val();

            pelangganID = $('#pelanggan-id').val(),
            kdPelanggan =$('#kd-pelanggan').val() ,
            nmDonatur= $('#NmDonatur').val(),
            nmWakif= $('#NmWakif').val(),
            alamat= $('#Alamat').val(),
            kota= $('#Kota').val(),
            pos= $('#Pos').val(),
            propinsi= $('#Propinsi').val(),
            telp= $('#Telp').val(),
            ket= $('#Keterangan').val(),
            hp= $('#Hp').val(),
            email= $('#Email').val();

            //--------- Validasi ---------------------------------------------//
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('donasi/validasi') }}",
                type: "POST",
                data: $('form').serialize(),
                dataType: "json",
                success: function (respon) {
                    if($.isEmptyObject(respon.error)) {
                        var skrg = new Date();
                        let year = skrg.getFullYear();
                        let month = skrg.getMonth();
                        let date = skrg.getDate();
                        var tglSkrg = new Date(year,month,date);
                        var arrId = tgl.split('/'); //tgl-format dd/mm/yyyy
                        selisihTrans = tglSkrg.getTime() - new Date(arrId[2],arrId[1]-1, arrId[0]).getTime();
                        selisihTrans = Math.round(selisihTrans/(1000*60*60*24));

                        if (tgl > tglSkrg)
                        {
                            showAlert('warning','','Tanggal Transaksi Tidak Sah');
                            return false;
                        }

                        if(selisihTrans<0 || selisihTrans > 360)
                        {
                            showAlert('warning','','Tanggal Transaksi Tidak Sah');
                            return false;
                        }

                        var arrIdSetor = tglSetor.split('/'); //tgl-format dd/mm/yyyy
                        selisihSetor =  tglSkrg.getTime() - new Date(arrIdSetor[2],arrIdSetor[1]-1, arrIdSetor[0]).getTime();
                        selisihSetor = Math.round(selisihSetor/(1000*60*60*24));

                        if(selisihSetor<0 || selisihSetor > 360)
                        {
                            showAlert('warning','','Tanggal Setor Tidak Sah.');
                            return false;
                        }

                        // const o = [modeEdit, alurKerja, donasiID, noKwitansi, idBukuBank
                        //         , sah, kdKas, kdAgen, kdSales, kdCabang, tgl
                        //         , tglSetor, pelangganID, kdPelanggan
                        //         , nmDonatur, nmWakif, alamat, kota, pos, propinsi
                        //         , telp, ket, hp, email, biayaBank];
                        // const o = [{ModeEdit:modeEdit, AlurKerja:alurKerja, DonasiID:donasiID, NoKwitansi:noKwitansi, IdBukuBank:idBukuBank}];
                        const o = [{ModeEdit:modeEdit , AlurKerja:alurKerja, DonasiID:donasiID, NoKwitansi:noKwitansi, IdBukuBank:idBukuBank
                                , Sah:sah, KdKas:kdKas, KdAgen:kdAgen, KdSales:kdSales, KdCabang:kdCabang, Tgl:tgl
                                , TglSetor:tglSetor, PelangganID:pelangganID, KdPelanggan:kdPelanggan
                                , NmDonatur:nmDonatur, NmWakif:nmWakif, Alamat:alamat, Kota:kota, Pos:pos, Propinsi:propinsi
                                , Telp:telp, Ket:ket, Hp:hp, Email:email, BiayaBank:biayaBank}];

                        baris = tbl.tBodies[0].getElementsByTagName('tr');
                        rowCount = 0;
                        for (i = 0; i < baris.length - 1; i++)
                        {
                            kolomProgram    = baris.item(i).cells.item(idxKolomProgram);
                            kdProgram       = $(kolomProgram).children(':input').val();
                            kolomPrj        = baris.item(i).cells.item(idxKolomPrj);
                            kdProject       = $(kolomPrj).children('.kd-prj').val();
                            qty             = AdnToNum(baris.item(i).cells.item(idxKolomQty).innerHTML);
                            dana            = AdnToNum(baris.item(i).cells.item(idxKolomDana).innerHTML);
                            jmh             = qty*dana;

                            var btn = baris.item(i).cells.item(idxKolomEdit).firstChild.getAttribute('data-btn');
                            if(btn.toString().trim().toUpperCase()=="OK")
                            {
                                showAlert('warning','','Detail Transaksi Belum Lengkap.');
                                return false;
                            }

                            // const dtl = [dtlID, kdProgram, kdProject, qty, dana, jmh];
                            const dtl = [{DtlID:dtlID, NoKwitansi:noKwitansi, KdProgram:kdProgram, KdProject:kdProject, Qty:qty, Dana:dana, Jmh:jmh}];
                            o.push(dtl);
                        }
                        var total = AdnToNum(document.getElementById('td-total').innerHTML);

                        if(total==0)
                        {
                            showAlert('warning','','Detail Transaksi Tidak Ada.');
                            return false;
                        }

                        var ntransfer = AdnToNum($('#total-transfer').html());
                        if (idBukuBank.trim()!='' && ntransfer!= total)
                        {
                            showAlert('warning','','TOTAL Transaksi Tidak Sama dengan Jumlah Transfer.');
                            return false;
                        } else {
                            console.log('gagal');
                        }
                        console.log(o);
                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ url('donasi/simpan') }}",
                            type: "POST",
                            data: JSON.stringify(o),
                            dataType: "json",
                            contentType: "application/json; charset=utf-8",
                            success: function (respon) {
                                if (respon.IsSuccess)
                                {
                                    showAlert('success','',respon.Message);
                                    window.location = baseUrl + ("Donasi/Create");
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
        }//SimpanDonasi

    </script><!-- Simpan -->

    <script>
        $(document).ready(function () {
            $('#pelanggan-tambah').click(function (e) {
                $("#wadah-donatur").html("");
            });

            $('#modal-lookup').on('shown.bs.modal', function () {
                $('#filter-nm').focus();
            });

            $('#modal-lookup').on('hidden.bs.modal', function (e) {
                $('#NmDonatur').focus();
            })

            $('#pelanggan-tambah').click(function () {
                mode = 'TAMBAH';
                $('#modal-lookup').show();
                $('#filter-nm').focus();
            });
            $('#tampil-lookup').click(function(e){
                var param = "";
                arg = 1;
                param = AddQSParam(param, 'Nama', $('#filter-nm').val());
                param = AddQSParam(param, 'Hp', $('#filter-hp').val());
                param = AddQSParam(param, 'KdDonatur', $('#filter-kd').val());
                param = AddQSParam(param, 'page', arg);

                $("#wait-grid-lookup").css("display", "block");
                $.get('@Url.Action("ListLookup", "Donatur")' + param, function (respon) {
                    $("#wadah-donatur").html(respon);
                }).done(function(){
                    $("#wait-grid-lookup").css("display", "none");
                });
            });

            $('#btn-close').click(function () {
                $('#modal-form').trigger( "reset" );
                $('#modal-lookup').hide();
            });

            $(document).delegate(".clickable-row","click",function(){
                var pid = $(this.cells[0]).children('.pid').val();
                var kd = $(this.cells[1]).text();
                var nm = $(this.cells[2]).text();
                var alamat = $(this.cells[3]).text();
                var telp =$(this.cells[4]).text();
                var hp =$(this.cells[5]).text();
                var email =$(this.cells[6]).text();

                var kota = $(this.cells[0]).children('.ckota').val();
                var pos = $(this.cells[0]).children('.cpos').val();
                var kdPropinsi = $(this.cells[0]).children('.cpropinsi').val();

                $('#pelanggan-id').val(pid);
                $('#kd-pelanggan').val(kd);
                $('#NmDonatur').val(nm);
                $('#Alamat').val(alamat);
                $('#Kota').val(kota);
                $('#Telp').val(telp);
                $('#Pos').val(pos);
                $('#Propinsi').val(kdPropinsi);
                $('#Hp').val(hp);
                $('#Email').val(email);

                $('#cr-hp').val('');
                $('#cr-email').val('');
                $('#filter-nm').val('');
                $('#filter-kd').val('');
                $('#filter-hp').val('');
                $('#modal-lookup').modal('hide');
            });

        });//document

    </script><!--Simpan Pelanggan -->

    <script>
        function CekNoKwitansi(noKwitansi)
        {
            var urlAksi = "{{ url('donasi/cariNoKwitansi') }}";
            var no = $('#NoKwitansi').val();

            $.ajax({
                url: urlAksi,
                type: "POST",
                headers: getAdnToken(),
                data: {NoKwitansi: no},
                success: function (respon) {
                    if (respon.IsSuccess) {
                        if(respon.Message=="ADA")
                        {
                            showAlert('warning','','No. Kwitansi = '+ no + ' Sudah ADA dalam Database.');
                            $('#NoKwitansi').val("");
                            $('#NoKwitansi').focus();
                        }
                    }
                    else {
                        showAlert('error','',"Terjadi Kesalahan: " + respon.Message);
                    }
                    // $('#NoKwitansi').focus();
                }
            });

        }
    </script><!-- Cek No Kwitansi -->
@endsection
