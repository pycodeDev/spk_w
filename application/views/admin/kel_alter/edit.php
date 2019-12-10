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
                                <h1 class="h3 mb-0 text-gray-800">Edit Kriteria</h1>
                            </div>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-success float left">Edit Kriteria</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                    <form action="<?=base_url()?>admin/exe_edit" method="post">
                                        <div class="form-group row">
                                            <label for="nama_alternatif" class="col-sm-2 col-form-label">Nama Alternatif</label>
                                            <div class="col-sm-10">
                                            <input type="hidden" placeholder="Nama Alternatif" name="id_alternatif" class="form-control" value="<?=$alter->id_alternatif?>" id="nama_alternatif">
                                            <input type="text" placeholder="Nama Alternatif" name="nama_alternatif" class="form-control" value="<?=$alter->nama_alternatif?>" id="nama_alternatif">
                                            <?= form_error('nama_alternatif', '<small class="text-danger pl-3">','</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row-reverse bd-highlight">
                                            <div class="p-2 bd-highlight">
                                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
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