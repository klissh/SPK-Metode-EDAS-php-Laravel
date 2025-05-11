@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Heading --}}
    <div>
        <h2 class="text-2xl font-semibold text-cyan-600 flex items-center gap-2">
            <i class="bi bi-list-ul"></i>
            Sub Kriteria untuk: <span class="text-slate-800">{{ $kriteria->nama_kriteria }} ({{ $kriteria->code }})</span>
        </h2>
    </div>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 px-4 py-3 rounded relative shadow" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Aksi --}}
    <div class="flex justify-between flex-wrap gap-3">
        <a href="{{ route('sub-kriteria.create', ['kriteria_id' => $kriteria->id]) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
            <i class="bi bi-plus-circle"></i> Tambah Sub Kriteria
        </a>
        <a href="{{ route('kriteria.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-6 py-2 rounded-lg shadow flex items-center gap-2 transition">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Kriteria
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-cyan-100 text-cyan-800 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-center">No</th>
                    <th class="px-6 py-3">Nama Sub</th>
                    <th class="px-6 py-3 text-center">Nilai</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subkriterias as $sub)
                    <tr class="border-t hover:bg-slate-50">
                        <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $sub->nama_sub }}</td>
                        <td class="px-6 py-4 text-center">{{ $sub->nilai }}</td>
                        <td class="px-6 py-4 text-center">
                            <button type="button"
                                    onclick="document.getElementById('modalHapus{{ $sub->id }}').showModal();"
                                    class="inline-flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded px-3 py-1 text-sm transition shadow">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Konfirmasi Hapus --}}
                    <dialog id="modalHapus{{ $sub->id }}" class="rounded-xl p-0 backdrop:bg-black/50 w-full max-w-md">
                        <div class="bg-white rounded-xl shadow-lg">
                            <div class="bg-red-600 text-white px-6 py-3 rounded-t-xl flex justify-between items-center">
                                <h3 class="text-lg font-semibold">
                                    <i class="bi bi-exclamation-circle-fill me-2"></i> Konfirmasi Hapus
                                </h3>
                                <form method="dialog">
                                    <button type="submit" class="text-white text-2xl leading-none">&times;</button>
                                </form>
                            </div>
                            <div class="px-6 py-4">
                                <p class="text-sm text-slate-700">
                                    Yakin ingin menghapus sub kriteria <strong>{{ $sub->nama_sub }}</strong>?
                                </p>
                            </div>
                            <div class="px-6 py-4 flex justify-end gap-2 border-t">
                                <form method="POST" action="{{ route('sub-kriteria.destroy', $sub->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                                <form method="dialog">
                                    <button class="bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold px-4 py-2 rounded transition">
                                        Batal
                                    </button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-6 py-4 text-gray-500">Belum ada sub kriteria</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById('successAlert');
        if (alert) {
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
    });
</script>
@endpush
