<?php $this->load->view('template/header'); ?>

<?php if($this->session->userdata('level') == "1"){ ?>
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
            <th>Total Nilai</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach ($all_calculations as $index => $calculation): 
            ?>
            <tr>
            <td class="col-md-1"><?= $no ?></td>
            <td><?php echo $calculation['nama_kim']; ?></td>
                <!-- Total Nilai berdasarkan rata-rata -->
                <td>
                    <table class="">
                        <tr>                        
                            <?php
                             foreach ($calculation['nilaiEigen'] as $index => $value) {
                                $calculation['nilaiEigen'][$index] = $value;
                            }
                                //total nilai berdasarkan rata-rata = (rata-rata K1 x rata-rata K1 KIM1+(rata-rata K2 x rata-rata K2 KIM1)+(rata-rata K3 x rata-rata K3 KIM1)+(rata-rata K4 x ratarata K4 KIM1)
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
        <?php $no++; endforeach; ?>
        </tbody>
    </table>    



<?php }elseif($this->session->userdata('level') == "2"){ ?>
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
            <th>Total Nilai</th>
        </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach ($all_calculations as $index => $calculation): 
            ?>
            <tr>
            <td class="col-md-1"><?= $no ?></td>
            <td><?php echo $calculation['nama_kim']; ?></td>
                <!-- Total Nilai berdasarkan rata-rata -->
                <td>
                    <table class="">
                        <tr>                        
                            <?php
                             foreach ($calculation['nilaiEigen'] as $index => $value) {
                                $calculation['nilaiEigen'][$index] = $value;
                            }
                                //total nilai berdasarkan rata-rata = (rata-rata K1 x rata-rata K1 KIM1+(rata-rata K2 x rata-rata K2 KIM1)+(rata-rata K3 x rata-rata K3 KIM1)+(rata-rata K4 x ratarata K4 KIM1)
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
        <?php $no++; endforeach; ?>
        </tbody>
    </table>    

<?php }elseif($this->session->userdata('level') == "3"){ ?>



<?php } ?>

<?php $this->load->view('template/footer'); ?>