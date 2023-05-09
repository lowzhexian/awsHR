<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Insert Member</title>
        <script src="topbtn.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="mainStyle.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <style>
            tr,td{
  padding-left: 450px;
}
            
        </style>
    </head>
     <header  class="p-3 text-bg-dark">
        <div class="container">
            <div class=" d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li> 
                <a class="nav-link fs-5 pe-4 text-white link-primary" href="main.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                  </svg>
                </a>
              </li>
              </ul>

            </div>
        </div>
    </header>


    <div class="container">
    <div class="title-1 text-white pt-4"> 
        <h1>Staff Register</h1>
     </div>
        <?php
        require_once 'member-helper.php';
        ?>
        <?php
      global $id;
      global $name;
      global $gender;
      global $position;
      global $email;
      global $phone;
      
      
      if (!empty($_POST)){
            
            (isset($_POST['id']))?
           $id= trim($_POST['id']):
            $id ="";
            
            (isset($_POST['name']))?
           $name= trim($_POST['name']):
            $name ="";     
            
            (isset($_POST['position']))?
           $program= trim($_POST['position']):
            $position="";
            
            (isset($_POST['email']))?
           $email= trim($_POST['email']):
            $email="";
            
            (isset($_POST['phone']))?
           $phone= trim($_POST['phone']):
            $phone="";
            
           $id= trim($_POST['id']);
           $name= trim($_POST['name']);
           isset($_POST['gender'])?$gender=$_POST['gender'] : $gender=NULL;
           $position = trim($_POST['position']);
           $email = trim($_POST['email']);
           $phone = trim($_POST['phone']);
           $error ['id']=checkStaffID($id);
           $error ['name']=checkStaffName($name);
           $error['gender']= checkGender($gender);
           $error ['position']= checkPosition($position);
           $error ['email']= checkEmail($email);
           $error ['phone']= checkPhone($phone);
           
           $error=array_filter($error);
           if(empty($error)){
               $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
               $sql="INSERT INTO staff(id,name,gender,position,email,phone)VALUES (?,?,?,?,?,?)";
               $statement = $conn -> prepare($sql);
               $statement -> bind_param('ssssss', $id,$name,$gender,$position,$email,$phone);
               $statement ->execute();
               if($statement -> affected_rows >0){
                 echo"<div><a href = 'main.php'>Back to menu</a><p style='color:white;'>Student <strong>$name</strong> is inserted ! </p><div>";  
               }else{
                   echo"<div><p style='color:white;'>Unsable to insert record !</p><div>";
               }
               $conn->close();
               $statement ->close();
           }else{
               echo"<ul class= 'error'>";
               foreach ($error as $value){
                   echo"<li>$value</li>";
               }
               echo"</ul>";
           }
        }
      ?>
        <form action="" method="POST">
              <table class="text-white">
                  </br>
              <tr>
                  <td>Staff ID:     
                      <input type="text" name="id" value="<?php echo $id?>" /></td>
              </tr>
              <tr>
                  
                  <td></br>Staff Name:     
                      <input type="text" name="name" value="<?php echo $name?>" /></td>
              </tr>
              <tr>
                  <td></br>Gender:      
                       <input type="radio" name='gender' id="male" value="M" >
               <label for="male">Male</label>
                <input type="radio" name='gender' id="female" value="F" >
                  <label for="male">Female</label>
                  </td>
              </tr>
              <tr>
                  <td></br>Position:     
                      <select name="position">
                          <option value="">--Select an option--</option>
                         <?php
                            $position = getAllPosition();
                            foreach ($position as $incharge => $pos) {
                                printf("<option value='%s'%s>%s</option>",$incharge,($position == $incharge)?'checked':" ",$pos);
                            }                    
                          ?>
                      </select></td>
              </tr>
              <tr>
                  <td></br>Staff Email:     
                      <input type="email" name="email" value="<?php echo $email?>" /></td>
              </tr>
              <tr>
                  <td></br>Staff Phone:     
                      <input type="text" name="phone" value="<?php echo $phone?>" /></td>
              </tr>
              </table>
            </br>
             <input type="submit" value="Sign up" name="btnInsert"/>
          <input type="button" value="Cancel" name="btnCancel" onclick="location='main.php'"/>
        </form>
    </div>
</body>

<hr class="p-7">

<footer class="bg-dark text-center text-white">

  <div class="container pt-4">

    <footer class="bg-dark text-center text-white">
    <section class="mb-2">

      <div class="row">

        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Links</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="event.php" class="nav-link text-white link-primary ">Event</a>
            </li>
            <li>
              <a href="insert-member.php" class="nav-link text-white link-primary">Volunteer</a>
            </li>
          </ul>
        </div>


        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Contact Us</h5>

          <ul class="list-unstyled">
            <p>SBCB Human Resource Mangement</p>
            <p>Help center</p>
            <li>
              <a class="text-white link-primary" href="mailto: sbcb@gmail.com">scbc@gmail.com</a>
            </li>
          </ul>
        </div>


        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Links</h5>

          <ul class="list-unstyled mb-0">
            <li>
                <a class="btn btn-outline-primary btn-floating m-2" href="https://www.facebook.com/SCBC"" role="button">
                  <i class="fab fa-facebook-f"></i>
                </a>

                <a class="btn btn-outline-primary btn-floating m-2" style="width:39px; text-align: center;" href="https://www.instagram.com/scbc/?hl=en" role="button">
                  <i class="fab fa-instagram"></i>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </div>

  <hr style="color:rgb(97, 97, 97);background-color:rgb(37, 37, 37)">
  <div class="text-center pb-2 text-bg-dark">
    <p class="text-white"><small>@SCBC Human Resource Management</small></p>
  </div>
</footer>
    </body>
</html>
