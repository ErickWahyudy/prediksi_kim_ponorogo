<?php $this->load->view('template/header'); ?>

<div class="table-responsive">

    <table class="table table-bordered table-striped">
        <tr>
            <th colspan="6">Matriks Perbandingan <?= $data['nama_kim'] ?></th>
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
            <th colspan="6">Nilai Eigen <?= $data['nama_kim'] ?></th>
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
            <th colspan="2">Nilai CI dan CR <?= $data['nama_kim'] ?></th>
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
<a href="<?= base_url('superadmin/perhitungan/nilai_perbandingan') ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>

<?php $this->load->view('template/footer'); ?>