<?php

    class Student{
        //db staff
        private $con;
        private $table = 'students' ;

        //student properties
        public $reg_num;
        public $fname;
        public $lname;
        public $class_id;
        public $class_name;
        public $gender;
        public $birth_date;
        public $father_name;
        public $mother_name;
        public $parent_phone;
        public $parent_address;

/************************************** */

        // constructoer with db connection
        public function __construct( $db ){
            $this->con = $db;
        }

/************************************** */
        public function run_query($sql){

            // prepare the statement
            $stmt = $this->con->prepare($sql);
            return $stmt;
        }

/************************************** */

        // get all students info from db
        public function read_all(){
            //create query
            $query = 'SELECT
                     c.class_name as class_name,
                     s.reg_num,
                     s.fname,
                     s.lname,
                     s.class_id,
                     s.birth_date,
                     s.father_name,
                     s.mother_name,
                     s.parent_phone,
                     s.parent_address
                     FROM
                     ' .$this->table. ' s 
                     INNER JOIN 
                       class c ON s.class_id = c.id ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            //execute query
            $stmt->execute();
            
            return $stmt;
        }// end read-all methed


/************************************** */

         // get all students info from db
         public function read_one(){
            //create query
            $query = 'SELECT
                     c.class_name as class_name,
                     s.reg_num,
                     s.fname,
                     s.lname,
                     s.class_id,
                     s.gender,
                     s.birth_date,
                     s.father_name,
                     s.mother_name,
                     s.parent_phone,
                     s.parent_address
                     FROM
                     ' .$this->table. ' s 
                     LEFT JOIN 
                       class c ON s.class_id = c.id 
                       WHERE s.reg_num = ? LIMIT 1 ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            //pass the variable to the sql statement
            $stmt->bindParam(1, $this->reg_num);//1 means the 1st parameter
            //execute query
            $stmt->execute();
            // get data returned by query
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //put this data into the class variables

            $this->fname = $row['fname'];
            $this->lname = $row['lname'];
            $this->class_id = $row['class_id'];
            $this->class_name = $row['class_name'];
            $this->gender = $row['gender'];
            $this->birth_date = $row['birth_date'];
            $this->father_name = $row['father_name'];
            $this->mother_name = $row['mother_name'];
            $this->parent_phone = $row['parent_phone'];
            $this->parent_address = $row['parent_address'];
            
        }// end read-one methed


/************************************** */

         // create a students 
         public function create(){
            //create query
            $query = 'INSERT INTO ' .$this->table.' 
                     SET
                     reg_num        = :reg_num,
                     fname          = :fname,
                     lname          = :lname,
                     class_id       = :class_id,
                     birth_date     = :birth_date,
                     gender         = :gender,
                     father_name    = :father_name,
                     mother_name    = :mother_name,
                     parent_phone   = :parent_phone,
                     parent_address = :parent_address ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            // since data is coming from user, we have to clean it
            $this->reg_num        = htmlspecialchars( strip_tags( $this->reg_num ) );
            $this->fname          = htmlspecialchars( strip_tags( $this->fname ) );
            $this->lname          = htmlspecialchars( strip_tags( $this->lname ) );
            $this->class_id       = htmlspecialchars( strip_tags( $this->class_id ) );
            $this->birth_date     = htmlspecialchars( strip_tags( $this->birth_date ) );
            $this->gender         = htmlspecialchars( strip_tags( $this->gender ) );
            $this->father_name    = htmlspecialchars( strip_tags( $this->father_name ) );
            $this->mother_name    = htmlspecialchars( strip_tags( $this->mother_name ) );
            $this->parent_phone   = htmlspecialchars( strip_tags( $this->parent_phone ) );
            $this->parent_address = htmlspecialchars( strip_tags( $this->parent_address ) );

            // bind the parameters
            $stmt->bindParam( ':reg_num', $this->reg_num );
            $stmt->bindParam( ':fname', $this->fname );
            $stmt->bindParam( ':lname', $this->lname );
            $stmt->bindParam( ':class_id', $this->class_id );
            $stmt->bindParam( ':birth_date', $this->birth_date );
            $stmt->bindParam( ':gender', $this->gender );
            $stmt->bindParam( ':father_name', $this->father_name );
            $stmt->bindParam( ':mother_name', $this->mother_name );
            $stmt->bindParam( ':parent_phone', $this->parent_phone );
            $stmt->bindParam( ':parent_address', $this->parent_address );

            //execute query
            if( $stmt->execute() ){
                return true;
            }
            
            // if there was an error
            printf( 'Error %s. \n ', $stmt->error );
            return false;
            
        }// end create methed


/************************************** */

         // update a students 
         public function update(){
            //create query
            $query = 'UPDATE ' .$this->table.' 
            SET
            reg_num        = :reg_num,
            fname          = :fname,
            lname          = :lname,
            class_id       = :class_id,
            birth_date     = :birth_date,
            gender         = :gender,
            father_name    = :father_name,
            mother_name    = :mother_name,
            parent_phone   = :parent_phone,
            parent_address = :parent_address ';

   // prepare the statement
   $stmt = $this->con->prepare($query);
   // since data is coming from user, we have to clean it
   $this->reg_num        = htmlspecialchars( strip_tags( $this->reg_num ) );
   $this->fname          = htmlspecialchars( strip_tags( $this->fname ) );
   $this->lname          = htmlspecialchars( strip_tags( $this->lname ) );
   $this->class_id       = htmlspecialchars( strip_tags( $this->class_id ) );
   $this->birth_date     = htmlspecialchars( strip_tags( $this->birth_date ) );
   $this->gender         = htmlspecialchars( strip_tags( $this->gender ) );
   $this->father_name    = htmlspecialchars( strip_tags( $this->father_name ) );
   $this->mother_name    = htmlspecialchars( strip_tags( $this->mother_name ) );
   $this->parent_phone   = htmlspecialchars( strip_tags( $this->parent_phone ) );
   $this->parent_address = htmlspecialchars( strip_tags( $this->parent_address ) );

   // bind the parameters
   $stmt->bindParam( ':reg_num', $this->reg_num );
   $stmt->bindParam( ':fname', $this->fname );
   $stmt->bindParam( ':lname', $this->lname );
   $stmt->bindParam( ':class_id', $this->class_id );
   $stmt->bindParam( ':birth_date', $this->birth_date );
   $stmt->bindParam( ':gender', $this->gender );
   $stmt->bindParam( ':father_name', $this->father_name );
   $stmt->bindParam( ':mother_name', $this->mother_name );
   $stmt->bindParam( ':parent_phone', $this->parent_phone );
   $stmt->bindParam( ':parent_address', $this->parent_address );
            //execute query
            if( $stmt->execute() ){
                return true;
            }
            
            // if there was an error
            printf( 'Error %s. \n ', $stmt->error );
            return false;
            
        }// end update methed


/************************************** */

        // delete a student
        public function delete(){
              //create query
              $query = 'DELETE FROM ' .$this->table.' 
              WHERE reg_num = :reg_num';

                // prepare the statement
                $stmt = $this->con->prepare($query);
                // since data is coming from user, we have to clean it
                $this->reg_num  = htmlspecialchars( strip_tags( $this->reg_num ) );

                // bind the parameters
                $stmt->bindParam( ':reg_num', $this->reg_num );

                //execute query
                if( $stmt->execute() ){
                    return true;
                }
                
                // if there was an error
                printf( 'Error %s. \n ', $stmt->error );
                return false;
                    }// end of delete method


    }// end of class

?>