<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{
    public $card_reference_key;

    private function build_connection(){     //build sql database connection 
        $conn = new mysqli("localhost","root","","mail_send_service");
        if ($conn->connect_error){
            echo "Database Connection Error";
        }
        else{
            echo "connection";
            return $conn;
        }
        
    }
    private function close_connection($conn){   //close database connection
        $conn->close();
    }

    /**
     * Function to insert user or Employee in database.
     * 
     */
    function insert($tableName,$perameter){
        $conn = self::build_connection();
        $q = "select count(*) as count from $tableName";
        $id = $conn->query($q);


        $S = implode("','",$perameter);
        $S2 = "'".$S."'";
        $row = $id->fetch_assoc();
        $I = $row['count']+1;
        $S3 = "$I,";
        $perameters = $S3.$S2;
        $this->card_reference_key = $I;

        $q2 = "insert into $tableName values($perameters)";
        $conn->query($q2);
        echo "Data successfully insert!";
        self::close_connection($conn);
    }

    /**
     * This function is used to fetch users from table.
     */
    // function Fetch_list($tableName)
    // {
    //     $conn = self::build_connection();
    //     $q = "select * from ".$tableName;
    //     $result = $conn->query($q);
    //     $data = $result->fetch_all(MYSQLI_ASSOC);
    //     self::close_connection($conn);
    //     return $data;
    // }

    /**
     * This function is used to select user from table with the specific cnic.
     */
    function search()        // searching employee by cnic
    {
        $conn = self::build_connection();
        //$q = "select * from ".$tableName ." WHERE cnic='{$cnic}'";
        $q = "select count(*) as count from card";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        echo $row['count']+1;
        self::close_connection($conn);
        // if($result->num_rows > 0){
        //     return true;
        // }
        // else{
        //     return false;
        // }
    }

    /**
     * This functioon is used to search employee with specific CNIC and name.
     */
    // function searchEmployee($tableName,$Name,$CNIC){
    //     $conn = self::build_connection(); 
    //     $N = "'$Name'";
    //     $C = "'$CNIC'";
    //     $q = "select * from $tableName where CNIC = $C and Name = $N";
    //     $result = $conn->query($q);
    //     if ($result->num_rows > 0){
    //         $output = $result->fetch_assoc();
    //     }else{
    //         $output = array('Message' => 'No Employee Match :','status'=>'204');
    //     }
    //     self::close_connection($conn);
    //        return $output;
    //     }
   
}
// $database = new Database();
// $T = "merchant";
// $pera = array("987654321","50.234","1234","4444-11-8","9999-2-2");
// $database->insert($T,$pera);

?>
