<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ModelsU extends Model{
    protected $table = 'user';
    protected $allowedFields = ['id','nama','email','nomor_hp'];
    public function getUser(){
        return $this->findAll();
    }

    public function getData(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM user ORDER BY nama DESC")->getResultArray();
        return $q;
    }

    public function deleteUser($id){
        $query = $this->db->table('user')->delete(array('id' => $id));
        return $query;
    }

    public function whereUser($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM user WHERE id='$id'")->getRowArray();
        return $q;
    }

    public function whereUser2($nama){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM user WHERE nama='$nama'")->getRowArray();
        return $q;
    }

    public function whereUser3($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT nama as name FROM user WHERE id='$id'")->getRowArray()['name'];
        return $q;
    }

    public function whereUser4($query){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM user WHERE nama LIKE '%$query%'")->getResultArray();
        return $q;
    }

    public function perbaharui($id, $col, $data){        
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE user SET $col='$data' WHERE id='$id'");
        return $q;
    }

    public function perbaharuiUser($id, $nama, $email, $nomor){        
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE user SET nama='$nama', email='$email', nomor_hp='$nomor' WHERE id='$id'");
        return $q;
    }

    public function simpanUser($nama, $email, $nomor){                
        $db      = \Config\Database::connect();
        $q = $db->query("INSERT INTO user VALUES ('id','$nama','$email','$nomor')");
        return $q;
    }

    public function count(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT COUNT(id) as jumlah FROM user");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function countCari($query){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT COUNT(id) as jumlah FROM user WHERE nama LIKE '%$query%'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

}