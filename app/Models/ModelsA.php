<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ModelsA extends Model{
    protected $table = 'admin';
    protected $allowedFields = ['id','nama','username','password','email','nomor_hp','level'];
    public function getAdmin(){
        return $this->findAll();
    }

    public function getData(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM admin ORDER BY nama DESC")->getResultArray();
        return $q;
    }

    public function deleteAdmin($id){
        $query = $this->db->table('admin')->delete(array('id' => $id));
        return $query;
    }

    public function whereAdmin($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM admin WHERE id='$id'")->getRowArray();
        return $q;
    }

    public function whereAdmin2($username){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM admin WHERE username='$username'")->getRowArray();
        return $q;
    }

    public function whereAdmin3($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT nama as name FROM admin WHERE id='$id'")->getRowArray()['name'];
        return $q;
    }

    public function whereAdmin4($query,$kecuali){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM admin WHERE nama != '$kecuali' AND nama LIKE '%$query%'")->getResultArray();
        return $q;
    }

    public function perbaharui($id, $col, $data){        
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE admin SET $col='$data' WHERE id='$id'");
        return $q;
    }

    public function perbaharuiProfile($id, $nama, $email, $nomor){        
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE admin SET nama='$nama', email='$email', nomor_hp='$nomor' WHERE id='$id'");
        return $q;
    }

    public function simpanAdmin($username, $password, $email, $level){
        $nama = "";
        $nomor_hp = "";
        $log = 0;        
        $db      = \Config\Database::connect();
        $q = $db->query("INSERT INTO admin VALUES ('id','$nama','$username','$password','$email','$nomor_hp','$log','$level')");
        return $q;
    }

}