@extends('layouts.user')

@section('content')
<div class="container mx-auto py-6 px-4 animate-fadeIn">
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Hasil Ranking Alternatif</h2>
        <p class="text-gray-600 dark:text-gray-300 mt-2">Peringkat alternatif berdasarkan metode EDAS</p>
        <div class="h-1 w-24 bg-gradient-to-r from-blue-600 to-blue-400 rounded mx-auto mt-4"></div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-all duration-300">
        <div class="flex flex-wrap items-center justify-between mb-6">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-300">Nilai Tinggi</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-300">Nilai Sedang</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-300">Nilai Rendah</span>
                </div>
            </div>
            
            <div class="flex space-x-2">
                <button id="printButton" class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak
                </button>
                
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table id="rankingTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700 w-24">
                            <div class="flex items-center justify-center cursor-pointer hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200" onclick="sortTable(0)">
                                Ranking
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center cursor-pointer hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200" onclick="sortTable(1)">
                                Alternatif
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider border-b border-gray-200 dark:border-gray-700 w-48">
                            <div class="flex items-center justify-center cursor-pointer hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200" onclick="sortTable(2)">
                                Nilai Akhir (AS)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($ranking as $i => $item)
                        @php
                            // Determine color class based on ranking position
                            $rankClass = '';
                            $badgeClass = '';
                            
                            if ($i === 0) {
                                $rankClass = 'bg-green-50 dark:bg-green-900/30';
                                $badgeClass = 'bg-green-500';
                            } elseif ($i === 1) {
                                $rankClass = 'bg-blue-50 dark:bg-blue-900/30';
                                $badgeClass = 'bg-blue-500';
                            } elseif ($i === 2) {
                                $rankClass = 'bg-yellow-50 dark:bg-yellow-900/30';
                                $badgeClass = 'bg-yellow-500';
                            }
                            
                            // Determine color for AS value
                            $asValue = floatval($item['as']);
                            $asColorClass = '';
                            
                            if ($asValue >= 0.7) {
                                $asColorClass = 'text-green-600 dark:text-green-400';
                            } elseif ($asValue >= 0.4) {
                                $asColorClass = 'text-yellow-600 dark:text-yellow-400';
                            } else {
                                $asColorClass = 'text-red-600 dark:text-red-400';
                            }
                        @endphp
                        
                        <tr class="{{ $rankClass }} hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150 animate-fadeIn" style="animation-delay: {{ $i * 50 }}ms">
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex flex-col items-center">
                                    <span class="w-8 h-8 flex items-center justify-center rounded-full {{ $badgeClass }} text-white font-bold text-sm">
                                        {{ $i + 1 }}
                                    </span>
                                    @if ($i < 3)
                                        <span class="text-xs mt-1 text-gray-500 dark:text-gray-400">
                                            {{ $i === 0 ? 'Terbaik' : ($i === 1 ? 'Runner-up' : 'Ketiga') }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $item['nama'] }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-sm font-semibold {{ $asColorClass }}">
                                        {{ number_format($item['as'], 4) }}
                                    </span>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mt-2 overflow-hidden">
                                        <div class="h-2.5 rounded-full {{ $asValue >= 0.7 ? 'bg-green-500' : ($asValue >= 0.4 ? 'bg-yellow-500' : 'bg-red-500') }}" style="width: {{ min($asValue * 100, 100) }}%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">Belum ada data ranking</p>
                                    <p class="text-sm mt-1">Silakan lakukan perhitungan terlebih dahulu.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-8 flex justify-between items-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            
            <a href="{{ route('user.perhitungan', request()->route('id')) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Lihat Perhitungan
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to table rows
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(10px)';
            setTimeout(() => {
                row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, 50 * index);
        });
        
        // Print functionality
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
        
        // Export functionality
        document.getElementById('exportButton').addEventListener('click', function() {
            exportTableToCSV('ranking_hasil.csv');
        });
    });
    
    // Function to sort table
    function sortTable(n) {
        let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("rankingTable");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        
        while (switching) {
            switching = false;
            rows = table.rows;
            
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                
                // Get the text content for comparison
                let xContent, yContent;
                
                if (n === 0) {
                    // For ranking column, get the number
                    xContent = parseInt(x.querySelector('.rounded-full').textContent.trim());
                    yContent = parseInt(y.querySelector('.rounded-full').textContent.trim());
                } else if (n === 2) {
                    // For AS column, get the number
                    xContent = parseFloat(x.querySelector('.font-semibold').textContent.trim());
                    yContent = parseFloat(y.querySelector('.font-semibold').textContent.trim());
                } else {
                    // For text columns
                    xContent = x.textContent.toLowerCase();
                    yContent = y.textContent.toLowerCase();
                }
                
                if (dir == "asc") {
                    if ((typeof xContent === "number" && xContent > yContent) || 
                        (typeof xContent === "string" && xContent > yContent)) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if ((typeof xContent === "number" && xContent < yContent) || 
                        (typeof xContent === "string" && xContent < yContent)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
        
        // Update ranking numbers after sorting
        updateRankingNumbers();
    }
    
    // Function to update ranking numbers after sorting
    function updateRankingNumbers() {
        const rows = document.querySelectorAll('#rankingTable tbody tr');
        rows.forEach((row, index) => {
            const rankCell = row.querySelector('td:first-child .rounded-full');
            if (rankCell) {
                rankCell.textContent = index + 1;
            }
            
            // Update row styling based on new position
            row.className = row.className.replace(/bg-\w+-50 dark:bg-\w+-900\/30/g, '');
            const rankBadge = row.querySelector('td:first-child .rounded-full');
            rankBadge.className = rankBadge.className.replace(/bg-\w+-500/g, '');
            
            if (index === 0) {
                row.classList.add('bg-green-50', 'dark:bg-green-900/30');
                rankBadge.classList.add('bg-green-500');
            } else if (index === 1) {
                row.classList.add('bg-blue-50', 'dark:bg-blue-900/30');
                rankBadge.classList.add('bg-blue-500');
            } else if (index === 2) {
                row.classList.add('bg-yellow-50', 'dark:bg-yellow-900/30');
                rankBadge.classList.add('bg-yellow-500');
            } else {
                rankBadge.classList.add('bg-gray-500');
            }
            
            // Update ranking label
            const rankLabel = row.querySelector('td:first-child .text-xs');
            if (rankLabel) {
                if (index < 3) {
                    rankLabel.textContent = index === 0 ? 'Terbaik' : (index === 1 ? 'Runner-up' : 'Ketiga');
                } else {
                    rankLabel.textContent = '';
                }
            }
        });
    }
    
    // Function to export table to CSV
    function exportTableToCSV(filename) {
        const csv = [];
        const rows = document.querySelectorAll('#rankingTable tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = [], cols = rows[i].querySelectorAll('td, th');
            
            for (let j = 0; j < cols.length; j++) {
                // Get plain text content
                let text = '';
                if (j === 0 && i > 0) {
                    // For ranking column in data rows
                    text = i;
                } else if (j === 2 && i > 0) {
                    // For AS column in data rows
                    text = cols[j].querySelector('.font-semibold').textContent.trim();
                } else {
                    // For other cells
                    text = cols[j].textContent.trim().replace(/\s+/g, ' ');
                }
                
                // Escape quotes and add quotes around each field
                row.push('"' + text.replace(/"/g, '""') + '"');
            }
            csv.push(row.join(','));
        }
        
        // Download CSV file
        const csvFile = new Blob([csv.join('\n')], {type: 'text/csv'});
        const downloadLink = document.createElement('a');
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        #printButton, #exportButton, a[href], button {
            display: none !important;
        }
    }
</style>
@endsection