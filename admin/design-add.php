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

// Define variables and initialize with empty values
$name = $design_parent = $uploaded_msg = "";
$name_err = $design_parent_err = $image_upload_err = "";
// image upload
$errors = array();
$uploadedFiles = array();
$extension = array("jpeg","jpg","png","gif");
$bytes = 1024;
$KB = 1024;
$totalBytes = $bytes * $KB;


$counter = 0;

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $designs = new Design();
    $design_details = $designs->viewDesigns($id);	

    $products = new Product();
    $product_details = $products->viewAllDesignProducts($id);

    //extract($product_details);
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $design_parent = $_GET['id'];

    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter name.";
    } else{
        $name = trim($_POST["name"]);
    }

  // Validate credentials
  if(empty($name_err) && empty($design_parent_err)){

    //$folder_name = preg_replace('/\s+/', '', $name);
    // Create directory if it does not exist
    if(!is_dir("../img/gallery/". $name)) {
        mkdir("../img/gallery/". $name); 
    }
    $UploadFolder = "../img/gallery/". $name;

    // echo($UploadFolder);
    // die();

    // add product details
    $product_details = new Product();
    $product_id = $product_details->insertProduct($design_parent,$name);
    
    foreach($_FILES["file_upload"]["tmp_name"] as $key=>$tmp_name){
        
        $temp = $_FILES["file_upload"]["tmp_name"][$key];
        $name = $_FILES["file_upload"]["name"][$key];
         
        if(empty($temp))
        {
            break;
        }
         
        $counter++;
        $UploadOk = true;
         
        if($_FILES["file_upload"]["size"][$key] > $totalBytes)
        {
            $UploadOk = false;
            array_push($errors, $name." file size is larger than the 1 MB.");
        }
         
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        if(in_array($ext, $extension) == false){
            $UploadOk = false;
            array_push($errors, $name." is invalid file type.");
        }
         
        if(file_exists($UploadFolder."/".$name) == true){
            $UploadOk = false;
            array_push($errors, $name." file is already exist.");
        }
         
        if($UploadOk == true){
            move_uploaded_file($temp,$UploadFolder."/".$name);
            array_push($uploadedFiles, $name);
            // insert image details to db
            $product_details->insertProductImages($product_id,$name);
        }
    }

    if($counter>0){

        if(count($errors)>0)
        {
            $image_upload_err = "<p>Errors:</p>";
            $image_upload_err .="<ul class='list-group'>";
            foreach($errors as $error)
            {
                $image_upload_err .= "<li class='list-group-item'>".$error."</li>";
            }
            $image_upload_err .= "</ul>";
        }
         
        if(count($uploadedFiles)>0)
        {
            $uploaded_msg  = "<p>Uploaded Files:</p>";
            $uploaded_msg .= "<ul class='list-group'>";
            foreach($uploadedFiles as $fileName)
            {
                $uploaded_msg .= "<li class='list-group-item'>".$fileName."</li>";
            }
            $uploaded_msg .= "</ul><br/>";
             
            $uploaded_msg .= "<p> " . count($uploadedFiles)." file(s) are successfully uploaded.</p>";

            $result = true;
        }                               
    }
    else{
        $image_upload_err = "Please, Select file(s) to upload.";
    }

    // add images details
    //$result = $product_details->insertProductImages($product_id,$image);


    if($result){
        $_SESSION['return_msg'] = '<div id="flash-msg" class = "alert alert-success r-sucess" role = "alert"> Product added successfully</div>';
    } else {
        $_SESSION['return_msg'] = '<div class="alert alert-danger r-fail" role="alert">Oops! something went wrong. Please try again.</div>';
    }

  }

}

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    
    <?php include 'header.php'; ?>
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        
    </style>


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
                            <div class="col-lg-12 px-5 py-2" style="color: orange;">
                                <?php echo $image_upload_err; ?>
                                <?php echo $uploaded_msg; ?>
                            </div>
                        </div>

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 m-2 text-gray-800">Add New Product</h1>
                        <a href="testimonials.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Designs</a>
                        </div>

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                
                                    <div class="col-lg-12">
                                        <div class="p-5">
                                            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

                                                <div class="form-group<?php echo (!empty($design_parent_err)) ? 'has-error' : ''; ?> row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <select class="form-control mb-2" name="design_parent" id="design_parent" disabled>
                                                            <option value='<?php echo $design_details['id']; ?>' selected><?php echo $design_details['name']; ?></option>
                                                        </select>
                                                        <span class="help-block"><?php echo $design_parent_err; ?></span>     
                                                        <!-- <input type="text" name="design_parent" class="form-control" id="design_parent" value="<?php echo $design_details['name']; ?>" readonly required>-->
                                                    </div>
                                                </div>

                                                <div class="form-group<?php echo (!empty($name_err)) ? 'has-error' : ''; ?> row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" required>
                                                        <span class="help-block"><?php echo $name_err; ?></span>                                                    
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label> Product Images <small><em>(Max 5)</em></small></label>      
                                                    </div>                                           
                                                </div>

                                                <div class="form-group col-lg-12 input-files">
                                                    <div class="row upimg img-1">
                                                        <div class="col-lg-3">
                                                            <div id="uploadPreview-1" class="prev-img"></div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="file-upload" class="custom-file-upload" id="file-up-btn-1">
                                                                Add a Photo
                                                            </label>        
                                                            <input type="file" name="file_upload[]" required>
                                                        </div>
                                                        <a href="javascript:void(0);" id='remove-1' class="remImg" style="display:none;">
                                                            <i class="fa fa-minus-circle remove-num" aria-hidden="true"></i>
                                                            Delete Image
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <div id='addAnother' style="display:none;">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i><a href="javascript:void(0);" class="addImg"> Add Another Image</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="form-group row">
                                                    <div class="col-sm-2 mb-3 mb-sm-0">
                                                        <input type="submit" class="btn btn-primary btn-block" id="product_submit_btn" value="Add Product">
                                                    </div>
                                                </div>                                     
                                                
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

    <!-- Page level custom scripts -->
    <script src="js/demo/multi-image-upload.js"></script>
	
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
