<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';
	
	$designs = new Design();
	$products = new Product();
	$design_details = $designs->viewDesigns($_GET['design_id']);	
	$product_details = $products->viewAllDesignProducts($_GET['design_id']);

	extract($design_details); 

	//print_r($product_details);
	//die();

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo $name; ?> | Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>
	
	<!-- Page specific styles-->
	<link rel="stylesheet" href="vendor/slick/slick/slick.css">
  <link rel="stylesheet" href="vendor/lightGallery-master/dist/css/lightgallery.min.css">

</head>

<body>
	<!-- Header -->
	<?php include('header.php'); ?>	
	
	<!-- Page Header -->
	<div class="container cake-designs">
		<!-- Page Heading/Breadcrumbs -->
		<h1><?php echo $name; ?></h1>
	</div>

	<!-- Page Content -->
	<div class="container">

		<div class="row mt-5">

		<?php 
		if(count($product_details) > 0 ) {
			foreach ($product_details as $row) { 
		?> 	
			<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
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
									<a href="img/gallery/<?php echo $childrow['image'];?>">
										<img class="img-fluid image" src="img/gallery/<?php echo $childrow['image'];?>" alt="">
									</a>
								</div>
								<?php } ?>

								<!-- <div class="item"><a href="img/kids/1/2.jpg"><img class="img-fluid" src="img/kids/1/2.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/1/3.jpg"><img class="img-fluid" src="img/kids/1/3.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/1/4.jpg"><img class="img-fluid" src="img/kids/1/4.jpg" alt=""></a></div> -->

							</div>
							<div class="middle">
								<div class="text"><i class="fas fa-search"></i></div>
							</div>
						</div>
						<!-- Details-->
						<div class="card-body">
							<h4 class="card-title text-center"><?php echo $row['name'];?></h4>
							<div class="col text-center">
							  <a href="order-design.php?product_id=<?php echo $row['id']; ?>" class="btn main-btn btn-dark">Order Now</a>
							</div>							
						</div>
						<div class="ps-product__preview pp1">
							<div class="ps-product__variants pv1">

							<?php 
								$product_image_thumbnails = $products->viewProductImages($row['id']);
								foreach ($product_image_thumbnails as $childrow) {
							?>
								<div class="item"><img src="img/gallery/<?php echo $childrow['image'];?>" alt=""></div>
							<?php } ?>					

								<!-- <div class="item"><img src="img/kids/1/2.jpg" alt=""></div>
								<div class="item"><img src="img/kids/1/3.jpg" alt=""></div>
								<div class="item"><img src="img/kids/1/4.jpg" alt=""></div> -->

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
			
			<!-- <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
				<div class="ps-product__thumbnail pt1">
					<div class="card">
						<!-- Images slider --
						<div class="overlay-container">
							<div class="ps-product__image pi1">
								<div class="item"><a href="img/kids/2/1.jpg"><img class="img-fluid image" src="img/kids/2/1.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/2/2.jpg"><img class="img-fluid" src="img/kids/2/2.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/2/3.jpg"><img class="img-fluid" src="img/kids/2/3.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/2/4.jpg"><img class="img-fluid" src="img/kids/2/4.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/2/5.jpg"><img class="img-fluid" src="img/kids/2/5.jpg" alt=""></a></div>
							</div>
							<div class="middle">
								<div class="text"><i class="fas fa-search"></i></div>
							</div>
						</div>
						<!-- Details--
						<div class="card-body">
							<h4 class="card-title text-center">Hatchimals Cake</h4>
							<div class="col text-center">
							  <button type="button" class="btn main-btn btn-dark">Order Now</button>
							</div>
						</div>						
					</div>
					
					<div class="ps-product__preview pp1">
						<div class="ps-product__variants pv1">
								<div class="item"><img src="img/kids/2/1.jpg" alt=""></div>
								<div class="item"><img src="img/kids/2/2.jpg" alt=""></div>
								<div class="item"><img src="img/kids/2/3.jpg" alt=""></div>
								<div class="item"><img src="img/kids/2/4.jpg" alt=""></div>
								<div class="item"><img src="img/kids/2/5.jpg" alt=""></div>
						</div>
					</div>
				</div>
			</div> -->
			
			<!-- <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
				<div class="ps-product__thumbnail pt1">
					<div class="card">
						<!-- Images slider --
						<div class="overlay-container">
							<div class="ps-product__image pi1">
								<div class="item"><a href="img/kids/3/1.jpg"><img class="img-fluid image" src="img/kids/3/1.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/3/2.jpg"><img class="img-fluid" src="img/kids/3/2.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/3/3.jpg"><img class="img-fluid" src="img/kids/3/3.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/3/4.jpg"><img class="img-fluid" src="img/kids/3/4.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/3/5.jpg"><img class="img-fluid" src="img/kids/3/5.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/3/6.jpg"><img class="img-fluid" src="img/kids/3/6.jpg" alt=""></a></div>
							</div>
							<div class="middle">
								<div class="text"><i class="fas fa-search"></i></div>
							</div>
						</div>
						<!-- Details--
						<div class="card-body">
							<h4 class="card-title text-center">Paw Patrol Cake</h4>
							<div class="col text-center">
							  <button type="button" class="btn main-btn btn-dark">Order Now</button>
							</div>
						</div>
						<div class="ps-product__preview pp1">
							<div class="ps-product__variants pv1">
								<div class="item"><img src="img/kids/3/1.jpg" alt=""></div>
								<div class="item"><img src="img/kids/3/2.jpg" alt=""></div>
								<div class="item"><img src="img/kids/3/3.jpg" alt=""></div>
								<div class="item"><img src="img/kids/3/4.jpg" alt=""></div>
								<div class="item"><img src="img/kids/3/5.jpg" alt=""></div>
								<div class="item"><img src="img/kids/3/6.jpg" alt=""></div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			
			<!-- <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
				<div class="ps-product__thumbnail pt1">
					<div class="card">
						<!-- Images slider --
						<div class="overlay-container">
							<div class="ps-product__image pi1">
								<div class="item"><a href="img/kids/4/1.jpg"><img class="img-fluid image" src="img/kids/4/1.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/4/2.jpg"><img class="img-fluid" src="img/kids/4/2.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/4/3.jpg"><img class="img-fluid" src="img/kids/4/3.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/4/4.jpg"><img class="img-fluid" src="img/kids/4/4.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/4/5.jpg"><img class="img-fluid" src="img/kids/4/5.jpg" alt=""></a></div>
								<div class="item"><a href="img/kids/4/6.jpg"><img class="img-fluid" src="img/kids/4/6.jpg" alt=""></a></div>
							</div>
							<div class="middle">
								<div class="text"><i class="fas fa-search"></i></div>
							</div>
						</div>
						<!-- Details--
						<div class="card-body">
							<h4 class="card-title text-center">Gekko Cake</h4>
							<div class="col text-center">
							  <button type="button" class="btn main-btn btn-dark">Order Now</button>
							</div>
						</div>
						<div class="ps-product__preview pp1">
							<div class="ps-product__variants pv1">
								<div class="item"><img src="img/kids/4/1.jpg" alt=""></div>
								<div class="item"><img src="img/kids/4/2.jpg" alt=""></div>
								<div class="item"><img src="img/kids/4/3.jpg" alt=""></div>
								<div class="item"><img src="img/kids/4/4.jpg" alt=""></div>
								<div class="item"><img src="img/kids/4/5.jpg" alt=""></div>
								<div class="item"><img src="img/kids/4/6.jpg" alt=""></div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			
		</div>

	</div>
	<!-- /.container -->

	<!-- Footer -->
	<?php include('footer.php'); ?>

	<?php include('layout-footer.php'); ?>
	
	<!-- Custom Plugins -->
    <script src="vendor/lightGallery-master/dist/js/lightgallery-all.min.js"></script>
	<script src="vendor/slick/slick/slick.min.js"></script>
	<script src="vendor/slick-animation.min.js"></script>
	<script src="js/custom.js"></script>
	
</body>

</html>
