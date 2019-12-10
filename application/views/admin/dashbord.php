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
                                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kriteria</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$row_krit?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Alternatif</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$row_alter?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        <!-- Content Row -->

                        <!-- Chart -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-success">Bar Chart</h6>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                <canvas id="graphic_id" width="100%" height="30"></canvas>
                                </div>
                            <hr>
                                Hasil Perangkingan dari Alterntif dan
                            </div>
                        </div>

                        <!-- EndChart -->

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
        <script src="<?=base_url()?>assets/js/demo/chart-bar-demo.js"></script>
    <!-- End Script  -->
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