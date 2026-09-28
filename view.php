<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MVC PHP App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav { background-color: #bce6fb; padding: 10px; margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #000; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th { background-color: #9ee0ff; padding: 10px; text-align: left; }
        td { padding: 8px; }
        .form-container { width: 300px; margin: 20px 0; }
        .form-group { margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; }
        .form-group select, .form-group input { width: 180px; padding: 5px; }
        .btn-save { background-color: #9ee0ff; border: 1px solid #000; padding: 8px 20px; cursor: pointer; border-radius: 5px; }
        .btn-delete { color: red; text-decoration: none; }
    </style>
</head>
<body>

    <!-- Navigasi Atas -->
    <nav>
        <a href="controller.php?page=employee">Employee</a> | 
        <a href="controller.php?page=office">Office</a> | 
        <a href="controller.php?page=office_employee">Office-Employees</a>
    </nav>

    <?php if ($page === 'employee'): ?>
        <h2>List Karyawan</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Usia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = $employees->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['jabatan']); ?></td>
                    <td><?= htmlspecialchars($row['usia']); ?></td>
                    <td><a class="btn-delete" href="controller.php?page=employee&action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')">Delete</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Tambah Karyawan</h3>
        <form action="controller.php?page=employee&action=add" method="POST">
            <div class="form-group"><label>Nama:</label><input type="text" name="nama" required></div>
            <div class="form-group"><label>Jabatan:</label><input type="text" name="jabatan" required></div>
            <div class="form-group"><label>Usia:</label><input type="number" name="usia" required></div>
            <button type="submit" class="btn-save">Submit</button>
        </form>

    <?php elseif ($page === 'office'): ?>
        <h2>List Office</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = $offices->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['address']); ?></td>
                    <td><?= htmlspecialchars($row['city']); ?></td>
                    <td><?= htmlspecialchars($row['phone']); ?></td>
                    <td><a class="btn-delete" href="controller.php?page=office&action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')">Delete</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Tambah Office</h3>
        <form action="controller.php?page=office&action=add" method="POST">
            <div class="form-group"><label>Name:</label><input type="text" name="name" required></div>
            <div class="form-group"><label>Address:</label><input type="text" name="address" required></div>
            <div class="form-group"><label>City:</label><input type="text" name="city" required></div>
            <div class="form-group"><label>Phone:</label><input type="text" name="phone" required></div>
            <button type="submit" class="btn-save">Submit</button>
        </form>

    <?php elseif ($page === 'office_employee'): ?>
        <h2>Office Employees</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Office</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $officeEmployees->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['employee_name']); ?></td>
                    <td><?= htmlspecialchars($row['office_name']); ?></td>
                    <td><a class="btn-delete" href="controller.php?page=office_employee&action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Hapus relasi?')">Delete</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="form-container">
            <form action="controller.php?page=office_employee&action=add" method="POST">
                <div class="form-group">
                    <label>Employee</label>
                    <select name="employee_id" required>
                        <?php while ($emp = $employees->fetch_assoc()): ?>
                            <option value="<?= $emp['id']; ?>"><?= htmlspecialchars($emp['nama']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Office</label>
                    <select name="office_id" required>
                        <?php while ($off = $offices->fetch_assoc()): ?>
                            <option value="<?= $off['id']; ?>"><?= htmlspecialchars($off['name']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div style="text-align: center; margin-top: 15px;">
                    <button type="submit" class="btn-save">SAVE</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

</body>
</html>