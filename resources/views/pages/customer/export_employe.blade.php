<table class="table data-table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAMA LENGKAP</th>
        </tr>
    </thead>
    <tbody>
        @for($k=0;$k<count($alldata);$k++)
            <tr>
                <td>{{ $alldata[$k]->id }}</td>
                <td>{{ $alldata[$k]->name }}</td>
            </tr>
        @endfor
    </tbody>
</table>
