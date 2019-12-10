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
                                <h1 class="h3 mb-0 text-gray-800">Kelola Kriteria</h1>
                            </div>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-success float left">Kelola Kriteria</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="<?=base_url();?>admin/tambah_kriteria" class="float-right btn btn-sm btn-success" style="color:#fff;"><i class="fas fa-plus"></i> Tambah Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="<?=base_url()?>admin/del_krit" class="mb-3 btn btn-sm btn-danger" style="color:#fff"><i class="fas fa-trash-alt"></i> Hapus    </a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>no</th>
                                                    <th>Nama Kriteria</th>
                                                    <th>Rank Krit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($krit as $key):
                                            ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$key->nama_kriteria?></td>
                                                    <td><?=$key->rank?></td>
                                                </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        // var_dump($abcd);
                                        ?>
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
        <script src="<?=base_url()?>assets/js/demo/chart-bar-demo.js"></script>
    <!-- End Script  -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
</body>
</html>