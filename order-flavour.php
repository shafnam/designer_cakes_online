<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';
	$flavours = new Flavour();
	$flavour_details = $flavours->viewFlavourInfo($_GET['flavour_id']);
	extract($flavour_details); 

	//check whether item is a parent or child
	$product = new Product();
    $has_parent = $product->checkHasParent($_GET['flavour_id'],'flavours');

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
	
	<!-- Page specific styles-->
	<link rel="stylesheet" href="vendor/slick/slick/slick.css">
	<link rel="stylesheet" href="vendor/lightGallery-master/dist/css/lightgallery.min.css">
	<link rel="stylesheet" href="vendor/step-wizard/css/step-wizard.css">

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
				<?php if($has_parent == null){ ?>
					<h1>Order - <?php echo $name; ?></h1>
				<?php } else { ?>				
				<h1>Order - <?php echo $ParentName . ' / '. $ChildName; ?></h1>
				<?php } ?>
			</div>
			<div class="col-lg-3">
				<a href="javascript:history.go(-1)" class="btn main-btn"><< GO BACK</a>
			</div>
		</div>
	</div>

	<!-- Page Content -->
	<div class="container my-5">

		<!-- Steps -->
		<div class="stepwizard">
			<div class="stepwizard-row setup-panel">
				<!-- <div class="stepwizard-step">
					<a href="#step-1" type="button" class="btn btn-primary stepwizard-btn">
						<img src="img/step-1b.png" alt="">
					</a>
					<p> Cake Flavour</p>
				</div> -->
				<div class="stepwizard-step">
					<a href="#step-1" type="button" class="btn btn-primary stepwizard-btn">
						<img src="img/step-2b.png" alt="">
					</a>
					<p> Cake Filling</p>
				</div>
				<div class="stepwizard-step">
					<a href="#step-2" type="button" class="btn btn-default btn-circle stepwizard-btn disabled">
						<img src="img/step-3b.png" alt="">
					</a>												
					<p> Cake Shape & Size</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 p-5">
						
				<form role="form" id="order-flavour-form" class="cake-flavours">
								
					<!-- Cake Flavour -->
					<div class="setup-content" id="step-1">
					
						<div class="row">										
							<div class="col-lg-12 pb-5">
								<h3>Choose Cake Flavour</h3>
							</div>
						</div>
										
						<div class="row">
									
							<!-- Sponge Cake -->
							<div class="col-lg-4 mb-4">								
								<label class="img-label">
									<input type="radio" name="flavour" value="sponge-cake" id="sponge-cake" required>
									<img class="card-img-top" src="img/cake-flavours/1.jpg" alt="" style="height: 195px;">
									<h4 class="px-3 pt-3 m-0">Sponge Cake</h4>		
								</label>								
								<!-- extra sponge flavours -->
								<div class="sponge-flavours" style="display: none;">
									<div class="row">
										<div class="col-lg-6">		
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sponge-flavour" value="Vanilla" id="sponge-cake-vanilla"><span>Vanilla</span>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sponge-flavour" value="Chocolate" id="sponge-cake-chocolate"><span>Chocolate</span>
												</label>
											</div>
										</div>
										<div class="col-lg-6">		
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sponge-flavour" value="Strawberry" id="sponge-cake-strawberry"><span>Strawberry</span>
												</label>
											</div>
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sponge-flavour" value="Coffee" id="sponge-cake-coffee"><span>Coffee</span>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Carrot Cake -->
							<div class="col-lg-4 mb-4">				
								<label class="img-label">
									<input type="radio" name="flavour" value="carrot-cake" id="carrot-cake">
									<img class="card-img-top" src="img/cake-flavours/2.jpg" alt="" style="height: 195px;">
									<h4 class="px-3 pt-3 m-0">Carrot Cake</h4>		
								</label>
							</div>

							<!-- Choco Mud Cake -->
							<div class="col-lg-4 mb-4">				
								<label class="img-label">
									<input type="radio" name="flavour" value="chocolate-mud-cake" id="chocolate-mud-cake">
									<img class="card-img-top" src="img/cake-flavours/3.jpg" alt="" style="height: 195px;">
									<h4 class="px-3 pt-3 m-0">Chocolate Mud Cake</h4>		
								</label>
							</div>

						</div>
						
						<div class="row">
							
							<!-- Red Velvet Cake -->
							<div class="col-lg-4 mb-4">				
								<label class="img-label">
									<input type="radio" name="flavour" value="red-velvet-cake" id="red-velvet-cake">
									<img class="card-img-top" src="img/cake-flavours/4.jpg" alt="" style="height: 195px;">
									<h4 class="px-3 pt-3 m-0">Red Velvet Cake</h4>		
								</label>
							</div>
							
							<!-- Sri Lankan Cake -->
							<div class="col-lg-4 mb-4">
								
								<label class="img-label">
									<input type="radio" name="flavour" value="sl-cake" id="sl-cake">
									<img class="card-img-top" src="img/cake-flavours/5.jpg" alt="" style="height: 195px;">
									<h4 class="px-3 pt-3 m-0">Sri Lankan Cake</h4>		
								</label>
								<!-- extra sl flavours -->
								<div class="sl-flavours" style="display: none;">
									<div class="row">
										<div class="col-lg-12">		
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sl-flavour" value="Vanilla Butter Cake" id="sl-cake-vanilla"><span>Vanilla Butter Cake</span>
												</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sl-flavour" value="Chocolate Cake" id="sl-cake-chocolate"><span>Chocolate Cake</span>
												</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-check">
												<label class="form-check-label radio">
													<input type="radio" class="form-check-input" name="sl-flavour" value="Ribbon Cake" id="sl-cake" id="sl-cake-ribbon"><span>Ribbon Cake</span>
												</label>
											</div>
										</div>
									</div>
								</div>	

							</div>
							
							<!-- Dietary Requirement Cakes -->
							<div class="col-lg-4 mb-4">
								
								<label class="img-label">
									<input type="radio" name="flavour" value="dr-cake" id="dr-cake">
									<img class="card-img-top" src="img/cake-flavours/6.jpg" alt="" style="height: 195px;">
									<h4 class="px-3 pt-3 m-0">Dietary Requirement Cakes</h4>		
								</label>
								<!-- extra dr flavours -->
								<div class="dr-flavours ml-3" style="display: none;">
									<div class="form-check">
										<label class="form-check-label radio">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Vanilla - Eggless Cake" id="dr-cake-vanilla-eggless">
											Vanilla - Eggless Cake
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label radio">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Chocolate - Eggless Cake" id="dr-cake-chocolate-eggless">
											Chocolate - Eggless Cake
										</label>
									</div>

									<div class="form-check">
										<label class="form-check-label radio">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Vanilla - Gluten Free Cake" id="dr-cake-vanilla-gf">
											Vanilla - Gluten Free Cake
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Chocolate - Gluten Free Cake" id="dr-cake-chocolate-gf">
											Chocolate - Gluten Free Cake
										</label>
									</div>

									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Vanilla - Lactose Free Cake" id="dr-cake-vanilla-lf">
											Vanilla - Lactose Free Cake
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Chocolate - Lactose Free Cake" id="dr-cake-chocolate-lf">
											Chocolate - Lactose Free Cake
										</label>
									</div>

									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Vanilla - Vegan Cake" id="dr-cake-vanilla-vegan">
											Vanilla - Vegan Cake
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="dr-flavour" value="Chocolate - Vegan Cake" id="dr-cake-chocolate-vegan">
											Chocolate - Vegan Cake
										</label>
									</div>
								</div>

							</div>
						
						</div>
						
						<div class="row">
						
							<div class="col-lg-12">
								<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>	
							</div>
							
						</div>

					</div>

					<!-- Cake Filling -->
					<div class="setup-content" id="step-2">

						<div class="row">
							<div class="col-lg-12 pb-5">
								<h3>Choose Cake Filling</h3>
							</div>
						</div>
							
						<div class="row">
							
							<?php for ($x = 1; $x <= 15; $x++) { ?>
							<div class="col-lg-2 mb-4">				
								<label class="img-label">
									<input type="radio" name="filling" value="filling-<?php echo $x; ?>" id="filling-<?php echo $x; ?>" required>
									<img class="card-img-top" src="img/cake-flavours/4.jpg" alt="" style="height: 100px;">
									<h5 class="p-3 m-0">Cake Filling <?php echo $x; ?></h5>		
								</label>
							</div>
							<?php } ?>
							
							<div class="clearfix"></div>

							<div class="col-lg-12">
								<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>	
							</div>

						</div>

							<!-- <div class="col-xs-12">
									<div class="col-md-11">
											<h3> Step 2</h3>
											<div class="form-group">
													<label class="control-label">Company Name</label>
													<input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
											</div>
											<div class="form-group">
													<label class="control-label">Company Address</label>
													<input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address"  />
											</div>
											<button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
									</div>
							</div> -->

					</div>

					<!-- Cake Shape & Size -->
					<div class="setup-content" id="step-3">
							
						<div class="row">						
							<!-- Cake Tiers -->
							<div class="col-lg-12 pb-5">
								<h3>Choose Cake Tiers</h3>
							</div>
						</div>
						
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
						
						<!--<div >-->
						
						<div class="row" id="cake_shape" style="display:none;">
							
							<!-- Cake Shape -->							
							<div class="col-lg-12 pb-5">
								<h3>Choose Cake Shape</h3>
							</div>
								
							<div class="col-lg-4 mb-4">								
								<label class="img-label">
									<input type="radio" name="shape" value="round" id="round" required>
									<img class="card-img-top" src="img/no/single_tier_cake.jpg" alt="" style="height: 195px;">
									<h4 class="p-3 m-0">Round</h4>		
								</label>								
							</div>
						
							<div class="col-lg-4 mb-4">								
								<label class="img-label">
									<input type="radio" name="shape" value="square" id="square">
									<img class="card-img-top" src="img/no/tiered-cake.jpg" alt="" style="height: 195px;">
									<h4 class="p-3 m-0">Square</h4>		
								</label>								
							</div>
							
							<div class="col-lg-4 mb-4">								
								<label class="img-label">
									<input type="radio" name="shape" value="heart" id="heart">
									<img class="card-img-top" src="img/no/tiered-cake.jpg" alt="" style="height: 195px;">
									<h4 class="p-3 m-0">Heart</h4>		
								</label>								
							</div>
							
						</div>
							
						<!--</div>
						
						<div >-->
						
						<div class="row" id="cake_size" style="display:none;">
						
							<!-- Cake Size -->							
							<div class="col-lg-12 pb-5">
								<h3>Choose Cake Size</h3>
							</div>
							
							<div class="col-lg-12">
								<select class="form-control mb-5" name="size" id="size">
									<option value="6&quot; (Serves 6-8)|0">6" (Serves 6-8)</option>
									<option value="7&quot; (Serves 10-12)|0">7" (Serves 10-12)</option>
									<option value="8&quot; (Serves 10-18)|0">8" (Serves 10-18)</option>
									<option value="9&quot; (Serves 20-24)|0">9" (Serves 20-24)</option>
									<option value="10&quot; (Serves 26-35)|0">10" (Serves 26-35)</option>
									<option value="12&quot; (Serves 35-48)|0">12" (Serves 35-48)</option>
									<option value="14&quot; (Serves 50-65)|0">14" (Serves 50-65)</option>
									<option value="16&quot; (Serves 70-85)|0">16" (Serves 70-85)</option>
								</select>								
							</div>					
						
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<button class="btn btn-primary nextBtn pull-right" type="button">Next</button>	
							</div>
						</div>

						
								<!-- <div class="col-xs-12">
										<div class="col-md-11">
												<h3> Step 3</h3>
												<p>Take a moment to review the form, and edit any information.</p>
												<button class="btn btn-success pull-right" type="submit">Finish!</button>
										</div>
								</div>
						
						</div>-->
						
					</div>

				</form>

			</div>
		</div>

	</div>
	<!-- /.container -->

	<!-- Footer -->
	<?php include('footer.php'); ?>

	<?php include('layout-footer.php'); ?>
	
	<!-- Custom Plugins -->
    <script src="js/custom.js"></script>
	<script src="vendor/step-wizard/js/step-wizard.js"></script>
	<script src="vendor/step-wizard/js/jquery.tooltipster.min.js"></script>
	<script src="vendor/step-wizard/js/jquery.validate.min.js"></script>

	<script>
	$(document).ready(function(){
		/*$(".cake_size_single").click(function(){
			$(".cake_size_box").toggle();
		});

		$(".cake_size_box").change(function(){
			$("#cake_size_box2").show();
		});*/

		//Reference: https://jsfiddle.net/fwv18zo1/
		/*var $select1 = $( '#select1' ),
				$select2 = $( '#select2' ),
				$options = $select2.find( 'option' );
				
		$select1.on( 'change', function() {
			$select2.html( $options.filter( '[value="' + this.value + '"]' ) );
		} ).trigger( 'change' );*/

	});
	</script>
		
	
</body>

</html>
