<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            padding: 30px;
        }
        .container {
            background: #fff;
            width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            padding: 20px;
        }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error { color: red; font-size: 0.9em; }
        button {
            margin-top: 15px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h2>Input Data Mahasiswa</h2>
    <form action="processData.php" method="post">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama">

        <label>Email:</label>
        <input type="email" name="email">

        <label>Password:</label>
        <input type="password" name="password">

        <button type="submit">Kirim</button>
    </form>
</div>
</body>
</html>
