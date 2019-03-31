<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

// Include config file
require_once "includes/class.crud.php";
	
$designs = new Design();
$products = new Product();
$design_details = $designs->viewDesigns($_GET['design_id']);	
$product_details = $products->viewAllDesignProducts($_GET['design_id']);

extract($design_details); 

if(isset($_POST['btn-del']))
{
  $id = $_POST['id'];
  $result = $products->deleteProduct($id);

  if($result){
    $_SESSION['return_msg'] = '<div id="flash-msg" class = "alert alert-success r-sucess" role = "alert"> Product deletd successfully</div>';
    header('Location: testimonials.php');
    exit; 
  } else {
    $_SESSION['return_msg'] = '<div class="alert alert-danger r-fail" role="alert">Oops! something went wrong. Please try again.</div>';
  }

}

	//print_r($product_details);
	//die();

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <?php include 'header.php'; ?>
    <!-- Custom styles for this page -->
    <link rel="stylesheet" href="../vendor/slick/slick/slick.css">
  	<link rel="stylesheet" href="../vendor/lightGallery-master/dist/css/lightgallery.min.css">

  </head>

  <body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<?php include('sidebar.php'); ?>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<?php include('top-navbar.php'); ?>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->

				<div class="container-fluid">

					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800"><?php echo $name; ?></h1>
						<?php if(!in_array($id, array(1,2))){ ?>
							<a href="design-add.php?id=<?php echo $id; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
						<?php } ?>
					</div>

					<div class="card-body p-5">
						<div class="row">

							<?php 
							if(count($product_details) > 0 ) {
								foreach ($product_details as $row) { 
							?> 	
								<div class="col-lg-3 col-md-4 col-sm-6 mb-3 portfolio-item">
									<div class="ps-product__thumbnail pt1">
										<div class="card">
											<!-- Images slider -->
											<div class="overlay-container">
												<div class="ps-product__image pi1">

													<?php 
														$product_image_details = $products->viewProductImages($row['id']);
														foreach ($product_image_details as $childrow) {
													?>
													<div class="item">
														<a href="../img/gallery/<?php echo $row['name'] . '/' . $childrow['image'];?>">
															<img class="img-fluid image" src="../img/gallery/<?php echo $row['name'] . '/' . $childrow['image'];?>" alt="">
														</a>
													</div>
													<?php } ?>													

												</div>
												<div class="middle">
													<div class="text"><i class="fas fa-search"></i></div>
												</div>
											</div>
											<!-- Details-->
											<div class="card-body">
												<h4 class="card-title text-center"><?php echo $row['name'];?></h4>
												<div class="col text-center">
													<a href="design-edit.php?product_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
														<i class="fa fa-edit "></i> Edit
													</a>
													<a class="open-del btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['id'];?>">
														<i class="fas fa-trash"></i> Delete
													</a>
												</div>							
											</div>
											<div class="ps-product__preview pp1">
												<div class="ps-product__variants pv1">

												<?php 
													$product_image_thumbnails = $products->viewProductImages($row['id']);
													foreach ($product_image_thumbnails as $childrow) {
												?>
													<div class="item"><img src="../img/gallery/<?php echo $row['name'] . '/' . $childrow['image'];?>" alt=""></div>
												<?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php 
								}
							} else { ?>

								<h2 style="height: 200px;">No Designs Yet</h2>
							<?php
							}
							?>

						</div>
					</div>

				</div>

			</div>

			<!-- delete Modal-->
			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Are you Sure to Delete?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						</div>
						<div class="modal-body">
							Select "Delete" below if you are ready to delete the product.
						</div>
						<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<input type="hidden" name="id" id="id" value=""/>
							<input type="submit" name="btn-del" class="btn btn-primary" value="Delete Design">
						</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer -->
			<?php include('page-footer.php'); ?>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->
	
	</div>
	<!-- End of Page Wrapper -->
	
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
    </a>	

	<!-- Footer -->
	<?php include('footer.php'); ?>

	<!-- Page level plugins -->
    <script src="../vendor/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
	<script src="../vendor/slick/slick/slick.min.js"></script>
	<script src="../vendor/slick-animation.min.js"></script>

    <!-- Page level custom scripts -->    
	<script src="../js/custom.js"></script>
	
</body>

</html>
