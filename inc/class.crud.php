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

        function viewParentDesigns($slug = null) {

            if($slug != null){
                $sql = "SELECT * FROM designs WHERE parent_id IS NULL AND NOT slug = :slug";
                $stmt = $this->con->prepare($sql);    
                $stmt->execute(array(':slug' => $slug));    
            }else {
                $sql = "SELECT * FROM designs WHERE parent_id IS NULL";     
                $stmt = $this->con->query($sql);    
                $stmt->execute();
            }
    
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
                // die(); SELECT * FROM products JOIN product_images ON products.id = product_images.product_id WHERE products.design_id=:design_id

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
                $sql = "SELECT * FROM products 
                        WHERE products.design_id = :design_id";
                
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

        function viewDesignProductImages($design_id) {
    
            $sql = "SELECT p.name AS ProductName, p.id AS ProductID, p_i.image AS ProductImage, MIN(p_i.created_at) AS PDate
                    FROM products p
                    JOIN product_images p_i
                    ON p.id = p_i.product_id 
                    WHERE p.design_id = :design_id
                    GROUP BY ProductID;";

            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':design_id' => $design_id));
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        function viewParentFlavours($slug = null) {
    
            if($slug != null){
                $sql = "SELECT * FROM flavours WHERE parent_id IS NULL AND NOT slug = :slug";
                $stmt = $this->con->prepare($sql);    
                $stmt->execute(array(':slug' => $slug));    
            }else {
                $sql = "SELECT * FROM flavours WHERE parent_id IS NULL"; 
                $stmt = $this->con->query($sql);    
                $stmt->execute();
            }          
           
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

                $sql = "SELECT f1.id as childID, f1.name as ChildName, f2.id as parentID, f2.name as ParentName 
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

        function viewChildFlavoursByFilling($filling_id) {

            // $sql = "SELECT f2.*
            // FROM flavours AS fl 
            // JOIN flavours AS f2 
            // ON fl.parent_id = f2.id 
            // LEFT JOIN flavour_filling AS ff 
            // ON fl.id = ff.flavour_id
            // LEFT JOIN fillings AS fi 
            // ON ff.filling_id = fi.id
            // WHERE fi.id = :filling_id
            // GROUP By fl.parent_id 
            // HAVING fl.parent_id IS NOT NULL";

            $sql = "SELECT f2.* 
            FROM flavours AS fl 
            JOIN flavours AS f2 
            ON fl.parent_id = f2.id 
            LEFT JOIN flavour_filling AS ff 
            ON fl.id = ff.flavour_id 
            LEFT JOIN fillings AS fi 
            ON ff.filling_id = fi.id 
            WHERE fi.id = :filling_id
            GROUP By fl.parent_id";

            // $sql = "SELECT fl.id as childID, fl.name as ChildName, fl.slug as ChildSlug, 
            // f2.id as parentID, f2.name as ParentName, f2.slug as ParentSlug
            // FROM flavours AS fl 
            // JOIN flavours AS f2 
            // ON fl.parent_id = f2.id 
            // LEFT JOIN flavour_filling AS ff 
            // ON fl.id = ff.flavour_id
            // LEFT JOIN fillings AS fi 
            // ON ff.filling_id = fi.id
            // WHERE fi.id = :filling_id";  AND fl.parent_id = :parent_id"

            // $sql = "SELECT fl.* 
            // FROM flavours AS fl
            // LEFT JOIN flavour_filling AS ff 
            // ON fl.id = ff.flavour_id 
            // LEFT JOIN fillings AS fi 
            // ON ff.filling_id = fi.id 
            // WHERE fi.id = :filling_id
            // AND fl.parent_id IS NULL";
            
             
            $stmt = $this->con->prepare($sql);
            // $stmt->execute(array(':filling_id' => $filling_id, ':parent_id' => $parent_id));    
            $stmt->execute(array(':filling_id' => $filling_id));  
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewParentFlavoursByFilling($filling_id) {

            $sql = "SELECT fl.* 
            FROM flavours AS fl
            LEFT JOIN flavour_filling AS ff 
            ON fl.id = ff.flavour_id 
            LEFT JOIN fillings AS fi 
            ON ff.filling_id = fi.id 
            WHERE fi.id = :filling_id
            AND fl.parent_id IS NULL";            
             
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':filling_id' => $filling_id));  
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewChildFlavourWithFilling($parent_id,$filling_id) {
            
            $sql = "SELECT fl.* 
            FROM flavours AS fl
            LEFT JOIN flavour_filling AS ff 
            ON fl.id = ff.flavour_id 
            LEFT JOIN fillings AS fi 
            ON ff.filling_id = fi.id 
            WHERE fi.id = :filling_id
            AND fl.parent_id = :parent_id";
             
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':filling_id' => $filling_id, ':parent_id' => $parent_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        function viewFillings() {
    
            $sql = "SELECT * FROM fillings";    
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewFillingInfo($filling_id) {
              
            $sql = "SELECT * FROM fillings WHERE id = :filling_id";           
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':filling_id' => $filling_id));
    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            // print_r($results);
            // die();

            if ($results) {
                return $results;
            }

        }
        

    }

    class Tier
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

        function viewParentTiers() {
    
            $sql = "SELECT * FROM tiers WHERE parent_id IS NULL";    
            $stmt = $this->con->query($sql);    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                return $results;
            }
        }

        function viewChildTiers() {
    
            $parent_id = 2;
            $sql = "SELECT * FROM tiers WHERE parent_id = :parent_id";    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':parent_id' => $parent_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function  viewTierInfo($tier_id) {
            $sql = "SELECT * FROM tiers WHERE id = :tier_id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':tier_id' => $tier_id));
    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }
        }
        

    }

    class Size
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

        function viewSizeByTier($tier_id) {

            //, fi.id AS fID, fl.name AS flavourName, fl.id AS flavourID
    
            $sql = "SELECT * FROM sizes WHERE tier_id = :tier_id";   
             
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':tier_id' => $tier_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function  viewSizeInfo($size_id) {
            $sql = "SELECT * FROM sizes WHERE id = :size_id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':size_id' => $size_id));
    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }
        }
        

    }

    class Shape
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

        function viewShapeBySize($size_id) {

            //, fi.id AS fID, fl.name AS flavourName, fl.id AS flavourID
    
            $sql = "SELECT s1.*
            FROM shapes s1
            INNER JOIN servings s2 
            ON (s1.id = s2.shape_id)
            WHERE size_id = :size_id";              
             
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':size_id' => $size_id));    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }

        }

        function viewShapeInfo($shape_id) {
            
            $sql = "SELECT * FROM shapes WHERE id = :shape_id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':shape_id' => $shape_id));    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }
        }

    }

    class Serving
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

        function viewServingsBySizeAndTier($shape_id,$size_id,$tier_id) {
            
            $sql = "SELECT *
            FROM servings 
            WHERE shape_id = :shape_id 
            AND size_id = :size_id
            AND tier_id = :tier_id";              
             
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':size_id' => $size_id,':tier_id' => $tier_id, ':shape_id' => $shape_id));    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }
        }
    }

    class Order
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

        function insertOrderData($design_option=null,$product_id,$flavour_id,$sub_flavour_id=null,$filling_id,$tier_id,$multiple_tier_id=null,$size_id,$shape_id,$f_name,$l_name,$email,$phone,$delivery_date,$method,$venue_address=null,$add_details_on_cake,$cake_name=null,$cake_age=null) {
            
            $sql = "INSERT INTO orders (
                    design_option, product_id, flavour_id, 
                    sub_flavour_id, filling_id, tier_id,  
                    multiple_tier_id, size_id, shape_id,
                    f_name, l_name,
                    email, phone,
                    delivery_date,method,
                    venue_address,add_details_on_cake,
                    cake_name,cake_age ) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(1, $design_option);
            $stmt->bindParam(2, $product_id);
            $stmt->bindParam(3, $flavour_id);
            $stmt->bindParam(4, $sub_flavour_id);
            $stmt->bindParam(5, $filling_id);
            $stmt->bindParam(6, $tier_id);
            $stmt->bindParam(7, $multiple_tier_id);
            $stmt->bindParam(8, $size_id);           
            $stmt->bindParam(9, $shape_id);  
            $stmt->bindParam(10, $f_name); 
            $stmt->bindParam(11, $l_name); 
            $stmt->bindParam(12, $email); 
            $stmt->bindParam(13, $phone); 
            $stmt->bindParam(14, $delivery_date); 
            $stmt->bindParam(15, $method); 
            $stmt->bindParam(16, $venue_address); 
            $stmt->bindParam(17, $add_details_on_cake); 
            $stmt->bindParam(18, $cake_name); 
            $stmt->bindParam(19, $cake_age); 

            $result = $stmt->execute();

            if ($result) {
                return true;
            }

        }
    }


