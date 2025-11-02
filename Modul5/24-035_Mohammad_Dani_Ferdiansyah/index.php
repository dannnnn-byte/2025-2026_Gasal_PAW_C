<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-tambah {
            background-color: #28a745;
            color: white;
            margin-bottom: 15px;
            display: inline-block;
        }
        .btn-tambah:hover { background-color: #218838; }

        .btn-edit {
            background-color: orange;
            color: white;
        }
        .btn-edit:hover { background-color: #e69500; }

        .btn-hapus {
            background-color: red;
            color: white;
        }
        .btn-hapus:hover { background-color: #cc0000; }

        .tombol-container {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Data Master Supplier</h2>

<div class="container">
    <div class="tombol-container">
        <a href="tambah.php" class="btn btn-tambah">+ Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($d = mysqli_fetch_array($data)) {
            echo "
            <tr>
                <td>$no</td>
                <td>$d[nama]</td>
                <td>$d[telp]</td>
                <td>$d[alamat]</td>
                <td>
                    <a class='btn btn-edit' href='edit.php?id=$d[id]'>Edit</a>
                    <a class='btn btn-hapus' href='hapus.php?id=$d[id]' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</div>

</body>
</html>
