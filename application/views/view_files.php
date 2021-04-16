<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Crud Operations</title>

	<?php include_once 'template/index.html'?>
	<style>
		.error{
			color: red;
			margin-left: -67%;
		}
	</style>
</head>
<body>
<?php include_once 'template/header.php' ?>
<div class="container pt-5 pb-5">
	<div class="row">
		<div class="col-md-12">
			<!-- Card -->
			<!-- Card -->
			<div class="card card-cascade wider">

				<!-- Card image -->
				<div class="view view-cascade gradient-card-header blue-gradient">

					<!-- Title -->
					<h2 class="card-header-title mb-3">Download Documents</h2>
					<!-- Text -->
					<p class="mb-0"><i class="fas fa-calendar mr-2"></i><?php echo date('yy-m-d')?></p>

				</div>

				<!-- Card content -->
				<div class="card-body card-body-cascade text-center">

					<!-- Text -->
					<p class="card-text">Click on download button to download file
					</p>
					<!-- Link -->

					<table class="table" id="employee_table">
						<thead class="grey lighten-2">
						<tr>
							<th scope="col">Employee Id</th>
							<th scope="col">File Name</th>
							<th scope="col">Action</th>

						</tr>
						</thead>
						<tbody>
						<tr>
							<th scope="row">Emp_101</th>
							<th scope="row">Dcoument_1.pdf</th>
							<td><a class="btn-floating btn-danger" href="Dcoument_1.pdf" download><i class="fas fa-download"></i></a></td>

						<tr>
							<th scope="row">Emp_101</th>
							<th scope="row">Dcoument_2.pdf</th>
							<td><a class="btn-floating btn-danger" href="Dcoument_1.pdf" download ><i class="fas fa-download"></i></a></td>

						</tr>
						<tr>
							<th scope="row">Emp_101</th>
							<th scope="row">Dcoument_3.pdf</th>
							<td><a class="btn-floating btn-danger"href="Dcoument_1.pdf" download><i class="fas fa-download"></i></a></td>

						</tr>
						<tr>
							<th scope="row">Emp_101</th>
							<th scope="row">Dcoument_4.pdf</th>
							<td><a class="btn-floating btn-danger" href="Dcoument_1.pdf" download><i class="fas fa-download"></i></a></td>
						</tr>
						<tr>
							<th scope="row">Emp_101</th>
							<th scope="row">Dcoument_5.pdf</th>
							<td><a class="btn-floating btn-danger" href="Dcoument_1.pdf" download><i class="fas fa-download"></i></a></td>
						</tr>

						</tbody>
					</table>

				</div>
				<!-- Card content -->

			</div>
			<!-- Card -->
			<!-- Card -->
		</div>
	</div>
</div>

<?php include_once 'template/footer.php' ?>



</body>
<script>
	var openAddDataModal=()=>{
		$('#addDataModal').modal('show');
	}

	$(document).ready(()=>{
		$(document).ready( function () {
			$('#employee_table').DataTable();
		} );
		$("#addEmployeeData").validate({
			rules: {
				name: {
					required: true
				},
				email: {
					required: true
				},
				mobile: {
					required: true
				},
				address: {
					required: true
				},
				dob: {
					required: true
				},
			},

			errorElement: "span",
			submitHandler: function (form) {
				let data=document.getElementById('addEmployeeData');
				let formData=new FormData(data);
				console.log(formData);
				$.ajax({
					url: '<?= base_url("add_emp_data") ?>',
					type: "POST",
					data: formData,
					cache : false,
					processData: false,
					contentType: false,
					dataType:'json',
					success: function (sucess) {
						if (sucess.status == 200) {
							alert("Data Inserted");
							$('#addEmployeeData').trigger('reset');
						} else {
							$('#addEmployeeData').trigger('reset');
						}
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		});
	});
</script>
</html>
