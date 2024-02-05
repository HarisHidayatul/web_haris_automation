<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style>
    </style>
    <h1>Laporan Pengeluaran</h1>
    <table>
        <tbody>
            <tr>
                <td>Nama Kapal</td>
                <td>:</td>
                <td>{{ $kapal }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $pekerjaan }}</td>
            </tr>
            <tr>
                <td>Status Pekerjaan</td>
                <td>:</td>
                <td>{{ $status_pekerjaan }}</td>
            </tr>
            <tr>
                <td>Teknisi Terlibat</td>
                <td>:</td>
                <td>
                    @foreach ($users as $user)
                        {{ $user->nama_lengkap }},
                    @endforeach
                </td>
                <td></td>
            </tr>
            <tr>
                <td>Lokasi Pekerjaan</td>
                <td>:</td>
                <td>{{ $lokasi_pekerjaan }}</td>
            </tr>
        </tbody>
    </table>
    <table border="1">
        <thead>
            <tr>
                <th>Tanggal Pengeluaran</th>
                <th>Jenis Pengeluaran</th>
                <th>Item</th>
                <th>Jumlah Pengeluaran</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @php
                $currentDate = null;
            @endphp
            @foreach ($all_pengeluaran as $tanggal => $jenisCollection)
                @foreach ($jenisCollection as $jenis => $items)
                    @for ($i = 0; $i < count($items); $i++)
                        <tr>
                            @if ($currentDate != $items[$i]->tanggal_pengeluaran)
                                <td rowspan="{{ count($items) }}">
                                    {{ date('d/m/Y', strtotime($items[$i]->tanggal_pengeluaran)) }}</td>
                                @php
                                    $currentDate = $items[$i]->tanggal_pengeluaran;
                                @endphp
                            @else
                                <td></td>
                            @endif
                            @if ($i === 0)
                                <td rowspan="{{ count($items) }}">{{ $items[$i]->jenis_pengeluaran }}</td>
                            @endif
                            <td>{{ $items[$i]->item }}</td>
                            <td style="text-align: right; padding-right: 10px;">
                                {{ number_format($items[$i]->jumlah_pengeluaran, 0, '.', '.') }}</td>
                            @if ($items[$i]->link_image != null)
                                <td>Ada</td>
                            @else
                                <td>Tidak Ada</td>
                            @endif
                        </tr>
                    @endfor
                @endforeach
            @endforeach
            @php
                $indexThisLoop = 0;
            @endphp
            @foreach ($jenis_pengeluaran as $loop_pengeluaran)
                <tr>
                    <td colspan="3">{{ $loop_pengeluaran }}</td>
                    <td colspan="2" style="text-align: right; padding-right: 10px;">
                        {{ number_format($total_jenis_pengeluaran[$indexThisLoop], 0, '.', '.') }}
                    </td>
                </tr>
                @php
                    $indexThisLoop = $indexThisLoop + 1;
                @endphp
            @endforeach
            <tr>
                <td colspan="3">Total</td>
                <td colspan="2" style="text-align: right; padding-right: 10px;">
                    {{ number_format($total_pengeluaran, 0, '.', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <div style="page-break-before: always;"></div>
    @foreach ($all_pengeluaran as $tanggal => $jenisCollection)
        @foreach ($jenisCollection as $jenis => $items)
            @for ($i = 0; $i < count($items); $i++)
                @if ($items[$i]->link_image != null)
                    <img src="{{ $items[$i]->link_image }}" alt=""
                        style="height: 300px; width: auto; max-width: 500px;" loading="lazy">
                    {{-- <div>{{$items[$i]->link_image}}</div> --}}
                @endif
            @endfor
        @endforeach
    @endforeach
    @foreach ($pdfContents as $pdfContent)
        <img src="{{ $pdfContent }}" alt="PDF Image" style="width: 100%;">
    @endforeach
</body>

</html>
