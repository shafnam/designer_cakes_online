<?php	
	session_start();
	if(isset($_SESSION['fname'])){
		$fname = $_SESSION['fname'];
	}	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';
	$products = new Product();
	$product_details = $products->viewProductInfo($_GET['product_id']);
	extract($product_details); 

	$flavours = new Flavour();	
	$flavour_details = $flavours->viewParentFlavours();	

	$fillings = new Filling();
	

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Order Now | Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>
	
	<!-- Page specific style
	<link rel="stylesheet" href="vendor/slick/slick/slick.css">
	<link rel="stylesheet" href="vendor/lightGallery-master/dist/css/lightgallery.min.css">
	<link rel="stylesheet" href="vendor/step-wizard/css/step-wizard.css">-->

	<style>
	
	
	</style>

</head>

<body>
	<!-- Header -->
	<?php //include('header.php'); ?>	
	
	<!-- Page Header cake-designs-->
	<div class="container cake-designs my-5" id="order-design">
		<div class="row">
			<div class="col-lg-9">
				<!-- Page Heading/Breadcrumbs -->
				<h1>Order - <?php echo $name; ?></h1>
			</div>
			<div class="col-lg-3">
				<a href="javascript:history.go(-1)" class="btn main-btn"><< GO BACK</a>
			</div>
		</div>
	</div>

	<!-- Page Content -->
	<div class="container my-5">

		<div class="row">
			<div class="col-lg-11 mx-auto d-block px-5 py-0">
						
				<!-- multistep form -->
				<form class="form cf cake-flavours" id="order-design-form" action="submit.php">
                    <div class="wizard">

                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1" class="nav-link active">
										<span class="round-tab">
											<img src="img/step-1b.png">
										</span>
									</a>
									<p> Cake Flavour</p>
                                </li>
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2" class="nav-link disabled">
									<span class="round-tab">
											<img src="img/step-2b.png">
										</span>
									</a>
									<p> Cake Filling</p>
                                </li>
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3" class="nav-link disabled">
									<span class="round-tab">
											<img src="img/step-3b.png">
										</span>
									</a>
									<p> Cake Size</p>
                                </li>
                                <!-- <li role="presentation" class="nav-item text-center">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4" class="nav-link disabled">
										<span class="round-tab">
											<i class="fa fa-phone"></i>
										</span>
									</a>
                                </li>
                                <li role="presentation" class="nav-item text-center">
                                    <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5" class="nav-link disabled">
										<span class="round-tab">
											<i class="fa fa-check"></i>
										</span>
									</a>
                                </li> -->
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
								<h3 class="text-md-left pb-4">Choose Cake Flavour</h3>

                                <div class="row">

								<?php foreach ($flavour_details as $row) { ?> 
									<div class="col-lg-4 mb-4">	

										<label class="img-label">
											<input type="radio" name="flavour" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>" required>
											<img class="card-img-top img-fluid" src="img/cake-flavours/<?php echo $row['image'];?>" alt="" style="width: 250px;height: 175px;">
											<h4 class="px-3 pt-3 m-0"><?php echo $row['name'];?></h4>		
										</label>

										<?php 
											$child_flavour_details = $flavours->viewChildFlavours($row['id']);
											if(count($child_flavour_details) > 0 ){
										?>

											<div id="<?php echo $row['slug'];?>-flavour" class="hide" style="display: none;">
												<div class="row">
													<div class="col-lg-12">
														<?php foreach ($child_flavour_details as $childrow) { ?>		
															<div class="form-check">
																<label class="form-check-label radioz">
																	<input type="radio" class="form-check-inputz no-req" name="<?php echo $row['slug'];?>-flavour" value="<?php echo $childrow['id'];?>" id="<?php echo $childrow['slug'];?>">
																	<span><?php echo $childrow['name'];?></span>
																</label>
															</div>
														<?php } ?>
													</div>											
												</div>
											</div>

										<?php } ?>	

									</div>
								<?php } ?>

								</div>
								
                                <ul class="list-inline text-md-left">
									<li><button type="button" id="Step_1" class="btn btn-lg btn-primary next-step next-button">Next</button></li>
									<p id="flavour-error" style="display:none;">please select a cake flavour</p>
								</ul>
								
                            </div>

                            <div class="tab-pane" role="tabpanel" id="step2">
								
								<h3 class="text-md-left pb-4">Choose Cake Filling</h3>
								
								<div class="row cakeFillings">	
                                   <!-- Filled with ajax data=-->

								</div>
								
                                <ul class="list-inline text-md-left">
                                    <li><button type="button" id="Step_2" class="btn btn-lg btn-primary next-step next-button">Next</button></li>
								</ul>
								
							</div>
							
                            <div class="tab-pane" role="tabpanel" id="step3">
								<h3 class="text-md-left pb-4">Choose Cake Tiers</h3>
                                <div class="row">

									<div class="col-lg-4 mb-4">								
										<label class="img-label">
											<input type="radio" name="tiers" value="single" id="single" required>
											<img class="card-img-top" src="img/no/single_tier_cake.jpg" alt="" style="height: 195px;">
											<h4 class="p-3 m-0">Single Cake</h4>		
										</label>								
									</div>
									
									<div class="col-lg-4 mb-4">								
										<label class="img-label">
											<input type="radio" name="tiers" value="tiered" id="tiered">
											<img class="card-img-top" src="img/no/tiered-cake.jpg" alt="" style="height: 195px;">
											<h4 class="p-3 m-0">Tiered Cake</h4>		
										</label>								
									</div>
                                    
								</div>
								
                                <ul class="list-inline text-md-left">
                                    <li><button type="button" class="btn btn-lg btn-primary next-step next-button">Next Step</button></li>
								</ul>
								
							</div>
							
                            <!-- <div class="tab-pane" role="tabpanel" id="step4">
                                <h1 class="text-md-left">Step 4</h1>
                                <div class="row">
                                   
                                </div>
                                <ul class="list-inline text-md-left">
                                    <li><button type="button" class="btn btn-lg btn-common next-step next-button">Next Step</button></li>
                                </ul>
                            </div> 
                            <div class="tab-pane" role="tabpanel" id="step5">
                                <h1 class="text-md-left">Complete</h1>
                                <div class="row">

                                </div>
							</div>-->
							
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </form>

			</div>
		</div>

	</div>
	<!-- /.container -->

	<!-- Footer -->
	<?php include('footer.php'); ?>

	<?php include('layout-footer.php'); ?>
	
	<!-- Custom Plugins 
    <script src="vendor/step-wizard/js/step-wizard.js"></script>
	<script src="vendor/step-wizard/js/jquery.tooltipster.min.js"></script>
	<script src="vendor/step-wizard/js/jquery.validate.min.js"></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>-->

	<script>
	
	</script>
		
	
</body>

</html>
