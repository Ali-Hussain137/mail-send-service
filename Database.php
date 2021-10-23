<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{
    public $card_reference_key;

    private function build_connection(){     //build sql database connection 
        $conn = new mysqli("localhost","root","","mail_sending_service");
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
        $col_name = null;
        if ($tableName == "card"){
            $col_name = "Card_number,Cvc_number,Valid_from,Valid_till"; 
        }elseif($tableName == "merchant"){
            $col_name = "Name,Email,Merchant_Password,Image,Create_at,Current_at,Card_id";
        }elseif($tableName == "secondary_user"){
            $col_name = "Name,Email,User_password,Email_permission,List_view_permission,Payment_permission,Forget_password_permission,Login_permission,Token,Merchant_id";
        }elseif($tableName == "request"){
            $col_name = "Mail_from,Mail_to,Mail_cc,Mail_bcc,Subject,Body,Merchant_id,Response_id";
        }elseif($tableName == "response"){
            $col_name = "Status,error,Description";
        }

        $S = implode("','",$perameter);
        $S2 = "'".$S."'";
        $conn = self::build_connection();
        

        $q2 = "insert into $tableName($col_name) values($S2)";
        $conn->query($q2);
        echo "Data successfully insert!";
        self::close_connection($conn);
    }




    function get_id($tableName,$col_name,$value){
        $conn = self::build_connection();
        $q = "select Id from $tableName where $col_name = $value";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        $ret = $row['Id'];
        self::close_connection($conn);
        return $ret;
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
    // function search()        // searching employee by cnic
    // {
    //     $conn = self::build_connection();
    //     //$q = "select * from ".$tableName ." WHERE cnic='{$cnic}'";
    //     $q = "select count(*) as count from card";
    //     $result = $conn->query($q);
    //     $row = $result->fetch_assoc();
    //     echo $row['count']+1;
    //     self::close_connection($conn);
    //     // if($result->num_rows > 0){
    //     //     return true;
    //     // }
    //     // else{
    //     //     return false;
    //     // }
    // }

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
