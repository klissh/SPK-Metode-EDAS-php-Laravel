<div class="bg-white rounded-xl shadow mb-6">
    <div class="bg-blue-600 text-white px-6 py-3 rounded-t-xl font-semibold flex items-center gap-2">
        {{ $title }}
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-center text-slate-700">
            <thead class="bg-blue-100 text-blue-800 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2">Alternatif</th>
                    @foreach ($kriterias as $k)
                        <th class="px-4 py-2">{{ $k->code }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $altCode => $row)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="text-left px-4 py-2 font-medium">
                            <strong>{{ $altCode }}</strong>
                            @isset($alternatifs)
                                @php
                                    $alt = $alternatifs->firstWhere('code', $altCode);
                                @endphp
                                @if ($alt)
                                    <br>
                                    <span class="text-xs text-gray-500">{{ $alt->nama_alternatif }}</span>
                                @endif
                            @endisset
                        </td>
                        @foreach ($kriterias as $k)
                            <td class="px-4 py-2">
                                {{ number_format($row[$k->code] ?? 0, 3) }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
