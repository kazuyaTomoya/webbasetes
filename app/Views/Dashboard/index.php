<?= $this->extend('template') ?>
<?= $this->section('content') ?>
	<style type="text/css">
		#layout-alert{
            position: absolute; top: 0; right: 0; margin: 2rem; z-index: 2;         
        }
        #imageLogo{
			max-width: 15rem; max-height: 5rem; padding: 0.5rem; border: solid 1px black; border-radius: 5px;
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

	<div class="modal fade" id="previewLogo">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
				    <h5 class="modal-title">Preview</h5>
				    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				    <center>
				        <img src="" id="preview" class="img-fluid">
				    </center>		       
				</div>
				<div class="modal-footer">
				    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal" id="tutupModal">Tutup</button>		        	
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div id="layout-alert">
			<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
				<strong>Succesfully!</strong> Data is Update! (!Refresh page to see the changes)
			</div>
		</div>

		<div id="dashboardPage">
			<div class="card m-2 shadow bg-secondary text-light">
				<div class="card-header">
					<small class="m-1">Setting Logo, Label, Icon</small>
				</div>			
				<div class="card-body p-1 d-block w-100">
					<div class="d-flex justify-content-start">
						<div class="card m-1 shadow-sm bg-secondary text-light">					
							<div class="card-body">
								<small>*Logo (800x200)</small>
								<center>
									<img src="<?= base_url('Assets/logo/'.$beranda['logo'].'');?>" id="imageLogo">
								</center>
								<input type="file" name="image" class="form-control my-2 bg-secondary text-light" disabled="true" id="upload">
								<p style="font-size:0.73rem; line-height: 0.9rem; color: darkblue;">*Muncul pada setiap logo di halaman user dan menu admin (Maximize).</p>
							</div>
							<div class="card-footer d-flex justify-content-between">
								<button class="btn btn-sm mx-1 btn-success" id="editImg">EDIT</button>
								<button class="btn btn-sm mx-1 btn-danger" id="batalImg">BATAL</button>
								<button class="btn btn-sm mx-1 btn-primary" id="saveImg">SAVE</button>
							</div>					
						</div>

						<div class="card m-1 shadow-sm bg-secondary text-light">					
							<div class="card-body">
								<small>*Logo (64x64)</small>
								<center>
									<img src="<?= base_url('Assets/logo/'.$beranda['logo_kecil'].'');?>" id="imageLogo">
								</center>
								<input type="file" name="image" class="form-control my-2 bg-secondary text-light" disabled="true" id="upload2">
								<p style="font-size:0.73rem; line-height: 0.9rem; color: darkblue;">*Muncul pada bagian logo menu admin (Minimize).</p>
							</div>
							<div class="card-footer d-flex justify-content-between">
								<button class="btn btn-sm mx-1 btn-success" id="editImg2">EDIT</button>
								<button class="btn btn-sm mx-1 btn-danger" id="batalImg2">BATAL</button>
								<button class="btn btn-sm mx-1 btn-primary" id="saveImg2">SAVE</button>
							</div>					
						</div>

						<div class="card m-1 shadow-sm bg-secondary text-light">					
							<div class="card-body">
								<small>*Fav Icon</small>
								<center>
									<img src="<?= base_url('Assets/logo/'.$beranda['icon_fav'].'');?>" id="imageLogo">
								</center>
								<input type="file" name="image" class="form-control my-2 bg-secondary text-light" disabled="true" id="upload3">
								<p style="font-size:0.73rem; line-height: 0.9rem; color: darkblue;">*Muncul pada bagian address bar dan merupakan logo dari laman web.</p>
							</div>
							<div class="card-footer d-flex justify-content-between">
								<button class="btn btn-sm mx-1 btn-success" id="editImg3">EDIT</button>
								<button class="btn btn-sm mx-1 btn-danger" id="batalImg3">BATAL</button>
								<button class="btn btn-sm mx-1 btn-primary" id="saveImg3">SAVE</button>
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
			$("#alertSuccess").hide();
			$("#saveImg").hide();
			$("#batalImg").hide();
			$("#saveImg2").hide();
			$("#batalImg2").hide();
			$("#saveImg3").hide();
			$("#batalImg3").hide();

			if((screen.width<=1024) && (screen.width<=768)){
		    	document.getElementById("slide").style.display = "none";
		    	document.getElementById("topbar").style.display = "none";
		    	document.getElementById("content").style.display = "none";
				$('#alertDevice').modal('show');					
			}

			$("#tutupAlert").click(function(){		
				window.location.href = "<?= base_url('Home')?>";
			});

			$("#tutupModal").click(function(){
				if($('#upload').disabled === false){
					$("#saveImg").show();
					$("#saveImg2").hide();	
					$("#saveImg3").hide();	
				}			
				
				if($('#upload2').disabled === false){
					$("#saveImg").hide();
					$("#saveImg2").show();
					$("#saveImg3").hide();	
				}

				if($('#upload3').disabled === false){
					$("#saveImg").hide();
					$("#saveImg2").hide();
					$("#saveImg3").show();	
				}
				
			});

			$("#editImg").click(function(){
				$('#upload').prop('disabled', false);
				
				$("#batalImg").show();
				$("#editImg").hide();
			});

			$("#batalImg").click(function(){
				$('#upload').prop('disabled', true);		

				$("#saveImg").hide();
				$("#batalImg").hide();
				$("#editImg").show();
			});

			$("#saveImg").click(function(){
				const fileupload = $('#upload').prop('files')[0];			
				let formData = new FormData();
		        formData.append('image', fileupload);		        

		        $.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/updateLogo1');?>",
					data: formData,
					cache: false,
			        processData: false,
			       	contentType: false,
					dataType: "text",
					success: function(response){
						$("#alertSuccess").show();
						setTimeout('$("#alertSuccess").hide()',5000);						
						$('#upload').prop('disabled', true);
						$("#saveImg").hide();
						$("#batalImg").hide();
						$("#editImg").show();
						document.getElementById('upload').value	 = "";						
					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});
			});

			$("#editImg2").click(function(){
				$('#upload2').prop('disabled', false);
				
				$("#batalImg2").show();
				$("#editImg2").hide();
			});

			$("#batalImg2").click(function(){
				$('#upload2').prop('disabled', true);		

				$("#saveImg2").hide();
				$("#batalImg2").hide();
				$("#editImg2").show();
			});

			$("#saveImg2").click(function(){
				const fileupload = $('#upload2').prop('files')[0];			
				let formData = new FormData();
		        formData.append('image', fileupload);		        

		        $.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/updateLogo2');?>",
					data: formData,
					cache: false,
			        processData: false,
			       	contentType: false,
					dataType: "text",
					success: function(response){
						$("#alertSuccess").show();
						setTimeout('$("#alertSuccess").hide()',5000);						
						$('#upload2').prop('disabled', true);
						$("#saveImg2").hide();
						$("#batalImg2").hide();
						$("#editImg2").show();
						document.getElementById('upload2').value	 = "";						
					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});
			});

			$("#editImg3").click(function(){
				$('#upload3').prop('disabled', false);
				
				$("#batalImg3").show();
				$("#editImg3").hide();
			});

			$("#batalImg3").click(function(){
				$('#upload3').prop('disabled', true);		

				$("#saveImg3").hide();
				$("#batalImg3").hide();
				$("#editImg3").show();
			});

			$("#saveImg3").click(function(){
				const fileupload = $('#upload3').prop('files')[0];			
				let formData = new FormData();
		        formData.append('image', fileupload);		        

		        $.ajax({
					type: "POST", //Method pengiriman data
					url: "<?= base_url('Home/updateLogo3');?>",
					data: formData,
					cache: false,
			        processData: false,
			       	contentType: false,
					dataType: "text",
					success: function(response){
						$("#alertSuccess").show();
						setTimeout('$("#alertSuccess").hide()',5000);						
						$('#upload3').prop('disabled', true);
						$("#saveImg3").hide();
						$("#batalImg3").hide();
						$("#editImg3").show();
						document.getElementById('upload3').value	 = "";						
					},
					error: function(xhr, ajaxOptions, thrownError){
						alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
					}
				});
			});

			$("#upload").change(function() {
				var reader = new FileReader();
				var image = document.getElementById("upload");
				var prev = document.getElementById("preview");

				reader.onload = function (e) {
					prev.src=e.target.result;
				}    

				reader.readAsDataURL(image.files[0]);			
				$('#previewLogo').modal('show');
				$("#saveImg").show();
			});

			$("#upload2").change(function() {
				var reader = new FileReader();
				var image = document.getElementById("upload2");
				var prev = document.getElementById("preview");

				reader.onload = function (e) {
					prev.src=e.target.result;
				}    

				reader.readAsDataURL(image.files[0]);
				$('#previewLogo').modal('show');
				$("#saveImg2").show();
			});

			$("#upload3").change(function() {
				var reader = new FileReader();
				var image = document.getElementById("upload3");
				var prev = document.getElementById("preview");

				reader.onload = function (e) {
					prev.src=e.target.result;
				}    

				reader.readAsDataURL(image.files[0]);
				$('#previewLogo').modal('show');
				$("#saveImg3").show();
			});
		});
	</script>
	
<?= $this->endSection() ?>