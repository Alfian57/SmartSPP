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
                    <th>Total Terbayar (Rp)</th>
                    <th>Persentase Terbayar (%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $classroom }}</td>
                    <td>{{ $number_of_students }}</td>
                    <td>@money($total_bills)</td>
                    <td>@money($total_validated_payments)</td>
                    <td>{{ number_format($payment_percentage, 2) }}%</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total">
                    <td>Total Tagihan Keseluruhan:</td>
                    <td colspan="4">@money($total_bills)</td>
                </tr>
                <tr class="total">
                    <td>Total Terbayar Keseluruhan:</td>
                    <td colspan="4">@money($total_validated_payments)</td>
                </tr>
                <tr class="total">
                    <td>Jumlah Siswa Keseluruhan:</td>
                    <td colspan="4">{{ $number_of_students }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
