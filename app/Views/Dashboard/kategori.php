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

	<div class="modal fade" id="ModalEdit">
        <div class="modal-dialog modal-dialog-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnCloseEdit"></button>
                </div>
                <div class="modal-body">                    
                    <div id="hasilEdit">
                        
                    </div>              
                </div>
            </div>
        </div>
    </div>

<div id="contentKategori">
	<div id="layout-alert">
		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
			<strong>Succesfully!</strong> Data is Update!					
		</div>

		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccessKategori">
			<strong>Succesfully!</strong> Data Kategori is Update!
		</div>

		<div class="alert alert-warning alert-dismissible fade show shadow" role="alert" id="alertKategori">
			<strong>Warning!</strong> Kategori is empty!					
		</div>
	</div>

	<div class="card mx-4 my-2 shadow rounded-3 bg-secondary text-light">
		<div class="card-header d-flex justify-content-between">
			<h3>Data Kategori</h3>	

			<div class="form-floating">
				<input type="search" class="form-control bg-secondary text-light" id="qKategori"  autocomplete="off">
				<label>Cari Kategori</label>
			</div>			
		</div>

		<div class="card-body">		
			<div class="row">
				<div class="col">
					<div id="dataNew">

					</div>

					<div id="qdataKategori">

					</div>
				</div>
				<div class="col-4 bg-dark border-start rounded-3 py-2">
					<small>*Create New Kategori</small>
					<div class="row mb-2">
						<div class="form-floating">
							<input type="text" class="form-control bg-secondary text-light" id="kategoriNew">
							<label>Kategori</label>
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
		window.onload = showKategori();
		$("#alertSuccess").hide();
		$("#alertSuccessKategori").hide();
		$("#alertLoading").hide();			
		$("#alertKategori").hide();
		$("#btnKirimNew").hide();		
		$("#dataNew").show();	

		if((screen.width<=1024) && (screen.width<=768)){
	    	document.getElementById("slide").style.display = "none";
	    	document.getElementById("topbar").style.display = "none";	
	    	document.getElementById("contentKategori").style.display = "none";	    	
			$('#alertDevice').modal('show');					
		}

		$("#tutupAlert").click(function(){		
			window.location.href = "<?= base_url('Home')?>";
		});

		function showKategori(){
			$.ajax({
				type: "POST",
				url: "<?= base_url('Home/showKategori');?>",
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

		$("#kategoriNew").keyup(function(){
			if(document.getElementById("kategoriNew").value == ""){
				$("#alertKategori").show();
				setTimeout('$("#alertKategori").hide()',3000);
				$("#btnKirimNew").hide();					
			}
			if(document.getElementById("kategoriNew").value != ""){		
				$("#btnKirimNew").show();					
			}
		});		

		$("#btnKirimNew").click(function(){						
			let formData = new FormData();
	        formData.append('kategori', $('#kategoriNew').val());	        

			if(document.getElementById("kategoriNew").value != ""){
				$.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/updateKategori');?>",
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
						$("#alertKategori").hide();
						
						$("#alertSuccessKategori").show();
						setTimeout('$("#alertSuccessKategori").hide()',3000);						
						document.getElementById("kategoriNew").value = "";
						$("#alertLoading").hide();
						showKategori();				

					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});

				showKategori();
				return false
			}
		});	

		$(document).on('click','.hapusData',function(){
			var idadmin = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "<?= base_url('Home/dKategori'); ?>",
				data: {id: idadmin},
				success:function(){	
					showKategori();
				}
			});		
			return false;
		});

		$(document).on('click','.editData',function(){
			var idadmin = $(this).attr('id');
			$.ajax({
				type: "POST",
				url: "<?= base_url('Home/showUKategori'); ?>",
				data: {id: idadmin},
				dataType: "json",
				success:function(response){	
					$('#ModalEdit').modal('show');
					$("#hasilEdit").html(response.data).show();
					$("#btnKirimEdit").hide();             		
				}
			});
		});

		$(document).on('click','#btnKirimEdit',function(){					
			let formData = new FormData();
	        formData.append('kategori', $('#kategoriEdit').val());
	        formData.append('id', $('#idkategori').val());	        

			if(document.getElementById("kategoriEdit").value != ""){
				$.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/editKategori');?>",
					data: formData,
					cache: false,
		            processData: false,
		            contentType: false,
					dataType: "text",
					success: function(response){
						$('#ModalEdit').modal('hide');											
						$("#alertSuccessKategori").show();
						setTimeout('$("#alertSuccessKategori").hide()',3000);
						showKategori();				
					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});

				showKategori();
				return false
			}
		});

		$(document).on('keyup','#kategoriEdit',function(){
			if(document.getElementById("kategoriEdit").value == ""){				
				$("#btnKirimEdit").hide();					
			}
			if(document.getElementById("kategoriEdit").value != ""){		
				$("#btnKirimEdit").show();					
			}
		});

		$("#qKategori").keyup(function(){
			if(document.getElementById("qKategori").value === "" ){
				$("#dataNew").show();
				$("#qdataKategori").hide();
			}
			if(document.getElementById("qKategori").value === " "){
				$("#dataNew").show();
				$("#qdataKategori").hide();
			}
			if(document.getElementById("qKategori").value != "" && document.getElementById("qKategori").value != " "){
				$("#dataNew").hide();
				$.ajax({
					type: "POST",
					url: "<?= base_url('Home/showQKategori');?>",
					data: {q:$(this).val()},
					dataType: "json",
                    success: function(response){
                        $("#qdataKategori").html(response.data).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
				});	
			}
			
		});

		showKategori();

	});	

</script>
<?= $this->endSection() ?>