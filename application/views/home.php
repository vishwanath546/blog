
<?php $this->load->view('template/header.php'); ?>
<div class="container pt-5 pb-5">
	<input type="hidden" id="category" name="category" value="">

	<div class="row">
		<div class="col-md-12">
			<!-- Card -->
			<!-- Section: Blog v.1 -->
			<section class="my-5">

				<!-- Section heading -->
				<h2 class="h1-responsive font-weight-bold text-center my-5">Recent posts</h2>
				<!-- Section description -->

				<div class="row">

					<div class="col-md-12">
						<!--Dropdown primary-->
						<div class="dropdown float-right">
							<!--Trigger-->
							<button class="btn btn-danger dropdown-toggle  mx-0" style="margin:0px" type="button" id="dropdownMenu1" data-toggle="dropdown"
									aria-haspopup="true" aria-expanded="false">By Category</button>
							<!--Menu-->
							<div class="dropdown-menu dropdown-danger" id="cats_dropdown">
							</div>
						</div>
						<!--/Dropdown primary-->
					</div>
					<div class="col-md-12 mt-3" id="all_blogs_div">

					</div>
				</div>


			</section>

			<div class="row">
				<div class="col-md-6">
					<nav>
						<div id="pegination_div">

						</div>
					</nav>
				</div>

			</div>

			<!-- Section: Blog v.1 -->
			<!-- Card -->
		</div>
	</div>
</div>

<!----login Model---->
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="login_form"name="login_form">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body mx-3">
				<div class="md-form mb-5">
					<i class="fas fa-envelope prefix grey-text"></i>
					<input type="email" id="username" name="username" class="form-control validate" placeholder="Your email" >

				</div>

				<div class="md-form mb-4">
					<i class="fas fa-lock prefix grey-text"></i>
					<input type="password" id="password_login" name="password_login" class="form-control validate" placeholder="Your password" >

				</div>

			</div>
			<div class="modal-footer d-flex justify-content-center">
				<button class="btn btn-danger" type="submit">Login</button>
			</div>
		</div>
		</form>
	</div>
</div>


<?php $this->load->view('template/footer.php'); ?>
<script>

	$(document).ready(()=>{
		getAllCats();
		$("#pegination_div").find("a").addClass("page-link waves-effect");
		$("#login_form").validate({
			rules: {
				username: {
					required: true
				},
				password_login: {
					required: true
				},
			},
			messages: {
				username: {
					required: "Please Enter Username",
				},

				password_login: {
					required: "Please Enter password",
				},


			},
			// errorElement: "span",
			submitHandler: function (form) {
				let data=document.getElementById('login_form');
				let formData=new FormData(data);
				$.ajax({
					url: '<?= base_url("user_login") ?>',
					type: "POST",
					data: formData,
					cache : false,
					processData: false,
					contentType: false,
					dataType:'json',
					success: function (sucess) {
						if (sucess.status == 200) {


								window.location.href='<?= base_url('admin'); ?>';

						} else {
							toastr.error(sucess.body);

						}
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		});
		createPagination(0);
		$('#pegination_div').on('click','a',function(e){
			e.preventDefault();
			var pageNum = $(this).attr('data-ci-pagination-page');

			createPagination(pageNum);
		});
	});


	function getAllCats() {
		$.ajax({
			url: '<?= base_url("get_cats") ?>',
			type: "POST",
			dataType:'json',
			success: function (sucess) {
				$('#cats_dropdown').empty();
				if (sucess.status == 200) {
					var data=sucess.body;
					let catDiv='';
					data.forEach((value,index)=>{
						console.log(value);
						catDiv += '<a class="dropdown-item" type="button" onclick="getAllBlogsByCat(`'+value.category+'`)">'+value.category+'</a>';
					});
					$('#cats_dropdown').append(catDiv);
					$('#cats_dropdown').append('<a class="dropdown-item" type="button" onclick="getAllBlogsByCat()" >All</a>');
				} else {
					$('#cats_dropdown').append('<a class="dropdown-item" type="button" >No Category Created Yet</a>');
				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	}

	function genrateBlogDiv(data){
		let blogDiv='';
		if(data.length!=undefined){
			data.forEach((value,index)=>{

					blogDiv+='<div class="row">' +
							'<div class="col-lg-5">' +
							'<div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">' +
							'<img class="img-fluid" src="'+value.image+'" alt="Sample image">' +
							'<a>' +
							'<div class="mask rgba-white-slight"></div>' +
							'</a>' +
							'</div>' +
							'</div>' +
							'<div class="col-lg-7">' +
							'<a href="#!" class="green-text">' +
							'<h6 class="font-weight-bold mb-3"><i class="fas fa-utensils pr-2"></i>'+value.category+'</h6>' +
							'</a>' +
							'<h3 class="font-weight-bold mb-3"><strong>'+value.title+'</strong></h3>' +
							'<p style="overflow-y: auto;height: 146px;">'+value.description+'</p>' +
							'<p>Uploaded at<a></a><strong>, '+value.created_at+'</strong></p>' +

							'</div>' +
							'</div><hr class="my-5">';


			});
		}else{
			blogDiv+='<div class="row">' +
					'<div class="col-lg-5">' +
					'<div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">' +
					'<a>' +
					'<div class="mask rgba-white-slight"></div>' +
					'</a>' +
					'</div>' +
					'</div>' +
					'<div class="col-lg-7">' +
					'<h3 class="font-weight-bold "><strong>No Blogs Created Yet</strong></h3>' +
					'<p></p>' +
					'<p></p>' +

					'</div>' +
					'</div><hr class="my-5">';
		}

		return blogDiv;
	}


	function getAllBlogsByCat(Category='') {
		$('#category').val(Category);
		createPagination(0);
	}

	function createPagination(pageNum){
		$.ajax({
			url: '<?= base_url()?>BlogController/loadData/'+pageNum,
			type: 'post',
			dataType: 'json',
			data:{category:$('#category').val()},
			success: function(responseData){
				$('#all_blogs_div').empty();
				$('#pegination_div').empty();


					$('#all_blogs_div').append(genrateBlogDiv(responseData.empData));
					$('#pegination_div').append(responseData.pagination);
					$("#pegination_div").find("a").addClass("page-link waves-effect");

			}
		});
	}

</script>

