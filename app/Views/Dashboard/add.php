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

<div id="contentAddBarang">
	<div id="layout-alert">
		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
			<strong>Succesfully!</strong> Data is Update!					
		</div>

		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccessBarang">
			<strong>Succesfully!</strong> Barang is Publish!
		</div>

		<div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertNamaBarang">
			<strong>Alert!</strong> Nama Barang is empty					
		</div>		

		<div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertKategoriBarang">
			<strong>Alert!</strong> Kategori Barang not selected!					
		</div>

		<div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertHargaBarang">
			<strong>Alert!</strong> Harga Barang is empty!
		</div>

		<div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertStokBarang">
			<strong>Alert!</strong> Stok Barang is empty!
		</div>

		<div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertDeskripsiBarang">
			<strong>Alert!</strong> Deskripsi Barang is empty!
		</div>
	</div>

	<div class="d-flex flex-column p-3">
		<div class="d-flex justify-content-between mb-3">
			<a href="#" onclick="history.back();">
				<img src="<?= base_url('Assets/icon/IcoBack.svg');?>" style="width:4rem; height:3rem;">
			</a>
						
			<button class="btn btn-sm btn-info rounded-3" id="btnKirimBarang">
				<i class="bi bi-send"></i>
				Upload
			</button>		
		</div>
		<div class="row bg-secondary text-light rounded-3 p-2">
			<div class="col d-flex flex-column">
				<div class='form-floating mb-3'>
					<input type='text' id='namaBarang' class='form-control bg-secondary text-light' autocomplete='off'>					
					<input type="hidden" id="idAdmin" value="<?= $user['id']?>">
					<label>Nama Barang</label>
				</div>										
				<textarea id='editor1'></textarea>
			</div>

			<div class='col-3 d-flex flex-column'>
				<div class='form-floating mb-3'>
					<input type='text' id='tanggalBarang' class='form-control bg-secondary text-light' disabled='true' value='<?= date('d M, Y')?>'>
					<label>Tanggal</label>
				</div>
				<div class='form-floating mb-3'>
					<input type='file' id='imageBarang' class='form-control bg-secondary text-light'>
					<label>Foto Barang</label>
				</div>
				<div class='form-floating mb-3'>
					<select class='form-select bg-secondary text-light' id='kategoriBarang'>
						<option value='' selected>--Pilih Kategori</option>
					<?php foreach ($kategori as $k) {?>
						<option value="<?= $k['id']?>"><?= $k['kategori']?></option>
					<?php } ?>
					</select>
					<label>Kategori</label>
				</div>
				<div class='form-floating mb-3'>
					<input type='number' id='stokBarang' class='form-control bg-secondary text-light'>
					<label>Stok</label>
				</div>
				<div class='form-floating mb-3'>
					<input type='number' id='hargaBarang' class='form-control bg-secondary text-light'>
					<label>Harga</label>
				</div>
			</div>
		</div>
	</div>

</div>

<script src="<?= base_url('Assets/js/jquery.3.6.0.min.js') ?>"></script>
<script src="<?= base_url('Assets/js/ckeditor3/ckeditor.js');?>"></script>
<script type="text/javascript">
	CKEDITOR.replace('editor1', 
	{ 				 							
	 	language : "en",
	 	filebrowserUploadUrl: '<?php echo base_url('Home/uploadfile') ?>'
	});

	$(document).ready(function(){
		$("#alertSuccess").hide();
		$("#alertSuccessBarang").hide();
		$("#alertNamaBarang").hide();
		$("#alertKategoriBarang").hide();
		$("#alertDeskripsiBarang").hide();
		$("#alertHargaBarang").hide();
		$("#alertStokBarang").hide();			

		if((screen.width<=1024) && (screen.width<=768)){
		    document.getElementById("slide").style.display = "none";
		    document.getElementById("topbar").style.display = "none";
		    document.getElementById("contentAddBarang").style.display = "none";	    	
			$('#alertDevice').modal('show');					
		}

		$("#tutupAlert").click(function(){		
			window.location.href = "<?= base_url('Home')?>";
		});		

		$("#namaBarang").on('keyup', function(){
			if($(this).val() == ""){
				$("#alertNamaBarang").show();
				setTimeout('$("#alertNamaBarang").hide()',3000);				
			}else{
				$("#alertNamaBarang").hide()
			}
		});

		$("#kategoriBarang").on('change', function(){
			if($(this).val() == ""){
				$("#alertKategoriBarang").show();
				setTimeout('$("#alertKategoriBarang").hide()',3000);				
			}else{
				$("#alertKategoriBarang").hide()
			}
		});

		$("#stokBarang").on('keyup', function(){
			if($(this).val() == ""){
				$("#alertStokBarang").show();
				setTimeout('$("#alertStokBarang").hide()',3000);				
			}else{
				$("#alertStokBarang").hide()
			}
		});

		$("#hargaBarang").on('keyup', function(){
			if($(this).val() == ""){
				$("#alertHargaBarang").show();
				setTimeout('$("#alertHargaBarang").hide()',3000);				
			}else{
				$("#alertHargaBarang").hide()
			}
		});

		$("#btnKirimBarang").on('click',function(){
			var ck = CKEDITOR.instances['editor1'].getData();
			const imageupload = $('#imageBarang').prop('files')[0];
			let formData = new FormData();
	        formData.append('nama', $('#namaBarang').val());
	        formData.append('deskripsi', ck);
	        formData.append('image', imageupload);	        
	        formData.append('id_kategori', $('#kategoriBarang').val());
	        formData.append('id_admin', $('#idAdmin').val());
	        formData.append('stok', $('#stokBarang').val());
	        formData.append('harga', $('#hargaBarang').val());
	        formData.append('create_at', $('#tanggalBarang').val());	        

			if(document.getElementById("namaBarang").value == ""){
				$("#alertNamaBarang").show();
				setTimeout('$("#alertNamaBarang").hide()',3000);
			}

			if(document.getElementById("kategoriBarang").value == ""){
				$("#alertKategoriBarang").show();
				setTimeout('$("#alertKategoriBarang").hide()',3000);
			}

			if(document.getElementById("stokBarang").value == ""){
				$("#alertStokBarang").show();
				setTimeout('$("#alertStokBarang").hide()',3000);
			}

			if(document.getElementById("hargaBarang").value == ""){
				$("#alertHargaBarang").show();
				setTimeout('$("#alertHargaBarang").hide()',3000);
			}

			if(ck == ""){				
				$("#alertDeskripsiBarang").show();
				setTimeout('$("#alertDeskripsiBarang").hide()',3000);					
			}

			if(document.getElementById("namaBarang").value != "" && document.getElementById("kategoriBarang").value != "" && ck != "" && document.getElementById("stokBarang").value != "" && document.getElementById("hargaBarang").value != ""){
				$.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/uploadBarang');?>",
					data: formData,
					cache: false,
			        processData: false,
			        contentType: false,
					dataType: "text",
					success: function(response){
						$("#alertSuccessBarang").show();
						setTimeout('$("#alertSuccessBarang").hide()',3000);
						$("#alertNamaBarang").hide();
						$("#alertKategoriBarang").hide();
						$("#alertDeskripsiBarang").hide();
						$("#alertStokBarang").hide();
						$("#alertHargaBarang").hide();
						document.getElementById("namaBarang").value = "";
						document.getElementById("kategoriBarang").value = "";						
						document.getElementById("stokBarang").value = "";
						document.getElementById("hargaBarang").value = "";
						setTimeout('window.location.href = "<?= base_url('Home/barang')?>"',1500);		
					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});
			}
		});
		
	});
	

	
</script>
<?= $this->endSection() ?>