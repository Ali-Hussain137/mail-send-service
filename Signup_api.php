<?php
  require "Database.php";
  require "validation.php";
class SignUpMerchant{
    private $Card_id;
    // This Function contain all headers of Rest API
    
    function headers_function(){    
        header("Content-Type: application/json");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods:POST");
    }

    // This function will take Name and CNIC as perameter and check validation

    function Merchant_validation(&$Name,&$Email,&$Merchant_password){//,&$Status,&$Image,&$Create_at,&$Current_at,&$Token,&$Card_id){
        //$validate = new Validate();
        $data = json_decode(file_get_contents("php://input"),true);
        $Name = $data['Name'];
        $Email = $data['Email'];
        $Merchant_password = $data['Merchant_password'];
        // $Status = $data['Status'];
        // $Image = $data['Image'];
        // $Create_at = $data['Create_at'];
        // $Current_at = $data['Current_at'];
        // $Token = $data['Token'];
        // $Card_id = $data['Card_id'];




        // if ($validate->name_validate($data['Name']) == true){
        //     $Name = $data['Name'];
        // }
        // else{
        //     die("Name is not valid");
        // }
        // if ($validate->cnic_validate($data['CNIC']) == true){
        //     $CNIC = $data['CNIC'];
        // }
        // else{
        //     die("CNIC is not valid");
        // }
    }

    function Card_validation(&$Card_number,&$Credit,&$Cvc_number,&$Valid_from,&$Valid_till){
        //$validate = new Validate();
        $data = json_decode(file_get_contents("php://input"),true);
        $Card_number = $data['Card_number'];
        //$Credit = $data['Credit'];
        $Cvc_number = $data['Cvc_number'];
        $Valid_from = $data['Valid_from'];
        $Valid_till = $data['Valid_till'];
    }

    // This fucntion will take php object , conver to json format and return json

    function json_conversion($Object)
    {
        return json_encode($Object);
    }


    function Card_Api($tableName,$Card_number,$Credit,$Cvc_number,$Valid_from,$Valid_till){
        $Credit = "50.0000";
        self::headers_function();
        self::Card_validation($Card_number,$Credit,$Cvc_number,$Valid_from,$Valid_till);
        $db = new Database();
        $pera = array($Card_number,$Credit,$Cvc_number,$Valid_from,$Valid_till);
        $db->insert($tableName,$pera);
        $this->card_id = $db->card_reference_key;
    }


    function Merchant_Api($tableName,$Name,$Email,$Merchant_password,$Status = true,$Image = "Image.jpeg",$Create_at = "10:12:13",$Current_at = "11:12:13",$Token = "0123734568456"){
        self::headers_function();
        self::Merchant_validation($Name,$Email,$Merchant_password);
        $Card_id = $this->card_id;
        $db = new Database();
        $pera = array($Name,$Email,$Merchant_password,$Status,$Image,$Create_at,$Current_at,$Token,$Card_id);
        $db->insert($tableName,$pera);

    }
    // This fucntion will take table Name , Name, CNIC and fetch data and print in json format
    function Sign_Api($Name,$Email,$Merchant_password,$Card_number,$Credit,$Cvc_number,$Valid_from,$Valid_till){
        self::Card_Api("card",$Card_number,$Credit,$Cvc_number,$Valid_from,$Valid_till);
        self::Merchant_Api("merchant",$Name,$Email,$Merchant_password);
    }
}
    $Name = null;
    $Email = null;
    $Merchant_password = null;
    $Card_number = null;
    $Cvc_number = null;
    $Valid_from = null;
    $Valid_till = null;
    $Credit = null;
    $Api = new SignUpMerchant();
    $Api->Sign_Api($Name,$Email,$Merchant_password,$Card_number,$Credit,$Cvc_number,$Valid_from,$Valid_till);

?>