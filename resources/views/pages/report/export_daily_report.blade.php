<table class="table data-table table-striped">
    <thead>
        <tr>
            <th class="fw-bold">No</th>
            <th class="fw-bold">Nama Aksi</th>
            @foreach (range($timeRange['min'], $timeRange['max']) as $rows)
                <th class="text-center fw-bold">{{ $rows }}:00</th>
            @endforeach
            <th class="text-center fw-bold">Total</th>
        </tr>
    </thead>
    <tbody>
        @php $i=0; @endphp
        @foreach ($actionDaily as $k=>$v)
            <tr>
                <td>{{ ($i+1) }}</td>
                <td>{{ $v->name }}</td>
                @if ($salesId!='')
                    @php $total = 0; @endphp
                @endif
                @foreach (range($timeRange['min'], $timeRange['max']) as $hour)
                    @if ($salesId!='')
                        @php $tampil = 0; @endphp
                            @foreach($dailyReport as $t=>$u)
                                @php
                                if($u->action_id == $v->id && $hour == $u->hour)
                                {
                                    $tampil = $u->result;
                                    break;
                                }
                                @endphp
                            @endforeach
                        @php $total+= $tampil; @endphp
                    @endif
                    <td class="text-center">{{ $tampil ?? '-' }}</td>
                @endforeach
                <td class="text-center fw-bold">{{ $total ?? '-' }}</td>
            </tr>
            @php $i++; @endphp
        @endforeach
    </tbody>
</table>
