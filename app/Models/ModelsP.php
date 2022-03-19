<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ModelsP extends Model{
    protected $table = 'produk';
    protected $allowedFields = ['id','id_admin','id_kategori','nama','deskripsi','stok','harga','create_at','image'];
    public function getBarang(){
        return $this->findAll();
    }

    public function deleteBarang($id){
        $query = $this->db->table('produk')->delete(array('id' => $id));
        return $query;
    }

    public function whereBarang($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk WHERE id='$id'")->getRowArray();
        return $q;
    }

    public function whereBarang2($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk WHERE id='$id'")->getRowArray();
        //$q->paginate(8, 'post');
        return $q;
    }

    public function whereBarang3($nama){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk WHERE nama='$nama'")->getRowArray();        
        return $q;
    }

    public function likeBarang($q){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk WHERE nama LIKE '%$q%' ORDER BY id DESC")->getResultArray();
        return $q;
    }

    public function likeBarang2($q,$start,$halaman){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk WHERE nama LIKE '%$q%' ORDER BY id DESC LIMIT $start,$halaman")->getResultArray();
        return $q;
    }

    public function simpan($id_admin, $id_kategori, $nama, $deskripsi, $stok, $harga, $create_at, $image){
        $db      = \Config\Database::connect();
        $q = $db->query("INSERT INTO produk VALUES ('id', '$id_admin', '$id_kategori', '$nama', '$deskripsi', '$stok','$harga','$create_at','$image')");
        return $q;
    }

    public function updateBarang($id,$id_kategori,$nama,$deskripsi,$stok,$harga,$image){
        $db      = \Config\Database::connect();
        $q = $db->query("UPDATE produk SET id_kategori='$id_kategori', nama='$nama', deskripsi='$deskripsi', stok='$stok', harga='$harga', image='$image' WHERE id='$id'");
        return $q;
    }

    public function getBarang2($start,$halaman){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk ORDER BY id DESC LIMIT $start,$halaman")->getResultArray();
        return $q;
    }

    public function getBarang3(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT * FROM produk ORDER BY id DESC")->getResultArray();
        return $q;
    }

    public function countBarang2(){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT COUNT(id) as jumlah FROM produk");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function countBarang3($like){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT COUNT(id) as jumlah FROM produk where nama LIKE '%$like%'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function countBarangNama($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT nama as jumlah FROM produk WHERE id='$id'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function getBarangDeskripsi($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT deskripsi as jumlah FROM produk WHERE id='$id'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function getBarangCreate($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT create_at as jumlah FROM produk WHERE id='$id'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

    public function getBarangKategori($id){
        $db      = \Config\Database::connect();
        $q = $db->query("SELECT id_kategori as jumlah FROM produk WHERE id='$id'");
        $data = $q->getRowArray()['jumlah'];
        return $data;
    }

}