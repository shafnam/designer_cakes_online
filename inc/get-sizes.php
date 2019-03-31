<?php

    require_once 'config.php';
    require_once 'class.crud.php';
    
    $sizes = new Size();

    if($_POST['id']){
        
        $id = $_POST['id'];       
        $size_details = $sizes->viewSizeByTier($id);
        
        if($size_details == null){

            echo "<h1>No Sizes Available</h1>";

        } else {
?>
            <div class="col-lg-12 mt-4">	
             <h3 class="text-md-left pb-4">Please Choose Cake Size</h3>
            </div>

            <div class="col-lg-6 mb-4">	
                
                <select class="form-control mb-2" name="size" id="size">
                    <option value='0'>Select Size</option>
                    <?php foreach ($size_details as $row) { ?>
                        <option value='<?php echo $row['id']; ?>'><?php echo $row['name']; ?> Inch</option>
                    <?php } ?>
                </select>

            </div>
            <div class="col-lg-6 mb-4"></div>

<?php
            

        }
    }

?>