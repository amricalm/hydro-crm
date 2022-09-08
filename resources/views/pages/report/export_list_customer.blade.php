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
        </tr>
    </thead>
        <tbody>
        @php $no = 1; @endphp
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
            </tr>
            @php $no++; @endphp
        @endforeach
    </tbody>
</table>
