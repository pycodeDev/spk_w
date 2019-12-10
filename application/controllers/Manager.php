<?php

class Manager extends CI_Controller{

    public function __construct()
	{
        parent::__construct();
        $this->load->library('pdf');
    }
    
    public function index(){
        $data['title'] = "Manager Dashboard";
        $data['row_krit'] = $this->db->query("select * from t_kriteria")->num_rows();
        $data['row_alter'] = $this->db->query("select * from t_alternatif")->num_rows();
        $data['rank'] = $this->crud_model->ranking();
        $data['graph'] = json_encode($data['rank']);
        $this->load->view('manager/dashboard',$data);
    }
    //start kelola kriteria
    public function kriteria(){
        $krit = $this->crud_model;
        $data['title'] = "Kelola Kriteria";
        $data['krit'] = $krit->getAll('t_kriteria');
        $data['abcd'] = $krit->test();
        $this->load->view('manager/kriteria/index',$data);
    }
    //end kelola kriteria

    //start kelola sub kriteria
    public function sub_kriteria(){
        $data['title'] = "Kelola sub Kriteria";
        $data['krit'] = $this->crud_model->getKrit();
        $data['sub_krit'] = $this->crud_model->data_sk();
        $this->load->view('manager/sub_kriteria/index',$data);
    }

    public function data_sub(){
        $postData = $this->input->post();
        $t_sub_krit = $this->crud_model;
        $data  = $t_sub_krit->data_sub($postData);

        echo json_encode($data);
    }
    //end kelola sub kriteria
    
    //start kelola alternatif
    public function alternatif(){
        $data['title'] = "Kelola alternatif";
        $data['alter'] = $this->crud_model->getAll("t_alternatif");
        $this->load->view('manager/alternatif/index',$data);
    }
    //end kelola alternatif

    public function rank(){
        $this->crud_model->smarter();
        $data['rank'] = $this->crud_model->ranking();
        $data['graph'] = json_encode($data['rank']);
        $this->load->view('manager/rank/index',$data);
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