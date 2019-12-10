<!-- start header -->
<?php $this->load->view('_partial/header.php');?>
<!-- end header -->

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
            <?php $this->load->view('_partial/sidebar.php')?>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content  -->
                    <div id="content">

                        <!-- Navbar  -->
                            <?php $this->load->view('_partial/navbar.php')?>
                        <!-- End Navbar  -->

                        <!-- Page Content  -->
                        <div class="container-fluid">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Data Perangkingan</h1>
                                <a href="<?=base_url();?>admin/print" class="btn btn-md btn-warning"><i class="fa fa-print text-white"></i></a>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-success float left">Data Hasil Perangkingan</h6>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Ranking</th>
                                                        <th>Nama Alternatif</th>                                    
                                                        <th>Ranking</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $r=1;
                                                    for ($i=0; $i < sizeof($rank); $i++) {
                                                ?>
                                                    <tr>
                                                        <td><?=$r++?></td>
                                                        <td><?=$rank[$i]['nama_alternatif']?></td>
                                                        <td><?=$rank[$i]['hasil']?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-success float left">Grafik Data Perangkingan</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <canvas id="graphic_id" width="100%" height="30"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Page Content  -->

                    </div>
                <!-- End Main Content  -->

                <!-- Footer  -->
                    <?php $this->load->view('_partial/footer.php')?>
                <!-- End Footer  -->

            </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

    <!-- ScrollTop  -->
        <?php $this->load->view('_partial/scrolltop.php')?>
    <!-- End ScrollTop  -->

    <!-- Modal -->
        <?php $this->load->view('_partial/modal.php')?>
    <!-- End Modal -->

    <!-- Script  -->
        <?php $this->load->view('_partial/script.php')?>
        <!-- <script src="<?=base_url()?>assets/js/demo/chart-bar-demo.js"></script> -->
    <!-- End Script  -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("<?php echo site_url('admin/rank')?>",
                function (data)
                {
                    console.log(<?=$graph?>);
                     var alter = [];
                     var hasil = [];

                    for (var i in <?=$graph?>) {
                        alter.push(<?=$graph?>[i].nama_alternatif);
                        hasil.push(<?=$graph?>[i].hasil);
                    }

                    var chartdata = {
                        labels: alter,
                        datasets: [
                            {
                                label: 'Hasil Ranking',
                                backgroundColor: '#1cc88a',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: hasil
                            }
                        ]
                    };

                    var graphTarget = $("#graphic_id");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
    </script>
</body>
</html>