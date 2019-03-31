<?php

    require_once 'config.php';
    require_once 'class.crud.php';
    
    $shapes = new Shape();

    if($_POST['id']){
        
        $id = $_POST['id'];       
        $shape_details = $shapes->viewShapeBySize($id);
        
        if($shape_details == null){

            echo "<h1>No Shapes Available</h1>";

        } else {
?>
            <div class="col-lg-12 mt-04">	
             <h3 class="text-md-left pb-4">Please Choose Cake Shape</h3>
            </div>
<?php
            foreach ($shape_details as $row) { 
?>

            <div class="col-lg-4 mb-4">	

                <label class="img-label">
                    <input type="radio" name="shape" value="<?php echo $row['id'];?>" id="<?php echo $row['slug'];?>" required>
                    <img class="card-img-top img-fluid" src="img/cake-shapes/<?php echo $row['image'];?>" alt="" style="width: 150px;">
                    <h5 class="pt-3 m-0 text-center"><?php echo $row['name'];?></h4>		
                </label>

            </div>

<?php
            }

        }
    }

?>