<?php

    class Login{
        //db staff
        private $con;
        private $table = 'login' ;

        //login properties
        public $reg_num;
        public $uname;
        public $password;
        public $level;

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

        // get all users info from db
        public function read_all(){
            //create query
            $query = 'SELECT reg_num, uname, level FROM ' .$this->table;

            // prepare the statement
            $stmt = $this->con->prepare($query);
            //execute query
            $stmt->execute();
            
            return $stmt;
        }// end read-all methed

        
/************************************** */

         // get one user info from db
         public function read_one(){
              //create query
            $query = 'SELECT reg_num, uname, level FROM ' .$this->table. 
                     ' WHERE uname = :uname AND password = :password ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
             // since data is coming from user, we have to clean it
             $this->uname    = htmlspecialchars( strip_tags( $this->uname ) );
             $this->password = htmlspecialchars( strip_tags( $this->password ) );

            //pass the variable to the sql statement
            $stmt->bindParam( ':uname', $this->uname );
            $stmt->bindParam( ':password', $this->password );
            //execute query
            $stmt->execute();
            return $stmt;
            // // get data returned by query
            // $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // //put this data into the class variables

            // $this->reg_num = $row['reg_num'];
            // $this->uname   = $row['uname'];
            // $this->level   = $row['level'];
            
        }// end read-one methed

        
/************************************** */
         // create a user 
         public function create(){
            //create query
            $query = 'INSERT INTO ' .$this->table.' 
                     SET
                     reg_num = :reg_num,
                     uname = :uname,
                     password = :password,
                     level = :level ';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            // since data is coming from user, we have to clean it
            $this->reg_num  = htmlspecialchars( strip_tags( $this->reg_num ) );
            $this->uname    = htmlspecialchars( strip_tags( $this->uname ) );
            $this->password = htmlspecialchars( strip_tags( $this->password ) );
            $this->level    = htmlspecialchars( strip_tags( $this->level ) );

            // bind the parameters
            $stmt->bindParam( ':reg_num', $this->reg_num );
            $stmt->bindParam( ':uname', $this->uname );
            $stmt->bindParam( ':password', $this->password );
            $stmt->bindParam( ':level', $this->level );

            //execute query
            if( $stmt->execute() ){
                return true;
            }
            
            // if there was an error
            printf( 'Error %s. \n ', $stmt->error );
            return false;
            
        }// end create methed

        
/************************************** */
         // update a password 
         public function update(){ 
            //create query
            $query = 'UPDATE ' .$this->table.' 
                     SET
                     password = :password
                     WHERE reg_num = :reg_num';

            // prepare the statement
            $stmt = $this->con->prepare($query);
            // since data is coming from user, we have to clean it
            $this->password = htmlspecialchars( strip_tags( $this->password ) );

            // bind the parameters
            $stmt->bindParam( ':password', $this->password );
            $stmt->bindParam( ':reg_num', $this->reg_num );

            //execute query
            if( $stmt->execute() ){
                return true;
            }
            
            // if there was an error
            printf( 'Error %s. \n ', $stmt->error );
            return false;
            
        }// end update methed

        
/************************************** */
        // delete a user
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