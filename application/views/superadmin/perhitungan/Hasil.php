<!-- views/superadmin/perhitungan/nilai_perbandingan.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan Nilai Perbandingan</title>
</head>
<body>
    <h1><?php echo $judul; ?></h1>
    
    <table border="1">
        <tr>
            <th>Nama KIM</th>
            <th>Nilai KIM 1</th>
            <th>Nilai KIM 2</th>
            <th>Nilai KIM 3</th>
            <!-- Tambahkan kolom untuk setiap nilai KIM yang diperlukan -->
            <!-- ... -->
            <th>Total Nilai KIM</th>
        </tr>
        <?php foreach ($nilaiEigenSetiapData as $data) { ?>
        <tr>
            <td><?php echo $data['nama_kim']; ?></td>
            <td><?php echo $data['nilai_kim'][0]; ?></td>
            <td><?php echo $data['nilai_kim'][1]; ?></td>
            <td><?php echo $data['nilai_kim'][2]; ?></td>
            <!-- Menampilkan nilai KIM lainnya sesuai kebutuhan -->
            <!-- ... -->
            <td><?php echo $data['total_nilai_kim']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
