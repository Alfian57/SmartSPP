@component('mail::message')
    <h2 style="color: #333333;">Hai, {{ $name }}!</h2>
    <h2 style="color: #333333;">Anda memiliki tagihan bulanan</h2>
    <p>Ini adalah email konfirmasi untuk memberitahu Anda tentang tagihan bulanan Anda.</p>
    <p>Berikut adalah detail tagihan bulanan Anda:</p>
    <ul>
        <li>
            <strong>Nama:</strong> {{ $name }}
        </li>
        <li>
            <strong>Total Tagihan:</strong> {{ $nominal }}
        </li>
    </ul>
    <p>Mohon untuk melakukan pembayaran sebelum tanggal jatuh tempo untuk menghindari penalti keterlambatan.</p>
    <p>Jika Anda memiliki pertanyaan atau butuh bantuan terkait tagihan Anda, jangan ragu untuk menghubungi tim dukungan
        kami di <a href="mailto:pembayaran_spp@example.com"
            style="color: #007bff; text-decoration: none;">pembayaran_spp@example.com</a> dan kami akan dengan senang hati
        membantu Anda.</p>
    <br>
    <p style="color: #888888; font-size: 12px;">Pesan ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
@endcomponent
