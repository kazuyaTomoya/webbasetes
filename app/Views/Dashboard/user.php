<?= $this->extend('template') ?>

<?= $this->section('content') ?>
	
	<style type="text/css">
		#layout-alert{
			position: absolute;
			top: 0;
			right: 0;
			margin: 2rem;
			z-index: 2;			
		}
	</style>

	<div class="modal fade" id="alertDevice">
		<div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      	<div class="modal-body py-4 px-2">
		        	<center>
		        		<h3 style="font-family: Helvetica; color:#950101; font-weight: 650;">Menu Admin Hanya Bisa Dibuka Pada Device Laptop/PC</h3>
		        		<p style="font-family: Helvetica; color:#79018C;">[Silahkan Login Kembali Melalui Perangkan Laptop/PC]</p>
		        		<button type="button" class="btn btn-sm btn-outline-primary w-100" id="tutupAlert">OK</button>
		        	</center>		       
		      	</div>
		    </div>
	  	</div>
	</div>

<div id="contentUser">
	<div id="layout-alert">
		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
			<strong>Succesfully!</strong> Data is Update!					
		</div>

		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccessUser">
			<strong>Succesfully!</strong> Data User is Update!
		</div>

		<div class="alert alert-warning alert-dismissible fade show shadow" role="alert" id="alertNama">
			<strong>Warning!</strong> Nama is empty!					
		</div>

		<div class="alert alert-warning alert-dismissible fade show shadow" role="alert" id="alertEmail">
			<strong>Warning!</strong> Email is empty!
		</div>

		<div class="alert alert-warning alert-dismissible fade show shadow" role="alert" id="alertNomor">
			<strong>Warning!</strong> Nomor HP is empty!
		</div>
	</div>

	<div class="card mx-4 my-2 shadow rounded-3 bg-secondary text-light">
		<div class="card-header d-flex justify-content-between">
			<h3>Data User</h3>	

			<div class="form-floating">
				<input type="search" class="form-control bg-secondary text-light" id="qUser"  autocomplete="off">
				<label>Cari Nama User</label>
			</div>			
		</div>

		<div class="card-body">		
			<div class="row">
				<div class="col">
					<div id="dataNew">

					</div>

					<div id="qdataUser">

					</div>
				</div>
				<div class="col-4 bg-dark border-start rounded-3 py-2">
					<small>*Create New User</small>
					<div class="row mb-2">
						<div class="form-floating">
							<input type="text" class="form-control bg-secondary text-light" id="namaNew">
							<label>Nama</label>
						</div>		
					</div>
					<div class="row mb-2">
						<div class="form-floating">
							<input type="email" class="form-control bg-secondary text-light" id="emailNew">
							<label>Email Address</label>
						</div>						
					</div>
					<div class="row mb-2">
						<div class="form-floating">
							<input type="number" class="form-control bg-secondary text-light" id="nomorNew">
							<label >Nomor Hp</label>
						</div>						
					</div>
					<div class="row px-2">
						<button class="btn-sm btn btn-primary" id="btnKirimNew">Kirim</button>				
					</div>
					<div class="row" id="alertLoading">						
						<div>
							<center>
								<img src="<?= base_url('Assets/Loading.gif');?>" style="height: 3rem; width: 100%; max-width: 3vw;">
							</center>
						</div>
					</div>
				</div>												
			</div>
			
		</div>
		
	</div>
</div>

<script src="<?= base_url('Assets/js/jquery.3.6.0.min.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){	
		window.onload = showUser();
		$("#alertSuccess").hide();
		$("#alertSuccessUser").hide();
		$("#alertLoading").hide();			
		$("#alertNama").hide();
		$("#alertNomor").hide();
		$("#alertEmail").hide();
		$("#btnKirimNew").hide();
		$("#dataNew").show();	

		if((screen.width<=1024) && (screen.width<=768)){
	    	document.getElementById("slide").style.display = "none";
	    	document.getElementById("topbar").style.display = "none";	
	    	document.getElementById("contentUser").style.display = "none";	    	
			$('#alertDevice').modal('show');					
		}

		$("#tutupAlert").click(function(){		
			window.location.href = "<?= base_url('Home')?>";
		});

		function showUser(){
			$.ajax({
				type: "POST",
				url: "<?= base_url('Home/showUser');?>",
				dataType: "json",
				beforeSend: function(e){
					if(e && e.overrideMimeType) {
		                e.overrideMimeType("application/json;charset=UTF-8");
		            }
				},
	            success: function(response){
	                $("#dataNew").html(response.data).show();
	            },
	            error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
	                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
	            }
			});
		}	

		$("#namaNew").keyup(function(){
			if(document.getElementById("namaNew").value == ""){
				$("#alertNama").show();
				setTimeout('$("#alertNama").hide()',5000);
				$("#btnKirimNew").hide();					
			}
			if(document.getElementById("namaNew").value != "" && document.getElementById("emailNew").value != "" && document.getElementById("nomorNew").value != ""){		
				$("#btnKirimNew").show();					
			}
		});				

		$("#emailNew").keyup(function(){
			if(document.getElementById("emailNew").value == ""){
				$("#alertEmail").show();
				setTimeout('$("#alertEmail").hide()',5000);
				$("#btnKirimNew").hide();					
			}
			if(document.getElementById("namaNew").value != "" && document.getElementById("emailNew").value != "" && document.getElementById("nomorNew").value != ""){		
				$("#btnKirimNew").show();					
			}			
		});

		$("#nomorNew").keyup(function(){
			if(document.getElementById("nomorNew").value == ""){
				$("#alertNomor").show();
				setTimeout('$("#alertNomor").hide()',5000);
				$("#btnKirimNew").hide();					
			}
			if(document.getElementById("namaNew").value != "" && document.getElementById("emailNew").value != "" && document.getElementById("nomorNew").value != ""){		
				$("#btnKirimNew").show();					
			}			
		});

		$("#btnKirimNew").click(function(){						
			let formData = new FormData();
	        formData.append('nama', $('#namaNew').val());
	        formData.append('email', $('#emailNew').val());
	        formData.append('nomor_hp', $('#nomorNew').val());	        

			if(document.getElementById("namaNew").value != "" && document.getElementById("emailNew").value != "" && document.getElementById("nomorNew").value != ""){
				$.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/updateUser');?>",
					data: formData,
					cache: false,
		            processData: false,
		            contentType: false,
					dataType: "text",
					beforeSend: function(e){						
			            $("#alertLoading").show();
			            $("#btnKirimNew").hide();
					},
					success: function(response){						
						$("#alertNama").hide();
						$("#alertEmail").hide();
						$("#alertNomor").hide();
						
						$("#alertSuccessUser").show();
						setTimeout('$("#alertSuccessUser").hide()',3000);						
						document.getElementById("namaNew").value = "";
						document.getElementById("emailNew").value = "";
						document.getElementById("nomorNew").value = "";							
						$("#alertLoading").hide();
						showUser();				

					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});

				showUser();
				return false
			}
		});	

		$(document).on('click','.hapusData',function(){
			var idadmin = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "<?= base_url('Home/dUser'); ?>",
				data: {id: idadmin},
				success:function(){	
					showUser();
				}
			});		
			return false;
		});

		$("#qUser").keyup(function(){
			if(document.getElementById("qUser").value === "" ){
				$("#dataNew").show();
				$("#qdataUser").hide();
			}
			if(document.getElementById("qUser").value === " "){
				$("#dataNew").show();
				$("#qdataUser").hide();
			}
			if(document.getElementById("qUser").value != "" && document.getElementById("qUser").value != " "){
				$("#dataNew").hide();
				$.ajax({
					type: "POST",
					url: "<?= base_url('Home/showQUser');?>",
					data: {q:$(this).val()},
					dataType: "json",
                    success: function(response){
                        $("#qdataUser").html(response.data).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
				});	
			}
			
		});

		$(document).on('click','.waUser',function(){
			var no = $(this).attr('id');			
			var filter = no.slice(1, 12);
			window.open('https://api.whatsapp.com/send?phone=62'+filter, '_blank');
		});

		$(document).on('click','.emailUser',function(){
			var email = $(this).attr('id');			
			window.open('https://mail.google.com/mail/u/0/?view=cm&tf=1&fs=1&to='+email, '_blank');
		});

		showUser();

	});	

</script>
<?= $this->endSection() ?>