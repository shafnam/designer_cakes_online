<?php

    require_once 'config.php';
    require_once 'class.crud.php';
    
    $fillings = new Filling();

    if($_POST['id']){
        
        $id = $_POST['id'];       
        $filling_details = $fillings->viewFillingByFlavour($id);
        
        if($filling_details == null){

            echo "<h1>No Filling Available</h1>";

        } else {

            foreach ($filling_details as $row) { 
?>
            <div class="col-lg-4 mb-4">	

                <label class="img-label">
                    <input type="radio" name="filling" value="<?php echo $row['slug'];?>" id="<?php echo $row['slug'];?>" required>
                    <img class="card-img-top img-fluid" src="img/cake-fillings/<?php echo $row['image'];?>" alt="" style="width: 100px;">
                    <h4 class="px-3 pt-3 m-0"><?php echo $row['name'];?></h4>		
                </label>

            </div>

<?php
            }

            // while($row = mysqli_fetch_array($sql)){
            //     echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
            // }
        }
    }

?>