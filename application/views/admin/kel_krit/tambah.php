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
                                <h1 class="h3 mb-0 text-gray-800">Tambah Kriteria</h1>
                            </div>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="m-1 font-weight-bold text-primary float left">Tambah Kriteria</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <form action="<?=base_url()?>admin/test_krit" method="post">
                                            <div class="form-group" id="dynamic_form">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <input type="text" name="kriteria" id="p_name" placeholder="Masukkan Kriteria" class="form-control">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" name="rank" id="quantity" placeholder="Masukkan Rangking" >
                                                    </div>
                                                    <div class="button-group">
                                                        <a href="javascript:void(0)" class="btn btn-success" id="plus5">Tambah</a>
                                                        <a href="javascript:void(0)" class="btn btn-danger" id="minus5">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary" value="Submit">
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
        <script src="<?=base_url();?>assets/js/dynamic-form.js"></script>
    <!-- End Script  -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script>
        $(document).ready(function() {
        	var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
		        limit:10,
		        formPrefix : "dynamic_form",
		        normalizeFullForm : false
		    });

        	// dynamic_form.inject([{p_name: 'Kriteria 1',quantity: '1'},{p_name: 'Harshal',quantity: '123'}]);

		    $("#dynamic_form #minus5").on('click', function(){
		    	var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
		    	if (initDynamicId === 2) {
		    		$(this).closest('#dynamic_form').next().find('#minus5').hide();
		    	}
		    	$(this).closest('#dynamic_form').remove();
		    });

		    // $('form').on('submit', function(event){
	        // 	var values = {};
			// 	$.each($('form').serializeArray(), function(i, field) {
			// 	    values[field.name] = field.value;
			// 	});
			// 	console.log(values)
        	// 	event.preventDefault();
        	// })
        });
    </script>
</body>
</html>