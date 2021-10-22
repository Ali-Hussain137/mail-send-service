<?php
    class Validate      //Create validation class to check all the input in correct methord :
    {
        /**
         *email_validate function get one parmeter and check email pattern if pattern match return true else false
         */
        public function email_validate($email)                                            
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false; 
            }
            else{
                return true;
            } 
        }
        /**
         * password_validate function get one parmeter and check password pattern if pattern match return true else false
         */
        public function password_validate($password)        
        {
            $password_pattern='/^(?=.*[A-Z]).{8,20}$/';     //password length > 8 and also 1 uppercase charecter
            if(!preg_match($password_pattern, $password)){  //check patteren match
                return false;
            }
            else{
                return true;
            } 
        }
        /**
         *phone_validate function get one parmeter and check phone pattern if pattern match return true else false
         */
        public function phone_validate($phone)
        {
            $phone_pattern = "/^(03)+([0-4]{1})+([0-9]{1})[-]([0-9]{7})$/";     //number of total length 11 start 03 and next to digit between 00-49 next 7 digit 0-9
            if(!preg_match($phone_pattern, $phone)){    //check patteren match
                return false;
            }
            else{
                return true;
            } 
        }
        /**
         *name_validate function get one parmeter and check name pattern if pattern match return true else false
         */
        public function name_validate($name)
        {
            $name_pattern="/^[a-zA-Z ]*$/";     //Not Accept Special character and digit
            if(!preg_match($name_pattern, $name)){      //check patteren match
                return false;
            }
            else{
                return true;
            } 
        }
        /**
         *cnic_validate function get one parmeter and check CNIC pattern if pattern match return true else false
         */
        public function cnic_validate($cnic)
        {
            $cnic_pattern="/^([0-9]{5})[-]([0-9]{7})[-]([0-9]{1})$/"; //length of CNIC is 13 and first - after 5 digit second - after 7 digit 
            if(!preg_match($cnic_pattern, $cnic)){      //check patteren match
                return false;
            }
            else{
                return true;
            } 
        }
        /**
         * dep_validate function get one parmeter and Depement password pattern if pattern match return true else false
         */
        public function dep_validate($department)
        {
            $department_pattern="/^[a-zA-Z]*+[0-9]*$/";  //enter only number and also alphabet and number not start number and end alphabet
            if(!preg_match($department_pattern, $department)){     //check patteren match
                echo "invalid";
                return false;
            }
            else{
                return true;
            }
        }
    }
?>
