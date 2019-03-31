<?php

    require_once 'config.php';
    require_once 'class.crud.php';
    
    $servings = new Serving();

    if($_POST['id'] && $_POST['tier_id'] && $_POST['size_id'] ){
        
        $id = $_POST['id']; 
        $size_id = $_POST['size_id'];  
        $tier_id = $_POST['tier_id'];      

        $serving_details = $servings->viewServingsBySizeAndTier($id,$size_id,$tier_id);
        
        if($serving_details == null){

            echo "<h1>No Servings Available</h1>";

        } else {
?>
            <div class="col-lg-12 mt-4">	
             <h5 class="text-md-left pb-4">Approximate Cake Servings: <?php echo $serving_details['name']; ?> People</h5>
            </div>

<?php            

        }
    }

?>