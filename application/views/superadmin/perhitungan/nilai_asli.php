<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama KIM</th>
                <th>Wilayah</th>
                <th>Event</th>
                <th>Media Sosial</th>
                <th>Website</th>
                <th>Sanksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $anggota_kim): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $anggota_kim['nama_kim'] ?></td>
                <td><?= $anggota_kim['wilayah'] ?></td>
                <td><?= $anggota_kim['bobot_event'] ?></td>
                <td><?= $anggota_kim['bobot_medsos'] ?></td>
                <td><?= $anggota_kim['bobot_website'] ?></td>
                <td><?= $anggota_kim['bobot_sanksi'] ?></td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data -->
    <div class="modal fade" id="modalTambahDataKIM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="add" method="post">
                            <tr>
                                <th>Nama KIM</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_kim" class="form-control" placeholder="Nama KIM"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Wilayah</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="wilayah" class="form-control" placeholder="Wilayah"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Event</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_event" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Event --</option>
                                        <option value="2">Pelantikan, Monitoring</option>
                                        <option value="3">Giat Desa 2x, Pelantikan, Monitoring</option>
                                        <option value="4">Giat Desa 3x, Bimtek 2x, Pelantikan, Studi Banding,
                                            Monitoring</option>
                                        <option value="5">Giat Desa 5x, Bimtek 4x, Pelantikan,
                                            Monitoring, Pekan KIM</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Event</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="jumlah_event" class="form-control" required="">
                                        <option value="">-- Pilih Jumlah Event --</option>
                                        <option value="1-3">1 - 3</option>
                                        <option value="4-7">4 - 7</option>
                                        <option value="8-11">8 - 11</option>
                                        <option value=">12">> 12</option>

                                </td>
                            </tr>
                            <tr>
                                <th>Media Sosial</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_medsos" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Media Sosial --</option>
                                        <option value="2">Instagram, Twitter</option>
                                        <option value="3">Instagram, Twitter, Facebook</option>
                                        <option value="4">Instagram, Twitter, Facebook, Youtube</option>
                                        <option value="5">Instagram, Twitter, Facebook, Youtube, Tiktok</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Media Sosial</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="jumlah_medsos" class="form-control" required="">
                                        <option value="">-- Pilih Jumlah Media Sosial --</option>
                                        <option value="1-2">1 - 2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value=">5">> 5</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Website</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_website" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Website --</option>
                                        <option value="2">Memiliki Website</option>
                                        <option value="3">Memiliki Website, Tampilan Menarik, Fitur Lengkap</option>
                                        <option value="4">Memiliki Website, Tampilan Sangat Menarik, Fitur Sangat Lengkap,
                                            Aktif Update Berita</option>
                                        <option value="5">Memiliki Website, Tampilan Sangat Menarik, Fitur Sangat Lengkap,
                                            Aktif Update Berita, Advertising</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Sanksi</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_sanksi" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Sanksi --</option>
                                        <option value="4">1 - 3</option>
                                        <option value="3">4 - 6</option>
                                        <option value="2">7 - 10</option>
                                        <option value="1">> 11</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal impor data dari Excel -->
    <!-- <div class="modal fade" id="modalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Impor Data dari Excel</h4>
                    <a href="<?= site_url('superadmin/judul_skripsi/buatTemplateExcel') ?>" class="btn btn-success">Unduh Template Excel</a>

                </div>
                <div class="modal-body">
                    <form id="importExcelForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="excelFile">Pilih File Excel:</label>
                            <input type="file" class="form-control" id="excelFile" name="excelFile" accept=".xlsx,.xls">
                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" id="importExcelBtn">Impor</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Modal -->

    <!-- Modal edit data judul skripsi-->
    <?php foreach($data as $anggota_kim): ?>
    <div class="modal fade" id="edit<?= $anggota_kim['id_anggota'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="edit" method="post">
                            <tr>
                                <th>ID Anggota KIM</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_anggota" value="<?= $anggota_kim['id_anggota'] ?>"
                                        class="form-control" readonly>
                                    <input type="hidden" name="id_event" value="<?= $anggota_kim['id_event'] ?>"
                                        class="form-control" readonly>
                                    <input type="hidden" name="id_medsos" value="<?= $anggota_kim['id_medsos'] ?>"
                                        class="form-control" readonly>
                                    <input type="hidden" name="id_website" value="<?= $anggota_kim['id_website'] ?>"
                                        class="form-control" readonly>
                                    <input type="hidden" name="id_sanksi" value="<?= $anggota_kim['id_sanksi'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama KIM</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_kim" value="<?= $anggota_kim['nama_kim'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Wilayah</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="wilayah" value="<?= $anggota_kim['wilayah'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Event</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_event" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Event --</option>
                                        <option value="2" <?php if($anggota_kim['bobot_event'] == 2) echo 'selected' ?>>Pelantikan, Monitoring</option>
                                        <option value="3" <?php if($anggota_kim['bobot_event'] == 3) echo 'selected' ?>>Giat Desa 2x, Pelantikan, Monitoring</option>
                                        <option value="4" <?php if($anggota_kim['bobot_event'] == 4) echo 'selected' ?>>Giat Desa 3x, Bimtek 2x, Pelantikan, Studi Banding, Monitoring</option>
                                        <option value="5" <?php if($anggota_kim['bobot_event'] == 5) echo 'selected' ?>>Giat Desa 5x, Bimtek 4x, Pelantikan, Monitoring, Pekan KIM</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Event</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="jumlah_event" class="form-control" required="">
                                        <option value="">-- Pilih Jumlah Event --</option>
                                        <option value="1-3" <?php if($anggota_kim['jumlah_event'] == '1-3') echo 'selected' ?>>1 - 3</option>
                                        <option value="4-7" <?php if($anggota_kim['jumlah_event'] == '4-7') echo 'selected' ?>>4 - 7</option>
                                        <option value="8-11" <?php if($anggota_kim['jumlah_event'] == '8-11') echo 'selected' ?>>8 - 11</option>
                                        <option value=">12" <?php if($anggota_kim['jumlah_event'] == '>12') echo 'selected' ?>>> 12</option>

                                </td>
                            </tr>
                            <tr>
                                <th>Media Sosial</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_medsos" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Media Sosial --</option>
                                        <option value="2" <?php if($anggota_kim['bobot_medsos'] == 2) echo 'selected' ?>>Instagram, Twitter</option>
                                        <option value="3" <?php if($anggota_kim['bobot_medsos'] == 3) echo 'selected' ?>>Instagram, Twitter, Facebook</option>
                                        <option value="4" <?php if($anggota_kim['bobot_medsos'] == 4) echo 'selected' ?>>Instagram, Twitter, Facebook, Youtube</option>
                                        <option value="5" <?php if($anggota_kim['bobot_medsos'] == 5) echo 'selected' ?>>Instagram, Twitter, Facebook, Youtube, Tiktok</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Media Sosial</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="jumlah_medsos" class="form-control" required="">
                                        <option value="">-- Pilih Jumlah Media Sosial --</option>
                                        <option value="1-2" <?php if($anggota_kim['jumlah_medsos'] == '1-2') echo 'selected' ?>>1 - 2</option>
                                        <option value="3" <?php if($anggota_kim['jumlah_medsos'] == 3) echo 'selected' ?>>3</option>
                                        <option value="4" <?php if($anggota_kim['jumlah_medsos'] == 4) echo 'selected' ?>>4</option>
                                        <option value=">5" <?php if($anggota_kim['jumlah_medsos'] == '>5') echo 'selected' ?>>> 5</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Website</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_website" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Website --</option>
                                        <option value="2" <?php if($anggota_kim['bobot_website'] == 2) echo 'selected' ?>>Memiliki Website</option>
                                        <option value="3" <?php if($anggota_kim['bobot_website'] == 3) echo 'selected' ?>>Memiliki Website, Tampilan Menarik, Fitur Lengkap</option>
                                        <option value="4" <?php if($anggota_kim['bobot_website'] == 4) echo 'selected' ?>>Memiliki Website, Tampilan Sangat Menarik, Fitur Sangat Lengkap, Aktif Update Berita</option>
                                        <option value="5" <?php if($anggota_kim['bobot_website'] == 5) echo 'selected' ?>>Memiliki Website, Tampilan Sangat Menarik, Fitur Sangat Lengkap, Aktif Update Berita, Advertising</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Sanksi</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="bobot_sanksi" class="form-control" required="">
                                        <option value="">-- Pilih Kriteria Sanksi --</option>
                                        <option value="4" <?php if($anggota_kim['bobot_sanksi'] == 4) echo 'selected' ?>>1 - 3</option>
                                        <option value="3" <?php if($anggota_kim['bobot_sanksi'] == 3) echo 'selected' ?>>4 - 6</option>
                                        <option value="2" <?php if($anggota_kim['bobot_sanksi'] == 2) echo 'selected' ?>>7 - 10</option>
                                        <option value="1" <?php if($anggota_kim['bobot_sanksi'] == 1) echo 'selected' ?>>> 11</option>
                                    </select>
                                </td>
                            </tr>
                                                        
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)"
                                        onclick="hapus_anggotakim('<?= $anggota_kim['id_anggota'] ?>')"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->

    <script>
        //add data
        $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('superadmin/anggota_kim/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    if (data.status) {
                        $('#modalTambahDataKIM');
                        $('#add')[0].reset();
                        swal({
                            title: "Berhasil",
                            text: "Data berhasil ditambahkan",
                            type: "success",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE",
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        // Hapus tag HTML dari pesan error
                        var errorMessage = $('<div>').html(data.message).text();
                        swal({
                            title: "Gagal",
                            text: errorMessage, // Menampilkan pesan error dari server
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Menampilkan pesan error jika terjadi kesalahan pada AJAX request
                    swal({
                        title: "Error",
                        text: "Terjadi kesalahan saat mengirim data",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OK",
                    });
                }
            });
        });
    });


    //edit
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('superadmin/anggota_kim/api_edit/') ?>" + form_data.get('id_anggota'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_anggota'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            },
            //memanggil swall ketika gagal
            error: function(data) {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Diubah",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            }
        });
    });

    //ajax hapus
    function hapus_anggotakim(id_anggota) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Dihapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('superadmin/anggota_kim/api_hapus/') ?>" + id_anggota,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Dihapus",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Dihapus",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal hapus", "Data Tidak Jadi Dihapus", "error");
            }
        });
    }
    </script>
    <?php endif; ?>
    <?php $this->load->view('template/footer'); ?>
