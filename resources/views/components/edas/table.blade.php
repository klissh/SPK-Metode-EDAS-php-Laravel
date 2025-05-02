<div class="card mb-4">
    <div class="card-header bg-primary text-white">{{ $title }}</div>
    <div class="card-body p-0">
        <table class="table table-striped table-bordered mb-0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $k)
                        <th>{{ $k->code }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $altCode => $row)
                    <tr>
                        <td class="fw-bold">
                            {{ $altCode }}
                            @isset($alternatifs)
                                @php
                                    $alt = $alternatifs->firstWhere('code', $altCode);
                                @endphp
                                @if ($alt)
                                    <br><small>{{ $alt->nama_alternatif }}</small>
                                @endif
                            @endisset
                        </td>
                        @foreach ($kriterias as $k)
                            <td>{{ number_format($row[$k->code] ?? 0, 3) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
