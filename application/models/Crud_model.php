<?php
defined('BASEPATH') OR exit('No direct script access alowed');

class Crud_model extends CI_Model
{
    public function krit()
    {
        return
        [
            [
                'field' => 'nama_kriteria',
                'label' => 'Nama Kriteria',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Nama Kriteria'
                ]
            ],

            [
                'field' => 'rank',
                'label' => 'Rank',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Rangking'
                ]
            ],

            [
                'field' => 'bobot',
                'label' => 'Bobot',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan isi Bobot'
                ]
            ]
        ];
    }

    public function sub_krit()
    {
        return
        [
            [
                'field' => 'id_kriteria',
                'label' => 'Id Kriteria',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Id Kriteria'
                ]
            ],

            [
                'field' => 'nama_sub_kriteria',
                'label' => 'Nama Sub Kriteria',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Nama Sub Kriteria'
                ]
            ],

            [
                'field' => 'rank',
                'label' => 'Rank',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan isi Rank'
                ]
            ],

            [
                'field' => 'bobot',
                'label' => 'Bobot',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan isi Bobot'
                ]
            ]
        ];
    }

    public function alter()
    {
        return
        [
            [
                'field' => 'nama_alternatif',
                'label' => 'Nama Alternatif',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Nama alternatif'
                ]
            ]
        ];
    }

    /* 
    Create model for 
        kriteria,
        sub kriteria,
        alternatif
    */
    public function s_krit()
    {
        // $hasil =array();
        $post = $this->input->post();
        $item = $post['dynamic_form']['dynamic_form'];
        for ($i=0; $i < count($item); $i++) { 
            $data = array(
                'nama_kriteria' => $post['dynamic_form']['dynamic_form'][$i]['kriteria'],
                'rank' => $post['dynamic_form']['dynamic_form'][$i]['rank'],
                'bobot' => $this->roc($post['dynamic_form']['dynamic_form'][$i]['rank'],count($item))
            );
            // array_push($hasil,$data);
            $this->db->insert('t_kriteria', $data);
        }
        // return $hasil;
    }
    public function s_sub_krit()
    {
        // $hasil =array();
        $post = $this->input->post();
        $item = $post['dynamic_form']['dynamic_form'];
        for ($i=0; $i < count($item); $i++) { 
            $data = array(
                'id_kriteria' => $post['id_kriteria'],
                'nama_sub_kriteria' => $post['dynamic_form']['dynamic_form'][$i]['sub_kriteria'],
                'rang' => $post['dynamic_form']['dynamic_form'][$i]['rank'],
                'bobot' => $this->roc($post['dynamic_form']['dynamic_form'][$i]['rank'],count($item))
            );
            // array_push($hasil,$data);
            $this->db->insert('t_sub_kriteria', $data);
        }
        // return $hasil;
    }
    public function s_alter()
    {
        $post = $this->input->post();
        $data = array(
            'nama_alternatif' => $post['nama_alternatif']
        );
        $this->db->insert('t_alternatif', $data);
    }

    public function s_rank($id){
        $cek = $this->db->query("select count(id) as jml from t_perangkingan where id_alternatif='$id'")->result_array();
        if ($cek[0]['jml'] > 0) {
            $this->u_per();
        }else{
            $post = $this->input->post();
            $a = $this->db->query("select id_kriteria from t_kriteria order by rank asc")->result_array();
            for ($i=0; $i < sizeof($a); $i++) { 
                $rank = $i+1;
                $test = 'kriteria'.$rank;
                $data = array(
                    "id_alternatif" => $post['id_alternatif'],
                    "id_kriteria" => $a[$i]['id_kriteria'],
                    "bobot" => $post[$test]
                );
                $this->db->insert('t_perangkingan', $data);
            }
        }
    }

    /* 
    Read model for 
        kriteria,
        sub kriteria,
        alternatif
    */
    public function getAll($table){
        return $this->db->get($table)->result();
    }
    public function getKrit(){
        return $this->db->order_by("id_kriteria", "asc")->get("t_kriteria")->result();
    }
    public function getById($table,$field,$id){
        return $this->db->get_where($table, [$field => $id])->row();
    }
    public function data_sub($post){
        $hasil = array();
        $q = $this->db->select("tk.nama_kriteria, tk.id_kriteria, tk.rank, tsk.nama_sub_kriteria, tsk.rang")->join("t_kriteria tk","tsk.id_kriteria=tk.id_kriteria", "left")->get_where("t_sub_kriteria tsk", ['tsk.id_kriteria' => $post['id']]);
        $hasil = $q->result_array();
        return $hasil;
    }
    public function data_sk(){
        return $this->db->query("select * from t_sub_kriteria left join t_kriteria on t_sub_kriteria.id_kriteria=t_kriteria.id_kriteria order by t_sub_kriteria.id_kriteria asc")->result();
    }
    public function get_alter_rank(){
        return $this->db->query("select * from t_perangkingan tp left join t_alternatif ta on tp.id_alternatif=ta.id_alternatif")->result();
    }
    public function data_form(){
        $data[] = array();       
        $q = $this->db->select("nama_kriteria,id_kriteria")->order_by('rank','asc')->get("t_kriteria")->result_array();
        for ($i=0; $i < sizeof($q); $i++) { 
            $aa = array();
            $que = $this->db->select("nama_sub_kriteria,bobot")->order_by('rang','asc')->get_where("t_sub_kriteria", ["id_kriteria" => $q[$i]['id_kriteria']])->result_array();
            for ($a=0; $a < sizeof($que); $a++) { 
                array_push($aa, array(
                    $que[$a]['nama_sub_kriteria'] => $que[$a]['bobot']
                ));
            }

            array_push($data,array(
                $q[$i]['nama_kriteria'] => [$aa]
            ));
        }
        return $data;
    }
    /* 
    Update model for 
        kriteria,
        sub kriteria,
        alternatif
    */
    public function u_krit()
    {
        $post = $this->input->post();
        $data = array(
            'nama_kriteria' => $post['nama_kriteria'],
            'rank' => $post['rank'],
            'bobot' => $post['bobot']
        );
        $this->db->update("t_kriteria", $data, array("id_kriteria" => $post["id_kriteria"]));
    }   
    public function u_sub_krit()
    {
        $post = $this->input->post();
        $data = array(
            'id_kriteria' => $post['id_kriteria'],
            'nama_sub_kriteria' => $post['nama_sub_kriteria'],
            'rang' => $post['rank'],
            'bobot' => $post['bobot']
        );
        $this->db->update("t_sub_kriteria", $data, array("id_sub" => $post["id_sub"]));
    }   
    public function u_alter()
    {
        $post = $this->input->post();
        $data = array(
            'nama_alternatif' => $post['nama_alternatif']
        );
        $this->db->update("t_alternatif", $data, array("id_alternatif" => $post["id_alternatif"]));
    }   

    public function u_per()
    {
        $post = $this->input->post();
        $a = $this->db->select("nama_kriteria,id_kriteria")->order_by('rank','asc')->get("t_kriteria")->result_array();
        for ($i=0; $i < sizeof($a); $i++) { 
            $b = $i+1;
            $test = 'kriteria'.$b;
            $data = array(
                "bobot" => $post[$test]
            );
            $this->db->update("t_perangkingan", $data, array("id_alternatif" => $post["id_alternatif"], "id_kriteria" => $a[$i]['id_kriteria']));
        }

    }
    /* 
    Delete model for 
        kriteria,
        sub kriteria,
        alternatif
    */
    public function d_krit()
    {
        // return $this->db->delete("t_kriteria", array("id_kriteria" => $id));
        $this->db->query('TRUNCATE TABLE t_kriteria');
        $this->db->query('TRUNCATE TABLE t_sub_kriteria');
        $this->db->query('TRUNCATE TABLE t_perangkingan');
        return $this->db->query('TRUNCATE TABLE t_hasil');
    }
    public function d_sub_krit($id)
    {
        $this->db->query('TRUNCATE TABLE t_perangkingan');
        $this->db->query('TRUNCATE TABLE t_hasil');
        return $this->db->delete("t_sub_kriteria", array("id_kriteria" => $id));
    }
    public function d_alter($id)
    {
        $this->db->query('TRUNCATE TABLE t_perangkingan');
        $this->db->query('TRUNCATE TABLE t_hasil');
        return $this->db->delete("t_alternatif", array("id_alternatif" => $id));
    }
    public function d_perangkingan($id)
    {
        $this->db->delete("t_hasil", array("id_alternatif" => $id));
        return $this->db->delete("t_perangkingan", array("id_alternatif" => $id));
    }
    /* 
    function
    */
    public function test(){
        $a[] = array();
        for ($i=0; $i < 5; $i++) { 
            $a[$i] = array(
                "a$i" => $i
            );
        }

        return $a;
    }

    public function roc($rank,$jum){
        $hasil = 0;
        for ($i=$rank; $i <= $jum; $i++) { 
            if ($i == 1) {
                $hasil = $hasil + 1;
            }else {
                $hasil = $hasil + (1/$i);
            }
        }
        $a = $hasil/$jum;
        return $a;
    }

    public function t_alter(){
        $data = array();
        $alter = $this->db->get("t_alternatif")->result_array();
        for ($i=0; $i < sizeof($alter); $i++) { 
            $a = $alter[$i]['id_alternatif'];
            $ceka = $this->db->query("SELECT id_alternatif FROM `t_perangkingan` where id_alternatif='$a'")->num_rows();
            if ($ceka > 0) {
                array_push($data,array(
                    "id_alternatif" => $alter[$i]['id_alternatif'],
                    "nama_alternatif" => $alter[$i]['nama_alternatif'],
                    "status" => "sudah"
                ));
            }else {
                array_push($data,array(
                    "id_alternatif" => $alter[$i]['id_alternatif'],
                    "nama_alternatif" => $alter[$i]['nama_alternatif'],
                    "status" => "belum"
                ));
            }
        }
        return $data;
    }

    public function smarter(){
        $data = $this->db->query("SELECT id_alternatif FROM `t_perangkingan` GROUP by id_alternatif ORDER by id_alternatif ASC")->result_array();

        for ($i=0; $i < sizeof($data); $i++) { 
            $id = $data[$i]['id_alternatif'];
            $cek = $this->db->query("SELECT count(id_alternatif) as jml FROM `t_hasil` where id_alternatif=$id")->row();
            if ($cek->jml > 0) {
                $a = $this->db->query("SELECT bobot,id_alternatif,id_kriteria from t_perangkingan where id_alternatif=$id")->result_array();

                $hasil = 0;
                for ($z=0; $z < sizeof($a); $z++) { 
                    $idkrit = $a[$z]['id_kriteria'];
                    $bbt = $a[$z]['bobot'];
                    $krit = $this->db->query("SELECT bobot from t_kriteria where id_kriteria=$idkrit")->row();
                    $az = $bbt*$krit->bobot;
                    $hasil = $hasil + $az;
                }
                $return = array(
                    'id_alternatif' => $id,
                    'hasil' => $hasil
                );

                $this->db->update("t_hasil", $return, array("id_alternatif" => $id));
            }else{
                $a = $this->db->query("SELECT bobot,id_alternatif,id_kriteria from t_perangkingan where id_alternatif=$id")->result_array();

                $hasil = 0;
                for ($v=0; $v < sizeof($a); $v++) { 
                    $idkrit = $a[$v]['id_kriteria'];
                    $bbt = $a[$v]['bobot'];
                    $krit = $this->db->query("SELECT bobot from t_kriteria where id_kriteria=$idkrit")->row();
                    $az = $bbt*$krit->bobot;
                    $hasil = $hasil + $az;
                }
                $return = array(
                    "id_alternatif" => $id,
                    "hasil" => $hasil
                );
    
                $this->db->insert('t_hasil', $return);
            }
        }
    }

    public function ranking(){
        $hasil = array();
        $data = $this->db->join("t_alternatif","t_hasil.id_alternatif=t_alternatif.id_alternatif", "left")->order_by("hasil","desc")->get("t_hasil")->result_array();
        for ($i=0; $i < sizeof($data); $i++) { 
            array_push($hasil, array(
                "id_alternatif" =>$data[$i]['id_alternatif'],
                "nama_alternatif" =>$data[$i]['nama_alternatif'],
                "hasil" => $data[$i]['hasil']
            ));
        }
        return $hasil;
    }
}