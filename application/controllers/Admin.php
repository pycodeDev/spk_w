<?php

class Admin extends CI_Controller{

    public function __construct()
	{
        parent::__construct();
        $this->load->library('pdf');
    }
    
    public function index(){
        $data['title'] = "Admin Dashboard";
        $data['row_krit'] = $this->db->query("select * from t_kriteria")->num_rows();
        $data['row_alter'] = $this->db->query("select * from t_alternatif")->num_rows();
        $data['rank'] = $this->crud_model->ranking();
        $data['graph'] = json_encode($data['rank']);
        $this->load->view('admin/dashbord',$data);
    }
    //start kelola kriteria
    public function kelola_kriteria(){
        $krit = $this->crud_model;
        $data['title'] = "Kelola Kriteria";
        $data['krit'] = $krit->getAll('t_kriteria');
        $data['abcd'] = $krit->test();
        $this->load->view('admin/kel_krit/index',$data);
    }

    public function tambah_kriteria(){
        $data['title'] = "Tambah Kriteria";
        $this->load->view('admin/kel_krit/tambah');
    }

    public function test_krit(){
        $t_krit = $this->crud_model;
        // $post['dynamic_form']['dynamic_form'][0]['kriteria']
        // $data['test'] = $post['dynamic_form']['dynamic_form'];
        $t_krit->s_krit();
        $this->session->set_flashdata('success', 'Berhasil Disimpan');
        redirect(site_url('admin/kelola_kriteria'));
    }

    public function del_krit(){
        // if (!isset($id)) show_404();
        $this->crud_model->d_krit();
        // if ($this->crud_model->d_krit($id)) {
        redirect(site_url('admin/kelola_kriteria'));
        // }
    }
    //end kelola kriteria

    //start kelola sub kriteria
    public function kelola_sub_kriteria(){
        $data['title'] = "Kelola sub Kriteria";
        $data['krit'] = $this->crud_model->getKrit();
        $data['sub_krit'] = $this->crud_model->data_sk();
        $this->load->view('admin/kel_sub_krit/index',$data);
    }

    public function data_sub(){
        $postData = $this->input->post();
        $t_sub_krit = $this->crud_model;
        $data  = $t_sub_krit->data_sub($postData);

        echo json_encode($data);
    }

    public function tambah_sub_kriteria($id){
        $t_sub_krit = $this->crud_model;
        $data['id_kriteria'] = $id;
        $data['krit'] = $this->crud_model->getById('t_kriteria','id_kriteria',$id);
        $this->load->view('admin/kel_sub_krit/tambah',$data);
    }

        public function test_sub_krit(){
        $t_krit = $this->crud_model;
        // $post['dynamic_form']['dynamic_form'][0]['kriteria']
        // $data['test'] = $post['dynamic_form']['dynamic_form'];
        $t_krit->s_sub_krit();
        $this->session->set_flashdata('success', 'Berhasil Disimpan');
        redirect(site_url('admin/kelola_sub_kriteria'));
    }

    public function del_sub_krit($id=null){
        if (!isset($id)) show_404();

        if ($this->crud_model->d_sub_krit($id)) {
            redirect(site_url('admin/kelola_sub_kriteria'));
        }
    }
    //end kelola sub kriteria
    
    //start kelola alternatif
    public function kelola_alternatif(){
        $data['title'] = "Kelola alternatif";
        $data['alter'] = $this->crud_model->getAll("t_alternatif");
        $this->load->view('admin/kel_alter/index',$data);
    }
    public function tambah_alternatif(){
        $t_alter = $this->crud_model;
        $validation = $this->form_validation;
        $validation->set_rules($t_alter->alter());

        if ($validation->run()){
            $t_alter->s_alter();
            $this->session->set_flashdata('success', 'Berhasil Disimpan');
            redirect(site_url('admin/kelola_alternatif'));
        }else{
            $data['title'] = "Tambah Kriteria";
            $this->load->view('admin/kel_alter/tambah',$data);
        }
    }
    public function edit_alternatif($id){
        $t_alter = $this->crud_model;
        $data['alter'] = $this->crud_model->getById('t_alternatif','id_alternatif',$id);
        $this->load->view('admin/kel_alter/edit',$data);
    }
    public function exe_edit(){
        $t_alter = $this->crud_model;
        $t_alter->u_alter();
        $this->session->set_flashdata('success', 'Berhasil Disimpan');
        redirect(site_url('admin/kelola_alternatif'));
    }
    public function del_alter($id=null){
        if (!isset($id)) show_404();

        if ($this->crud_model->d_alter($id)) {
            redirect(site_url('admin/kelola_alternatif'));
        }
    }
    //end kelola alternatif

    public function perangkingan(){
        $data['title'] = "Perangkingan";
        $data['variable'] = $this->crud_model->t_alter();
        $this->load->view('admin/perangkingan/index',$data);
    }
    
    public function tambah_perangkingan($id){
        $data['title'] = "Tambah Perangkingan";
        $data['form'] = $this->crud_model->data_form();
        $data['alter'] = $this->crud_model->getById('t_alternatif','id_alternatif',$id);
        $this->load->view('admin/perangkingan/tambah',$data);
    }

    public function test(){
        $t_krit = $this->crud_model;
        $post = $this->input->post();
        $t_krit->s_rank($post['id_alternatif']);
        redirect(site_url('admin/perangkingan/index'));
    }

    public function a(){
        $data['variable'] = $this->crud_model->t_alter();
        $this->load->view('admin/perangkingan/test',$data);
    }

    public function del_perangkingan($id=null){
        if (!isset($id)) show_404();

        if ($this->crud_model->d_perangkingan($id)) {
            redirect(site_url('admin/perangkingan'));
        }
    }

    public function rank(){
        $this->crud_model->smarter();
        $data['rank'] = $this->crud_model->ranking();
        $data['graph'] = json_encode($data['rank']);
        $this->load->view('admin/perangkingan/hasil',$data);
    }

    public function cobaa(){
        $a = $this->db->select("nama_kriteria,id_kriteria")->order_by('rank','asc')->get("t_kriteria")->result_array();
        $data['a'] = $a;
        $this->load->view('admin/test',$data);
    }

    public function print(){
        $image1 = base_url("assets/img/header.png");
		$pdf = new FPDF('p','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 

        $pdf->Cell(200,9,'',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        // $pdf->Line(20, 45, 210-20, 45);
        $pdf->Cell( 10, 20, $pdf->Image($image1, 5, 12, 200,40), 0, 0, 'l', false );
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->Cell(10,7,'',0,1);
        $pdf->Cell(10,7,'',0,1);
        $pdf->Cell(10,7,'',0,1);
        $pdf->Line(10, 55, 205-5, 55);
        $pdf->Line(10, 55, 205-5, 55);
        $pdf->Line(10, 55, 205-5, 55);
        $pdf->SetFont('Arial','B',10);

        $data = $this->crud_model->ranking();;
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(0,9,'LAPORAN HASIL PERANGKINGAN LAHAN KEBUN KELAPA SAWIT PT. EKA DURA INDONESIA',0,1,'C');
		$pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(50,6,'Rangking',1,0,'C');
        $pdf->Cell(85,6,'Alternatif',1,0,'C');
        $pdf->Cell(55,6,'Nilai',1,1,'C');

        $pdf->SetFont('Arial','',13);
		//prediksi 
		$r =1;
        foreach($data as $item){
            $pdf->Cell(50,6,$r++,1,0,'C');
            $b = $item['nama_alternatif'];
            $b = iconv('UTF-8', 'windows-1252', $b);
            $pdf->Cell(85,6,$b,1,0,'C');
            $pdf->Cell(55,6,$item['hasil'],1,1,'C');
        }

        $pdf->Output();
    }
}