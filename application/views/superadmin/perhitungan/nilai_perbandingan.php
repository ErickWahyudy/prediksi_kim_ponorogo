<?php $this->load->view('template/header'); ?>

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
                <th>Detail Perhitungan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data_kim as $anggota_kim): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $anggota_kim['nama_kim'] ?></td>
                <td><?= $anggota_kim['wilayah'] ?></td>
                <td><?= $anggota_kim['bobot_event'] ?></td>
                <td><?= $anggota_kim['bobot_medsos'] ?></td>
                <td><?= $anggota_kim['bobot_website'] ?></td>
                <td><?= $anggota_kim['bobot_sanksi'] ?></td>
                <td>
                    <a href="<?= base_url('superadmin/perhitungan/nilai_perbandingan/detail/'.$anggota_kim['id_anggota']) ?>"
                        class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Detail</a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
    
    
    <!-- Modal Detail -->
    <?php foreach($data_kim as $anggota_kim): ?>
    <div class="modal fade" id="detail<?= $anggota_kim['id_anggota'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detail <?= $judul ?> <?= $anggota_kim['nama_kim'] ?></h4>
                </div>

                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="6">Matriks Perbandingan</th>
                        </tr>
                        <tr>
                            <th>KRITERIA</th>
                            <?php foreach ($criteria as $criterion) { ?>
                            <th><?php echo $criterion; ?></th>
                            <?php } ?>
                        </tr>
                        <?php foreach ($matriksPerbandingan as $index => $row) { ?>
                        <tr>
                            <th style="height: 30px; width: 30px;"><?php echo $criteria[$index]; ?></th>
                            <?php foreach ($row as $value) { ?>
                            <td><?php echo $value; ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th>JUMLAH</th>
                            <?php foreach ($jumlahKolom as $kolom => $jumlah) { ?>
                            <td><?php echo number_format($jumlah, 3); ?></td>
                            <?php } ?>
                        </tr>
                    </table>

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="6">Nilai Eigen</th>
                        </tr>
                        <tr>
                            <th>Kriteria</th>
                            <?php foreach ($criteria as $criterion) { ?>
                            <th><?php echo $criterion; ?></th>
                            <?php } ?>
                            <th>JUMLAH</th>
                        </tr>
                        <?php
                    $sumEigen = array();
                    foreach ($nilaiEigen as $index => $row) { ?>
                        <tr>
                            <th><?php echo $criteria[$index]; ?></th>
                            <?php
                            $sum = 0;
                            foreach ($row as $value) { ?>
                            <td><?php echo number_format($value, 6); ?></td>
                            <?php
                                $sum += $value;
                                if (!isset($sumEigen[$index])) {
                                    $sumEigen[$index] = 0;
                                }
                                $sumEigen[$index] += $value;
                            } ?>
                            <td><?php echo number_format($sum, 6); ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <th>Rata-rata</th>
                            <?php
                        $n = count($criteria);
                        foreach ($sumEigen as $colSum) { ?>
                            <td><?php echo number_format($colSum / $n, 6); ?></td>
                            <?php } ?>
                            <td></td>
                        </tr>
                    </table>
                    
                    <table class="table table-bordered table-striped">
                    <tr>
                        <th colspan="2">Nilai CI dan CR</th>
                    </tr>
                    <?php
                        // Calculate Lamda max
                        $lamdaMax = 0;
                        for ($i = 0; $i < count($criteria); $i++) {
                            $lamdaMax += $jumlahKolom[$i] * ($sumEigen[$i] / count($criteria));
                        }

                        // Calculate CI
                        $CI = ($lamdaMax - count($criteria)) / (count($criteria) - 1);

                        // Define IR (Index Random) for a consistent matrix (you can adjust this value)
                        $IR = 0.90;

                        // Calculate CR
                        $CR = $CI / $IR;
                        ?>
                        
                        <tr>
                            <th class="col-md-3">Keterangan</th>
                            <th>Nilai</th>
                            </tr>
                            <tr>
                                <td>Lamda max</td>
                                <td><?php echo number_format($lamdaMax, 5); ?></td>
                            </tr>
                            <tr>
                                <td>CI</td>
                                <td><?php echo number_format($CI, 5); ?></td>
                            </tr>
                            <tr>
                                <td>CR</td>
                                <td><?php echo number_format($CR, 5); ?></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal Detail -->

    <?php $this->load->view('template/footer'); ?>