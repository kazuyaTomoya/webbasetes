<?= $this->extend('template') ?>

<?= $this->section('content') ?>
	<style type="text/css">

		.pagination_link{
			background: darkgray;
			color: black;
			cursor: pointer;
		}
		.pagination_link:hover{
			background: skyblue;
			color: black;
		}

		.active_pagination{
			background: skyblue;
			color: black;
			cursor: pointer;			
		}

		#layout-alert{
			position: absolute;
			top: 0;
			right: 0;
			margin: 2rem;
			z-index: 2;			
		}

		#dataQuery:hover::-webkit-scrollbar, #dataRekomendasi:hover::-webkit-scrollbar, #dataHeadline:hover::-webkit-scrollbar{
    		display: block;    		
    	}

    	#dataQuery:hover::-webkit-scrollbar-track, #dataRekomendasi:hover::-webkit-scrollbar-track, #dataHeadline:hover::-webkit-scrollbar-track{
    		background-color:transparent;
    	}

    	#dataQuery:hover::-webkit-scrollbar-thumb, #dataRekomendasi:hover::-webkit-scrollbar-thumb, #dataHeadline:hover::-webkit-scrollbar-thumb{
    		background-color:white;
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

	<div class="modal fade" id="ModalDetail">
        <div class="modal-dialog modal-dialog-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnCloseEdit"></button>
                </div>
                <div class="modal-body">                    
                    <div id="hasilDetail">
                        
                    </div>              
                </div>
            </div>
        </div>
    </div>

	<div id="print">
		
	</div>
	
<div id="contentBarang">
	<div id="layout-alert">
		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccess">
			<strong>Succesfully!</strong> Data is Update!					
		</div>

		<div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alertSuccessBarang">
			<strong>Succesfully!</strong> Data Barang is Update!					
		</div>

		<div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alertIdBarang">
			<strong>Alert!</strong> Barang is empty!					
		</div>		
	</div>

	<div class="row p-0 m-0">
		<div class="col py-2 d-flex justify-content-start">			
			<button type="button" class="btn btn-primary" id="newBarang">New Product</button>
			<?php if(!empty($data)){?>
				<button type="button" class="btn btn-danger mx-2" id="printBarang">
					<i class="bi bi-file-earmark-pdf"></i> Print
				</button>
			<?php }?>			

			<small class="border border-light border-3 rounded-3 p-2 text-light ms-2">All Product: <?= number_format($count,0,',','.')?></small>
		</div>

		<div class="col px-1">
			<div class="form-floating">
				<input type="search" class="form-control bg-secondary text-light" id="q" autocomplete="off">
				<label>Cari Barang</label>
			</div>
		</div>
	</div>

    <div class="mb-3 mt-1">
    	<?php if(!empty($data)){?>
    	<div id="barang">
    		
    	</div>
    	<?php } else{?>
    		<div class="card m-1 p-1 bg-danger shadow-sm">
    			<h6>Belum Ada Barang</h6>
    		</div>
    	<?php } ?>
    </div>

    <div class="my-4" id="cari">
    	
    </div>	
</div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
	<script src="<?= base_url('Assets/js/jquery.3.6.0.min.js') ?>"></script>
 	<script type="text/javascript">
 		$(document).ready(function(){
 			$("#alertSuccess").hide();
 			$("#alertSuccessBarang").hide(); 			
 			$("#alertIdBarang").hide();
			var select = 4;

			if((screen.width<=1024) && (screen.width<=768)){
		    	document.getElementById("slide").style.display = "none";
		    	document.getElementById("topbar").style.display = "none";
		    	document.getElementById("contentBarang").style.display = "none";	    	
				$('#alertDevice').modal('show');					
			}

			$("#tutupAlert").click(function(){		
				window.location.href = "<?= base_url('Home')?>";
			});
			
			function tampildata(jum,page){
				$.ajax({
					type: "POST",
					url: "<?= base_url('Home/showBarang');?>",
					data: {jumlah:jum, page:page},
					dataType: "json",
					beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        $("#barang").html(response.data).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
				});
			};

			$(document).on('click','.pagination_link', function(){
				var page = $(this).attr("id");
				var jum = select;
				tampildata(jum,page)
			});

			$(document).on('click','.hapusBarang',function(){
				var idadmin = $(this).attr('id');
				var hal = $("#halBarang").val();
				$.ajax({
					type: "POST",
					url: "<?= base_url('Home/dBarang'); ?>",
					data: {id: idadmin},
					success:function(){	
						$("#alertSuccess").show();
						setTimeout('$("#alertSuccess").hide()',3000);
						tampildata(4,hal);
					}
				});		
				return false;
			});

			$(document).on('click','.lihatBarang',function(){
				var idadmin = $(this).attr('id');
				$.ajax({
					type: "POST",
					url: "<?= base_url('Home/showDBarang'); ?>",
					data: {id: idadmin},
					dataType: "json",
					success:function(response){	
						$('#ModalDetail').modal('show');
						$("#hasilDetail").html(response.data).show();						
					}
				});
			});

			$(document).on('click','.editBarang',function(){
				var id = $(this).attr('id');
				window.location.href = "<?= base_url('Home/editBarang/')?>/"+id;
			});

			tampildata(4,'');										
		});

		$("#q").keyup(function(){
			if(($(this).val() == '') || ($("#q").val() == null) ){
				$("#barang").show();
				$("#cari").hide();
			}else{
				$("#barang").hide();				
				$.ajax({
					type: "POST",
					url: "<?= base_url('Home/showQBarang');?>",
					data: {q:$(this).val()},
					dataType: "json",
					beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        $("#cari").html(response.data).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
				});	
			}
			
		});

		$("#newBarang").click(function(){		
			window.location.href = "<?= base_url('Home/addBarang')?>";
		});	

		$("#printBarang").click(function(){
			$.ajax({
				type: "POST",
				url: "<?= base_url('Home/showPBarang');?>",				
				dataType: "json",
                success: function(response){
                    $("#print").html(response.data).show();
                    var element = document.getElementById('print');
                    element.style.width = '700px';
			        element.style.height = '900px';
			        var opt = {
			            margin:       0.5,
			            filename:     'Data Barang.pdf',
			            image:        { type: 'jpeg', quality: 1 },
			            html2canvas:  { scale: 1 },
			            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait',precision: '12' }
			        };			       
			        html2pdf().set(opt).from(element).save();
			        setTimeout('$("#print").hide()',500);			        
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
			});	
		});	
 	</script>

<?= $this->endSection() ?>
