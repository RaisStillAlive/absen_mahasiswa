<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #4CAF50;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1, h2 {
            color: #4CAF50;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 6px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulir Data Mahasiswa</h1>
        <form action="create.php" method="post">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="universitas">Universitas:</label>
            <input type="text" id="universitas" name="universitas" required>

            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="jurusan" required>

            <label for="no_hp">No HP:</label>
            <input type="text" id="no_hp" name="no_hp" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <input type="submit" value="Simpan">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = htmlspecialchars($_POST['id']);
            $nama = htmlspecialchars($_POST['nama']);
            $universitas = htmlspecialchars($_POST['universitas']);
            $jurusan = htmlspecialchars($_POST['jurusan']);
            $no_hp = htmlspecialchars($_POST['no_hp']);
            $alamat = htmlspecialchars($_POST['alamat']);

            $data = [
                'id' => $id,
                'nama' => $nama,
                'universitas' => $universitas,
                'jurusan' => $jurusan,
                'no_hp' => $no_hp,
                'alamat' => $alamat,
            ];

            $file = 'data_mahasiswa.txt';

            $fileHandle = fopen($file, 'a');
            fwrite($fileHandle, json_encode($data) . PHP_EOL);
            fclose($fileHandle);

            echo "<p>Data berhasil disimpan!</p>";
        }
        ?>
    </div>
</body>
</html>
