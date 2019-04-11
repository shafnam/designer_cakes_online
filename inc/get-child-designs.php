<?php

    require_once 'config.php';
    require_once 'class.crud.php';
    
    $products = new Product();

    if($_POST['id']){
        
        $id = $_POST['id'];       
        $product_details = $products->viewDesignProductImages($id);
        
        if($product_details == null){

            echo '<div class="col-lg-12 mt-0"><h5 class="text-md-left pb-0 pl-5">No Designs Yet. Please Choose Another Cake Category</h5></div>';

        } else {
?>
            <div class="col-lg-12 mb-4">	
                <h3 class="text-md-left pb-0">Please Choose a Preferred Design</h3>
            </div>

            <?php foreach ($product_details as $row) { ?>
                <div class="col-lg-3 mb-4">	

                    <label class="img-label mx-auto d-block">
                        <input type="radio" name="product" value="<?php echo $row['ProductID'];?>" id="<?php echo $row['ProductName'];?>" required>
                        <img class="card-img-top img-fluid mx-auto d-block" src="img/gallery/<?php echo $row['ProductName'] . '/' . $row['ProductImage'];?>" alt="" style="width: 200px;">
                        <h5 class="px-3 pt-3 m-0 text-center"><?php echo $row['ProductName'];?></h4>		
                    </label>

                </div>
            <?php } ?>  

<?php   }
    }
?>