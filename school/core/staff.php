<?php

    class Staff{
        //db staff
        private $con;
        private $table = 'staff' ;

        //student properties
        public $staff_id;
        public $fname;
        public $lname;
        public $gender;
        public $class_id;
        public $class_name;
        public $subj_id;
        public $birth_date;
        public $subj_name;
        public $email;
        public $phone;
        public $address;

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
        
 // get only one students marks of a particular subject and class info from db
                public function read_os($reg, $cname, $sub){
                    //create query
                    $query = 'SELECT
                             test_score, exam_score, total_score, grade
                             FROM students s INNER JOIN
                             marks m ON s.reg_num = m.reg_num
                             INNER JOIN 
                             subjects sb ON m.subj_id = sb.id 
                             WHERE s.reg_num = :reg
                             AND s.class_id = (SELECT id FROM class WHERE class_name = :cname )
                             AND  sb.subj_name = :sub_name';
        
                    // prepare the statement
                    $stmt = $this->con->prepare($query);
                    $stmt->bindParam(':reg', $reg);//1 means the 1st parameter
                    $stmt->bindParam(':cname', $cname);//1 means the 1st parameter
                    $stmt->bindParam(':sub_name', $sub);//1 means the 1st parameter
                    //execute query
                    $stmt->execute();
                    
                    return $stmt;
                }// end read-all methed
        
        /************************************** */

/************************************** */

        // get all students marks of a particular subject and class info from db
        public function read_al($cname, $sub){
            //create query
            $query = 'SELECT
                     *
                     FROM students s INNER JOIN
                     marks m ON s.reg_num = m.reg_num
                     INNER JOIN 
                     subjects sb ON m.subj_id = sb.id 
                     WHERE s.class_id = (SELECT id FROM class WHERE class_name = :cname )
                     AND  sb.subj_name = :sub_name';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':cname', $cname);//1 means the 1st parameter
            $stmt->bindParam(':sub_name', $sub);//1 means the 1st parameter
            //execute query
            $stmt->execute();
            
            return $stmt;
        }// end read-all methed

/************************************** */

/************************************** */

        // get all teachers info from db
        public function read_all(){
            //create query
            $query = 'SELECT
                     *
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

         // get all teacher info from db
         public function read_one($reg){
            //create query
            $query = 'SELECT
                     *
                     FROM
                     ' .$this->table. ' s 
                     INNER JOIN 
                       class c ON s.class_id = c.id 
                     INNER JOIN 
                       subjects sb ON s.subj_id = sb.id 
                     WHERE s.staff_id = ? LIMIT 1 ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            //pass the variable to the sql statement
            $stmt->bindParam(1, $reg);//1 means the 1st parameter
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
            $this->staff_id = $row['staff_id'];
            $this->subj_id = $row['subj_id'];
            $this->phone = $row['phone'];
            $this->address = $row['address'];
            $this->subj_name = $row['subj_name'];
            $this->email = $row['email'];
        
            
        }// end read-one methed


/************************************** */

         // create a students 
         public function create(){
            //create query
            $query = 'INSERT INTO ' .$this->table.' 
                     SET
                     staff_id   = :staff_id,
                     fname      = :fname,
                     lname      = :lname,
                     class_id   = :class_id,
                     birth_date = :birth_date,
                     gender     = :gender,
                     subj_id    = :subj_id,
                     email      = :email,
                     phone      = :phone,
                     address    = :address ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            // since data is coming from user, we have to clean it
            $this->staff_id       = htmlspecialchars( strip_tags( $this->staff_id ) );
            $this->fname          = htmlspecialchars( strip_tags( $this->fname ) );
            $this->lname          = htmlspecialchars( strip_tags( $this->lname ) );
            $this->class_id       = htmlspecialchars( strip_tags( $this->class_id ) );
            $this->birth_date     = htmlspecialchars( strip_tags( $this->birth_date ) );
            $this->gender         = htmlspecialchars( strip_tags( $this->gender ) );
            $this->subj_id        = htmlspecialchars( strip_tags( $this->subj_id ) );
            $this->email          = htmlspecialchars( strip_tags( $this->email ) );
            $this->phone          = htmlspecialchars( strip_tags( $this->phone ) );
            $this->address        = htmlspecialchars( strip_tags( $this->address ) );

            // bind the parameters
            $stmt->bindParam( ':staff_id', $this->staff_id );
            $stmt->bindParam( ':fname', $this->fname );
            $stmt->bindParam( ':lname', $this->lname );
            $stmt->bindParam( ':class_id', $this->class_id );
            $stmt->bindParam( ':gender', $this->gender );
            $stmt->bindParam( ':birth_date', $this->birth_date );
            $stmt->bindParam( ':subj_id', $this->subj_id );
            $stmt->bindParam( ':email', $this->email );
            $stmt->bindParam( ':phone', $this->phone );
            $stmt->bindParam( ':address', $this->address );

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
            staff_id   = :staff_id,
            fname      = :fname,
            lname      = :lname,
            class_id   = :class_id,
            birth_date = :birth_date,
            gender     = :gender,
            subj_id    = :subj_id,
            email      = :email,
            phone      = :phone,
            address    = :address ';

   // prepare the statement
   $stmt = $this->con->prepare($query);
   // since data is coming from user, we have to clean it
   $this->staff_id       = htmlspecialchars( strip_tags( $this->staff_id ) );
   $this->fname          = htmlspecialchars( strip_tags( $this->fname ) );
   $this->lname          = htmlspecialchars( strip_tags( $this->lname ) );
   $this->class_id       = htmlspecialchars( strip_tags( $this->class_id ) );
   $this->birth_date     = htmlspecialchars( strip_tags( $this->birth_date ) );
   $this->gender         = htmlspecialchars( strip_tags( $this->gender ) );
   $this->subj_id        = htmlspecialchars( strip_tags( $this->subj_id ) );
   $this->email          = htmlspecialchars( strip_tags( $this->email ) );
   $this->phone          = htmlspecialchars( strip_tags( $this->phone ) );
   $this->address        = htmlspecialchars( strip_tags( $this->address ) );

   // bind the parameters
   $stmt->bindParam( ':staff_id', $this->staff_id );
   $stmt->bindParam( ':fname', $this->fname );
   $stmt->bindParam( ':lname', $this->lname );
   $stmt->bindParam( ':class_id', $this->class_id );
   $stmt->bindParam( ':gender', $this->gender );
   $stmt->bindParam( ':birth_date', $this->birth_date );
   $stmt->bindParam( ':subj_id', $this->subj_id );
   $stmt->bindParam( ':email', $this->email );
   $stmt->bindParam( ':phone', $this->phone );
   $stmt->bindParam( ':address', $this->address );

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
              WHERE staff_id = :staff_id';

                // prepare the statement
                $stmt = $this->con->prepare($query);
                // since data is coming from user, we have to clean it
                $this->staff_id  = htmlspecialchars( strip_tags( $this->staff_id ) );

                // bind the parameters
                $stmt->bindParam( ':staff_id', $this->staff_id );

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