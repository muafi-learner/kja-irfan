<?php
// 1. GANTI BAGIAN INI DENGAN KREDENSIAL DATABASE HOSTINGER-MU
$host = "localhost"; 
$dbname = "——————————————————";
$username = "———————————————————————";
$password = "——————————————————";

// 2. KONEKSI DAN SIMPAN KE DATABASE
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Pastikan ada request POST yang masuk
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form HTML
        $nama = $_POST['nama'] ?? '';
        $perusahaan = $_POST['perusahaan'] ?? '';
        $nomor = $_POST['nomor'] ?? '';
        $email = $_POST['email'] ?? '';

        // Query insert ke tabel 'leads'
        $sql = "INSERT INTO leads (nama, perusahaan, nomor, email) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        // Eksekusi penyimpanan data
        $stmt->execute([$nama, $perusahaan, $nomor, $email]);
        
        // Kembalikan respon sukses
        echo json_encode(["status" => "sukses"]);
    }
} catch(PDOException $e) {
    // Kalau error, tampilkan pesannya
    echo json_encode(["status" => "error", "pesan" => $e->getMessage()]);
}
?>
