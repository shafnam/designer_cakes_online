<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

// Include config file
require_once "includes/config.php";

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include 'header.php'; ?>
  </head>

  <body>

    <!-- Navigation -->
    <?php //include 'menu.php'; ?>

    <!-- Page Content -->
    <div class="container inner-page award-s">

      <!-- Page Heading/Breadcrumbs 
      <h2 style="margin-top: 3rem !important;margin-bottom: 3rem !important;">
        Add New Event
      </h2>-->
		
		<div class="row">
			
			<div class="col-md-12">

				<div class="card" style="margin-bottom: 100px;">
					<div class="card-header">	
						<h3 class="float-left">All Products</h3>
						<a href="add-event.php" class="btn btn-info float-right btn-sm">Add New Product</a>
					</div>
					<div class="card-body">	
						<table class="table">
							<tr>
								<th>Event Image</th>
								<th style="width: 20%;">Event Name</th>
								<th style="width: 20%;">Description</th>
								<th>Date</th>
								<th style="width: 20%;">Venue</th>
								<th>Time</th>
								<th>Action</th>
							</tr>
							<?php 
								/*$sql = "SELECT * FROM events ORDER BY date DESC";								
								if($stmt = $pdo->prepare($sql)){									
									if($stmt->execute()){
										while ($row = $stmt->fetch()) { ?>	
										<tr>
											<td><img src="images/<?php echo $row['image']; ?>" style="width: 100px;"></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['description']; ?></td>
											<td><?php echo $row['date']; ?></td>
											<td><?php echo $row['venue']; ?></td>
											<td><?php echo $row['time']; ?></td>
											<td>
												<a href="edit-event.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a> 
												<a href="delete-event.php?id=<?php echo $row['id']; ?>" id="delete-event.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this item?');">Delete</a>
											</td>	
										</tr>
										<?php } ?>
										
									<?php 
									} else{
										echo "Oops! Something went wrong. Please try again later.";
									}
								}*/
							?>							
						</table>		
					</div>
					<div class="card-footer">
						<a href="logout.php" class="btn btn-warning float-right btn-sm">Sign out from your account</a>
					</div>
				</div>
			
			</div>
			
		</div>

    </div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>
	
	<script>
	</script>

  </body>

</html>
