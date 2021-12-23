<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model
{
    private $_table = "petugas";

    public $id_petugas;
    public $username;
    public $password;
    public $nama_petugas;
    public $level;

    public function rules()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required'],

            ['field' => 'nama_petugas',
            'label' => 'Nama Petugas',
            'rules' => 'required'],

            ['field' => 'level',
            'label' => 'Level',
            'rules' => 'required'],
            
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id_petugas)
    {
        return $this->db->get_where($this->_table, ["id_petugas" => $id_petugas])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->username = $post["username"];
        $this->password = md5($post["password"]);
        $this->nama_petugas = $post["nama_petugas"];
        $this->level = $post["level"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_petugas = $post["id"];
        $this->username = $post["username"];
        $this->password = md5($post["password"]);
        $this->nama_petugas = $post["nama_petugas"];
        $this->level = $post["level"];
        $this->db->update($this->_table, $this, array('id_petugas' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_petugas" => $id));
    }
}
