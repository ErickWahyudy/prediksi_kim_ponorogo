<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="keywords"
        content="<?= $nama_judul['nama_judul'] ?>, <?= $nama_judul['meta_keywords'] ?>, <?= $nama_judul['meta_description'] ?>, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="<?= $nama_judul['meta_description'] ?>">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?= base_url('themes/admin') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet"
        href="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
    <!-- bootstrap wysihtml5 - text editor -->
    <script src="<?= base_url('themes/admin') ?>/bower_components/jquery/jquery-1.11.2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->
    <!-- maps -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZe7HOqihPIijMcH43anmVsJTZLcYdg28&callback=initMap"
        type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <!-- Favicon -->
    <link href="<?= base_url('themes/kassandra-wifi') ?>/img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }

    #preview_logo {
        display: none;
    }
    </style>
</head>

<body background="<?= base_url('themes/admin') ?>/dist/home1.jpg" style="background-size: cover;">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
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


                    <!-- tombol keluar -->
                    <a href="<?= base_url('login') ?>" class="btn btn-warning btn-sm">Keluar</a>
                    <footer>
                        <center>
                            <strong>Copyright &copy; <?php echo date('Y'); ?>
                                <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
                                <a href="https://bit.ly/kassandrahdproduction"
                                    target="blank"><?= $nama_judul['nama_judul'] ?></a>.</strong> All rights
                            reserved.
                            <br><i>Access application with <?php echo "". get_client_browser()."";?>.
                                <?php echo "". get_client_ip()."";?></i>
                        </center>
                    </footer>

                    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

                </div>
                <!-- ./wrapper -->

                <!-- jQuery 3 -->
                <script src="<?= base_url('themes/admin') ?>/bower_components/jquery/dist/jquery.min.js">
                </script>
                <!-- jQuery UI 1.11.4 -->
                <script src="<?= base_url('themes/admin') ?>/bower_components/jquery-ui/jquery-ui.min.js">
                </script>
                <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
                <script>
                $.widget.bridge('uibutton', $.ui.button);
                </script>
                <!-- Bootstrap 3.3.7 -->
                <script src="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js">
                </script>

                <script
                    src="<?= base_url('themes/admin') ?>/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js">
                </script>
                <!-- jvectormap -->
                <script src="<?= base_url('themes/admin') ?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js">
                </script>
                <script src="<?= base_url('themes/admin') ?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js">
                </script>
                <!-- jQuery Knob Chart -->
                <script src="<?= base_url('themes/admin') ?>/bower_components/jquery-knob/dist/jquery.knob.min.js">
                </script>
                <!-- daterangepicker -->
                <script src="<?= base_url('themes/admin') ?>/bower_components/moment/min/moment.min.js">
                </script>
                <!-- <script src="<?= base_url('themes/admin') ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
                <!-- datepicker -->
                <script
                    src="<?= base_url('themes/admin') ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
                </script>
                <script
                    src="<?= base_url('themes/admin') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js">
                </script>
                <script src="<?= base_url('themes/admin') ?>/bower_components/chart.js/Chart.js">
                </script>

                <script>
                $(function() {
                    $('#example1').DataTable()
                    $('#example2').DataTable({
                        'paging': true,
                        'lengthChange': false,
                        'searching': false,
                        'ordering': true,
                        'info': true,
                        'autoWidth': false
                    })
                })

                //   $(function () {
                //     $("#example1").DataTable({
                //       "responsive": true, "lengthChange": false, "autoWidth": false,
                //       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                //     $('#example2').DataTable({
                //       "paging": true,
                //       "lengthChange": false,
                //       "searching": false,
                //       "ordering": true,
                //       "info": true,
                //       "autoWidth": false,
                //       "responsive": true,
                //     });
                //   });
                </script>

                <?php
 //menampilkan ip address menggunakan function getenv()
 function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}

	 //menampilkan jenis web browser pengunjung
function get_client_browser() {
    $browser = '';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
        $browser = 'Netscape';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
        $browser = 'Firefox';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
        $browser = 'Chrome';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
        $browser = 'Opera';
    else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
        $browser = 'Internet Explorer';
  	else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Browser'))
        $browser = 'Browser';
    else
        $browser = 'Other';
    return $browser;
}

?>


                <script
                    src="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
                </script>
                <script
                    src="<?= base_url('themes/admin') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js">
                </script>
                <!-- Slimscroll -->
                <script
                    src="<?= base_url('themes/admin') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js">
                </script>
                <!-- FastClick -->
                <script src="<?= base_url('themes/admin') ?>/bower_components/fastclick/lib/fastclick.js">
                </script>
                <!-- AdminLTE App -->
                <script src="<?= base_url('themes/admin') ?>/dist/js/adminlte.min.js"></script>
                <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                <!-- <script src="<?= base_url('themes/admin') ?>/dist/js/pages/dashboard.js"></script> -->
                <!-- AdminLTE for demo purposes -->
                <script src="<?= base_url('themes/admin') ?>/dist/js/demo.js"></script>
</body>

</html>