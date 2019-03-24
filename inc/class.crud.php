<?php

    include_once 'config.php';

    class Design
    {
        private $conn;
	
        public function __construct()
        {
            try {
                $this->con = new Database();
                $this->con = $this->con->dbConnection();
            } catch (Exception $e) {
                die("Error:" . $e->getMessage());
            }            
        }

        function viewParentDesigns() {
    
            $sql = "SELECT * FROM designs WHERE parent_id IS NULL";    
            $stmt = $this->con->query($sql);    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }
        }

        function viewChildDesigns($parent_id) {
    
            $sql = "SELECT * FROM designs WHERE parent_id = :parent_id";    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':parent_id' => $parent_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewDesigns($id) {
    
            $sql = "SELECT * FROM designs WHERE id = :id";    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        /*
        public function create($fname,$lname,$email,$contact)
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO tbl_users(first_name,last_name,email_id,contact_no) VALUES(:fname, :lname, :email, :contact)");
                $stmt->bindparam(":fname",$fname);
                $stmt->bindparam(":lname",$lname);
                $stmt->bindparam(":email",$email);
                $stmt->bindparam(":contact",$contact);
                $stmt->execute();
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage(); 
                return false;
            }
        
        }
 
        public function getID($id)
        {
            $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
            $stmt->execute(array(":id"=>$id));
            $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
            return $editRow;
        }
 
        public function update($id,$fname,$lname,$email,$contact)
        {
            try
            {
                $stmt=$this->db->prepare("UPDATE tbl_users SET first_name=:fname, 
                                                                last_name=:lname, 
                                email_id=:email, 
                                contact_no=:contact
                            WHERE id=:id ");
                $stmt->bindparam(":fname",$fname);
                $stmt->bindparam(":lname",$lname);
                $stmt->bindparam(":email",$email);
                $stmt->bindparam(":contact",$contact);
                $stmt->bindparam(":id",$id);
                $stmt->execute();
                
                return true; 
            }
            catch(PDOException $e)
            {
                echo $e->getMessage(); 
                return false;
            }
        }
 
        public function delete($id)
        {
            $stmt = $this->db->prepare("DELETE FROM tbl_users WHERE id=:id");
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        }*/
 
        /* paging
        
        public function dataview($query)
        {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            if($stmt->rowCount()>0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                                <tr>
                                <td><?php print($row['id']); ?></td>
                                <td><?php print($row['first_name']); ?></td>
                                <td><?php print($row['last_name']); ?></td>
                                <td><?php print($row['email_id']); ?></td>
                                <td><?php print($row['contact_no']); ?></td>
                                <td align="center">
                                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                </td>
                                <td align="center">
                                <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                                </td>
                                </tr>
                                <?php
                }
            }
            else
            {
            ?>
                        <tr>
                        <td>Nothing here...</td>
                        </tr>
                        <?php
            }
        
        }
    
        public function paging($query,$records_per_page)
        {
            $starting_position=0;
            if(isset($_GET["page_no"]))
            {
                $starting_position=($_GET["page_no"]-1)*$records_per_page;
            }
            $query2=$query." limit $starting_position,$records_per_page";
            return $query2;
        }
        
        public function paginglink($query,$records_per_page)
        {
        
            $self = $_SERVER['PHP_SELF'];
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            $total_no_of_records = $stmt->rowCount();
            
            if($total_no_of_records > 0)
            {
                ?><ul class="pagination"><?php
                $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                $current_page=1;
                if(isset($_GET["page_no"]))
                {
                    $current_page=$_GET["page_no"];
                }
                if($current_page!=1)
                {
                    $previous =$current_page-1;
                    echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                    echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
                }
                for($i=1;$i<=$total_no_of_pages;$i++)
                {
                    if($i==$current_page)
                    {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                    }
                    else
                    {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                    }
                }
                if($current_page!=$total_no_of_pages)
                {
                    $next=$current_page+1;
                    echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                    echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
                }
            ?></ul><?php
            }
        }
    
        paging */
 
    }

    class Product
    {
        private $conn;
	
        public function __construct()
        {
            try {
                $this->con = new Database();
                $this->con = $this->con->dbConnection();
            } catch (Exception $e) {
                die("Error:" . $e->getMessage());
            }            
        }

        public function checkHasParent($id,$table){
            $parent = array(); 
            
            $sql = "SELECT parent_id FROM $table WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $parent = $result['parent_id'];
            return $parent;
        }
        
        function viewAllDesignProducts($design_id){

            $has_parent = $this->checkHasParent($design_id,'designs');

            if($has_parent == null){

                // is a parent design

                // print_r($has_parent);
                // die();

                $ids_array = array();
                $sql = "SELECT * FROM designs WHERE parent_id = :parent_id";
                $stmt1 = $this->con->prepare($sql);
                $stmt1->execute(array(':parent_id' => $design_id));
                $designs = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($designs as $row) {
                    $ids_array[] = $row['id'];
                }

                $ids_array = implode("','",$ids_array);            
                $sql = "SELECT * FROM products WHERE design_id IN ('".$ids_array."')";
                $stmt = $this->con->prepare($sql);
                $stmt->execute(array(':design_id' => $design_id));
        
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } else {
                // is a child design
                // print_r($has_parent);
                // die();
                $sql = "SELECT * FROM products WHERE design_id = :design_id";
                $stmt = $this->con->prepare($sql);
                $stmt->execute(array(':design_id' => $design_id));
        
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }            

            if ($results) {
                return $results;
            }
        }        

        function viewProductImages($product_id) {
    
            $sql = "SELECT * FROM product_images WHERE product_id = :product_id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':product_id' => $product_id));
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewProductInfo($product_id) {
    
            $sql = "SELECT * FROM products WHERE id = :product_id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':product_id' => $product_id));
    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }
        
    }

    class Flavour
    {
        private $conn;
	
        public function __construct()
        {
            try {
                $this->con = new Database();
                $this->con = $this->con->dbConnection();
            } catch (Exception $e) {
                die("Error:" . $e->getMessage());
            }            
        }

        function viewParentFlavours() {
    
            $sql = "SELECT * FROM flavours WHERE parent_id IS NULL";    
            $stmt = $this->con->query($sql);    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                return $results;
            }
        }

        function viewChildFlavours($parent_id) {
    
            $sql = "SELECT * FROM flavours WHERE parent_id = :parent_id";    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':parent_id' => $parent_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewFlavourInfo($flavour_id) {

            $product = new Product();
            $has_parent = $product->checkHasParent($flavour_id,'flavours');

            if($has_parent == null){

                // is a parent design

                //print_r($has_parent);
                //die();

                $sql = "SELECT * FROM flavours WHERE id = :flavour_id";

            } else {

                $sql = "SELECT f1.id as childID, f1.name as ChildName, f2.name as ParentName 
                        FROM flavours f1 
                        JOIN flavours f2 
                        ON f1.parent_id = f2.id 
                        WHERE f1.id = :flavour_id";

                // print_r($sql);
                // die();
            }    
            
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':flavour_id' => $flavour_id));
    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            // print_r($results);
            // die();

            if ($results) {
                return $results;
            }

        }

    }

    class Filling
    {
        private $conn;
	
        public function __construct()
        {
            try {
                $this->con = new Database();
                $this->con = $this->con->dbConnection();
            } catch (Exception $e) {
                die("Error:" . $e->getMessage());
            }            
        }

        function viewFillingByFlavour($flavour_id) {

            //, fi.id AS fID, fl.name AS flavourName, fl.id AS flavourID
    
            $sql = "SELECT fi.*
            FROM fillings AS fi 
            LEFT JOIN flavour_filling AS ff 
            ON fi.id = ff.filling_id 
            LEFT JOIN flavours AS fl 
            ON ff.flavour_id = fl.id
            WHERE fl.id = :flavour_id";   
             
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':flavour_id' => $flavour_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

    }

