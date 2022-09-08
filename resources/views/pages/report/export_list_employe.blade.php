<table>
    <thead>
        <tr class="border-top">
            <th>No</th>
            <th>NIP</th>
            <th>Nama Karyawan</th>
            <th>Hp</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Facebook</th>
            <th>Instagram</th>
            <th>Status</th>
        </tr>
    </thead>
        <tbody>
        @php $no = 1; @endphp
        @foreach ($allData as $row)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $row->nip }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->hp }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->facebook }}</td>
                <td>{{ $row->instagram }}</td>
                <td>{{ $status }}</td>
            </tr>
            @php $no++; @endphp
        @endforeach
    </tbody>
</table>
