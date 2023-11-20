<?php $this->load->view('template/header'); ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<?php 
if($aksi == "lihat"):
?>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahDataKIM"><i class="fa fa-plus"></i>
    Tambah</a>
    <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalImportExcel"><i class="fa fa-upload"></i> Impor dari Excel</a> -->
<br /><br /><br />
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $anggota_kim): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $anggota_kim['nama_kim'] ?></td>
                <td><?= $anggota_kim['wilayah'] ?></td>
                <td>  
                   <?= $anggota_kim['nama_event'] ?> (<?= $anggota_kim['bobot_event'] ?>)
                </td>
                <td>  
                    <?= $anggota_kim['nama_medsos'] ?> (<?= $anggota_kim['bobot_medsos'] ?>)
                </td>
                <td>
                    <?php $stt = $anggota_kim['bobot_website'];
                        if ($stt == 2) {
                            echo "Memiliki Website";
                        } elseif ($stt == 3) {
                            echo "Memiliki Website, Tampilan Menarik, Fitur Lengkap";
                        } elseif ($stt == 4) {
                            echo "Memiliki Website, Tampilan Sangat Menarik, Fitur Sangat Lengkap, Aktif Update Berita";
                        } elseif ($stt == 5) {
                            echo "Memiliki Website, Tampilan Sangat Menarik, Fitur Sangat Lengkap, Aktif Update Berita, Advertising";
                        } ?>
                    (<?= $anggota_kim['bobot_website'] ?>)
                </td>
                <td>
                    <?php $stt = $anggota_kim['bobot_sanksi'];
                        if ($stt == 4) {
                            echo "1 - 3";
                        } elseif ($stt == 3) {
                            echo "4 - 6";
                        } elseif ($stt == 2) {
                            echo "7 - 10";
                        } elseif ($stt == 1) {
                            echo "> 11";
                        } ?>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="hapus_anggotakim('<?= $anggota_kim['id_anggota'] ?>')"
                        class="btn btn-danger" title="Hapus"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

   <!-- Modal tambah data -->
    <div class="modal fade" id="modalTambahDataKIM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                    <input type="text" name="nama_kim" class="form-control" placeholder="Nama KIM" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Wilayah</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="wilayah" class="form-control" placeholder="Wilayah" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Kriteria Event</th>
                            </tr>
                            <tr>
                                <td>
                                    <div id="dynamic_field">
                                    <label class="checkbox-inline" for="event1">
                                        <input type="checkbox" id="event1" name="nama_event[]" value="Pelantikan"> Pelantikan
                                    </label>
                                    <label class="checkbox-inline" for="event2">
                                        <input type="checkbox" id="event2" name="nama_event[]" value="Monitoring"> Monitoring
                                    </label>
                                    <label class="checkbox-inline" for="event3">
                                        <input type="checkbox" id="event3" name="nama_event[]" value="Giat Desa"> Giat Desa
                                    </label>
                                    <label class="checkbox-inline" for="event4">
                                        <input type="checkbox" id="event4" name="nama_event[]" value="Bimtek"> Bimtek
                                    </label><br>
                                    <label class="checkbox-inline" for="event5">
                                        <input type="checkbox" id="event5" name="nama_event[]" value="Studi Banding"> Studi Banding
                                    </label>
                                    <label class="checkbox-inline" for="event6">
                                        <input type="checkbox" id="event6" name="nama_event[]" value="Pekan KIM"> Pekan KIM
                                    </label>
                                    <label id="checkbox_items">
                                        <!-- Tempat untuk menambahkan elemen checkbox dinamis -->
                                    </label><br>
                                     <!-- membuat klik tombol tambah item -->
                                     <input type="text" id="new_item" class="form-control" placeholder="tambah item lainnya" autocomplete="off" style="width: 20%; display: inline-block;">
                                        <button type="button" class="btn btn-primary btn-sm" id="add_item"><i class="fa fa-plus"></i></button>
                                    </div>
                                </td>
                            </tr>
                         
                            <tr>
                                <th>Media Sosial</th>
                            </tr>
                            <tr>
                                <td>
                                    <div id="dynamic_field2">
                                    <label class="checkbox-inline" for="medsos1">
                                        <input type="checkbox" id="medsos1" name="nama_medsos[]" value="Instagram"> Instagram
                                    </label>
                                    <label class="checkbox-inline" for="medsos2">
                                        <input type="checkbox" id="medsos2" name="nama_medsos[]" value="Twitter"> Twitter
                                    </label>
                                    <label class="checkbox-inline" for="medsos3">
                                        <input type="checkbox" id="medsos3" name="nama_medsos[]" value="Facebook"> Facebook
                                    </label>
                                    <label class="checkbox-inline" for="medsos4">
                                        <input type="checkbox" id="medsos4" name="nama_medsos[]" value="Youtube"> Youtube
                                    </label><br>
                                    <label class="checkbox-inline" for="medsos5">
                                        <input type="checkbox" id="medsos5" name="nama_medsos[]" value="Tiktok"> Tiktok
                                    </label>
                                    <label id="checkbox_items2">
                                        <!-- Tempat untuk menambahkan elemen checkbox dinamis -->
                                    </label><br>
                                     <!-- membuat klik tombol tambah item -->
                                     <input type="text" id="new_item2" class="form-control" placeholder="tambah item lainnya" autocomplete="off" style="width: 20%; display: inline-block;">
                                    <button type="button" class="btn btn-primary btn-sm" id="add_item2"><i class="fa fa-plus"></i></button>
                                    
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

    <script>
        //add data nama event dinamis
        $(document).ready(function () {
        var i = 6;
        var j = 5;

        // Add data nama event dinamis
        $('#add_item').click(function () {
            var newItemName = $('#new_item').val().trim();

            if (newItemName !== "") {
                i++;
                $('#checkbox_items').append('<label class="checkbox-inline" for="event' + i + '"><input type="checkbox" id="event' + i + '" name="nama_event[]" value="' + newItemName + '">' + newItemName + '</label>');
                $('#new_item').val("");
            } else {
                swal({
                    title: "Gagal",
                    text: "Nama item tidak boleh kosong",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                });
            }
        });

        // Add data nama medsos dinamis
        $('#add_item2').click(function () {
            var newItemName = $('#new_item2').val().trim();

            if (newItemName !== "") {
                j++;
                $('#checkbox_items2').append('<label class="checkbox-inline" for="medsos' + j + '"><input type="checkbox" id="medsos' + j + '" name="nama_medsos[]" value="' + newItemName + '">' + newItemName + '</label>');
                $('#new_item2').val("");
            } else {
                swal({
                    title: "Gagal",
                    text: "Nama item tidak boleh kosong",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OK",
                });
            }
        });


        $('#add').submit(function (e) {
            e.preventDefault();

            // Dapatkan semua nilai checkbox yang dicentang
            var selectedItems = $('input[name="nama_event[]"]:checked').map(function () {
                return this.value;
            }).get();
            var selectedItems2 = $('input[name="nama_medsos[]"]:checked').map(function () {
                return this.value;
            }).get();

            // Hapus semua nilai sebelum menambahkan yang baru
            $('input[name="nama_event[]"]').remove();
            $('input[name="nama_medsos[]"]').remove();

            // Tambahkan nilai checkbox ke FormData
            selectedItems.forEach(function (item) {
                $('#add').append('<input type="checkbox" name="nama_event[]" value="' + item + '" checked style="display:none">');
            });
            selectedItems2.forEach(function (item) {
                $('#add').append('<input type="checkbox" name="nama_medsos[]" value="' + item + '" checked style="display:none">');
            });

            $.ajax({
                url: "<?= site_url('admin/anggota_kim/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
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
                    url: "<?php echo site_url('admin/anggota_kim/api_hapus/') ?>" + id_anggota,
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
