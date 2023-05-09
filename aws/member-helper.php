<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

define('DB_HOST',"localhost");
define('DB_USER',"root");
define('DB_PASS',"");
define('DB_NAME',"HRDB");



function checkPositiom ($position){
    if($position== NULL){
        return"<p style='color:white;'>Please select a <strong>position</strong>!</p>";
    }else if(!array_key_exists($position, getAllPosition())){
        return"<p style='color:red;'><b>select a valid position!</b></p>";
        }

}

function checkPhone($phone){
    if($phone == NULL){
        return"<p style='color:white;'>Please Fill In Your <strong>Phone Number</strong>!</p>";
    }else if(!preg_match("/^[0-9]{10}$/",$phone)){
       return "<p style='color:red;'><b>Invalid Phone Number!</b></p>";
} 

}

function checkEmail($email){
   
    if($email == NULL){
        return"<p style='color:white;'>Please Fill In Your <strong>Student Email</strong>!</p>";
    }else if(!filter_var( $email = "example@example.com", FILTER_VALIDATE_EMAIL)) {
    return "<p style='color:red;'><b>Invalid email format!</b></p>";
    }
}

function checkStaffName ($name){
    if($name == NULL){
        return"<p style='color:white;'>Please Fill In Your <strong>Name</strong>!</p>";
    }else if(!preg_match("/^[A-Za-z@ ,\.\-\'\/]+$/",$name)){
        return"<p style='color:red;'><b>Invalid User Name!</b></p>";
        
    }
}

function checkGender($gender)
{
    if ($gender == null)
    {
        return "<p style='color:white;'>Please select a <strong>Gender</strong>!</p>";
    }
 
}

function checkStaffID($id){
    if($id == NULL){
        return"<p style='color:white;'>Please Fill In  <strong>Staff ID</strong>!</p>";
    }else if(!preg_match("/^[0-9]{7}$/",$id)){
        return "<p style='color:red;'><b>Invaild Staff ID!</b></p>";
    }else if(checkDupicateID($id)){
        return "<p style='color:white;'>Duplicated Staff ID Deteced</p>";
    }
}
function checkDupicateID($id){
  $exist = false;

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $id  = $conn->real_escape_string($id);
    $sql = "SELECT * FROM staff WHERE ID = '$id'";

    if ($result = $conn->query($sql))
    {
        if ($result->num_rows > 0)
        {
            $exist = true;
        }
    }

    $result->free();
    $conn->close();

    return $exist;
}
function getAllGender(){
    return array(
        "M"=>"Male️",
        "F"=>"Female️",
    );
}
function getAllPosition(){
    return array(
        "CEO"=>"Chief Executive Officer",
        "MD"=>"Managing Director",
        "ST"=>"Staff",
        "MN"=>"Manager",
    );
}



