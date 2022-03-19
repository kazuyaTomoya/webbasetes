<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>	

	<!-- Bootstrap -->    
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('Assets/css/bootstrap-icons/font/bootstrap-icons.css');?>">

    <style type="text/css">
    	::-webkit-scrollbar {
		    height: 6px;
		    width: 6px;
		    background: transparent;
		}

		::-webkit-scrollbar-thumb {
		    background: transparent;
		    -webkit-border-radius: 1ex;
		    -webkit-box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.75);
		}

		::-webkit-scrollbar-corner {
		    background: transparent;
		}		

    	body{
    		margin: 0px;
    		padding: 0px;
    		height: 100vh;
    		font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    		font-smooth: always;
    		-webkit-font-smoothing: antialiased;
  			-moz-osx-font-smoothing: grayscale;
    	}

    	#slide{
    		background: url(<?= base_url('Assets/Abstrak 1.jpg')?>);    		
    		width: 20vw;
    		padding: 0.2rem;
    		max-height: 100vh;
    		overflow-y: hidden;
    		z-index: 1;
    		border-right: solid 0.1rem gray;
    		-webkit-backdrop-filter: blur(10px);
  			backdrop-filter: blur(10px);
    	}

    	#slide #logoMini{
    		display: none;
    	}

    	#slide #logoMaxi{
    		margin: 0;
    		-webkit-backdrop-filter: blur(8px);
  			backdrop-filter: blur(8px);
    	}

    	#slide #logoMaxi img{
    		position: relative;
    		margin: 0.5rem;
    		width:14rem;
    		height:4rem;    		
    	}

    	#slide #slideMaxi::-webkit-scrollbar{
    		display: none;
    	}

    	#slide #slideMaxi::-webkit-scrollbar-track{
    		background-color:transparent;
    		box-shadow: none;
    	}

    	#slide #slideMaxi::-webkit-scrollbar-thumb{
    		background-color:transparent;
    		box-shadow: none;
    	}

    	#slide #slideMaxi:hover::-webkit-scrollbar{
    		display: block;    		
    	}

    	#slide #slideMaxi:hover::-webkit-scrollbar-track{
    		background-color:transparent;
    	}

    	#slide #slideMaxi:hover::-webkit-scrollbar-thumb{
    		background-color:white;
    	}

    	#slide #slideMaxi{
    		margin: 0;
    		padding: 0.5rem;    		
    		max-height: 87vh;
    		height: 100%;
    		overflow-y: scroll;
    		border-top: solid 0.1rem black;   
    		-webkit-backdrop-filter: blur(8px);
  			backdrop-filter: blur(8px); 		
    	}

    	#slide #slideMaxi p{
    		display: block;
    		color: white;
    		font-weight: 400;
    		font-size: 0.85rem;
    		text-decoration: none;
    		padding: 0.1rem 0.4rem;    		
    		border-radius: 10px;
    		margin: 0.2rem 0rem;
    	}

    	#slide #slideMaxi p img{
    		width: 1.5rem;
    		height: 1.5rem;
    		margin: 0.5rem;
    	}

    	#slide #slideMaxi p:hover{
    		cursor: pointer;
    		color: black;
    		background: white;
    		box-shadow: 0.1rem 0.1rem 0.1rem rgb(198, 197, 197);
    		animation: a 0.2s linear;
    	}    

    	.active{
    		color: black;
    		background: white;   		 	
    		box-shadow: 0.1rem 0.1rem 0.1rem rgb(198, 197, 197);	
    	}

    	#slide #slideMini{
    		display: none;
    		max-height: 90vh;
    		height: 100%;
    		overflow-y: scroll;
    		-webkit-backdrop-filter: blur(8px);
  			backdrop-filter: blur(8px); 
    	}

    	#slide #slideMini::-webkit-scrollbar{
    		display: none;
    	}

    	#slide #slideMini::-webkit-scrollbar-track{
    		background-color:transparent;
    		box-shadow: none;
    	}

    	#slide #slideMini::-webkit-scrollbar-thumb{
    		background-color:transparent;
    		box-shadow: none;
    	}

    	#slide #slideMini:hover::-webkit-scrollbar{
    		display: block;    		
    	}

    	#slide #slideMini:hover::-webkit-scrollbar-track{
    		background-color:transparent;
    	}

    	#slide #slideMini:hover::-webkit-scrollbar-thumb{
    		background-color:white;
    	}

    	#slide.mini{
    		width: 7vw;
    		animation: mini 0.3s linear;
    	}

    	#slide.mini #logoMaxi{
    		display: none;
    	}

    	#slide.mini #logoMini{
    		display: block;
    		-webkit-backdrop-filter: blur(8px);
  			backdrop-filter: blur(8px);
    	}

    	#slide.mini #slideMaxi{
    		display: none;
    	}

    	#slide.mini #slideMini{
    		display: block;    		
    		padding: 0 0.2rem;    		
    	}

		#slide.mini #slideMini p{
			display: block;			
			margin: 0.5rem;
		}    	

    	#slide.mini #slideMini p img{
    		margin: 0.2rem;
    		width: 2.2rem;
    		height: 2.2rem;    		
    	}

    	#slide.mini #slideMini p:hover img{    		
    		cursor: pointer;
    		background: white;
    		border-radius: 5px;
    		transition: all 0.3s;
    	}

    	#slide.mini #slideMini .activeMini{    		
    		background: white;
    		border-radius: 5px;
    	}

    	#slide.maxi{
    		width: 20vw;
    		animation: maxi 0.3s linear;
    	}

    	#slide.maxi #logoMini{
    		display: none;
    	}

    	#slide.maxi #slideMaxi p{
    		display: block;
    		color: white;
    		font-weight: 400;
    		font-size: 0.85rem;
    		text-decoration: none;
    		padding: 0.1rem 0.4rem;    		
    		border-radius: 10px;
    		margin: 0.2rem 0rem;
    	}

    	#slide.maxi #slideMaxi p:hover{
    		color: black;
    		background: white;
    		box-shadow: 0.1rem 0.1rem 0.1rem rgb(198, 197, 197);
    		animation: a 0.5s linear;
    	}

    	#slide.maxi #slideMini{
    		display: none;
    	}

    	#topbar{
    		background: url(<?= base_url('Assets/Abstrak 1.jpg')?>);  
  			color: white; 		
    		display: flex;
    		justify-content: space-between;    		
    		border-bottom: solid 0.1rem grey;  	
    	}

    	#blur-Topbar{
    		display: flex;
    		justify-content: space-between;    		
    		width: 100vw;
    		-webkit-backdrop-filter: blur(10px);
  			backdrop-filter: blur(10px); 
    	}

    	#menuprofile{
    		width: 2rem;
    		height: 2rem;
    		margin: 0 0.5rem;
    		padding: 0.1rem;
    		border-radius: 5px; 		
    	}

    	#menuprofile img{
    		width: 1.8rem;
    		height: 1.8rem;
    	}

    	#menuprofile:hover{
    		cursor: pointer;
    		background: white;
    		box-shadow: 0.1rem 0.1rem 0.1rem rgb(197, 197, 197);
    		transition: all 0.3s;
    	}

    	@keyframes mini{
    		0%{
    			width: 20vw;
    		}
    		100%{
    			width: 7vw;
    		}
    	}

    	@keyframes maxi{
    		0%{
    			width: 5vw;
    		}
    		100%{
    			width: 20vw;
    		}
    	}

    	@keyframes a{
    		0%{
    			background:lightgray;
    			box-shadow: 0 0 0 rgb(0, 0, 0);
    		}
    		100%{
    			background: white;
    			box-shadow: 0.1rem 0.1rem 0.1rem rgb(198, 197, 197);
    		}
    	}
    </style>

</head>
<body style="background:#444444;">

	<div class="row m-0 p-0" style="background:#444444;">

		<!----   Slidebar Menu    --->
		<div id="slide">			
			<div id="logoMaxi">
				<center>
					<img src="<?= base_url('Assets/logo/'.$beranda['logo'].'');?>">
				</center>
			</div>

			<div id="logoMini">
				<img src="<?= base_url('Assets/logo/'.$beranda['logo_kecil'].'');?>" style="margin:0.5rem; width:3rem; height:3rem">
			</div>			
			<div id="slideMaxi">
				<?php if(($user['level'] == 'Owner') || ($user['level'] == 'Master')){?>
					<?php if($active == 'Dashboard'){?>
						<p id="menudashboard" class="active" style="color:black;"><img src="<?= base_url('Assets/icon/IcoDashboard.svg');?>">Dashboard</p>
					<?php }else{?>
						<p id="menudashboard"><img src="<?= base_url('Assets/icon/IcoDashboard.svg');?>">Dashboard</p>
					<?php }?>

					<?php if($active == 'User'){?>
						<p id="menuuser" class="active" style="color:black;"><img src="<?= base_url('Assets/icon/IcoProfile.svg');?>">User</p>
					<?php }else{?>
						<p id="menuuser"><img src="<?= base_url('Assets/icon/IcoProfile.svg');?>">User</p>
					<?php }?>					

					<?php if($active == 'Kategori'){?>
						<p id="menukategori" class="active" style="color:black;"><img src="<?= base_url('Assets/icon/IcoCategory.svg');?>">Kategori</p>
					<?php }else{?>
						<p id="menukategori"><img src="<?= base_url('Assets/icon/IcoCategory.svg');?>">Kategori</p>
					<?php }?>				

					<?php if($active == 'Barang'){?>
						<p id="menubarang" class="active" style="color:black;"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>">Barang</p>
					<?php }else{?>
						<p id="menubarang"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>">Barang</p>
					<?php }?>
				<?php }else{?>
					<?php if($active == 'Barang'){?>
						<p id="menubarang" class="active" style="color:black;"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>">Barang</p>
					<?php }else{?>
						<p id="menubarang"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>">Barang</p>
					<?php }?>
				<?php }?>
																                								      
				<p id="menulogout"><img src="<?= base_url('Assets/icon/IcoLogout.svg');?>">Logout</p>
			</div>

			<div id="slideMini">
				<?php if(($user['level'] == 'Owner') || ($user['level'] == 'Master')){?>
					<?php if($active == 'Dashboard'){?>
						<p id="menudashboardM"><img src="<?= base_url('Assets/icon/IcoDashboard.svg');?>" class="activeMini"></p>
					<?php }else{?>
						<p id="menudashboardM"><img src="<?= base_url('Assets/icon/IcoDashboard.svg');?>"></p>
					<?php }?>

					<?php if($active == 'User'){?>
						<p id="menuuserM"><img src="<?= base_url('Assets/icon/IcoProfile.svg');?>" class="activeMini"></p>
					<?php }else{?>
						<p id="menuuserM"><img src="<?= base_url('Assets/icon/IcoProfile.svg');?>"></p>
					<?php }?>			

					<?php if($active == 'Kategori'){?>
						<p id="menukategoriM"><img src="<?= base_url('Assets/icon/IcoCategory.svg');?>" class="activeMini"></p>
					<?php }else{?>
						<p id="menukategoriM"><img src="<?= base_url('Assets/icon/IcoCategory.svg');?>"></p>
					<?php }?>

					<?php if($active == 'Barang'){?>
						<p id="menubarangM"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>" class="activeMini"></p>
					<?php }else{?>
						<p id="menubarangM"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>"></p>
					<?php }?>
				<?php }else{?>
					<?php if($active == 'Barang'){?>
						<p id="menubarangM"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>" class="activeMini"></p>
					<?php }else{?>
						<p id="menubarangM"><img src="<?= base_url('Assets/icon/IcoAds.svg');?>"></p>
					<?php }?>
				<?php }?>
														               								                	
				<p id="menulogoutM"><img src="<?= base_url('Assets/icon/IcoLogout.svg');?>"></p>
			</div>
		</div>

		<div class="col p-0" style="max-height:100vh; overflow-y: hidden;">
			<div id="topbar">
				<div id="blur-Topbar">
					<div class="d-flex">
						<a href="#" id="menu">
							<img src="<?= base_url('Assets/icon/IcoMinimize.svg');?>" style="width: 3rem; height:3rem; margin:1rem; cursor: pointer;">
						</a>
					</div>				

					<div class="d-flex m-4">
						<h5 class="m-1">Hi, <?= $user['nama']?></h5>
						<p id="menuprofile">
							<img src="<?= base_url('Assets/icon/IcoUser.svg');?>">
						</p>
					</div>
				</div>
					
			</div>
			<div class="col p-2" style="height:87vh; overflow-y: scroll;">
				<?= $this->renderSection('content') ?>
			</div>
			<input type="hidden" id="namauserbaru" value="<?= $user['nama']?>">				
		</div>

		<div class="modal fade" id="profileModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Setting Profile</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" id="btnCloseProfile"></button>
				</div>
				<div class="modal-body">
					<small>Information</small>
					<div class="form-floating mb-2">
					  	<input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" disabled="true" value="<?= $user['nama']; ?>">
					  	<label for="nama" id="alertNamaPro2">Full Name</label>
					  	<label for="nama" id="alertNamaPro" class="text-danger">Nama is empty!</label>
					</div>					
					<div class="d-flex">
						<div class="form-floating me-1 w-50">
						  	<input type="email" class="form-control" id="email" placeholder="Email Addess" name="email" disabled="true" value="<?= $user['email']; ?>">
						  	<label for="nama" id="alertEmailPro2">Email Address</label>
						  	<label for="nama" id="alertEmailPro" class="text-danger">Email is empty!</label>
						</div>
						<div class="form-floating ms-1 w-50">
							<input type="number" class="form-control" id="nomor_hp" placeholder="Nomor Hp" name="no_hp" disabled="true" value="<?= $user['nomor_hp']; ?>">
							<label for="nama">Phone Number</label>							
						</div>						
					</div>					
					<hr>
					<small>Account</small>
					<div class="d-flex">
						<div class="form-floating mx-1 w-50">
						  	<input type="text" class="form-control" id="username" placeholder="Username" name="username" disabled="true" value="<?= $user['username']; ?>">
						  	<label for="nama">Username</label>
						</div>
						<div class="d-block w-50 mx-1">
							<div class="form-floating">
							  	<input type="password" class="form-control" id="password" placeholder="Password" name="password" disabled="true" value="<?= $user['password']; ?>">
							  	<label for="nama">Password</label>
							</div>
							<button class=" btn btn-sm btn-outline-primary my-1 float-end" id="showPassword" disabled="true">Show</button>
							<button class=" btn btn-sm btn-outline-danger my-1 float-end" id="hidePassword" disabled="true">Hidden</button>
						</div>						
					</div>
					
				</div>
				<div class="modal-footer d-flex py-2 justify-content-center">
					<div class="d-flex justify-content-center">
						<button class="btn btn-sm mx-1 btn-outline-success" id="editProfile">CHANGE INFORMATION</button>
						<button class="btn btn-sm mx-1 btn-outline-danger" id="batalProfile">BATAL</button>
						<button class="btn btn-sm mx-1 btn-outline-primary" id="saveProfile">SAVE</button>
					</div>
					<div class="d-flex justify-content-center">
						<button class="btn btn-sm mx-1 btn-outline-info" id="editPassword">CHANGE PASSWORD</button>	
						<button class="btn btn-sm mx-1 btn-outline-danger" id="batalPassword">BATAL</button>
						<button class="btn btn-sm mx-1 btn-outline-primary" id="savePassword">SAVE</button>
					</div>					
				</div>
			</div>
		</div>
	</div>
	</div>	
		
	<script src="<?= base_url('Assets/js/jquery.3.6.0.min.js') ?>"></script>	
	<script src="<?= base_url('Assets/js/bootstrap.js') ?>"></script>
	<script type="text/javascript">	
		$("#batalProfile").hide();
		$("#batalPassword").hide();		
		$("#saveProfile").hide();
		$("#savePassword").hide();		
		$('#showPassword').prop('disabled', true);				
		$("#hidePassword").hide();
		$("#alertNamaPro").hide();
		$("#alertEmailPro").hide();	
			
		$("#editProfile").click(function(){
			$('#nama').prop('disabled', false);
			$('#email').prop('disabled', false);
			$('#nomor_hp').prop('disabled', false);			
			
			$("#batalProfile").show();
			$("#editProfile").hide();
			$("#editPassword").hide();						
			$("#saveProfile").show();			
		});		

		$("#editPassword").click(function(){
			$('#password').prop('disabled', false);
			$('#showPassword').prop('disabled', false);
			$('#hidePassword').prop('disabled', false);
			
			$("#batalPassword").show();
			$("#editPassword").hide();
			$("#editProfile").hide();
			$("#editEmail").hide();
			if(document.getElementById("password").value != ""){
				$("#savePassword").show();
			}
		});

		$("#showPassword").click(function(){
			btn = document.getElementById("password");
			btn.type ="text";		
			$("#showPassword").hide();
			$("#hidePassword").show();
		});

		$("#hidePassword").click(function(){
			btn = document.getElementById("password");
			btn.type ="password";
			$("#showPassword").show();
			$("#hidePassword").hide();
		});

		$("#batalProfile").click(function(){
			document.getElementById("nama").value = "<?= $user['nama']; ?>";
			document.getElementById("email").value = "<?= $user['email']; ?>";
			document.getElementById("nomor_hp").value = "<?= $user['nomor_hp']; ?>";
			$('#nama').prop('disabled', true);
			$('#email').prop('disabled', true);
			$('#nomor_hp').prop('disabled', true);			

			$("#saveProfile").hide();
			$("#batalProfile").hide();
			$("#editProfile").show();
			$("#editPassword").show();			
		});

		$("#batalPassword").click(function(){
			btn = document.getElementById("password");			
			document.getElementById("password").value = "<?= $user['password']; ?>";
			if(btn.type == "text"){
				btn.type = "password";
				$("#showPassword").show();
				$("#hidePassword").hide();
			}
			$('#password').prop('disabled', true);
			$('#showPassword').prop('disabled', true);
			$('#hidePassword').prop('disabled', true);		

			$("#savePassword").hide();
			$("#batalPassword").hide();
			$("#editPassword").show();
			$("#editProfile").show();
			$("#editEmail").show();
		});

		$("#btnCloseProfile").click(function(){
			document.getElementById("nama").value = "<?= $user['nama']; ?>";
			document.getElementById("email").value = "<?= $user['email']; ?>";
			document.getElementById("nomor_hp").value = "<?= $user['nomor_hp']; ?>";
			document.getElementById("password").value = "<?= $user['password']; ?>";
			$('#nama').prop('disabled', true);
			$('#email').prop('disabled', true);
			$('#password').prop('disabled', true);
			$('#nomor_hp').prop('disabled', true);
			$('#showPassword').prop('disabled', true);
			$('#hidePassword').prop('disabled', true);

			$("#savePassword").hide();
			$("#saveProfile").hide();
			$("#batalPassword").hide();
			$("#batalProfile").hide();
			$("#editPassword").show();
			$("#editProfile").show();
		});

		$("#nama").keyup(function(){
			if(this.value === ""){
				$("#alertNamaPro").show();
				$("#alertNamaPro2").hide();
			}

			if(this.value != ""){
				$("#alertNamaPro").hide();
				$("#alertNamaPro2").show();
			}			
		});

		$("#email").keyup(function(){
			if(this.value === ""){
				$("#alertEmailPro").show();
				$("#alertEmailPro2").hide();
			}

			if(this.value != ""){
				$("#alertEmailPro").hide();
				$("#alertEmailPro2").show();
			}			
		});

		$("#password").keyup(function(){
			if(this.value === ""){
				$("#savePassword").hide();
			}

			if(this.value != ""){
				$("#savePassword").show();
			}
		});

		$("#saveProfile").click(function(){
			if(document.getElementById("nama").value === ""){
				$("#alertNamaPro").show();
			}

			if(document.getElementById("email").value === ""){
				$("#alertEmailPro").show();
			}

			if(document.getElementById("nama").value != "" && document.getElementById("email").value != ""){
				$.ajax({
					type: "POST", // Method pengiriman data bisa dengan GET atau POST
					url: "<?= base_url('Home/updateProfile'); ?>", // Isi dengan url/path file php yang dituju
					data: {
						nama : $("#nama").val(), email : $("#email").val(), nomor_hp : $("#nomor_hp").val()
					}, // data yang akan dikirim ke file yang dituju
					dataType: "text",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){ // Ketika proses pengiriman berhasil
                    	$("#alertSuccess").show();
						setTimeout('$("#alertSuccess").hide()',3000);
                    	$('#nama').prop('disabled', true);
                    	$('#email').prop('disabled', true);
                    	$('#nomor_hp').prop('disabled', true);
                        $("#saveProfile").hide();
						$("#batalProfile").hide();
						$("#editPassword").show();
						$("#editProfile").show();
						$('#profileModal').modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
            	});
			}
		});

		$("#savePassword").click(function(){			
			if(document.getElementById("password").value != ""){
				$.ajax({
					type: "POST", // Method pengiriman data bisa dengan GET atau POST
					url: "<?= base_url('Home/updatePassword'); ?>", // Isi dengan url/path file php yang dituju
					data: {
						password : $("#password").val()
					}, // data yang akan dikirim ke file yang dituju
					dataType: "text",
                    success: function(response){ // Ketika proses pengiriman berhasil
                    	$("#alertSuccess").show();
						setTimeout('$("#alertSuccess").hide()',3000);
						btn = document.getElementById("password");
						btn.type ="password";
						$('#showPassword').prop('disabled', true);
						$('#hidePassword').prop('disabled', true);
						$("#showPassword").show();
						$("#hidePassword").hide();
                    	$('#password').prop('disabled', true);                        
                        $("#savePassword").hide();
						$("#batalPassword").hide();
						$("#editPassword").show();
						$("#editProfile").show();
						$('#profileModal').modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
            	});
			}
		});
	

		let btnMenu = document.querySelector('#menu');
		let slide = document.querySelector('#slide');

		btnMenu.addEventListener('click', function(){
			if(slide.classList == 'mini'){
				slide.classList.remove('mini');
				slide.classList.add('maxi');

			}else{
				slide.classList.add('mini');
				slide.classList.remove('maxi');
			}	
		});

		$("#menudashboard").click(function(){		
			window.location.href = "<?= base_url('Home/dashboard')?>";
		});

		$("#menuuser").click(function(){		
			window.location.href = "<?= base_url('Home/user')?>";
		});		

		$("#menukategori").click(function(){		
			window.location.href = "<?= base_url('Home/kategori')?>";
		});

		$("#menubarang").click(function(){		
			window.location.href = "<?= base_url('Home/barang')?>";
		});

		$("#menulogout").click(function(){		
			window.location.href = "<?= base_url('Home/logout')?>";
		});

		$("#menudashboardM").click(function(){		
			window.location.href = "<?= base_url('Home/dashboard')?>";
		});	

		$("#menukategoriM").click(function(){		
			window.location.href = "<?= base_url('Home/kategori')?>";
		});

		$("#menubarangM").click(function(){		
			window.location.href = "<?= base_url('Home/barang')?>";
		});

		$("#menulogoutM").click(function(){		
			window.location.href = "<?= base_url('Home/logout')?>";
		});

		$("#menuprofile").click(function(){		
			$('#profileModal').modal('show');
		});

		$("#menuuserM").click(function(){		
			window.location.href = "<?= base_url('Home/user')?>";
		});

	</script>
</body>
</html>