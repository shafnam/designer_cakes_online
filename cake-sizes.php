<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';

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

	<title>Cake Sizes | Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>

</head>

<body>
	<!-- Header -->
	<?php include('header.php'); ?>

	<!-- Page Header -->
	<div class="container cake-designs">
		<!-- Page Heading/Breadcrumbs -->
		<h1>Cake Sizes</h1>
	</div>
	
	<!-- Page Content -->
	<div class="container cake-sizes cake-flavours pt-4" id="cake_size">

		<form method="get" action="order-size.php">

			<div class="row">	
												
				<div class="col-lg-12 mb-3">			
					<h3 class="text-md-left ml-0 py-2">Approximate Cake Portions Servings Chart</h3>
				</div>

				<div class="col-lg-6 mb-0">
					
					<p class="pt-0 mb-3" style="background: pink; padding-left: 1rem;">Single Cakes</p>	

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Cake Sizes</th>
									<th>Round Shaped</th>
									<th>Square Shaped</th>
									<th>Heart Shaped</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>5 Inch</th>
									<td>8 Servings</td>
									<td>8 Servings</td>
									<td>6 Servings</td>
								</tr>
								<tr>
									<th>6 Inch</th>
									<td>11 Servings</td>
									<td>18 Servings</td>
									<td>12 Servings</td>
								</tr>
								<tr>
									<th>7 Inch</th>
									<td>15 Servings</td>
									<td>24 Servings</td>
									<td>16 Servings</td>
								</tr>
								<tr>
									<th>8 Inch</th>
									<td>20 Servings</td>
									<td>32 Servings</td>
									<td>24 Servings</td>
								</tr>
								<tr>
									<th>9 Inch</th>
									<td>27 Servings</td>
									<td>35 Servings</td>
									<td>28 Servings</td>
								</tr>
								<tr>
									<th>10 Inch</th>
									<td>38 Servings</td>
									<td>50 Servings</td>
									<td>30 Servings</td>
								</tr>
								<tr>
									<th>11 Inch</th>
									<td>45 Servings</td>
									<td>56 Servings</td>
									<td>35 Servings</td>
								</tr>
								<tr>
									<th>12 Inch</th>
									<td>56 Servings</td>
									<td>72 Servings</td>
									<td>40 Servings</td>
								</tr>
								<tr>
									<th>14 Inch</th>
									<td>64 Servings</td>
									<td>98 Servings</td>
									<td>45 Servings</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div> 

				<div class="col-lg-6 mb-0">	

					<p class="pt-0 mb-3" style="background: pink; padding-left: 1rem;">Tiered Cakes</p>

					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>Cake Sizes</th>
									<th>Round Shaped</th>
									<th>Square Shaped</th>
									<th>Heart Shaped</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>6,10 Inch</th>
									<td>49 Servings</td>
									<td>68 Servings</td>
									<td>42 Servings</td>
								</tr>
								<tr>
									<th>8,12 Inch</th>
									<td>76 Servings</td>
									<td>104 Servings</td>
									<td>64 Servings</td>
								</tr>
								<tr>
									<th>6,8,10 Inch</th>
									<td>69 Servings</td>
									<td>100 Servings</td>
									<td>90 Servings</td>
								</tr>
								<tr>
									<th>6,9,12 Inch</th>
									<td>94 Servings</td>
									<td>125 Servings</td>
									<td></td>
								</tr>
								<tr>
									<th>8,10,12 Inch</th>
									<td>114 Servings</td>
									<td>154 Servings</td>
									<td>120 Servings</td>
								</tr>
								<tr>
									<th>6,8,10,12 Inch</th>
									<td>125 Servings</td>
									<td>172 Servings</td>
									<td></td>
								</tr>
								<tr>
									<th>8,10,12,14 Inch</th>
									<td>169 Servings</td>
									<td>308 Servings</td>
									<td></td>
								</tr>
								<tr>
									<th>6,8,10,12,14 Inch</th>
									<td>189 Servings</td>
									<td>326 Servings</td>
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

			<div class="row pt-4">

				<div class="col-lg-12 mb-4">
					<h3 class="text-md-left ml-0 py-2">Tier Types</h3>
					<p class="pt-0 mb-3" style="background: pink; padding-left: 1rem;">Click Tier to View Options</p>	
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

			</div>
			
			<div class="row mt-5" id="multiple-tier" style="display: none;">

				<div class="col-lg-12 mb-4">	
					<h3 class="text-md-left ml-0 py-2">Available Number of Tiers</h3>
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
				<li><button type="submit" id="Step_2" class="btn main-btn btn-dark next-step next-button">Order Now</button></li>
			</ul>

		</form>
		
		<!-- <h3 class="pt-1">Approximate Cake Portions Servings Chart</h3>

		<div class="row mt-3">

			<div class="col-lg-12 mb-3">
				<h4 class="pt-5 pb-1">Single Cakes</h4>				
			</div>

			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Cake Sizes</th>
								<th>Round Sponge</th>
								<th>Square Sponge</th>
								<th>Heart Shaped</th>
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

		</div>
		
		<div class="row mt-3">
			<div class="col-lg-12 mb-3">
				<h4 class="pt-5 pb-1">Tiered Cakes</h4>
			</div>
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Cake Sizes</th>
								<th>Round Sponge</th>
								<th>Square Sponge</th>
								<th>Heart Shaped</th>
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
						</tbody>
					</table>
				</div>
			</div>		
			
		</div>

		<div class="row mt-5">	
			<div class="col-lg-12 mb-3">
				<img class="img-fluid pb-3" src="img/cake-sizes.png" alt="">				
			</div>
		</div> -->

	</div>

	<?php include('footer.php'); ?>
	
	<?php include('layout-footer.php'); ?>	

</body>

</html>
