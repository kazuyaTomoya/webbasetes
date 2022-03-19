<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ModelsK extends Model{
    protected $table = 'kategori';
    protected $allowedFields = ['id','kategori'];
    public function getKategori(){
        return $this->findAll();
    }

    public function getData(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM kategori ORDER BY kategori ASC")->getResultArray();
        return $q;
    }

    public function getKategori2(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM kategori ORDER BY id DESC")->getResultArray();
        return $q;
    }

    public function getKategori3(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM kategori ORDER BY kategori ASC")->getResultArray();
        return $q;
    }

    public function deleteKategori($id){
        $query = $this->db->table('kategori')->delete(array('id' => $id));
        return $query;
    }

    public function whereKategori($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM kategori WHERE id='$id'")->getRowArray();
        return $q;
    }

    public function whereKategori2($kategori){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM kategori WHERE kategori='$kategori'")->getRowArray();
        return $q;
    }

    public function simpan($id, $kategori){
        $db      = \Config\Database::connect();
        $q = $db->query("INSERT INTO kategori VALUES ('$id', '$kategori')");
        return $q;
    }

    public function likeKategori($q){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM kategori WHERE kategori LIKE '%$q%'")->getResultArray();
        return $q;
    }

    public function count(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT COUNT(id) as jumlah FROM kategori");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function getKategoriRow($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT kategori as jumlah FROM kategori WHERE id='$id'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function updateKategori($id, $kategori){        
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE kategori SET kategori='$kategori' WHERE id='$id'");
        return $q;
    }

}