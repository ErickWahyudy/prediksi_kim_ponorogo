<?php $this->load->view('template/header'); ?>

<?php
    // Isi kode lain yang diperlukan sebelumnya

    // Mengumpulkan total nilai untuk setiap data
    $totals = [];
    foreach ($all_calculations as $index => $calculation) {
        $totalNilai = 0;
        for ($i = 0; $i < count($criteria); $i++) {
            $totalNilai += (array_sum($calculation['nilaiEigen'][$i]) / count($criteria)) * $calculation['nilaiEigen'][$i][$index];
        }
        $totals[$index] = $totalNilai;
    }

    // Mengurutkan array $all_calculations berdasarkan total nilai
    array_multisort($totals, SORT_DESC, $all_calculations);

    ?>

    <h1><?php echo $judul; ?></h1>

    <div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama KIM</th>
            <th>Total Nilai</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach ($all_calculations as $index => $calculation): ?>
            <tr>
            <td><?= $no ?></td>
            <td><?php echo $calculation['nama_kim']; ?></td>
                <!-- Total Nilai berdasarkan rata-rata -->
                <td>
                    <table class="">
                        <tr>                        
                            <?php
                                //total nilai berdasarkan rata-rata = (rata-rata K1 x rata-rata K1 KIM1+(rata-rata K2 x rata-rata K2 KIM1)+(rata-rata K3 x rata-rata K3 KIM1)+(rata-rata K4 x ratarata K4 KIM1)
                                $totalNilai = 0;
                                for ($i=0; $i < count($criteria); $i++) { 
                                    $totalNilai += (array_sum($calculation['nilaiEigen'][$i]) / count($criteria)) * $calculation['nilaiEigen'][$i][$index];
                                }
                            ?>

                            
                                <td><?php echo number_format($totalNilai, 5); ?></td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
        <?php $no++; endforeach; ?>
        </tbody>
    </table>


<?php $this->load->view('template/footer'); ?>
