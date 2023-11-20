<?php $this->load->view('template/header'); ?>

<?php
    foreach ($all_calculations as $index => $calculation) {
        foreach ($calculation['rataRataEigen_sorted'] as $index => $value) {
            $all_calculations[$index]['rataRataEigen_sorted'] = $value;
        }
        $totalNilai = 0;
        for ($i = 0; $i < count($criteria); $i++) {
            if (isset($calculation['nilaiEigen'][$i][$index])) {
                $totalNilai += (array_sum($calculation['nilaiEigen'][$i]) / count($criteria)) * $calculation['nilaiEigen'][$i][$index];
            }
        }
    
        $totals[] = array('index' => $index, 'totalNilai' => $totalNilai);
    }

    foreach ($totals as $index => $total) {
        $totals[$index]['index'] = $index;
    }
    // Mengurutkan $totals berdasarkan totalNilai
    usort($totals, function ($a, $b) {
        return $b['totalNilai'] > $a['totalNilai'];
    });

    // Menata kembali $all_calculations berdasarkan urutan totalNilai // Menata kembali $all_calculations berdasarkan urutan totalNilai
    $sorted_calculations = array();
    foreach ($totals as $total) {
        $sorted_calculations[] = $all_calculations[$total['index']];
    }

    // Mengganti $all_calculations dengan versi yang sudah diurutkan
    $all_calculations = $sorted_calculations;
    ?>

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
            <th>Total Nilai</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1;
        foreach ($all_calculations as $index => $calculation):             
        ?>
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
                        <?php foreach ($calculation['matriksPerbandingan'] as $index => $row) { ?>
                            <tr>
                            <th>
                                <?php echo $criteria[$index]; ?>
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
                        <?php foreach ($calculation['nilaiEigen'] as $index => $row): ?>
                            <tr>
                            <th style="height: 30px; width: 30px;">
                                <?php echo $criteria[$index]; ?>
                            </th>
                                <?php foreach ($row as $value): ?>
                                    <td><?php echo number_format($value, 6); ?></td>
                                <?php endforeach; ?>
                                <td><?php echo number_format(array_sum($row), 6); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                        <th>Rata-rata</th>
                                <?php foreach ($calculation['rataRataEigen'] as $value): ?>
                                    <td><?php echo number_format($value, 6); ?></td>
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
                                $consistency = ($cr < 0.2) ? 'Konsisten' : 'Tidak Konsisten';
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
                <!-- Total Nilai berdasarkan rata-rata -->
                <td>
                    <table class="">
                        <tr>                        
                         <?php
                                $totalNilai = 0;

                                for ($i = 0; $i < count($criteria); $i++) {
                                    if (isset($calculation['nilaiEigen'][$i][$index])) {
                                        $totalNilai += (array_sum($calculation['nilaiEigen'][$i]) / count($criteria)) * $calculation['nilaiEigen'][$i][$index];
                                    }
                                }

                               
                                ?>
                                <td><?php echo number_format($totalNilai, 5); ?></td>                   
                        </tr>
                    </table>
                </td>
            </tr>
           
            <?php
                $no++;
            endforeach;
            ?>
        </tbody>
    </table>

<?php $this->load->view('template/footer'); ?>