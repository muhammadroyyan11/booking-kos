!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px auto; /* Center the table horizontally */
            font-size: 0.9em;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #8d8a8a;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>

<body>
<center><h4 style="text-align: center;">Laporan Transaksi</h4></center><br>
<h5 style="margin-left: 25px">Periode : {{$data['start_date']}} - {{$data['end_date']}}</p></h5><br>
<table class="styled-table" border="1">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Transaksi ID</th>
        <th scope="col">Nama Kamar</th>
        <th scope="col">Penyewa</th>
        <th scope="col">Lama Sewa</th>
        <th scope="col">Tanggal Sewa</th>
        <th scope="col">Tanggal Berakhir</th>
        <th scope="col">Total Pembayaran</th>

    </tr>
    </thead>
    <tbody>
    @php
        $no=1;
    @endphp
    @foreach ($data['booking'] as $bookings)
            <?php
            $number = $bookings->harga_total;
            $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            $total =+ $bookings->harga_total;
            $total = $data['booking']->sum('harga_total');
            ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $bookings->transaction_number }}</td>
            <td>{{ $bookings->kamar->nama_kamar }}</td>
            <td>{{ getNameUser($bookings->user_id) }}</td>
            <td>{{ $bookings->lama_sewa }} Bulan</td>
            <td>{{ $bookings->tgl_sewa }}</td>
            <td>{{ $bookings->end_date_sewa }}</td>
            <td>{{ $formatter->formatCurrency($number, 'IDR') }} </td>

        </tr>
    @endforeach
    <tr>
        <td colspan="7" style="text-align: center;"><b>Total Pendapatan</b></td>
        <td >{{ $formatter->formatCurrency($total, 'IDR') }}</td>

    </tr>

    </tbody>
</table>
</body>
</html>
