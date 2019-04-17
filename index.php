<?php	
	require_once 'inc/config.php';
  	require_once 'inc/class.crud.php';
	$designs = new Design();
	$desgin_details = $designs->viewParentDesigns();

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>

</head>

<body>
	<!-- Header -->
	<?php include('header.php'); ?>

	<!-- Welcome -->
	<!-- <section class="container-fluid home-welcomes">
		
		<div class="row">
			<!-- <div class="col-lg-3">
				<img class="img-fluid" src="img/testimonials/1.jpg">	
			</div> --
			<div class="col-lg-12">
				<h2>Welcome</h2>
			</div>
		</div>

	</section> -->

	<!-- <div class="container homepage">

		<h2>Welcome</h2>
		
		<p class="text-center">
			The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus 
			Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. 
			Rackham.
		</p>

	</div> -->

	<!-- Page Content -->
	<div class="container homepage">

		<!-- Cake Category Section to Designer Cakes Toowoomba-->
		<section class="row mt-0 home-cake-section">

			<!-- Welcome -->
			<h2 class="col-lg-12 m-4 text-center pb-2">Welcome </h2>

			<p class="text-center pb-5">
				The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus 
				Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. 
				Rackham.
			</p>

			<?php foreach ($desgin_details as $row) { ?> 
			<div class="col-lg-4 mb-4">
				<div class="card m-3" id="zoomIn">
					<figure>	
						<img class="card-img-top" src="img/<?php echo $row['image'];?>" alt="<?php echo $row['name'];?>">	
					</figure>	
					<div class="card-footer">						
						<nav>
							<ul>
								<li class="sub-menu-parent" tab-index="0">
									<a href="cake-designs.php?design_id=<?php echo $row['id']; ?>"><?php echo $row['name'];?></a>
									<?php 
										$child_design_details = $designs->viewChildDesigns($row['id']);
										if(count($child_design_details) > 0 ){
									?>
										<ul class="sub-menu">
										<?php 
											foreach ($child_design_details as $childrow) { 
										?>
											<li>
												<a href="cake-designs.php?design_id=<?php echo $childrow['id']; ?>"><?php echo $childrow['name'];?></a>
											</li>	
										<?php 
											} 
										}
									?>									  
										</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<?php } ?>

		</section>
		<!-- /.row -->
	
	</div>

	<div class="container-fluid testimonial p-5">

		<h2 class="text-center white-text">What our Clients Say</h2>

		<!-- Testimonials setion -->
		<section class="text-center">
			<div class="card col-md-8 mb-5 mx-auto d-block">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="7000">
					<div class="w-100 carousel-inner" role="listbox">
						
						<div class="carousel-item active">
							<div class="carousel-caption">
								<div class="row">
									<div class="col-sm-3">
										<img src="img/testimonials/1.jpg" alt="" class="rounded-circle img-fluid"/>
									</div>
									<div class="col-sm-9">
										<!-- <i class="fa fa-quote-left fa-3x" style="color: #ffe9fc;"></i> -->
										<h3>Gives me Hope</h3>
										<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
										<small class="smallest mute">- Yayo Dudemous</small>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="carousel-caption">
								<div class="row">
									<div class="col-sm-3">
										<img src="img/testimonials/2.jpg" alt="" class="rounded-circle img-fluid"/>
									</div>
									<div class="col-sm-9">
										<h3>You will Love it.</h3>
										<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
										<small class="smallest mute">- Yayo Dudemous</small>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="carousel-caption">
								<div class="row">
									<div class="col-sm-3">
										<img src="img/testimonials/3.jpg" alt="" class="rounded-circle img-fluid"/>
									</div>
									<div class="col-sm-9">
										<h3>Velvet Pouch!</h3>
										<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
										<small class="smallest mute">- Yayo Dudemous</small>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="carousel-caption">
								<div class="row">
									<div class="col-sm-3">
										<img src="img/testimonials/4.jpg" alt="" class="rounded-circle img-fluid"/>
									</div>
									<div class="col-sm-9">
										<h3>Best Service!</h3>
										<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
										<small class="smallest mute">- Yayo Dudemous</small>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="carousel-caption">
								<div class="row">
									<div class="col-sm-3">
										<img src="img/testimonials/5.jpg" alt="" class="rounded-circle img-fluid"/>
									</div>
									<div class="col-sm-9">
										<h3>Happy About the Service!</h3>
										<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
										<small class="smallest mute">- Yayo Dudemous</small>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item">
							<div class="carousel-caption">
								<div class="row">
									<div class="col-sm-3">
										<img src="img/testimonials/6.jpg" alt="" class="rounded-circle img-fluid"/>
									</div>
									<div class="col-sm-9">
										<h3>Best Service!</h3>
										<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
										<small class="smallest mute">- Yayo Dudemous</small>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="float-right navi mt-3">
						<a class="" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon ico" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon ico" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>

				</div>
			</div>
		

		</section>

	</div>
		
	

	<?php include('footer.php'); ?>
	
	<?php include('layout-footer.php'); ?>	

</body>

</html>
