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
                <td>{{ $status }}</td>
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
                <td>{{ $lokasi }}</td>
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
                {{-- <th>Nama Image</th>
                <th>Link Image</th> --}}
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_pengeluaran as $tanggal => $jenisCollection)
                @php
                    $firstDate = true;
                @endphp
                @foreach ($jenisCollection as $jenis => $items)
                    @foreach ($items as $index => $item)
                        <tr>
                            @if ($firstDate)
                                <td name="tanggal">{{ $item->tanggal_pengeluaran }}</td>
                                @php
                                    $firstDate = false;
                                @endphp
                            @else
                                <td></td>
                            @endif
                            @if ($index === 0)
                                <td rowspan="{{ count($items) }}">{{ $item->jenis_pengeluaran }}</td>
                            @endif
                            <td>{{ $item->item }}</td>
                            <td>{{number_format($item->jumlah_pengeluaran, 0, '.', '.') }}</td>
                            {{-- <td>{{ $item->nama_image }}</td>
                            <td>{{ $item->link_image }}</td> --}}
                            @if ($item->link_image != null)
                                <td>Ada</td>
                            @else
                                <td>Tidak Ada</td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>


</body>

</html>
