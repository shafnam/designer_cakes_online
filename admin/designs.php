<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

// Include config file
require_once "includes/class.crud.php";

$designs = new Design();
$desgin_details = $designs->viewParentDesigns();


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <?php include 'header.php'; ?>
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

		<!-- Page Wrapper -->
		<div id="wrapper">

			<!-- Sidebar -->
			<?php include('sidebar.php'); ?>
			<!-- End of Sidebar -->

			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">

				<!-- Main Content -->
				<div id="content">

					<!-- Topbar -->
					<?php include('top-navbar.php'); ?>
					<!-- End of Topbar -->

          <!-- Begin Page Content -->
          
          <div class="container-fluid">

          <div class="row">                                
              <div class="col-lg-12">
              <?php
                if (isset($_SESSION['return_msg'])) {
                  echo $_SESSION['return_msg'];
                }
              ?>
              </div>
          </div>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Designs</h1>
            <!-- <a href="design-add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a> -->
          </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

              <!-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Designs</h6>
              </div> -->

              <div class="card-body p-5">
                
                <div class="row">
                  
                  <?php foreach ($desgin_details as $row) { ?> 
                    <div class="col-6 col-md-4 col-lg-4 mb-4">
                      <div class="card mx-auto text-center">
                        <img class="card-img-top" src="../img/<?php echo $row['image'];?>" alt="<?php echo $row['name'];?>">
                        <div class="card-footer">	
                        <?php 
                          $child_design_details = $designs->viewChildDesigns($row['id']);
                          if(count($child_design_details) > 0 ){
                        ?>		
                          <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              <?php echo $row['name'];?>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="design-view.php?design_id=<?php echo $row['id']; ?>">All <?php echo $row['name'];?></a>
                              <?php foreach ($child_design_details as $childrow) { ?>
                                <a class="dropdown-item" href="design-view.php?design_id=<?php echo $childrow['id']; ?>"><?php echo $childrow['name'];?></a>
                              <?php } ?>
                            </div>
                          </div>
                        <?php } else { ?>
                          <a href="design-view.php?design_id=<?php echo $row['id']; ?>" class="btn btn-primary">
                            <?php echo $row['name'];?>                     
                          </a>
                        <?php }?>
                        </div>
                      </div>
                    </div>
                  <?php 
                    } 
                  ?>		

                  

                </div>

              </div>

            </div>

          </div>
          <!-- /.container-fluid -->

        </div>
					
				<!-- End of Main Content -->

				<!-- Footer -->
				<?php include('page-footer.php'); ?>
				<!-- End of Footer -->

			</div>
			<!-- End of Content Wrapper -->

		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
    </a>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
	
	<script>
    
	</script>

  </body>

</html>
<?php
if (isset($_SESSION['return_msg'])) {
    unset($_SESSION['return_msg']);
}
