<?php	
	require_once 'inc/config.php';
	require_once 'inc/class.crud.php';
	
	$flavours = new Flavour();	
	$flavour_details = $flavours->viewParentFlavours();	
	//$products = new Product();
	//$product_details = $products->viewAllDesignProducts($_GET['design_id']);

	//extract($design_details); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Cake Flavours | Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>
	
	<style>
	
	
	</style>

</head>

<body>
	<!-- Header -->
	<?php include('header.php'); ?>

	<!-- Page Header -->
	<div class="container cake-designs" id="cake-flavours">
		<!-- Page Heading/Breadcrumbs -->
		<h1>Cake Flavours</h1>
	</div>	
	
	<div class="container mt-5 cake-flavours">

		<div class="row mt-5">

			<?php foreach ($flavour_details as $row) { ?> 
			<div class="col-lg-4 mb-4">
				<div class="card m-3" id="zoomInd">
					<img id="Flavour-<?php echo $row['id'];?>" class="card-img-top" src="img/cake-flavours/<?php echo $row['image'];?>" alt="<?php echo $row['name'];?>" style="height: 195px;">	
					
					<div class="card-footer">				
						<h4 class="px-3 pt-3 m-0"><?php echo $row['name'];?></h4>
					<?php 
						$child_flavour_details = $flavours->viewChildFlavours($row['id']);
						if(count($child_flavour_details) > 0 ){
					?>
						<h6 class="pt-3 px-3 showFlavours" data-id="<?php echo $row['id'];?>">View Available Flavours</h6>

						<div id="flavourOptions-<?php echo $row['id'];?>" style="display:none;">
							<div class="form-group px-3 m-0">
								<select id="dLabel" class="form-control" onchange="document.getElementById('Flavour-<?php echo $row['id'];?>').src = this.value">
								<?php foreach ($child_flavour_details as $childrow) { ?>
									<option value="img/cake-flavours/<?php echo $childrow['image'];?>" data-id="<?php echo $childrow['id'];?>"><?php echo $childrow['name'];?></option>
								<?php } ?>
								</select>
							</div>

							<a id="OrderLinkOne" class="btn main-btn btn-dark mx-3 mt-3" href="order-flavour.php?flavour_id=<?php echo $childrow['id'];?>">Order Now</a> 
						
						</div>

					<?php } else {?>
						<a id="OrderLinkOne" class="btn main-btn btn-dark mx-3 mt-3" href="order-flavour.php?flavour_id=<?php echo $row['id'];?>">Order Now</a>									  
					<?php } ?>					
					</div>
				</div>
			</div>
			<?php } ?>

		</div>		

	</div>


	<?php include('footer.php'); ?>
	
	<?php include('layout-footer.php'); ?>	

</body>

</html>
