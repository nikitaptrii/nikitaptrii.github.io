<?php
include 'koneksi.php';

// Handle POST request for insert
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['npm'])) {
    // Check if it is an update or insert
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl_lhr = $_POST['tgl_lhr'];
    $jk = $_POST['jk'];
    $email = $_POST['email'];

    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $query = "UPDATE identitas SET nama='$nama', alamat='$alamat', tgl_lhr='$tgl_lhr', jk='$jk', email='$email' WHERE npm='$npm'";
    } else {
        $query = "INSERT INTO identitas (npm, nama, alamat, tgl_lhr, jk, email) VALUES ('$npm', '$nama', '$alamat', '$tgl_lhr', '$jk', '$email')";
    }

    if (mysqli_query($koneksi, $query)) {
        $response = array(
            'status' => 'success',
            'message' => 'Data berhasil disimpan!',
            'data' => array(
                'npm' => $npm,
                'nama' => $nama,
                'alamat' => $alamat,
                'tgl_lhr' => $tgl_lhr,
                'jk' => ($jk == 'L') ? 'Laki-laki' : 'Perempuan',
                'email' => $email
            )
        );
        echo json_encode($response);
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)));
    }
    exit();
}

// Handle DELETE request
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $npm = $_DELETE['npm'];

    $query = "DELETE FROM identitas WHERE npm='$npm'";
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus!'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . mysqli_error($koneksi)));
    }
    exit();
}

// Fetch existing data to display (if needed)
$result = mysqli_query($koneksi, "SELECT * FROM identitas");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spicy+Rice&display=swap" rel="stylesheet">
    <style>
        body {
    font-family: "Jost", sans-serif;
    font-weight: 400;
    font-style: italic;
    background-color: #FFF8DC;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #8FBC8F;
    font-weight: 600;
    font-size: 35px;
    font-family: "Spicy Rice", serif;
}

form {
    background-color: #FFF0F5;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 40px;
}

label {
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 8px;
}

input[type="text"],
input[type="date"],
input[type="email"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="email"]:focus {
    border-color: #3498db;
}

.radio-group {
    margin-bottom: 20px;
}

.radio-group label {
    margin-right: 15px;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #8FBC8F;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th,
table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #f9fafb;
}

.message {
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
    display: none;
}

.message.success {
    background-color: #d4edda;
    color: #155724;
}

.message.error {
    background-color: #f8d7da;
    color: #721c24;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Input Data Mahasiswa</h2>
        <div id="message" class="message"></div>
        <form id="mahasiswaForm">
            <label>NPM</label>
            <input type="text" name="npm" id="npm" required>
            <label>Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label>Alamat</label>
            <input type="text" name="alamat" id="alamat" required>
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lhr" id="tgl_lhr" required>
            <label>Jenis Kelamin</label>
            <div class="radio-group">
                <label><input type="radio" name="jk" value="L" required> Laki-laki</label>
                <label><input type="radio" name="jk" value="P" required> Perempuan</label>
            </div>
            <label>Email:</label>
            <input type="email" name="email" id="email" required>
            <input type="submit" name="submit" value="Simpan">
        </form>

        <h2>Tampilan Data Mahasiswa</h2>
        <table id="dataMahasiswa">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr data-npm="<?php echo $row['npm']; ?>">
                    <td><?php echo $row['npm']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['tgl_lhr']; ?></td>
                    <td><?php echo ($row['jk'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <button class="editBtn">Edit</button>
                        <button class="deleteBtn">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        // Form submission
        document.getElementById('mahasiswaForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const action = formData.get('npm') ? 'insert' : 'update';
            formData.append('action', action);

            fetch('crud.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('message');
                if (data.status === 'success') {
                    messageDiv.className = 'message success';
                    messageDiv.textContent = data.message;
                    messageDiv.style.display = 'block';

                    const newRow = `
                        <tr data-npm="${data.data.npm}">
                            <td>${data.data.npm}</td>
                            <td>${data.data.nama}</td>
                            <td>${data.data.alamat}</td>
                            <td>${data.data.tgl_lhr}</td>
                            <td>${data.data.jk}</td>
                            <td>${data.data.email}</td>
                            <td>
                                <button class="editBtn">Edit</button>
                                <button class="deleteBtn">Delete</button>
                            </td>
                        </tr>`;
                    document.querySelector('#dataMahasiswa tbody').innerHTML += newRow;

                    document.getElementById('mahasiswaForm').reset();
                    setTimeout(() => {
                        messageDiv.style.display = 'none';
                    }, 3000);
                } else {
                    messageDiv.className = 'message error';
                    messageDiv.textContent = data.message;
                    messageDiv.style.display = 'block';
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Handle edit button click
        document.querySelector('#dataMahasiswa tbody').addEventListener('click', function(e) {
            if (e.target.classList.contains('editBtn')) {
                const row = e.target.closest('tr');
                const npm = row.getAttribute('data-npm');
                const nama = row.children[1].textContent;
                const alamat = row.children[2].textContent;
                const tgl_lhr = row.children[3].textContent;
                const jk = row.children[4].textContent === 'Laki-laki' ? 'L' : 'P';
                const email = row.children[5].textContent;

                document.getElementById('npm').value = npm;
                document.getElementById('nama').value = nama;
                document.getElementById('alamat').value = alamat;
                document.getElementById('tgl_lhr').value = tgl_lhr;
                document.querySelector(`input[name="jk"][value="${jk}"]`).checked = true;
                document.getElementById('email').value = email;
            }
        });

        // Handle delete button click
        document.querySelector('#dataMahasiswa tbody').addEventListener('click', function(e) {
            if (e.target.classList.contains('deleteBtn')) {
                const row = e.target.closest('tr');
                const npm = row.getAttribute('data-npm');

                fetch('crud.php', {
                    method: 'DELETE',
                    body: new URLSearchParams({ npm: npm }),
                    headers: {
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const messageDiv = document.getElementById('message');
                    if (data.status === 'success') {
                        messageDiv.className = 'message success';
                        messageDiv.textContent = data.message;
                        messageDiv.style.display = 'block';
                        row.remove(); // Remove the row from the table
                    } else {
                        messageDiv.className = 'message error';
                        messageDiv.textContent = data.message;
                        messageDiv.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>
</html>

<?php $koneksi->close(); ?>
