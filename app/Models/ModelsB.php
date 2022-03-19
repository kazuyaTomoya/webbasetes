<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ModelsB extends Model{
    protected $table = 'beranda';
    protected $allowedFields = ['id','logo','logo_kecil','icon_fav','icon'];
    public function getIndex(){
        return $this->findAll();
    }

    public function getBeranda(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM beranda")->getResultArray();
        return $q;
    }

    public function whereBeranda(){
        $id = 1;
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM beranda WHERE id='$id'")->getRowArray();
        return $q;
    }

    public function updateLogo1($id, $logo){
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE beranda SET logo='$logo' WHERE id='$id'");
        return $q;
    }

    public function updateLogo2($id, $logo){
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE beranda SET logo_kecil='$logo' WHERE id='$id'");
        return $q;
    }

    public function updateLogo3($id, $logo){
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE beranda SET icon_fav='$logo' WHERE id='$id'");
        return $q;
    }

    public function perbaharui($id, $col, $data){        
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE beranda SET $col='$data' WHERE id='$id'");
        return $q;
    }

}