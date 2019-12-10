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
                                <h1 class="h3 mb-0 text-gray-800">Kelola Data Perangkingan</h1>
                            </div>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-success float left">Kelola Data Perangkingan</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="<?=base_url()?>admin/rank" class="mb-3 btn btn-sm btn-success" style="color:#fff"><i class="fas fa-search"></i>Eksekusi Perangkingan</a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>no</th>
                                                    <th>Nama Alternatif</th>                                    
                                                    <th>Sudah Input Data?</th>                                   
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $no =1;
                                                for ($i=0; $i < sizeof($variable); $i++) {
                                            ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$variable[$i]['nama_alternatif']?></td>
                                                    <td><span class="<?=$variable[$i]['status'] == 'sudah'? "badge badge-success" : "badge badge-danger"?>"><?=$variable[$i]['status']?></span></td>
                                                    <td><a href="<?=base_url();?>admin/tambah_perangkingan/<?=$variable[$i]['id_alternatif']?>"" class="btn btn-md btn-success"><i class="fas fa-eye" style="color:#fff"></i></a>
                                                    <a href="<?=base_url();?>admin/del_perangkingan/<?=$variable[$i]['id_alternatif']?>"" class="btn btn-md btn-danger"><i class="fas fa-trash-alt" style="color:#fff"></i></a>
                                                    </td>
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