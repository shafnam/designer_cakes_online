<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';

	$products = new Product();
	$product_details = $products->viewProductInfo($_GET['product_id']);
	extract($product_details); 

	$flavours = new Flavour();	
	$flavour_details = $flavours->viewParentFlavours();	

	$tiers = new Tier();
	$tier_details = $tiers->viewParentTiers();
	$m_tier_details = $tiers->viewChildTiers();
	
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
	
	<!-- Page specific styles -->
	<link href="vendor/datepicker/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	

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
				<form class="form cf cake-flavours" id="order-design-form" method="post" action="inc/submit.php">
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
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4" class="nav-link disabled">
										<span class="round-tab">
											<img src="img/step-4b.png">
										</span>
									</a>
									<p> Personal Info</p>
                                </li>
                                <!-- <li role="presentation" class="nav-item text-center">
                                    <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5" class="nav-link disabled">
										<span class="round-tab">
											<i class="fa fa-check"></i>
										</span>
									</a>
                                </li> -->
                            </ul>
                        </div>

                        <div class="tab-content">

                            <!-- Please Choose a Cake Flavour -->
							<div class="tab-pane active" role="tabpanel" id="step1">
								
								<h3 class="text-md-left pb-4">Please Choose a Cake Flavour</h3>

                                <div class="row">

									<?php foreach ($flavour_details as $row) { ?> 
										<div class="col-lg-4 mb-4">	

											<label class="img-label">
												<input type="radio" name="flavour" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>" required>
												<img class="card-img-top img-fluid" src="img/cake-flavours/<?php echo $row['image'];?>" alt="" style="width: 250px;height: 175px;">
												<h4 class="px-3 pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
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
																		<input type="radio" class="form-check-inputz no-req" name="sub_flavour" value="<?php echo $childrow['id'];?>" id="<?php echo $row['slug'];?>-sub-flavour">
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
									<li><button type="button" id="Step_1" class="btn main-btn btn-dark next-step next-button">Next</button></li>
								</ul>
								
                            </div>

                            <!-- Please Choose a Cake Filling -->
							<div class="tab-pane" role="tabpanel" id="step2">
								
								<h3 class="text-md-left pb-4">Please Choose a Cake Filling</h3>
								
								<div class="row cakeFillings">	
                                   <!-- filled with ajax data -->
								</div>
								
                                <ul class="list-inline text-md-left">
                                    <li><button type="button" id="Step_2" class="btn main-btn btn-dark next-step next-button">Next</button></li>
								</ul>
								
							</div>
							
							<!-- Please Choose Tier Type -->
                            <div class="tab-pane" role="tabpanel" id="step3">
								
								<div class="row">

									<div class="col-lg-12 mb-4">
										<h3 class="text-md-left pb-4">Please Choose Tier Type</h3>
									</div>	

									<?php foreach ($tier_details as $row) { ?>
										<div class="col-lg-3 mb-4">	

											<label class="img-label">
												<input type="radio" name="tiers" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>" required>
												<img class="card-img-top img-fluid" src="img/cake-tiers/<?php echo $row['image'];?>" alt="" style="width: 200px;">
												<h5 class="px-3 pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
											</label>

										</div>
									<?php } ?>  

								</div>								

								<div class="row" id="multiple-tier" style="display: none;">

									<div class="col-lg-12 mb-4">	
										<h3 class="text-md-left py-2">Please Choose Number of Tiers</h3>
									</div>

									<?php foreach ($m_tier_details as $row) {  ?>
										<div class="col-lg-3 mb-4">	

											<label class="img-label" style="border: 0px solid #dee2e6;">
												<input type="radio" name="multiple_tiers" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>">
												<img class="card-img-top img-fluid" src="img/cake-tiers/<?php echo $row['image'];?>" alt="" style="width: 150px;">
												<h5 class="px-3 pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
											</label>

										</div>
									<?php } ?>                                    
								</div>
								
								<div class="row cakeSizes" style="display: none;">									
                                   	<!-- filled with ajax data -->
								</div>

								<div class="row cakeShapes" style="display: none;">									
                                   	<!-- filled with ajax data -->
								</div>

								<div class="row cakeServings" style="display: none;">									
                                   	<!-- filled with ajax data -->
								</div>
								
                                <ul class="list-inline text-md-left">
                                    <li><button id="Step_3" class="btn main-btn btn-dark next-step next-button">Next</button></li>
								</ul>
								
							</div>
							
                           	<!-- Fill the Personal Details -->
							<div class="tab-pane" role="tabpanel" id="step4">
						   		
								<h3 class="text-md-left pb-4">Please Fill Your Personal Details Below</h3>

								<div class="row">
									
									<div class="col-lg-6 mb-4">

										<div class="form-group">
											<label for="name">First Name:</label>
											<input type="text" class="form-control" id="f_name" name="f_name">
										</div>
										
										<div class="form-group">
											<label for="email">Email address:</label>
											<input type="email" class="form-control" id="email">
										</div>																											

									</div>

									<div class="col-lg-6 mb-4">

										<div class="form-group">
											<label for="name">Last Name:</label>
											<input type="text" class="form-control" id="l_name" name="l_name">
										</div>
										
										<div class="form-group">
											<label for="phone">Phone Number:</label>
											<input type="number" class="form-control" id="phone" name="phone">
										</div>																			

									</div>										

								</div>

								<div class="row">

									<div class="col-lg-6 mb-4">

										<div class="form-group">
											<label for="delivery_date">Pick Up/Delivery Date:</label>
											<input id="datepicker" name="delivery_date" width="276" />		
										</div>

									</div>
									
									<div class="col-lg-6 mb-4">

										<div class="form-group ml-4">
											<label for="method">Method:</label>

											<div class="form-check">
												<input class="form-check-input" type="radio" value="pick-up" name="method" id="pick-up">
												<label class="form-check-label" for="pick-up">
													Pick Up
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" value="deliver" name="method" id="deliver">
												<label class="form-check-label" for="deliver">
													Deliver Within Toowoomba ($20)
												</label>
											</div>
											
										</div>

									</div>

									<div class="col-lg-12 mb-4">

										<div class="form-group">
											<label for="venue_address">Venue Address</label>
											<textarea class="form-control" id="venue_address" name="venue_address" rows="3"></textarea>
										</div>

									</div>

								</div>

								<div class="row" id="name-age-box">

									<div class="col-lg-12 mb-4">
										<div class="form-check ml-4">
											<input class="form-check-input" type="checkbox" name="add_details_on_cake" id="add_details_on_cake">
											<label class="form-check-label" for="add_details_on_cake">
												Need to add name and age on cake
											</label>
										</div>
									</div>
									
									<div class="col-lg-6 mb-4">

										<div class="form-group">
											<label for="name">Name on Cake:</label>
											<input type="text" class="form-control" id="cake_name" name="cake_name">
										</div>																				

									</div>

									<div class="col-lg-6 mb-4">

										<div class="form-group">
											<label for="email">Age on Cake: </label>
											<input type="number" class="form-control" id="cake_age" name="cake_age">
										</div>																			

									</div>										

								</div>


								<ul class="list-inline text-md-left">
									<li><button type="submit" id="Step_4" class="btn main-btn btn-dark next-step next-button">Submit Order</button></li>
								</ul>

                            </div> 
                             <!-- <div class="tab-pane" role="tabpanel" id="step5">
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
	
	<!-- Custom Plugins-->
	<script src="vendor/datepicker/js/gijgo.min.js" type="text/javascript"></script>
	<!-- <script src="js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap-validate.js"></script>
    <script src="js/order-design.js"></script> -->

	<script>
		$('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
	</script>
		
	
</body>

</html>
