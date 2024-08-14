<?php
session_start();

if (!isset($_GET['index']) || !isset($_SESSION['mahasiswa'][$_GET['index']])) {
    header('Location: index.php');
    exit;
}

$index = $_GET['index'];
$mahasiswa = $_SESSION['mahasiswa'][$index];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'Update') {
    $_SESSION['mahasiswa'][$index]['id'] = htmlspecialchars($_POST['id']);
    $_SESSION['mahasiswa'][$index]['nama'] = htmlspecialchars($_POST['nama']);
    $_SESSION['mahasiswa'][$index]['universitas'] = htmlspecialchars($_POST['universitas']);
    $_SESSION['mahasiswa'][$index]['jurusan'] = htmlspecialchars($_POST['jurusan']);
    $_SESSION['mahasiswa'][$index]['no_hp'] = htmlspecialchars($_POST['no_hp']);
    $_SESSION['mahasiswa'][$index]['alamat'] = htmlspecialchars($_POST['alamat']);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
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
        h1 {
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
        <h1>Edit Data Mahasiswa</h1>
        <form action="" method="post">
            <input type="hidden" name="action" value="Update">
            <input type="hidden" name="index" value="<?php echo $index; ?>">

            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $mahasiswa['id']; ?>" required>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>

            <label for="universitas">Universitas:</label>
            <input type="text" id="universitas" name="universitas" value="<?php echo $mahasiswa['universitas']; ?>" required>

            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="jurusan" value="<?php echo $mahasiswa['jurusan']; ?>" required>

            <label for="no_hp">No HP:</label>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo $mahasiswa['no_hp']; ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $mahasiswa['alamat']; ?>" required>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
