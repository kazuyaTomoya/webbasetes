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

<div id="contentEditBarang">
	<div id="layout-alert">
		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
			<strong>Succesfully!</strong> Data is Update!					
		</div>

		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccessBarang">
			<strong>Succesfully!</strong> Barang is Update!
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
						
			<button class="btn btn-sm btn-success rounded-3" id="btnKirimBarangEdit">
				<i class="bi bi-send"></i>
				Update
			</button>		
		</div>
		<div class="row bg-secondary text-light rounded-3 p-2">
			<div class="col d-flex flex-column">
				<div class='form-floating mb-3'>
					<input type='text' id='namaBarangEdit' class='form-control bg-secondary text-light' autocomplete='off' value="<?= $data['nama']?>">					
					<input type="hidden" id="idAdminEdit" value="<?= $data['id_admin']?>">
					<input type="hidden" id="idBarang" value="<?= $data['id']?>">
					<label>Nama Barang</label>
				</div>										
				<textarea id='editor1'><?= $data['deskripsi']?></textarea>
			</div>

			<div class='col-3 d-flex flex-column'>
				<div class='form-floating mb-3'>
					<input type='text' id='tanggalBarangEdit' class='form-control bg-secondary text-light' disabled='true' value='<?= date("d M, Y",strtotime($data['create_at'])) ?>'>
					<label>Tanggal</label>
				</div>
				<div class='form-floating mb-3'>
					<?php if(!empty($data['image'])){?>
						<img src="<?= base_url('Assets/images/'.$data['image'].'')?>" style="width: 100%; height:10rem;" id="imageBarang">
						<input type="hidden" id="namaImageBarang" value="<?= $data['image']?>">
					<?php } ?>
					<input type='file' id='imageBarangEdit' class='form-control bg-secondary text-light'>
					<label>Foto Barang</label>
				</div>
				<div class='form-floating mb-3'>
					<select class='form-select bg-secondary text-light' id='kategoriBarangEdit'>
						<option value='<?= $data['id_kategori']?>' selected><?= $modelsK->getKategoriRow($data['id_kategori'])?></option>
					<?php foreach ($kategori as $k) {?>
						<option value="<?= $k['id']?>"><?= $k['kategori']?></option>
					<?php } ?>
					</select>
					<label>Kategori</label>
				</div>
				<div class='form-floating mb-3'>
					<input type='number' id='stokBarangEdit' class='form-control bg-secondary text-light' value="<?= $data['stok']?>">
					<label>Stok</label>
				</div>
				<div class='form-floating mb-3'>
					<input type='number' id='hargaBarangEdit' class='form-control bg-secondary text-light' value="<?= $data['harga']?>">
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
		    document.getElementById("contentEditBarang").style.display = "none";	    	
			$('#alertDevice').modal('show');					
		}

		$("#tutupAlert").click(function(){		
			window.location.href = "<?= base_url('Home')?>";
		});		

		$("#namaBarangEdit").on('keyup', function(){
			if($(this).val() == ""){
				$("#alertNamaBarang").show();
				setTimeout('$("#alertNamaBarang").hide()',3000);				
			}else{
				$("#alertNamaBarang").hide()
			}
		});

		$("#kategoriBarangEdit").on('change', function(){
			if($(this).val() == ""){
				$("#alertKategoriBarang").show();
				setTimeout('$("#alertKategoriBarang").hide()',3000);				
			}else{
				$("#alertKategoriBarang").hide()
			}
		});

		$("#stokBarangEdit").on('keyup', function(){
			if($(this).val() == ""){
				$("#alertStokBarang").show();
				setTimeout('$("#alertStokBarang").hide()',3000);				
			}else{
				$("#alertStokBarang").hide()
			}
		});

		$("#hargaBarangEdit").on('keyup', function(){
			if($(this).val() == ""){
				$("#alertHargaBarang").show();
				setTimeout('$("#alertHargaBarang").hide()',3000);				
			}else{
				$("#alertHargaBarang").hide()
			}
		});

		$("#btnKirimBarangEdit").on('click',function(){
			var ck = CKEDITOR.instances['editor1'].getData();
			const imageupload = $('#imageBarangEdit').prop('files')[0];
			let formData = new FormData();
	        formData.append('nama', $('#namaBarangEdit').val());
	        formData.append('deskripsi', ck);
	        formData.append('image', imageupload);        
	        formData.append('image_lama', $('#imageBarang').src);
	        formData.append('nama_image_lama', $('#namaImageBarang').val());
	        formData.append('id_kategori', $('#kategoriBarangEdit').val());
	        formData.append('id', $('#idBarang').val());
	        formData.append('stok', $('#stokBarangEdit').val());
	        formData.append('harga', $('#hargaBarangEdit').val());	        	       

			if(document.getElementById("namaBarangEdit").value == ""){
				$("#alertNamaBarang").show();
				setTimeout('$("#alertNamaBarang").hide()',3000);
			}

			if(document.getElementById("kategoriBarangEdit").value == ""){
				$("#alertKategoriBarang").show();
				setTimeout('$("#alertKategoriBarang").hide()',3000);
			}

			if(document.getElementById("stokBarangEdit").value == ""){
				$("#alertStokBarang").show();
				setTimeout('$("#alertStokBarang").hide()',3000);
			}

			if(document.getElementById("hargaBarangEdit").value == ""){
				$("#alertHargaBarang").show();
				setTimeout('$("#alertHargaBarang").hide()',3000);
			}

			if(ck == ""){				
				$("#alertDeskripsiBarang").show();
				setTimeout('$("#alertDeskripsiBarang").hide()',3000);					
			}

			if(document.getElementById("namaBarangEdit").value != "" && document.getElementById("kategoriBarangEdit").value != "" && ck != "" && document.getElementById("stokBarangEdit").value != "" && document.getElementById("hargaBarangEdit").value != ""){
				$.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/updateBarang');?>",
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
						document.getElementById("namaBarangEdit").value = "";
						document.getElementById("kategoriBarangEdit").value = "";						
						document.getElementById("stokBarangEdit").value = "";
						document.getElementById("hargaBarangEdit").value = "";
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