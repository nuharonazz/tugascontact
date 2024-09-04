<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "contact_info";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #ffe6f0; 
            font-family: Arial, sans-serif;
        }

        .notification {
            color: green; 
            margin: 20px 0;
        }

        .notification.error {
            color: red; 
        }

        form {
            background-color: #ffccda; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #ff6699; 
            margin-top: 20px; 
        }

        label {
            color: #ff6699; 
            font-weight: bold;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ff6699; 
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px; 
        }

        .gender-options {
            margin: 8px 0;
        }

        .gender-options input {
            margin-right: 5px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #ff6699; 
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #ff3366; 
        }
    </style>
    <script>
        function confirmSubmit() {
            return confirm('Apakah Anda yakin ingin mengirimkan jawaban ini?');
        }
    </script>
</head>
<body>
<?php
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $nim = mysqli_real_escape_string($conn, $_POST['nim']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $saran = mysqli_real_escape_string($conn, $_POST['saran']);


        $checkQuery = "SELECT * FROM mahasiswa WHERE nim='$nim'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            $message = "<p class='notification error'>NIM sudah ada. Data tidak disimpan.</p>";
        } else {
            
            $query = "INSERT INTO mahasiswa (nama, nim, email, kelas, gender, saran) 
                      VALUES ('$nama', '$nim', '$email', '$kelas', '$gender', '$saran')";


        if (mysqli_query($conn, $query)) {
                $message = "<p class='notification'>Data berhasil disimpan!</p>";
            } else {
                $message = "<p class='notification error'>Error: " . $query . "<br>" . mysqli_error($conn) . "</p>";
            }
        }
    }

    echo $message;
    ?>

<form action="" method="POST" onsubmit="return confirmSubmit()">
        <h2>Contact Form</h2>
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="nim">NIM:</label><br>
        <input type="text" id="nim" name="nim" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="kelas">Kelas:</label><br>
        <input type="text" id="kelas" name="kelas" required><br><br>

        <label for="gender">Gender:</label><br>
        <div class="gender-options">
            <input type="radio" id="laki-laki" name="gender" value="Laki-laki" required>
            <label for="laki-laki">Laki-laki</label><br>
            <input type="radio" id="perempuan" name="gender" value="Perempuan" required>
            <label for="perempuan">Perempuan</label>
        </div><br>

        <label for="saran">Saran:</label><br>
        <textarea id="saran" name="saran"></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
