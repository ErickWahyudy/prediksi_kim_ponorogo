<?php $this->load->view('template/header'); ?>

<?php if($this->session->userdata('level') == "1"){ ?>
    <!DOCTYPE html>
    <h1><?php echo $judul; ?></h1>

    <div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama KIM</th>
            <th>Matriks Perbandingan</th>
            <th>Nilai Eigen</th>
            <th>Nilai CI dan CR</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach ($all_calculations as $index => $calculation): ?>
            <tr>
            <td><?= $no ?></td>
            <td><?php echo $calculation['nama_kim']; ?></td>
                <td>
                <table class="table table-bordered table-striped">
                    <tr>
                    <th>KRITERIA</th>
                        <?php foreach ($criteria as $criterion) { ?>
                        <th><?php echo $criterion; ?></th>
                        <?php } ?>
                    </tr>
                        <?php foreach ($calculation['matriksPerbandingan'] as $row) { ?>
                            <tr>
                                <!-- view teks K1 K2 K3 K4 masih error -->
                            <th>
                                <!-- <?php echo $criteria[$index]; ?> -->
                            </th>
                                <?php foreach ($row as $value){ ?>
                                    <td><?php echo $value; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                            <?php foreach ($calculation['jumlahKolom'] as $value): ?>
                                <td><?php echo $value; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </td>
                <td>
                     <table class="table table-bordered table-striped">
                        <tr>
                            <th>KRITERIA</th>
                            <?php foreach ($criteria as $criterion): ?>
                                <th><?php echo $criterion; ?></th>
                            <?php endforeach; ?>
                            <th>Jumlah</th>
                        </tr>
                        <?php foreach ($calculation['nilaiEigen'] as $row): ?>
                            <tr>
                                <!-- view teks K1 K2 K3 K4 masih error -->
                            <th style="height: 30px; width: 30px;">
                                <!-- <?php echo $criteria[$index]; ?> -->
                            </th>
                                <?php foreach ($row as $value): ?>
                                    <td><?php echo number_format($value, 6); ?></td>
                                <?php endforeach; ?>
                                <td><?php echo number_format(array_sum($row), 6); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                        <th>Rata-rata</th>
                            <?php 
                                 $n = count($criteria);
                                 foreach ($calculation['nilaiEigen'] as $row): 
                            ?>
                                <td><?php echo number_format(array_sum($row)/$n, 6); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                        </tr>
                        <?php
                                //calculate LambdaMax
                                $lambdaMax = 0;
                                for ($i=0; $i < count($criteria); $i++) { 
                                    $lambdaMax += $calculation['jumlahKolom'][$i] * (array_sum($calculation['nilaiEigen'][$i]) / count($criteria));
                                }

                                //calculate CI
                                $ci = ($lambdaMax - count($criteria)) / (count($criteria) - 1);

                                //Define IR (Index Random) for a consistency matrix (you can adjust this value)
                                $ir = 0.90;

                                //calculate CR
                                $cr = $ci / $ir;

                                //calculate consistency
                                $consistency = ($cr < 0.1) ? 'Konsisten' : 'Tidak Konsisten';
                        ?>
                        <tr>
                            <td>Nilai LambdaMax</td>
                            <td><?php echo number_format($lambdaMax, 5); ?></td>
                        </tr>
                        <tr>
                            <td>Nilai CI</td>
                            <td><?php echo number_format($ci, 5); ?></td>
                        </tr>
                        <tr>
                            <td>Nilai CR</td>
                            <td><?php echo number_format($cr, 5); ?></td>
                        </tr>
                        <tr>
                            <td>Konsistensi</td>
                            <td><?php echo $consistency; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php $no++; endforeach; ?>
        </tbody>
    </table>



<?php }elseif($this->session->userdata('level') == "2"){ ?>
   <!-- cek plagiasi judul -->
<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Cek Plagiasi Judul</h4><br>
        </div>
        <a href="<?= base_url('admin/cek_plagiasi/input') ?>">
        <div class="icon">
            <i class="fa fa-check-square-o"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/cek_plagiasi/input') ?>" class="small-box-footer">Cek Plagiasi <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Judul Skripsi</h4><br>
        </div>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>">
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>" class="small-box-footer">Lihat Judul <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Input Judul Skripsi</h4><br>
        </div>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>">
        <div class="icon">
            <i class="fa fa-edit"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/judul_skripsi/lihat') ?>" class="small-box-footer">Input Judul <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php }elseif($this->session->userdata('level') == "3"){ ?>

    <!-- cek plagiasi judul -->
<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Cek Plagiasi Judul</h4><br>
        </div>
        <a href="<?= base_url('dosen/cek_plagiasi/input') ?>">
        <div class="icon">
            <i class="fa fa-check-square-o"></i>
        </div>
        </a>
        <a href="<?= base_url('dosen/cek_plagiasi/input') ?>" class="small-box-footer">Cek Plagiasi <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php } ?>

<?php $this->load->view('template/footer'); ?>