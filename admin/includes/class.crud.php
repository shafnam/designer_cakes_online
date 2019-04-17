<?php

    include_once 'config.php';

    class User
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

        function loginUser($username,$password) {
    
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':username' => $username));
            return $stmt;
        } 
    
    }

    class Testimonial
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

        function insertTestimonial($name,$testimonial) {
    
            $sql = "INSERT INTO testimonials (name, testimonial) VALUES (?, ?)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $testimonial);

            $result = $stmt->execute();

            if ($result) {
                return true;
            }
        }
        
        function getAllTestimonials() {
            
            $sql = "SELECT * FROM testimonials";
    
            $query = $this->con->query($sql);
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                return $results;
            }
        }

        function viewTestimonial($id) {

            $sql = "SELECT * FROM testimonials WHERE id = $id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(array(':id' => $id));    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($results) {
                return $results;
            }
        }

        function editTestimonial($id,$name,$testimonial) {

            $sql = "UPDATE testimonials SET name=:name, testimonial=:testimonial WHERE id=:id";
    
            $stmt = $this->con->prepare($sql);
            $stmt->bindparam(":name",$name);
            $stmt->bindparam(":testimonial",$testimonial);
            $stmt->bindparam(":id",$id);    
            
            $result = $stmt->execute();
            if ($result) {
                return true;
            }
        }

        function deleteTestimonial($id){
            $stmt = $this->con->prepare("DELETE FROM testimonials WHERE id=:id");
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
        }

        function getTestimonialCount(){
            $sql = "SELECT COUNT(*) FROM testimonials";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(); 
            $results=  $stmt->fetchColumn(); 

            if ($results) {
                return $results;
            }            
        }

        function getLatestTestimonials() {
            
            $sql = "SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 10";
    
            $query = $this->con->query($sql);
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                return $results;
            }
        }

    }

    class Design
    {
        private $conn;
	
        public function __construct() {
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

        /* CRUD Starts Here */

        function insertProduct($design_parent,$name) {
    
            $sql = "INSERT INTO products (design_id, name) VALUES (?, ?)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(1, $design_parent);
            $stmt->bindParam(2, $name);
            $stmt->execute();

            $last_id = $this->con->lastInsertId();

            if ($last_id) {
                return $last_id;
            }
        }

        function insertProductImages($product_id,$name) {
    
            $sql = "INSERT INTO product_images (product_id, image) VALUES (?, ?)";

            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(1, $product_id);
            $stmt->bindParam(2, $name);
            
            $result = $stmt->execute();

            if ($result) {
                return true;
            }
        }

        function deleteProduct($id){
            $stmt = $this->con->prepare("DELETE FROM testimonials WHERE id=:id");
            $stmt->bindparam(":id",$id);
            $stmt->execute();
            return true;
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

        function getOrderCount(){
            $sql = "SELECT COUNT(*) FROM orders";
    
            $stmt = $this->con->prepare($sql);
            $stmt->execute(); 
            $results=  $stmt->fetchColumn(); 

            if ($results) {
                return $results;
            }            
        }

        function getLatestOrders() {
            
            //$sql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 20";
            $sql = "SELECT o.id AS ORDER_ID, o.design_option AS D_OPTION, 
            o.product_name AS U_Product_Image, 
            o.f_name AS F_NAME, o.l_name AS L_NAME,
            o.delivery_date AS D_DATE,
            p.code AS PRODUCT_CODE, p.id AS PRODUCT_ID, p.name AS Product_Name, 
            p_i.image AS Product_Image, MIN(p_i.created_at) AS P_Date,
            fl.name AS FLAVOUR, 
            sfl.name AS SUB_FLAVOUR,
            fi.name AS FILLING,
            t.name AS TIER, 
            mt.name AS M_TIER,
            s.name AS SIZE,
            sh.name AS SHAPE
            FROM orders AS o 
            LEFT JOIN products AS p 
            ON p.id = o.product_id 
            LEFT JOIN product_images p_i
            ON p.id = p_i.product_id 
            LEFT JOIN flavours fl
            ON fl.id = o.flavour_id 
            LEFT JOIN flavours sfl
            ON sfl.id = o.sub_flavour_id
            LEFT JOIN fillings fi
            ON fi.id = o.filling_id
            LEFT JOIN tiers t
            ON t.id = o.tier_id 
            LEFT JOIN tiers mt
            ON mt.id = o.multiple_tier_id
            LEFT JOIN sizes s
            ON s.id = o.size_id
            LEFT JOIN shapes sh
            ON sh.id = o.shape_id
            GROUP By o.id
            ORDER BY o.created_at DESC LIMIT 10";
    
            $query = $this->con->query($sql);
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                return $results;
            }
        }

        function getAllOrders(){

            $sql = "SELECT o.id AS ORDER_ID, o.design_option AS D_OPTION, 
            o.product_name AS U_Product_Image, 
            o.f_name AS F_NAME, o.l_name AS L_NAME,
            o.delivery_date AS D_DATE,
            p.code AS PRODUCT_CODE, p.id AS PRODUCT_ID, p.name AS Product_Name, 
            p_i.image AS Product_Image, MIN(p_i.created_at) AS P_Date,
            fl.name AS FLAVOUR, 
            sfl.name AS SUB_FLAVOUR,
            fi.name AS FILLING,
            t.name AS TIER, 
            mt.name AS M_TIER,
            s.name AS SIZE,
            sh.name AS SHAPE
            FROM orders AS o 
            LEFT JOIN products AS p 
            ON p.id = o.product_id 
            LEFT JOIN product_images p_i
            ON p.id = p_i.product_id 
            LEFT JOIN flavours fl
            ON fl.id = o.flavour_id 
            LEFT JOIN flavours sfl
            ON sfl.id = o.sub_flavour_id
            LEFT JOIN fillings fi
            ON fi.id = o.filling_id
            LEFT JOIN tiers t
            ON t.id = o.tier_id 
            LEFT JOIN tiers mt
            ON mt.id = o.multiple_tier_id
            LEFT JOIN sizes s
            ON s.id = o.size_id
            LEFT JOIN shapes sh
            ON sh.id = o.shape_id
            GROUP By o.id";
    
            $query = $this->con->query($sql);
    
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                return $results;
            }

        }
    }

