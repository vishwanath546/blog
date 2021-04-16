
<?php $this->load->view('template/header.php'); ?>
<div class="container-fluid pt-5 pb-5">
	<div class="row">
		<div class="col-md-1">

		</div>
		<div class="col-md-10">
			<!-- Card -->
			<!-- Card -->
			<div class="card card-cascade">

				<!-- Card image -->
				<div class="view view-cascade gradient-card-header red">
<div class="row">
	<div class="col-md-6">
		<h2 class="card-header-title mb-3">Blog Details</h2>
	</div>
	<div class="col-md-6">
		<a type="button" class="btn-floating teal mt-1 mb-0" data-toggle="modal" data-target="#modalContactForm"><i class="fas fa-plus animated  infinite" aria-hidden="true"></i></a>
	</div>
</div>


				</div>


				<div class="card-body card-body-cascade text-center pt-2">


					<table class="table" id="blog_table">
						<thead class="grey lighten-2">
						<tr>
							<th scope="col"> Id</th>
							<th scope="col"> Title</th>
							<th scope="col"> Category</th>
							<th scope="col"> Created</th>
							<th scope="col"> Description</th>
							<th scope="col">Action</th>
						</tr>
						</thead>
						<tbody id="blog_body">
						</tbody>
					</table>

				</div>
				<!-- Card content -->

			</div>
			<!-- Card -->
			<!-- Card -->
		</div>
		<div class="col-md-1">

		</div>
	</div>
</div>


<!---create blog modal--->
<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="add_post" name="add_post" method="post">
			<input type="hidden" id="id" name="id">
			<input type="hidden" id="pre_image" name="pre_image">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Post New Blog</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body mx-3">
				<div class="md-form mb-5">
					<i class="fas fa-text-width prefix grey-text"></i>
					<input type="text" id="title" name="title" class="form-control validate" placeholder="Blog Title" style="margin-bottom: 5px">

				</div>

				<div class="md-form mb-5">
					<i class="fas fa-filter prefix grey-text"></i>
					<input type="text" id="category" name="category" class="form-control validate" placeholder="Blog Category" style="margin-bottom: 5px">

				</div>


				<div class="md-form">
					<i class="fas fa-comment prefix grey-text"></i>
					<textarea type="text" id="description" name="description" class="md-textarea form-control" style="margin-bottom: 5px" rows="4" placeholder="Description"></textarea>

				</div>

				<div class="input-group">

					<input type="file" class="form-controll" id="userfile"
						  name="userfile" >

				</div>

			</div>
			<div class="modal-footer d-flex justify-content-center">
				<button class="btn btn-danger"><i class="fas fa-paper-plane mr-2"></i>Post</button>
			</div>
		</div>
		</form>
	</div>
</div>
<?php $this->load->view('template/footer.php'); ?>
<script>


	$(document).ready(()=>{

		getAllBlogs();
		$("#add_post").validate({
			rules: {
				title: {
					required: true
				},
				category: {
					required: true
				},
				description: {
					required: true
				},
				userfile: {
					required: true
				},
			},
			messages: {
				title: {
					required: "Please Enter Title",
				},

				category: {
					required: "Please Enter Category",
				},
				description: {
					required: "Please Enter Description",
				},
				userfile: {
					required: "Please Select File",
				}

			},
			errorElement: 'span',
			submitHandler: function (form) {
				let data=document.getElementById('add_post');
				let formData=new FormData(data);
				$.ajax({
					url: '<?= base_url("add_blog") ?>',
					type: "POST",
					data: formData,
					cache : false,
					processData: false,
					contentType: false,
					dataType:'json',
					success: function (sucess) {
						if (sucess.status == 200) {
							$('#modalContactForm').modal('hide');
							getAllBlogs();
							toastr.success(sucess.body);
							$('#add_post').trigger('reset');
						} else {
							getAllBlogs();
							toastr.error(sucess.body);
							$('#modalContactForm').modal('hide');
							$('#add_post').trigger('reset');
						}
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		});
	});

	function getAllBlogs() {
		$.ajax({
			url: '<?= base_url("get_blog_for_admin") ?>',
			type: "POST",
			dataType:'json',
			success: function (sucess) {
				$('#blog_body').empty();
				if (sucess.status == 200) {
					var data=sucess.body;

						$('#blog_body').append(data);
					$('#blog_table').DataTable();

				} else {

				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	}

	function getAllBlogsById(id) {
		$.ajax({
			url: '<?= base_url("get_blog_by_id") ?>',
			type: "POST",
			data:{id:id},
			dataType:'json',
			success: function (sucess) {

				var validator = $("#add_post").validate();
				validator.resetForm();
				document.getElementById("add_post").reset();
				if (sucess.status == 200) {
					var data=sucess.body[0];
					$('#title').val(data.title);
					$('#category').val(data.category);
					$('#description').val(data.description);
					$('#id').val(data.id);
					$('#pre_image').val(data.image);
					$('#userfile_helper').text(data.image);
					$("#userfile").rules("remove", "required");
					$('#modalContactForm').modal('show');
				} else {

				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	}

	function deleteBlog(id) {
		var r = confirm("Do You want to remove this post");
		if (r == true) {
			$.ajax({
				url: '<?= base_url("delete_blog") ?>',
				type: "POST",
				data:{id:id},
				dataType:'json',
				success: function (sucess) {
					if (sucess.status == 200) {
						toastr.success('Blog Deleted From Your Account');
							getAllBlogs();
					} else {
						toastr.error('Blog Deleted From Your Account');
						getAllBlogs();
					}
				},
				error: function (error) {
					console.log(error);
				}
			});
		}

	}



	$('#modalContactForm').on('hidden.bs.modal',()=>{
	$('#add_post').trigger('reset');
		var validator = $("#add_post").validate();

		validator.resetForm();
		document.getElementById("add_post").reset();
	});
		

</script>

