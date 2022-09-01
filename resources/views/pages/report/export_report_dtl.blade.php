<table>
    <thead>
        <tr class="border-top">
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Hp</th>
            <th>Aksi</th>
            <th>Respon</th>
            <th>Sales</th>
        </tr>
    </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach ($allData as $row)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ Date("d/m/Y H:i",strtotime($row->date)) }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->hp }}</td>
                <td>{{ $row->action }}</td>
                <td>{{ $row->response }}</td>
                <td>{{ $row->sales }}</td>
            </tr>
            @php $no++; @endphp
        @endforeach
    </tbody>
</table>
