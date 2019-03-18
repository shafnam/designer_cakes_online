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

	<!-- Page Content -->
	<div class="container homepage">

		<!-- Cake Category Section-->
		<div class="row mt-0 home-cake-section">

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

		</div>
		<!-- /.row -->
		
	</div>

	<?php include('footer.php'); ?>
	
	<?php include('layout-footer.php'); ?>	

</body>

</html>
