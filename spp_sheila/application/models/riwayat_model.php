<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_model extends CI_Model
{
    private $_table = "siswa";

    public $nisn;
    public $nis;
    public $nama;    
    public $id_kelas;
    public $alamat;
    public $no_telp;
    public $id_spp;
    public $password;
    
    public function rules()
    {
        return [
            ['field' => 'nisn',
            'label' => 'NISN',
            'rules' => 'numeric'],

            ['field' => 'nis',
            'label' => 'NIS',
            'rules' => 'numeric'],

            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'id_kelas',
            'label' => 'Kelas',
            'rules' => 'required'],

            ['field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required'],

            ['field' => 'no_telp',
            'label' => 'No. Telpon',
            'rules' => 'numeric'],

            ['field' => 'id_spp',
            'label' => 'Tahun SPP',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Kata Sandi',
            'rules' => 'required'],
        ];
    }


    public function getById($nisn)
    {   
        $this->db->select('siswa.nis,siswa.nama,kelas.nama_kelas,siswa.alamat,siswa.no_telp,spp.nominal, pembayaran.tgl_bayar,pembayaran.bulan_dibayar,pembayaran.tahun_dibayar,pembayaran.jumlah_bayar');
        $this->db->from('siswa');
        $this->db->join('kelas','siswa.id_kelas=kelas.id_kelas');
        $this->db->join('spp','siswa.id_spp=spp.id_spp');
        $this->db->join('pembayaran','siswa.nisn=pembayaran.nisn');
        return $this->db->get_where($this->_table, ["nisn" => $nisn])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nisn = $post["nisn"];
        $this->nis = $post["nis"];
        $this->nama = $post["nama"];
        $this->id_kelas = $post["id_kelas"];
        $this->alamat = $post["alamat"];
        $this->no_telp = $post["no_telp"];
        $this->id_spp = $post["id_spp"];
        $this->password = md5($post["password"]);
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->nisn = $post["nisn"];
        $this->nis = $post["nis"];
        $this->nama = $post["nama"];
        $this->id_kelas = $post["id_kelas"];
        $this->alamat = $post["alamat"];
        $this->no_telp = $post["no_telp"];
        $this->id_spp = $post["id_spp"];
        $this->password = md5($post["password"]);
        $this->db->update($this->_table, $this, array('nisn' => $post['nisn']));
    }

    public function delete($nisn)
    {
        return $this->db->delete($this->_table, array("nisn" => $nisn));
    }
}
