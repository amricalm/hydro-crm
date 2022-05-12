// import Handsontable from "handsontable";
// import "handsontable/dist/handsontable.min.css";
// import "pikaday/css/pikaday.css";

// import { data } from "./constants";
// import { progressBarRenderer, starRenderer } from "./customRenderers";

// import {
//   alignHeaders,
//   drawCheckboxInRowHeaders,
//   addClassesToRows,
//   changeCheckboxCell
// } from "./hooksCallbacks";
function myAutocompleteRenderer(instance, td, row, col, prop, value, cellProperties) {
  Handsontable.AutocompleteCell.renderer.apply(this, arguments);
  td.style.fontStyle = 'italic';
  td.title = 'Type to show the list of options';
}

var data = [
  // ['', 'Ford', 'Tesla', 'Toyota', 'Honda'],
    {kd_akun:'xx', nm_akun:'',kd_program:'', kd_project:'',
      kd_program_sumber:'', kd_project_sumber:'', memo:'', debet:1200, kredit:13}
];

//console.log(dataAkun);
var container = document.getElementById('handsontable');
var hot = new Handsontable(container, {
  data: data,
  rowHeaders: true,
  colHeaders: true,
  colWidths: [100, 200, undefined, 100,100,100,100,100,100],
  //filters: true,
  //dropdownMenu: true,
  minSpareRows: 1,
  colHeaders: ['Kd', 'Nama Akun', 'Program','Project', 'Sumber Program', 'Sumber Project', 'Memo', 'Debet', 'Kredit'],
  columns: [
    // {data: "kd_akun",
    //   type: 'dropdown',
    //   trimDropdown: false,
    //   source: dataAkun},
    {renderer: myAutocompleteRenderer, editor: Handsontable.AutocompleteEditor},
    {data: "nm_akun"},
    {data: "kd_program"},
    {data: "kd_project"},
    {data: "kd_program_sumber"},
    {data: "kd_project_sumber"},
    {data: "memo"},
    {data: "debet", type:'numeric',  renderer: idRenderer,
      },
    {data: "kredit",type:'numeric', renderer: idRenderer,}
  ],
  licenseKey: 'non-commercial-and-evaluation'
});

hot.updateSettings({
  afterSelectionEnd: function(r, c, r2, c2) {
    console.log(hot.toPhysicalRow(r));
  }
})


function idRenderer(instance, td, row, col, prop, value, cellProperties) {
  Handsontable.renderers.NumericRenderer.apply(this, arguments);
  td.innerHTML = formatRupiah(td.innerHTML);
}

 /* Fungsi formatRupiah */
 function formatRupiah(angka, prefix) {

    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

// new Handsontable(example, {
//   data,
//   height: 450,
//   colWidths: [140, 126, 192, 100, 100, 90, 90, 110, 97],
//   colHeaders: [
//     "Company name",
//     "Country",
//     "Name",
//     "Sell date",
//     "Order ID",
//     "In stock",
//     "Qty",
//     "Progress",
//     "Rating"
//   ],
//   columns: [
//     { data: 1, type: "text" },
//     { data: 2, type: "text" },
//     { data: 3, type: "text" },
//     {
//       data: 4,
//       type: "date",
//       allowInvalid: false
//     },
//     { data: 5, type: "text" },
//     {
//       data: 6,
//       type: "checkbox",
//       className: "htCenter"
//     },
//     {
//       data: 7,
//       type: "numeric"
//     },
//     {
//       data: 8,
//       renderer: progressBarRenderer,
//       readOnly: true,
//       className: "htMiddle"
//     },
//     {
//       data: 9,
//       renderer: starRenderer,
//       readOnly: true,
//       className: "star htCenter"
//     }
//   ],
//   dropdownMenu: true,
//   hiddenColumns: {
//     indicators: true
//   },
//   contextMenu: true,
//   multiColumnSorting: true,
//   filters: true,
//   rowHeaders: true,
//   manualRowMove: true,
//   afterGetColHeader: alignHeaders,
//   afterGetRowHeader: drawCheckboxInRowHeaders,
//   afterOnCellMouseDown: changeCheckboxCell,
//   beforeRenderer: addClassesToRows,
//   licenseKey: "non-commercial-and-evaluation"
// });


