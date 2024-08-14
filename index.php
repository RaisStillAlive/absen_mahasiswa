<?php
session_start();

if (!isset($_SESSION['mahasiswa'])) {
    $_SESSION['mahasiswa'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action == 'Simpan') {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $universitas = $_POST['universitas'];
        $jurusan = $_POST['jurusan'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        
        $_SESSION['mahasiswa'][] = [
            'id' => htmlspecialchars($id),
            'nama' => htmlspecialchars($nama),
            'universitas' => htmlspecialchars($universitas),
            'jurusan' => htmlspecialchars($jurusan),
            'no_hp' => htmlspecialchars($no_hp),
            'alamat' => htmlspecialchars($alamat),
        ];
    } elseif ($action == 'Update') {
        $index = $_POST['index'];
        $_SESSION['mahasiswa'][$index]['id'] = htmlspecialchars($_POST['id']);
        $_SESSION['mahasiswa'][$index]['nama'] = htmlspecialchars($_POST['nama']);
        $_SESSION['mahasiswa'][$index]['universitas'] = htmlspecialchars($_POST['universitas']);
        $_SESSION['mahasiswa'][$index]['jurusan'] = htmlspecialchars($_POST['jurusan']);
        $_SESSION['mahasiswa'][$index]['no_hp'] = htmlspecialchars($_POST['no_hp']);
        $_SESSION['mahasiswa'][$index]['alamat'] = htmlspecialchars($_POST['alamat']);
    } elseif ($action == 'Delete') {
        $index = $_POST['index'];
        array_splice($_SESSION['mahasiswa'], $index, 1);
    }
}

$editMode = false;
if (isset($_GET['edit'])) {
    $editMode = true;
    $editIndex = $_GET['edit'];
    $editData = $_SESSION['mahasiswa'][$editIndex];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('image/sumeru.webp'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
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
            background-color: rgba(255, 255, 255, 0.8);
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
        input[type="submit"], .btn-delete {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"]:hover, .btn-delete:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: left;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="image/logo.webp" alt="Logo" style="width:100px; height:auto; margin-bottom: 20px;">
        <h1>Form Data Mahasiswa</h1>
        <form action="" method="post">
            <input type="hidden" name="action" value="<?php echo $editMode ? 'Update' : 'Simpan'; ?>">
            <?php if ($editMode): ?>
                <input type="hidden" name="index" value="<?php echo $editIndex; ?>">
            <?php endif; ?>

            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $editMode ? $editData['id'] : ''; ?>" required>

            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $editMode ? $editData['nama'] : ''; ?>" required>

            <label for="universitas">Universitas:</label>
            <input type="text" id="universitas" name="universitas" value="<?php echo $editMode ? $editData['universitas'] : ''; ?>" required>

            <label for="jurusan">Jurusan:</label>
            <input type="text" id="jurusan" name="jurusan" value="<?php echo $editMode ? $editData['jurusan'] : ''; ?>" required>

            <label for="no_hp">No HP:</label>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo $editMode ? $editData['no_hp'] : ''; ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?php echo $editMode ? $editData['alamat'] : ''; ?>" required>

            <input type="submit" value="<?php echo $editMode ? 'Update' : 'Simpan'; ?>">
        </form>

        <?php if (!empty($_SESSION['mahasiswa'])): ?>
            <h2>Daftar Mahasiswa</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Universitas</th>
                        <th>Jurusan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['mahasiswa'] as $index => $mhs): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($mhs['id']); ?></td>
                            <td><?php echo htmlspecialchars($mhs['nama']); ?></td>
                            <td><?php echo htmlspecialchars($mhs['universitas']); ?></td>
                            <td><?php echo htmlspecialchars($mhs['jurusan']); ?></td>
                            <td><?php echo htmlspecialchars($mhs['no_hp']); ?></td>
                            <td><?php echo htmlspecialchars($mhs['alamat']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <td>
                                <a href="index.php?edit=<?php echo $index; ?>">Edit</a>
                                <form action="" method="post" style="display:inline;">
                                    <input type="hidden" name="action" value="Delete">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <input type="submit" class="btn-delete" value="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                </form>
                            </td>
        <?php endif; ?>
    </div>
</body>
</html>
