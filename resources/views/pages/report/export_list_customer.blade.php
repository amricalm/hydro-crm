<table>
    <thead>
        <tr class="border-top">
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Hp</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>Jenis/Tipe Produk</th>
            <th>CRO</th>
            <th>Total Closing</th>
            <th>Tanggal Transaksi 1</th>
            <th>Teknisi/Sales 1</th>
            <th>Kunjungan/Penjualan 1</th>
            <th>Nominal Closing 1</th>
            <th>Tanggal Transaksi 2</th>
            <th>Teknisi/Sales 2</th>
            <th>Kunjungan/Penjualan 2</th>
            <th>Nominal Closing 2</th>
            <th>Tanggal Transaksi 3</th>
            <th>Teknisi/Sales 3</th>
            <th>Kunjungan/Penjualan 3</th>
            <th>Nominal Closing 3</th>
        </tr>
    </thead>
        <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($allData as $row)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->hp }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->facebook }}</td>
                <td>{{ $row->instagram }}</td>
                <td>{{ $row->history }}</td>
                <td>{{ $row->sales_name }}</td>
                <td>{{ $row->total!=0 ? $row->total : '' }}</td>
                <td>{{ $row->date1!='' ? Date("d/m/Y",strtotime(str_replace('-"', '/', $row->date1))) : '' }}</td>
                <td>{{ $row->technician1 }}</td>
                <td>{{ $row->maintenance1 }}</td>
                <td>{{ $row->price1!='' ? $row->price1 : '' }}</td>
                <td>{{ $row->date2!='' ? Date("d/m/Y",strtotime(str_replace('-"', '/', $row->date2))) : '' }}</td>
                <td>{{ $row->technician2 }}</td>
                <td>{{ $row->maintenance2 }}</td>
                <td>{{ $row->price2!='' ? $row->price2 : '' }}</td>
                <td>{{ $row->date3!='' ? Date("d/m/Y",strtotime(str_replace('-"', '/', $row->date3))) : '' }}</td>
                <td>{{ $row->technician3 }}</td>
                <td>{{ $row->maintenance3 }}</td>
                <td>{{ $row->price3!='' ? $row->price3 : '' }}</td>
            </tr>
            @php $no++; @endphp
        @endforeach
    </tbody>
</table>
