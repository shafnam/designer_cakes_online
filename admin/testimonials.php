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

$testimonals = new Testimonial();
$testimonal_details = $testimonals->getAllTestimonials();

if(isset($_POST['btn-del']))
{
  $id = $_POST['id'];
  $result = $testimonals->deleteTestimonial($id);

  if($result){
    $_SESSION['return_msg'] = '<div id="flash-msg" class = "alert alert-success r-sucess" role = "alert"> Testimonial deletd successfully</div>';
    header('Location: testimonials.php');
    exit; 
  } else {
    $_SESSION['return_msg'] = '<div class="alert alert-danger r-fail" role="alert">Oops! something went wrong. Please try again.</div>';
  }

}

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <?php include 'header.php'; ?>
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
              <h1 class="h3 mb-0 text-gray-800">Testimonials</h1>
              <a href="testimonial-add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Testimonials</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="testimonialsDataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Testimonial</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Testimonial</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($testimonal_details as $row){ ?>
                      <tr>
                        <td><?php echo($row['name'])  ?></td>
                        <td><?php echo($row['testimonial']) ?>  </td>
                        <td>
                          <a href="testimonial-view.php?id=<?php echo $row['id'] ?>" title="View Details" class="btn btn-success btn-circle btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="testimonial-edit.php?id=<?php echo $row['id'] ?>" title="Edit Testimonial" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> </a>
                          <a class="open-del btn btn-danger btn-circle btn-sm" href="#" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['id'];?>">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>  
                    </tbody>
                  </table>
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
    
    <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you Sure to Delete?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              Select "Delete" below if you are ready to delete the testimonial.
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" id="id" value=""/>
                <input type="submit" name="btn-del" class="btn btn-primary" value="Delete Testimonial">
              </form>
            </div>
          </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
	
    <script>
      $(document).on("click", ".open-del", function () {
          var Id = $(this).data('id');
          $(".modal-footer #id").val( Id );
          // As pointed out in comments, 
          // it is unnecessary to have to manually call the modal.
          // $('#addBookDialog').modal('show');
      });
    
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
