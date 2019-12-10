<?php
defined('BASEPATH') OR exit('No direct script access alowed');

class Login_model extends CI_Model
{
    private $table = "t_user";

    public $username;
    public $password;

    public function rules()
    {
        return
        [
            [
                'field' => 'username',
                'label' => 'user',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Username'
                ]
            ],

            [
                'field' => 'password',
                'label' => 'pass',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan Isi Password'
                ]
            ]
        ];
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where($this->table,['username' => $username])->row_array();

        if($user)
        {
            if($user['password'] == md5($password))
            {
                $data = 
                [
                    'username' => $username,
                    'nama' => $user['nama'],
                    'jabatan' => $user['jabatan']
                ];
                if($user['jabatan'] == 'admin')
                {
                    $this->session->set_userdata($data);
                    redirect('admin');
                }else if($user['jabatan'] == 'manager'){
                    $this->session->set_userdata($data);
                    redirect('manager');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf Password Salah !</div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf Username tidak Ditemukan !</div>');
            redirect('login');
        }
    }
}