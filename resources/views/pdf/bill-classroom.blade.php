<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tagihan Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .header p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .total td {
            background: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Klasifikasi Pembayaran SPP</h1>
            <p>Bulan: {{ ucfirst($month) }}</p>
            <p>Tahun: {{ $year }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>Jumlah Siswa</th>
                    <th>Total Tagihan (Rp)</th>
                    <th>Total Diskon (Rp)</th>
                    <th>Total Terbayar (Rp)</th>
                    <th>Sisa Tagihan (Rp)</th>
                    <th>Persentase Terbayar (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->nama }}</td>
                        <td>{{ $classroom->students_count }} Siswa</td>
                        <td>@money($classroom->total_tagihan)</td>
                        <td>@money($classroom->total_diskon)</td>
                        <td>@money($classroom->total_terbayar)</td>
                        <td>@money($classroom->total_tagihan - ($classroom->total_terbayar + $classroom->total_diskon))</td>
                        <td>{{ number_format((($classroom->total_terbayar + $classroom->total_diskon) / $classroom->total_tagihan) * 100, 2) }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total">
                    <td colspan="2">Total Tagihan Keseluruhan:</td>
                    <td colspan="3">@money($totalBillsAll)</td>
                </tr>
                <tr class="total">
                    <td colspan="2">Total Terbayar Keseluruhan:</td>
                    <td colspan="3">@money($totalValidatedPaymentsAll)</td>
                </tr>
                <tr class="total">
                    <td colspan="2">Total Sisa Tagihan Keseluruhan:</td>
                    <td colspan="3">@money($totalRemainingBillsAll)</td>
                </tr>
                <tr class="total">
                    <td colspan="2">Jumlah Siswa Keseluruhan:</td>
                    <td colspan="3">{{ $totalNumberOfStudentsAll }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
