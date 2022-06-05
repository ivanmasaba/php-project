<?php

    class Marks{
        //db staff
        private $con;
        private $table = 'marks' ;

        //student properties
        public $reg_num;
        public $subj_id;
        public $subj_name;
        public $test;
        public $exam;
        public $total;
        public $grade;

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

        // get all students marks info from db
        public function read_all($cname, $sub){
            //create query
            $query = 'SELECT
                     *
                     FROM students s INNER JOIN
                     ' .$this->table. ' m ON s.reg_num = m.reg_num
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

         // get all subjects marks for one students from db
         public function read_one($reg){
            //create query
            $query = 'SELECT
                     *
                     FROM
                     ' .$this->table. ' m 
                     INNER JOIN subjects
                     ON m.subj_id = subjects.id
                     WHERE m.reg_num = :reg ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            //pass the variable to the sql statement
            $stmt->bindParam(':reg', $reg);//1 means the 1st parameter
            //execute query
            $stmt->execute();
            
            return $stmt;
        }// end read-one methed


/************************************** */

         // create a students 
         public function create(){
            //create query
            $query = 'INSERT INTO ' .$this->table.' 
                     SET
                     reg_num = :reg_num,
                     subj_id = :id,
                     test_score = :test,
                     exam_score = :exam,
                     total_score = :total,
                     grade = :grade ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            // since data is coming from user, we have to clean it
            $this->reg_num     = htmlspecialchars( strip_tags( $this->reg_num ) );
            $this->id          = htmlspecialchars( strip_tags( $this->id ) );
            $this->test_score  = htmlspecialchars( strip_tags( $this->test_score ) );
            $this->exam_score  = htmlspecialchars( strip_tags( $this->exam_score ) );
            $this->total_score = htmlspecialchars( strip_tags( $this->total_score ) );
            $this->grade       = htmlspecialchars( strip_tags( $this->grade ) );

            // bind the parameters
            $stmt->bindParam( ':reg_num', $this->reg_num );
            $stmt->bindParam( ':id', $this->id );
            $stmt->bindParam( ':test_score', $this->test_score );
            $stmt->bindParam( ':exam_score', $this->exam_score );
            $stmt->bindParam( ':total_score', $this->total_score );
            $stmt->bindParam( ':grade', $this->grade );

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
         public function update($reg, $subj_id){ 
            //create query
            $query = 'UPDATE ' .$this->table.' 
            SET
            test_score = :test,
            exam_score = :exam,
            total_score = :total,
            grade = :grade 
            WHERE
            reg_num = :reg_num AND subj_id = :id';

   // prepare the statement
   $stmt = $this->con->prepare($query);
   // since data is coming from user, we have to clean it
   $this->test  = htmlspecialchars( strip_tags( $this->test ) );
   $this->exam  = htmlspecialchars( strip_tags( $this->exam ) );
   $this->total = htmlspecialchars( strip_tags( $this->total ) );
   $this->grade       = htmlspecialchars( strip_tags( $this->grade ) );

   // bind the parameters
   $stmt->bindParam( ':test', $this->test );
   $stmt->bindParam( ':exam', $this->exam );
   $stmt->bindParam( ':total', $this->total );
   $stmt->bindParam( ':grade', $this->grade );
   $stmt->bindParam( ':reg_num', $reg );
   $stmt->bindParam( ':id', $subj_id );

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