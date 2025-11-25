<?php
// Pastikan data POST ada
if (isset($_POST['saldo_awal']) && isset($_POST['jangka_waktu'])) {
    // Ambil input dari form
    $saldo_awal = (float)$_POST['saldo_awal'];
    $jangka_waktu = (int)$_POST['jangka_waktu'];

    // Tetapkan nilai konstanta
    $batas_saldo = 1100000; // Rp. 1.100.000,-
    $bunga_rendah = 0.03 / 12; // 3% p.a. (dibagi 12 untuk bulanan)
    $bunga_tinggi = 0.04 / 12; // 4% p.a. (dibagi 12 untuk bulanan)
    $biaya_admin = 9000;    // Rp. 9.000,-

    $saldo_akhir = $saldo_awal; // Inisialisasi saldo akhir dengan saldo awal

    echo "<h2>Perhitungan Saldo Akhir</h2>";
    echo "<p>Saldo Awal: Rp. ". number_format($saldo_awal, 0, ',', '.') ."</p>";
    echo "<p>Jangka Waktu (N): ". $jangka_waktu ." bulan</p>";
    echo "<table border='1'>
            <tr>
                <th>Bulan ke-</th>
                <th>Saldo Awal Bulan</th>
                <th>Bunga (Bulanan)</th>
                <th>Biaya Admin</th>
                <th>Saldo Akhir Bulan</th>
            </tr>";

    // Loop perhitungan per bulan
    for ($bulan = 1; $bulan <= $jangka_waktu; $bulan++) {
        $saldo_awal_bulan = $saldo_akhir;

        // Tentukan persentase bunga berdasarkan saldo terakhir (saldo_akhir bulan sebelumnya)
        if ($saldo_akhir < $batas_saldo) {
            $bunga = $saldo_akhir * $bunga_rendah; // Bunga 3% p.a.
        } else {
            $bunga = $saldo_akhir * $bunga_tinggi; // Bunga 4% p.a.
        }

        // Perhitungan saldo akhir bulan
        $saldo_akhir = $saldo_akhir + $bunga - $biaya_admin;

        // Tampilkan detail perhitungan per bulan
        echo "<tr>
                <td>{$bulan}</td>
                <td>Rp. ". number_format($saldo_awal_bulan, 0, ',', '.') ."</td>
                <td>Rp. ". number_format($bunga, 0, ',', '.') ."</td>
                <td>Rp. ". number_format($biaya_admin, 0, ',', '.') ."</td>
                <td>Rp. ". number_format($saldo_akhir, 0, ',', '.') ."</td>
              </tr>";
    }

    echo "</table>";
    echo "<h3>Saldo Akhir Setelah ". $jangka_waktu ." Bulan: Rp. ". number_format($saldo_akhir, 0, ',', '.') ."</h3>";

} else {
    echo "Data saldo awal atau jangka waktu belum diisi. Silakan kembali ke form.";
}
?>