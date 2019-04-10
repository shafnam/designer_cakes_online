<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';
	
	$fillings = new Filling();	
	$filling_details = $fillings->viewFillings();
	
	// print_r($filling_details);
	// die();
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Cake Fillings | Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>
	
	<style>
	</style>

</head>

<body>
	<!-- Header -->
	<?php include('header.php'); ?>

	<!-- Page Header -->
	<div class="container cake-designs">
		<!-- Page Heading/Breadcrumbs -->
		<h1>Cake Fillings</h1>
	</div>	
	
	<div class="container mt-5 cake-filling">
		
		<div class="row mt-5">

		<?php foreach ($filling_details as $row) { ?> 
		<div class="col-lg-3 mb-4">
			
			<div class="card m-3">

				<img class="card-img-top" src="img/cake-fillings/<?php echo $row['image'];?>" alt="<?php echo $row['name'];?>" style="height: 195px;">	
				
				<div class="card-footer">				
					<h5 class="px-3 pt-3 m-0"><?php echo $row['name'];?></h5>
					<a class="btn main-btn btn-dark mx-3 mt-3" href="order-filling.php?filling_id=<?php echo $row['id'];?>">Order Cake</a>									  
				</div>
				
			</div>

		</div>
		<?php } ?>

		</div>		

		<!-- <div class="row mt-5 pt-3">
			
			<div class="col-md-6">
				<img class="img-fluid" src="img/cake-fillings-sample.png" style="height: 500px;">  
			</div>

			<div class="col-md-6">
				<ul class="list-group">
					<li class="list-group-item">Vanilla Buttercream</li>
					<li class="list-group-item">Cream Cheese Buttercream</li>
					<li class="list-group-item">Chocolate Buttercream</li>
					<li class="list-group-item">Chocolate Hazelnut Buttercream</li>
					<li class="list-group-item">Strawberry Buttercream</li>
					<li class="list-group-item">Passionfruit Buttercream</li>
					<li class="list-group-item">Pineapple and Peach with Vanilla Buttercream</li>
					<li class="list-group-item">Passionfruit and Peach with Vanilla Buttercream</li>
					<li class="list-group-item">Black forest filling with Chocolate Buttercream</li>
					<li class="list-group-item">Strawberry jam with vanilla Buttercream</li>
					<li class="list-group-item">Rum Flavoured Buttercream</li>
					<li class="list-group-item">Blueberry flavoured buttercream</li>
					<li class="list-group-item">Butterscotch Flavoured Buttercream</li>
					<li class="list-group-item">Caramel flavoured buttercream</li>
					<li class="list-group-item">Lime Flavoured Buttercream</li>
				</ul>
			</div>	

			<div class="col-md-12 mt-5 py-5">	
			
				<h3 class="pb-3">Cross Matching Guide for Recommended Flavours and Fillings (BC = Buttercream)</h3>
				
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Cake</th>
								<th>Vanilla BC</th>
								<th>Cream Cheese BC</th>
								<th>Chocolate BC</th>
								<th>Chocolate Hazelnut BC</th>
								<th>Strawberry BC</th>
								<th>Passion fruit BC</th>
								<th>Pineapple + Peach</th>
								<th>Passionfruit + Peach</th>
								<th>Blackforest filling</th>
								<th>Rum Flavoured BC</th>
								<th>Blueberry BC</th>
								<th>Butterscotch BC</th>
								<th>Caramel BC</th>
								<th>Lime BC</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Vanilla</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
							 <tr>
								<td>Chocolate</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							 <tr>
								<td>Strawberry</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Coffee</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
							<tr>
								<td>Carrot</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Choco Mud</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Red Velvet</td>
								<td></td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>SL Vanilla Butter Cake</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
							<tr>
								<td>SL Choc Cake</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>SL Ribbon Cake</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Eggless Choc</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Eggless Vanilla</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
							<tr>
								<td>Gluten Free Choc</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Gluten Free Vanilla</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
							<tr>
								<td>Lactose Free Choc</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Lactose Free Vanilla</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
							<tr>
								<td>Vegan Choc</td>
								<td>✓</td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Vegan Vanilla</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
								<td>✓</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div> -->
	</div>


	<?php include('footer.php'); ?>
	
	<?php include('layout-footer.php'); ?>	

</body>

</html>
