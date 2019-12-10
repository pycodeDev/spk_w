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
                                <h1 class="h3 mb-0 text-gray-800">Data Sub Kriteria</h1>
                            </div>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-success float left">Data Sub Kriteria</h6>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col">
                                            <select class="form-control" name="kriteria" id="myselect">
                                                <?php
                                                foreach ($krit as $k):?>
                                                <option value="<?=$k->id_kriteria?>"><?=$k->nama_kriteria?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-success mb-2 filter-data">Pilih</button>
                                        </div>
                                    </div>
                                    

                                    <div class="table-responsive">
                                        <div id="coba">
                                            <table id="dataTable" class="table table-hover table-bordered">
                                                <thead> 
                                                    <tr>
                                                        <th>no</th>
                                                        <th>Nama Sub Kriteria</th> 
                                                        <th>Nama Kriteria</th> 
                                                        <th>Rangking</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td colspan="5"> Pilih Filter</td>
                                                </tbody>
                                            </table>
                                        </div>
                                <!-- <div id="pageData"></div> -->
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
        $('#datasTable').DataTable();
    });
</script>
<script type="text/javascript">

  $(document).ready(function(){
    $(".filter-data").click(function(){
			var id = $("#myselect").val();
            get_data(id);
		});
    });

    function get_data(id){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>admin/data_sub/",
            data: {id:id},
            dataType: 'json',
            success: function(data){
                    var len = data.length;
                    var no = 1;
                    var hasil =[];
                    if (len > 0) {
                        for (var i= 0; i < len; i++) {
                        
                        var row = $('<tr>' +
                                    '<td>' + no + '</td>' +
                                    '<td>' + data[i].nama_sub_kriteria + '</td>' +
                                    '<td>' + data[i].nama_kriteria + '</td>' + 
                                    '<td>' + data[i].rang + '</td>');
                        
                        hasil.push(row);
                        no=no+1;
                        // console.log(data)
                    }
                    $('#dataTable tbody').html(hasil);
                    }else{
                        $('#dataTable tbody').html('<td colspan="5" align="center">Data Tidak Ada</td>');
                    }
            },
            error: function() {
                $('#dt tbody').html('<td colspan="5" align="center">Error</td>');
            }
        });
    }
</script>
</body>
</html>