<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';

	$flavours = new Flavour();
	$flavour_details = $flavours->viewFlavourInfo($_GET['flavour_id']);
	extract($flavour_details); 

	//check whether item is a parent or child
	$product = new Product();
	$has_parent = $product->checkHasParent($_GET['flavour_id'],'flavours');
	
	$fillings = new Filling();
	$filling_details = $fillings->viewFillingByFlavour($_GET['flavour_id']);

	$tiers = new Tier();
	$tier_details = $tiers->viewParentTiers();
	$m_tier_details = $tiers->viewChildTiers();

	$designs = new Design();
	$desgin_details = $designs->viewParentDesigns('cupcakes-mini-cakes');

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

<body class="order-cake">
	<!-- Header -->
	
	<!-- Page Header -->
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

		<div class="row">
			<div class="col-lg-12 mx-auto d-block">
						
				<!-- multistep form -->
				<form class="form cf cake-flavours" id="order-flavour-form" method="post" action="inc/order-design-submit.php">
					<?php if($has_parent == null){ ?>
						<input type="hidden" name="flavour" value="<?php echo $id; ?>">
					<?php } else { ?>
						<input type="hidden" name="flavour" value="<?php echo $parentID; ?>">
						<input type="hidden" name="sub_flavour" value="<?php echo $childID; ?>">
					<?php }?>

				    <div class="wizard">

                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1" class="nav-link active">
										<span class="round-tab">
											<img src="img/step-2b.png">
										</span>
									</a>
									<p> Cake Filling</p>
                                </li>
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2" class="nav-link disabled">
										<span class="round-tab">
											<img src="img/step-3b.png">
										</span>
									</a>
									<p> Cake Size</p>
                                </li>
                                <li role="presentation" class="nav-item text-center mx-auto">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3" class="nav-link disabled">
										<span class="round-tab">
											<img src="img/step-6b.png">
										</span>
									</a>
									<p> Cake Design</p>
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

                            <!-- Please Choose a Cake Filling -->
							<div class="tab-pane active" role="tabpanel" id="step1">
								
								<h3 class="text-md-left pb-4">Please Choose a Cake Filling</h3>

                                <div class="row">

									<?php foreach ($filling_details as $row) { ?> 
										<div class="col-lg-3 mb-4">	

											<label class="img-label mx-auto d-block">
												<input type="radio" name="filling" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>" required>
												<img class="card-img-top img-fluid mx-auto d-block" src="img/cake-fillings/<?php echo $row['image'];?>" alt="" style="width: 100px;">
												<h5 class="pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
											</label>

										</div>
									<?php } ?>

								</div>
								
                                <ul class="list-inline text-md-left sub-cr">
									<li><button type="button" id="Step_1" class="btn main-btn btn-dark next-step next-button">Next</button></li>
								</ul>
								
                            </div>

                            <!-- Please Choose a Cake Tier -->
							<div class="tab-pane" role="tabpanel" id="step2">
								
								<div class="row px-5">

									<div class="col-lg-12 mb-4">
										<h3 class="text-md-left ml-0 mb-0">Please Choose Tier Type</h3>
									</div>	
										

									<?php foreach ($tier_details as $row) { ?>
										<div class="col-lg-2 mb-4">	

											<label class="img-label mx-auto d-block">
												<input type="radio" name="tiers" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>" required>
												<img class="card-img-top img-fluid mx-auto d-block" src="img/cake-tiers/<?php echo $row['image'];?>" alt="" style="width: 250px;">
												<h5 class="px-3 pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
											</label>

										</div>
									<?php } ?>  

									<div class="col-lg-7 mx-4 row p-2 sticky-table" style="">	
											
										<p class="text-right pl-3 mb-0">Approximate Cake Portions Servings Chart</p>

										<div class="col-lg-6 mb-0">
											
											<p class="pt-0 pb-1 mb-0"><small>Single Cakes</small></p>	

											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th>Cake Sizes</th>
															<th><i class="fas fa-circle" data-toggle="tooltip" data-placement="top" title="Circle Shape"></i></th>
															<th><i class="fa fa-square" data-toggle="tooltip" data-placement="top" title="Square Shape"></i></th>
															<th><i class="fa fa-heart" data-toggle="tooltip" data-placement="top" title="Heart Shape"></i></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th>5 Inch</th>
															<td>8</td>
															<td>8</td>
															<td>6</td>
														</tr>
														<tr>
															<th>6 Inch</th>
															<td>11</td>
															<td>18</td>
															<td>12</td>
														</tr>
														<tr>
															<th>7 Inch</th>
															<td>15</td>
															<td>24</td>
															<td>16</td>
														</tr>
														<tr>
															<th>8 Inch</th>
															<td>20</td>
															<td>32</td>
															<td>24</td>
														</tr>
														<tr>
															<th>9 Inch</th>
															<td>27</td>
															<td>35</td>
															<td>28</td>
														</tr>
														<tr>
															<th>10 Inch</th>
															<td>38</td>
															<td>50</td>
															<td>30</td>
														</tr>
														<tr>
															<th>11 Inch</th>
															<td>45</td>
															<td>56</td>
															<td>35</td>
														</tr>
														<tr>
															<th>12 Inch</th>
															<td>56</td>
															<td>72</td>
															<td>40</td>
														</tr>
														<tr>
															<th>14 Inch</th>
															<td>64</td>
															<td>98</td>
															<td>45</td>
														</tr>
													</tbody>
												</table>
											</div>

										</div> 

										<div class="col-lg-6 mb-0">	

											<p class="pt-0 pb-1 mb-0"><small>Tiered Cakes</small></p>

											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th>Cake Sizes</th>
															<th><i class="fas fa-circle" data-toggle="tooltip" data-placement="top" title="Circle Shape"></i></th>
															<th><i class="fa fa-square" data-toggle="tooltip" data-placement="top" title="Square Shape"></i></th>
															<th><i class="fa fa-heart" data-toggle="tooltip" data-placement="top" title="Heart Shape"></i></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th>6,10 Inch</th>
															<td>49</td>
															<td>68</td>
															<td>42</td>
														</tr>
														<tr>
															<th>8,12 Inch</th>
															<td>76</td>
															<td>104</td>
															<td>64</td>
														</tr>
														<tr>
															<th>6,8,10 Inch</th>
															<td>69</td>
															<td>100</td>
															<td>90</td>
														</tr>
														<tr>
															<th>6,9,12 Inch</th>
															<td>94</td>
															<td>125</td>
															<td></td>
														</tr>
														<tr>
															<th>8,10,12 Inch</th>
															<td>114</td>
															<td>154</td>
															<td>120</td>
														</tr>
														<tr>
															<th>6,8,10,12 Inch</th>
															<td>125</td>
															<td>172</td>
															<td></td>
														</tr>
														<tr>
															<th>8,10,12,14 Inch</th>
															<td>169</td>
															<td>308</td>
															<td></td>
														</tr>
														<tr>
															<th>6,8,10,12,14 Inch</th>
															<td>189</td>
															<td>326</td>
															<td></td>
														</tr>
														<tr>
															<td style="padding: 13px;"></td>
															<td style="padding: 13px;"></td>
															<td style="padding: 13px;"></td>
															<td style="padding: 13px;"></td>
														</tr>
													</tbody>
												</table>
											</div>

										</div> 

									</div>

								</div>								

								<div class="row mt-5 px-5" id="multiple-tier" style="display: none;">

									<div class="col-lg-12 mb-4">	
										<h3 class="text-md-left ml-0 py-2">Please Choose Number of Tiers</h3>
									</div>

									<?php foreach ($m_tier_details as $row) {  ?>
										<div class="col-lg-2 mb-4">	

											<label class="img-label mx-auto d-block" style="border: 0px solid #dee2e6;">
												<input type="radio" name="multiple_tiers" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>">
												<img class="card-img-top img-fluid mx-auto d-block" src="img/cake-tiers/<?php echo $row['image'];?>" alt="" style="width: 150px;">
												<h5 class="px-3 pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
											</label>

										</div>
									<?php } ?>

								</div>

								<div class="row px-5 cakeSizes" style="display: none;">									
								<!-- filled with ajax data -->
								</div>

								<div class="row px-5 cakeShapes" style="display: none;">									
								<!-- filled with ajax data -->
								</div>

								<div class="row px-5 cakeServings" style="display: none;">									
								<!-- filled with ajax data -->
								</div>

								<ul class="list-inline text-md-left sub-cr">
									<li><button type="button" id="Step_2" class="btn main-btn btn-dark next-step next-button">Next</button></li>
								</ul>								
								
							</div>
							
							<!-- Please Choose Tier Type -->
                            <div class="tab-pane" role="tabpanel" id="step3">
								
								<div class="row">

									<div class="col-lg-12 mb-0">
										<h3 class="text-md-left pb-0">Please Choose Cake Category</h3>
									</div>	

									<div class="col-lg-6 mb-0 sub-cr">

										<select class="form-control mb-2" name="design" id="design">
											<option value="0">Select Category</option>
											<?php 
												foreach ($desgin_details as $row) { 											
													$child_design_details = $designs->viewChildDesigns($row['id']);
													if(count($child_design_details) > 0 ) {
											?>
												<optgroup label="<?php echo $row['name'];?>">	
												<?php foreach ($child_design_details as $childrow) { ?>											
													<option value="<?php echo $childrow['id'];?>"><?php echo $childrow['name'];?></option>
												<?php } ?>
												</optgroup>
											<?php 
													} 
													else { ?>
													<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
											<?php
													}
												}
											?>
										</select>

									</div>
									<div class="col-lg-6 mb-0"></div>

								</div>	

								<div class="row cakeDesigns mt-2" style="display: none;">									
									<!-- filled with ajax data -->
								</div>


								<ul class="list-inline text-md-left sub-cr">
                                    <li><button id="Step_3" class="btn main-btn btn-dark next-step next-button">Next</button></li>
								</ul>
								
							</div>
							
                           	<!-- Fill the Personal Details -->
							<div class="tab-pane" role="tabpanel" id="step4">
									
								<h3 class="text-md-left pb-4">Please Fill Your Personal Details Below</h3>

								<div class="row sub-cr py-0">
									
									<div class="col-lg-6 mb-0">

										<div class="form-group">
											<label for="name">First Name:</label>
											<input type="text" class="form-control" id="f_name" name="f_name" required>
										</div>
										
										<div class="form-group">
											<label for="email">Email address:</label>
											<input type="email" class="form-control" id="email" name="email" required>
										</div>																											

									</div>

									<div class="col-lg-6 mb-0">

										<div class="form-group">
											<label for="name">Last Name:</label>
											<input type="text" class="form-control" id="l_name" name="l_name" required>
										</div>
										
										<div class="form-group">
											<label for="phone">Phone Number:</label>
											<input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" required>
										</div>																			

									</div>										

								</div>

								<div class="row sub-cr py-0">

									<div class="col-lg-6 mb-0">

										<div class="form-group">
											<label for="delivery_date">Pick Up/Delivery Date:</label>
											<input id="datepicker" name="delivery_date" width="276" required />		
										</div>

									</div>
									
									<div class="col-lg-6 mb-0">

										<div class="form-group mb-0">
											<label for="method">Method:</label>

											<div class="form-check ml-4">
												<input class="form-check-input" type="radio" value="pick-up" name="method" id="pick-up" required>
												<label class="form-check-label" for="pick-up">
													Pick Up
												</label>
											</div>
											<div class="form-check ml-4">
												<input class="form-check-input" type="radio" value="deliver" name="method" id="deliver">
												<label class="form-check-label" for="deliver">
													Deliver Within Toowoomba ($20)
												</label>
											</div>
											
										</div>

									</div>

									<div class="col-lg-12 mb-0" id="venuAddress" style="display: none;">

										<div class="form-group">
											<label for="venue_address">Venue Address</label>
											<textarea class="form-control" id="venue_address" name="venue_address" rows="3"></textarea>
										</div>

									</div>

								</div>

								<div class="row sub-cr py-0">

									<div class="col-lg-12 mt-0">
										<div class="form-check ml-4">
											<input class="form-check-input" type="checkbox" name="add_details_on_cake" id="add_details_on_cake">
											<label class="form-check-label" for="add_details_on_cake">
												Need to add name and age on cake
											</label>
										</div>
									</div>

								</div>									

								<div class="row sub-cr" id="nameAgeBox" style="display: none;">
								
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
												
								<ul class="list-inline text-md-left sub-cr">
									<li><button type="submit" id="Step_4" class="btn main-btn btn-dark next-step next-button">Submit Order</button></li>
								</ul>

							</div> 
							
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

	<script>
		$('#datepicker').datepicker({
			uiLibrary: 'bootstrap4',
			disableDates:  function (date) {
				const currentDate = new Date();
				return date > currentDate ? true : false;
			}
    	});
	</script>
		
	
</body>

</html>
