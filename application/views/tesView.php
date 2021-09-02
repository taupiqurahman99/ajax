<!DOCTYPE html>
<html>
<head>
	<title>Insert Data dengan ajax #1</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="<?php echo base_url() ?>assets/swal/dist/sweetalert2.js" type="text/javascript"></script>
<link href="<?php echo base_url() ?>assets/swal/dist/sweetalert2.css" rel="stylesheet" type="text/css"/>


<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div id="success"></div>
		<h2 class="text-center">Data Penawaran Layanan Produk</h2>
		<div class="text-center">
		<img src="logo.png">
	</div>
	<br>
		
		<div class="row">
				
				<div class="form-group">
					<label>Nama Perusahaan:</label>
					<div class="col-sm-10">
					<input type="text" name="name" id="name" class="form-control" required="required">
				</div>
				</div>
				<div class="form-group">
					<label>Telp:</label>
					<div class="col-sm-10">
					<input type="text" name="mobile" id="mobile" class="form-control" required="required">
				</div>
				</div>
				<div class="form-group">
					<label>Email:</label>
					<div class="col-sm-10">
					<input type="text" name="email" id="email" class="form-control" required="required">
				</div>
				</div>
				<div class="form-group">
					<label>Alamat:</label>
					<div class="col-sm-10">
					<input type="text" name="alamat" id="alamat" class="form-control" required="required">
					<input type="hidden" name="single" id="single">
				</div>
				</div>
				<div class="form-group">
					<label>Status Email:</label>
					<div class="col-sm-10">
					<input type="text" name="status_email" id="status_email" class="form-control" required="required">
					<input type="hidden" name="single" id="single">
				</div>
				</div>

				<div class="form-group">
					<label>Status Telp:</label>
					<div class="col-sm-10">
					<input type="text" name="status_telp" id="status_telp" class="form-control" required="required">
					<input type="hidden" name="single" id="single">
				</div>
				</div>
				<div class="form-group">
					<label>Status Penawaran</label>
					<div class="col-sm-10">
					<input type="text" name="status_pemesanan" id="status_pemesanan" class="form-control" required="required">
					<input type="hidden" name="single" id="single">
				</div>
				</div>
				<br>
				<br>
				<div class="col-sm-4">
					<br>
				<button class="btn btn-success form-control" type="submit" id="submit" value="submit">Simpan</button>

			</div>
			</div>
			<div class="col-sm-3" class="form-control">
		</div>
		<br>
		<div class="row container custom-control">
			<div id="showData">
			
			</div>
			<p>AS</p>
			<div id="productData">
				
			</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#submit').click(function(){
				var submit = $(this).val();
				var singleID = $('#single').val();
				var name = $('#name').val();
				var mobile = $('#mobile').val();
				var email = $('#email').val();
				var alamat = $('#alamat').val();
				var status_email = $('#status_email').val();
				var status_telp = $('#status_telp').val();
				var status_pemesanan = $('#status_pemesanan').val();

				$.ajax({
					url: "<?php echo base_url() ?>Test/insertData",
					method: "post",
					data : {submit: submit, singleID: singleID, name: name, mobile:mobile, email:email, alamat:alamat, status_email:status_email, status_telp:status_telp, status_pemesanan:status_pemesanan},
					success: function(data){
						$('#name').val("");
						$('#mobile').val("");
						$('#email').val("");
						$('#alamat').val("");
						$('#status_email').val("");
						$('#status_telp').val("");
						$('#status_pemesanan').val("");


						$('#success').addClass("alert alert-success");
						if($('#submit').val() == "submit")
						{
							$('#success').text("Data berhasil ditambahkan");
							
						
						}
						else
						{
							$('#success').text("Data berhasil diperbaharui");	
						}	
						$('#submit').addClass("btn btn-success");
						$('#showData').show();
						getData();
					}
				});
			});
			function getDataProduct(){

					$.ajax({
					url:"http://localhost:8080/product",
					method:"GET",
					dataType:"json",
            		crossDomain: true,
					success:function(data)
					{

						var html='';
						var i;
						var count= 1;
						html+='<ul>';

						Object.values(data.data).forEach((value)=>{
								html+='<li> Code :'+value.Code+'</li>'
								+'<li> Price :'+value.Price+'</li>';
						})
					
						html+='</ul>';
						$('#productData').html(html);
					}
				});
			}

			getDataProduct()
			getData();
			function getData()
			{
				$.ajax({
					url:"<?php echo base_url(); ?>Test/getData",
					method:"GET",
					dataType:"json",
					success:function(data)
					{
						var html='';
						var i;
						var count= 1;
						html+='<table class="table table-striped"><tr><th>Nama</th><th>Telp</th><th>Email</th><th>Alamat</th><th>Status Email</th><th>Status Telp</th><th>Status Penawaran</th><th>Aksi</th></tr>';
						for(i in data){

							html+='<tr><td>'+data[i].name+'</td><td>'+data[i].mobile+'</td><td>'+data[i].email+'</td><td>'+data[i].alamat+'</td><td>'+data[i].status_email+'</td><td>'+data[i].status_telp+'</td><td>'+data[i].status_pemesanan+'</td><td><button type="button" class="btn btn-success delete" id='+data[i].id+'>Delete</button>&nbsp;<button type="button" class="btn btn-success edit" id='+data[i].id+'>Edit</button></td></tr>';
						}
						html+='</table>';
						$('#showData').html(html);
					}
				});
			}

			$(document).on('click','.delete', function(){
					var delId = $(this).attr("id");
					if(confirm("Are you sure delete this record if yes then click'ok'"))
					{
					$.ajax({
						url:"<?php echo base_url(); ?>Test/deleteUserData",
						method:"post",
						data:{delId: delId},
						success:function(data){
							$('#success').addClass("alert-success");
							$('#success').text("Data Berhasil Dihapus");
							$('#success').fadeOut(3000);
							getData();
						}
					});
				}
				else
				{
					return false;
				}
			});
			$(document).on('click', '.edit', function(){
				var eID = $(this).attr("id");
				$.ajax({
					url:"<?php echo base_url(); ?>Test/fetchSingleData",
					method:"post",
					data:{eID: eID},
					dataType:"json",
					success:function(data){
						var i;
						for(i in data)
						{
							$('#name').val(data[i].name);
							$('#mobile').val(data[i].mobile);
							$('#email').val(data[i].email);
							$('#alamat').val(data[i].alamat);
							$('#status_email').val(data[i].status_email);
							$('#status_telp').val(data[i].status_telp);
							$('#alamat').val(data[i].status_pemesanan);
						}
						$('#single').val(eID);
						$('#submit').text("Update");
						$('#submit').val("update");
						$('#showData').hide();
						
					}
				});
			});
		});
	</script>

</body>
</html>  