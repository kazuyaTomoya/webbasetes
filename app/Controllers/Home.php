<?php

namespace App\Controllers;
use App\Models\ModelsA;
use App\Models\ModelsB;
use App\Models\ModelsU;
use App\Models\ModelsK;
use App\Models\ModelsP;

class Home extends BaseController
{
	function __construct()
    {
        $this->admin = new ModelsA();
        $this->beranda = new ModelsB();
        $this->user = new ModelsU();
        $this->kategori = new ModelsK();
        $this->barang = new ModelsP();
    }

	public function index()
	{
		return view('login.php');
	}

	public function login(){
		$session = session();
		$username = $this->request->getVar('username');//Mendapatkan data username
		$password = $this->request->getVar('password');//Mendapatkan data password
		$data = $this->admin->where('username', $username)->first();

        if($data){
            $pass = $data['password'];
            
            if($pass == $password){
                $ses_data = [
                    'id'   => $data['id'],
                    'nama'      => $data['nama'],
                    'username'  => $data['username'],
                    'password'  => $data['password'],
                    'level'  => $data['level'],
                    'login_status' => TRUE
                ];
                $session->set($ses_data);
                
                $callback = [
	                'data' => "Sukses"
	            ];
	            echo json_encode($callback);
    
            }else{
                $callback = [
	                'data' => "Password Salah"
	            ];
	            echo json_encode($callback);
            }
        }else{
            $callback = [
	               'data' => "Gagal"
	        ];
	        echo json_encode($callback);
        }
	}

	public function dashboard()
	{
		$session = session();
		$title = "Dashboard Admin";
		if($session->get('login_status') == FALSE){
			return redirect()->to('Home');	
		}else{
			$data = [
				'title' => $title,
				'active' => 'Dashboard',
				'beranda' => $this->beranda->whereBeranda(),				
				'user' => $this->admin->whereAdmin($session->get('id')),
			];
			return view('Dashboard/index.php',$data);						
		}
	}

	public function updateProfile(){
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $nomor_hp = $this->request->getVar('nomor_hp');        
        $id = session()->get('id');

        $this->admin->perbaharuiProfile($id, $nama, $email, $nomor_hp);
        return;
    }

    public function updatePassword(){
        $password = $this->request->getVar('password');
        $col = "password";
        $id = session()->get('id');

        $this->admin->perbaharui($id, $col, $password);
        return;
    }

    public function updateLogo1(){
        $image = $this->request->getFile('image');        
        $type = $image->getClientMimeType();
        $name = $image->getName();      
        $getBeranda = $this->beranda->whereBeranda();

        $ext = $type;
        $imageName = $image->getRandomName();
        $path = 'Assets/logo/'.$getBeranda['logo'];
        chmod($path, 0777);
        unlink($path);
        $image->move('Assets/logo', $imageName); 

        $this->beranda->updateLogo1(1, $imageName);        
    }

    public function updateLogo2(){
        $image = $this->request->getFile('image');        
        $type = $image->getClientMimeType();
        $name = $image->getName();      
        $getBeranda = $this->beranda->whereBeranda();

        $ext = $type;
        $imageName = $image->getRandomName();
        $path = 'Assets/logo/'.$getBeranda['logo_kecil'];
        chmod($path, 0777);
        unlink($path);
        $image->move('Assets/logo', $imageName); 

        $this->beranda->updateLogo2(1, $imageName);        
    }

    public function updateLogo3(){
        $image = $this->request->getFile('image');        
        $type = $image->getClientMimeType();
        $name = $image->getName();      
        $getBeranda = $this->beranda->whereBeranda();

        $ext = $type;
        $imageName = $image->getRandomName();
        $path = 'Assets/logo/'.$getBeranda['icon_fav'];
        chmod($path, 0777);
        unlink($path);
        $image->move('Assets/logo', $imageName); 

        $this->beranda->updateLogo3(1, $imageName);        
    }

    public function user()
    {
    	$session = session();
		$title = "Dashboard User";
		if($session->get('login_status') == FALSE){
			return redirect()->to('Home');	
		}else{
			$data = [
				'title' => $title,
				'active' => 'User',
				'beranda' => $this->beranda->whereBeranda(),				
				'user' => $this->admin->whereAdmin($session->get('id')),
			];
			return view('Dashboard/user.php',$data);						
		}
    }

    public function kategori()
    {
    	$session = session();
		$title = "Dashboard Kategori";
		if($session->get('login_status') == FALSE){
			return redirect()->to('Home');	
		}else{
			$data = [
				'title' => $title,
				'active' => 'Kategori',
				'beranda' => $this->beranda->whereBeranda(),				
				'user' => $this->admin->whereAdmin($session->get('id')),
			];
			return view('Dashboard/kategori.php',$data);						
		}
    }

    public function barang()
	{
		$session = session();
		$title = "Dashboard Barang";
		if($session->get('login_status') == FALSE){
			return redirect()->to('Home');	
		}else{
			$data = [
				'title' => $title,
				'active' => 'Barang',
				'beranda' => $this->beranda->whereBeranda(),				
				'user' => $this->admin->whereAdmin($session->get('id')),
				'count' => $this->barang->countBarang2(),
				'data' => $this->barang->getBarang(),
			];
			return view('Dashboard/barang.php',$data);						
		}
	}

	public function addBarang()
	{
		$session = session();
		$title = "Dashboard Tambah Barang";
		if($session->get('login_status') == FALSE){
			return redirect()->to('Home');	
		}else{
			$data = [
				'title' => $title,
				'active' => 'Barang',
				'beranda' => $this->beranda->whereBeranda(),				
				'user' => $this->admin->whereAdmin($session->get('id')),
				'kategori' => $this->kategori->getKategori3()				
			];
			return view('Dashboard/add.php',$data);						
		}
	}

	public function editBarang($id)
	{
		$session = session();
		$title = "Dashboard Edit Barang";
		if($session->get('login_status') == FALSE){
			return redirect()->to('Home');	
		}else{
			$data = [
				'title' => $title,
				'active' => 'Barang',
				'data' => $this->barang->whereBarang($id),
				'modelsK' => $this->kategori,
				'beranda' => $this->beranda->whereBeranda(),				
				'user' => $this->admin->whereAdmin($session->get('id')),
				'kategori' => $this->kategori->getKategori3()				
			];
			return view('Dashboard/edit.php',$data);						
		}
	}

    public function showUser(){
        $data = $this->user->getData();//Mendapatkan database User
        $no = 1; 
        $count = $this->user->count();// Menghitung total user        
        //jika data kosong
        if(empty($data)){
            $isi = "<center><h5 class='text-danger'>Data User Tidak Ada, Silahkan Tambahkan Data Terlebih Dahulu</h5></center>";
        }
        //jika data tidak kosong
        else{
                $isi = "            
                <div class='row mb-2 border-bottom'>
                    <div class='col-1'>
                        <center><b>No.</b></center>
                    </div>
                    <div class='col'>
                        <b>Nama</b>
                    </div>
                    <div class='col-4'>
                        <b>Email</b>
                    </div>
                    <div class='col-2'>
                        <b>Contact</b>
                    </div>
                    <div class='col-2'>
                        <center><b>Opsi</b></center>
                    </div>
                </div>
                <div style='max-height: 55vh; overflow-y: scroll; overflow-x: hidden; max-width: 100vw;'>
                ";
                foreach($data as $a){                    
                        $isi .= "
                        <div class='row py-1'>
                            <div class='col-1'>
                                <small><center>".$no++."</center></small>
                            </div>
                            <div class='col'>
                            	<small>".$a['nama']."</small>                           
                            </div>
                            <div class='col-4'>
                                <small>".$a['email']."</small>
                            </div>
                            <div class='col-2 d-flex justify-content-center'>";
                        if(empty($a['nomor_hp'])){
                            $isi .= "<input type='button' class='mx-1 btn btn-outline-light btn-sm emailUser' value='Email' id='".$a['email']."'>";
                        }else{
                            $isi .="<input type='button' class='mx-1 btn btn-outline-info btn-sm waUser' value='WA' id='".$a['nomor_hp']."'>
                                    <input type='button' class='mx-1 btn btn-outline-light btn-sm emailUser' value='Email' id='".$a['email']."'>";
                        }                            
                        $isi .="</div>
                            <div class='col-2'>
                                <center>                                
                                    <input type='button' class='btn btn-danger btn-sm hapusData' value='delete' id='".$a['id']."'>
                                </center>
                            </div> 
                        </div>
                        ";                                   
                }
                $isi .= "</div>";
          
        }

        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

    public function dUser(){
        $id = $this->request->getVar('id');            
        $this->user->deleteUser($id);  
    }

    public function showQUser(){        
        $query = $this->request->getvar('q');//Mengambil nilai pencarian
        $data = $this->user->whereUser4($query);//Mendapatkan data pencarian
        $no = 1;
        //Jika data kosong
        if(empty($data)){
            $isi = "
                <div class='row mb-2 border-bottom'>
                    <div class='col-1'>
                        <center><b>No.</b></center>
                    </div>
                    <div class='col'>
                        <b>Nama</b>
                    </div>
                    <div class='col-4'>
                        <b>Email</b>
                    </div>
                    <div class='col-2'>
                        <b>Contact</b>
                    </div>
                    <div class='col-2'>
                        <center><b>Opsi</b></center>
                    </div>
                </div>
            ";
        }
        //Jika data tidak kosong
        else{
            $isi = "            
                <div class='row mb-2 border-bottom'>
                    <div class='col-1'>
                        <center><b>No.</b></center>
                    </div>
                    <div class='col'>
                        <b>Nama</b>
                    </div>
                    <div class='col-4'>
                        <b>Email</b>
                    </div>
                    <div class='col-2'>
                        <b>Contact</b>
                    </div>
                    <div class='col-2'>
                        <center><b>Opsi</b></center>
                    </div>
                </div>
                <div style='max-height: 55vh; overflow-y: scroll; overflow-x: hidden; max-width: 100vw;'>
                ";
                foreach($data as $a){
                    
                        $isi .= "
                        <div class='row py-1'>
                            <div class='col-1'>
                                <small><center>".$no++."</center></small>
                            </div>
                            <div class='col'>
                            	<small>".$a['nama']."</small>
                            </div>
                            <div class='col-4'>
                                <small>".$a['email']."</small>
                            </div>
                            <div class='col-2 d-flex justify-content-center'>";
                        if(empty($a['nomor_hp'])){
                            $isi .= "<input type='button' class='mx-1 btn btn-outline-light btn-sm emailUser' value='Email' id='".$a['email']."'>";
                        }else{
                            $isi .="<input type='button' class='mx-1 btn btn-outline-info btn-sm waUser' value='WA' id='".$a['nomor_hp']."'>
                                    <input type='button' class='mx-1 btn btn-outline-light btn-sm emailUser' value='Email' id='".$a['email']."'>";
                        }                            
                        $isi .="</div>
                            <div class='col-2'>
                                <center>                                
                                    <input type='button' class='btn btn-danger btn-sm hapusData' value='delete' id='".$a['id']."'>
                                </center>
                            </div> 
                        </div>
                        ";
                                 
                }
            $isi .= "</div>";
        }

        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

    public function updateUser(){        
        $nama = $this->request->getVar('nama'); //Mengambil data nama yang dikirim
        $email = $this->request->getvar('email'); //Mengambil data email yang dikirim
        $nomor_hp = $this->request->getvar('nomor_hp'); //Mengambil data nomor_hp yang dikirim        
         
        $this->user->simpanUser($nama, $email, $nomor_hp);
        return;  
    }

    public function showKategori(){
        $data = $this->kategori->getData();//Mendapatkan database User
        $no = 1; 
        $count = $this->kategori->count();// Menghitung total user        
        //jika data kosong
        if(empty($data)){
            $isi = "<center><h5 class='text-danger'>Data Kategori Tidak Ada, Silahkan Tambahkan Data Terlebih Dahulu</h5></center>";
        }
        //jika data tidak kosong
        else{
                $isi = "            
                <div class='row mb-2 border-bottom'>
                    <div class='col-1'>
                        <center><b>No.</b></center>
                    </div>
                    <div class='col'>
                        <b>Kategori</b>
                    </div>
                    <div class='col-4'>
                        <center><b>Opsi</b></center>
                    </div>
                </div>
                <div style='max-height: 55vh; overflow-y: scroll; overflow-x: hidden; max-width: 100vw;'>
                ";
                foreach($data as $a){                    
                        $isi .= "
                        <div class='row py-1'>
                            <div class='col-1'>
                                <small><center>".$no++."</center></small>
                            </div>
                            <div class='col'>
                            	<small>".$a['kategori']."</small>                           
                            </div>                           
                            <div class='col-4'>
                                <center>                                
                                	<input type='button' class='btn btn-success btn-sm editData' value='edit' id='".$a['id']."'>
                                    <input type='button' class='btn btn-danger btn-sm hapusData' value='delete' id='".$a['id']."'>                                    
                                </center>
                            </div> 
                        </div>
                        ";                                   
                }
                $isi .= "</div>";
          
        }

        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

    public function dKategori(){
        $id = $this->request->getVar('id');            
        $this->kategori->deleteKategori($id);  
    }

    public function showQKategori(){        
        $query = $this->request->getvar('q');//Mengambil nilai pencarian
        $data = $this->kategori->likeKategori($query);//Mendapatkan data pencarian
        $no = 1;
        //Jika data kosong
        if(empty($data)){
            $isi = "
                <div class='row mb-2 border-bottom'>
                    <div class='col-1'>
                        <center><b>No.</b></center>
                    </div>
                    <div class='col'>
                        <b>Kategori</b>
                    </div>
                    <div class='col-4'>
                        <center><b>Opsi</b></center>
                    </div>
                </div>
            ";
        }
        //Jika data tidak kosong
        else{
            $isi = "            
                <div class='row mb-2 border-bottom'>
                    <div class='col-1'>
                        <center><b>No.</b></center>
                    </div>
                    <div class='col'>
                        <b>Kategori</b>
                    </div>
                    <div class='col-4'>
                        <center><b>Opsi</b></center>
                    </div>
                </div>
                <div style='max-height: 55vh; overflow-y: scroll; overflow-x: hidden; max-width: 100vw;'>
                ";
                foreach($data as $a){
                    
                        $isi .= "
                        <div class='row py-1'>
                            <div class='col-1'>
                                <small><center>".$no++."</center></small>
                            </div>
                            <div class='col'>
                            	<small>".$a['kategori']."</small>
                            </div>                            
                            <div class='col-4'>
                                <center>                                
                                	<input type='button' class='btn btn-success btn-sm editData' value='edit' id='".$a['id']."'>
                                    <input type='button' class='btn btn-danger btn-sm hapusData' value='delete' id='".$a['id']."'>                                    
                                </center>
                            </div> 
                        </div>
                        ";
                                 
                }
            $isi .= "</div>";
        }

        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

    public function updateKategori(){        
        $id = date('dmy').mt_rand(1000,9999);
        $kategori = $this->request->getvar('kategori'); //Mengambil data kategori yang dikirim        
         
        $this->kategori->simpan($id, $kategori);
        return;  
    }

    public function showUKategori(){
    	$id = $this->request->getvar('id');//Mengambil nilai id
        $data = $this->kategori->whereKategori($id);//Mendapatkan data berdasarkan id
        $isi = "
        	<div class='my-2 d-flex w-100'>
        		<div class='form-floating text-dark w-100'>
        			<input type='text' id='kategoriEdit' value='".$data['kategori']."' class='form-control'>
        			<label>Edit Kategori</label>
        			<input type='hidden' value='".$data['id']."' id='idkategori'>
        		</div>
        		<button class='btn btn-sm btn-primary mx-1' id='btnKirimEdit'>Simpan</button
        	</div>
        ";
        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }    

    public function editKategori(){
    	$id = $this->request->getvar('id'); //Mengambil data id yang dikirim
        $kategori = $this->request->getvar('kategori'); //Mengambil data kategori yang dikirim        
         
        $this->kategori->updateKategori($id, $kategori);
        return;
    }

    public function showPBarang(){
    	$data = $this->barang->getBarang();//Mendapatkan Data Barang
    	$no = 1;
    	if(empty($data)){
    		$isi = "<center><h5 class='text-danger'>Data Kategori Tidak Ada, Silahkan Tambahkan Data Terlebih Dahulu</h5></center>";
    	}else{
    		$isi = "
    			<center>
    				<h3>
    					Laporan Data Barang<br>".date('d M, Y H:i')." WIB
    				</h3>
    			</center>
    			<div class='row border mb-2 bg-secondary text-light'>
    				<div class='col-1'>
    					<small><b>No.</b></small>
    				</div>
    				<div class='col-3'>
    					<small><b>Nama Barang</b></small>
    				</div>
    				<div class='col-3'>
    					<small><b>Kategori</b></small>
    				</div>
    				<div class='col-2'>
    					<small><b>Stok</b></small>
    				</div>
    				<div class='col-2'>
    					<small><b>Harga</b></small>
    				</div>
    			</div>
    		";
    		foreach($data as $a){
    			$isi .= "
	    			<div class='row border'>
	    				<div class='col-1'>
	    					<small>".$no++."</small>
	    				</div>
	    				<div class='col-3'>
	    					<small>".$a['nama']."</small>
	    				</div>
	    				<div class='col-3'>
	    					<small>".$this->kategori->getKategoriRow($a['id_kategori'])."</small>
	    				</div>
	    				<div class='col-2'>
	    					<small>".number_format($a['stok'],0,',','.')."</small>
	    				</div>
	    				<div class='col-2'>
	    					<small>Rp ".number_format($a['harga'],0,',','.')."</small>
	    				</div>
	    			</div>
    			";
    		}
    	}

    	$callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

    public function showBarang(){
        $jumlah = $this->request->getVar("jumlah"); //Record per halaman
        $page = $this->request->getVar("page");      
        //jika halaman nya kosong maka diisi angka 1
        if(empty($page)){
            $page = 1;
        }else{
            $page = $this->request->getVar("page");
        }


        $start = ($page - 1)*$jumlah;
        $video = "";

        if(empty($jumlah)){
            $getBarang = $this->barang->getBarang2($start,5);
            $isi = "Ini Jumlah Nya Kosong";
        }else{
        	$isi = "";
            $getBarang = $this->barang->getBarang2($start,$jumlah);
            foreach ($getBarang as $k) {
                $isi .= "
                <div class='card m-1 p-1 shadow-sm bg-secondary text-light'>
                	<div class='row p-1'> 
                		<div class='col-1'>
                			<img src='".base_url('Assets/images/'.$k['image'].'')."' style='width:5rem; height:5rem;'>
                		</div>
                		<div class='col'>
                			<h6>".$k['nama']."</h6>
                			<div class='d-flex flex-column'>
                				<small class='text-dark'>Dipublikasikan ~ ".date("d M Y",strtotime($k['create_at']))." | Published : ".$this->admin->whereAdmin3($k['id_admin'])."
                				</small>                							
                			</div> 
                			<small class='border border-light rounded-3 py-1 px-2'>".$this->kategori->getKategoriRow($k['id_kategori'])."</small>               			
                		</div>

                		<div class='col-3 d-flex justify-content-end py-4'>                			        
                			<button class='btn btn-sm btn-primary mx-1 lihatBarang' id='".$k['id']."'>Lihat</button>                				
                			<button class='btn btn-sm btn-success mx-1 editBarang' id='".$k['id']."'>Edit</button>
                			<button class='btn btn-sm btn-danger mx-1 hapusBarang' id='".$k['id']."'>Hapus</button>                		
                		</div>
                	</div>
                </div>";
            } 
            $isi .= "<div class='mt-3'><center><input type='hidden' value='".$page."' id='halBarang'>";

            $hitungIsi = $this->barang->countBarang2();
            $total_pages = ceil($hitungIsi/$jumlah);
            for($i=1; $i<=$total_pages; $i++){
            	if($i == $page){
            		$isi .= "
                    <span class='active_pagination px-2 py-1 border border-2 border-primary rounded-3 mx-1' id='".$i."'>".$i."</span>";
            	}else{
            		$isi .= "
                    <span class='pagination_link px-2 py-1 border border-2 border-primary rounded-3 mx-1' id='".$i."'>".$i."</span>";
            	}                
            }

            $isi .= "</center></div>";
        }
           
        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

    public function dBarang(){
        $id = $this->request->getVar('id');//Mendaptakn data id artikel yang telah dikirim
        $this->barang->deleteBarang($id);//Menghapus artikel berdasarkan id barang
    }

    public function showQBarang(){
		$q = $this->request->getVar('q');
		if(empty($q)){
			$isi = " ";
		}else{
			$getBarang = $this->barang->likeBarang($q);
			$isi = "<div style='max-height:65vh; overflow-y: scroll; border:none; overflow-x:hidden' id='dataQuery'>";
			foreach ($getBarang as $k) {
                $isi .= "
                <div class='card m-1 p-1 shadow-sm bg-secondary text-light'>
                	<div class='row p-1'>
                		<div class='col-1'>
                			<img src='".base_url('Assets/images/'.$k['image'].'')."' style='width:5rem; height:5rem;'>
                		</div> 
                		<div class='col'>
                			<h6>".$k['nama']."</h6>
                			<div class='d-flex flex-column'>
                				<small class='text-dark'>Dipublikasikan ~ ".date("d M Y",strtotime($k['create_at']))." | Published : ".$this->admin->whereAdmin3($k['id_admin'])."
                				</small>                							
                			</div>
                			<small class='border border-light rounded-3 py-1 px-2'>".$this->kategori->getKategoriRow($k['id_kategori'])."</small>                 			
                		</div>

                		<div class='col-3 d-flex justify-content-end py-4'>                			        
                			<button class='btn btn-sm btn-primary mx-1 lihatBarang' id='".$k['id']."'>Lihat</button>                				
                			<button class='btn btn-sm btn-success mx-1 editBarang' id='".$k['id']."'>Edit</button>
                			<button class='btn btn-sm btn-danger mx-1 hapusBarang' id='".$k['id']."'>Hapus</button>                		
                		</div>
                	</div>
                </div>";
            }

            $isi .= "</div>";             
		}
		

		$callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
	}

	public function uploadBarang(){		        
		$nama = $this->request->getVar('nama');	
		$image = $this->request->getFile('image');
		$deskripsi = $this->request->getVar('deskripsi');
		$stok = $this->request->getVar('stok');
		$harga = $this->request->getVar('harga');		
		$id_kategori = $this->request->getVar('id_kategori'); 
		$id_admin = $this->request->getVar('id_admin'); 
		$create_at = date('Y-M-d H:i:s');		

		//Proses Simpan Gambar
		$type = $image->getClientMimeType();
        $name = $image->getName();      
        $ext = $type;
        $imageName = $image->getRandomName();                
        $image->move('Assets/images', $imageName);
        //Batas Proses Simpan Gambar

		$this->barang->simpan($id_admin, $id_kategori, $nama, $deskripsi, $stok, $harga, $create_at, $imageName);
	}

	public function updateBarang(){		        
		$nama = $this->request->getVar('nama');	
		$image_lama = $this->request->getVar('image_lama');
		$nama_image_lama = $this->request->getVar('nama_image_lama');	
		$image = $this->request->getFile('image');
		$deskripsi = $this->request->getVar('deskripsi');
		$stok = $this->request->getVar('stok');
		$harga = $this->request->getVar('harga');		
		$id_kategori = $this->request->getVar('id_kategori'); 
		$id = $this->request->getVar('id'); 

		//Proses Simpan Gambar
		if(!empty($image)){
			$type = $image->getClientMimeType();
	        $name = $image->getName();      
	        $ext = $type;
	        $path = $image_lama;
	        chmod($path, 0777);
	        unlink($path);
	        $imageName = $image->getRandomName();                
	        $image->move('Assets/images', $imageName);
		}		
        //Batas Proses Simpan Gambar
		else{
			$imageName = $nama_image_lama;
		}
		$this->barang->updateBarang($id, $id_kategori, $nama, $deskripsi, $stok, $harga, $imageName);
	}

	public function showDBarang(){
    	$id = $this->request->getvar('id');//Mengambil nilai id
        $data = $this->barang->whereBarang($id);//Mendapatkan data berdasarkan id
        $isi = "
        	<div class='row my-2'>
        		<div class='col-4 border-end'>
        			<img src='".base_url('Assets/images/'.$data['image'].'')."' style='height:10rem; width:100%;'>
        		</div>
        		<div class='col d-flex flex-column'>
        			<h5>Rp ".number_format($data['harga'],0,',','.')."</h5>
        			<h6>".$data['nama']."</h6>
        			<small>Stok: ".number_format($data['stok'],0,',','.')."</small>
        			<small>Kategori: ".$this->kategori->getKategoriRow($data['id_kategori'])."</small>
        			<small>Upload: ".date("d M Y",strtotime($data['create_at']))."</small>
        			<small>By: ".$this->admin->whereAdmin3($data['id_admin'])."</small>
        		</div>
        	</div>        	
        ";
        $callback = [
            'data' => $isi
        ];
        echo json_encode($callback);
    }

	public function uploadfile(){				
		if(isset($_FILES['upload']['name']))
		{		  				
			$file = $_FILES['upload']['tmp_name'];
            $file_name = $_FILES['upload']['name'];
            $file_name_array = explode(".", $file_name);
            $extension = end($file_name_array);
            $new_image_name = rand() . '.' . $extension;
            $allowed_extension = array("jpg", "jpeg", "png","PNG","JPEG","JPG");
            if(in_array($extension, $allowed_extension))
            {
                move_uploaded_file($file, './Assets/images/' . $new_image_name);
                $function_number = $_GET['CKEditorFuncNum'];
                $url = base_url().'/Assets/images/' . $new_image_name;
                $message = '';
                echo"<script>window.parent.CKEDITOR.tools.callFunction('$function_number','$url','$message')</script>";

            }
		 
		}else{
			echo "Error";
		}
	}

	public function logout(){
        $session = session();                
        //Untuk Akun Admin
        if($session->get('login_status') == TRUE){
            $id = $session->get('id');
            $ses_data = [
                'login_status' => FALSE
            ];
            $session->set($ses_data);            
        }        
        $session->remove('access_token');
        //$session->destroy(); 
        return redirect()->to('Home');

    }

}
