<?php

include '../koneksi.php';

$query = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center; 
            height: 100vh; 
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            max-width: 900px; 
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ff6699; 
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h2 {
            color: #ff6699;
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Mahasiswa</h2>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Gender</th>
                    <th>Saran</th>
                </tr>
            </thead>
            <tbody>
            <?php
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['saran']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php

mysqli_close($conn);
?>