<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1,
        .footer p {
            margin: 0;
        }

        .content {
            margin-bottom: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid #ddd;
        }

        .content th,
        .content td {
            padding: 8px;
            text-align: left;
        }

        .content th {
            background-color: #f2f2f2;
        }

        .summary {
            margin-top: 20px;
        }

        .summary p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Detail Tagihan</h1>
        </div>
        <div class="content">
            <p><strong>Nama Siswa:</strong> {{ $bill->student->nama }}</p>
            <p><strong>Nominal Tagihan:</strong> Rp {{ number_format($bill->nominal, 0, ',', '.') }}</p>
            <p><strong>Diskon:</strong> Rp {{ number_format($bill->diskon, 0, ',', '.') }}</p>
            <p><strong>Pembayaran:</strong></p>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bill->payments as $payment)
                        <tr>
                            <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                            <td>Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                            <td>{{ $payment->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="summary">
            <p><strong>Total Dibayarkan:</strong> Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
            <p><strong>Sisa Tagihan:</strong> Rp {{ number_format($amountDue, 0, ',', '.') }}</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
