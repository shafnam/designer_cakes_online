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

$id = $_GET['id'];

$testimonials = new Testimonial();
$testimonial_details = $testimonials->viewTestimonial($id);
extract($testimonial_details);

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
                        <h1 class="h3 m-2 text-gray-800">Testimonial Details</h1>
                        <a href="testimonials.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Testimonials</a>
                        </div>

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <form class="user">

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <h2><?php echo $name; ?></h2>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <label><?php echo $testimonial; ?></label>
                                                    </div>                                           
                                                </div>
                                                
                                                <hr>
                                                
                                            </form>

                                        </div>
                                    </div>

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
                
                <?php
                    // if (isset($_SESSION['return_msg'])) {
                    //     unset($_SESSION['return_msg']);
                    // }
                ?>

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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
	
	<script>
        $(document).ready(function () {
            $("#flash-msg").delay(3000).fadeOut("slow");
        });
	</script>

  </body>

</html>
<?php
if (isset($_SESSION['return_msg'])) {
    unset($_SESSION['return_msg']);
}
?>
