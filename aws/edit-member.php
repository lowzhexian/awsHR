<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>

    <head>
        <meta charset="UTF-8">
        <title>Edit Member</title>
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
    <body>
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
                      <li> <a class="nav-link fs-5 px-2 text-white link-primary" href="display-member.php">Staff</a></li>  
           <li> <a class="nav-link fs-5 px-2 text-white link-primary" href="displaytest.php">Edit Staff</a></li>  
          
              </ul>

            </div>
        </div>
    </header>
    
    <div class="body"style="background-image: url('computer-science.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;width:100%;text-align: center;">
    <div class="container">
    <div class="title-1 text-white pt-4">
        <?php
      include 'member-helper.php';
        ?>
        <h1>Edit Member</h1>
     </div>

         <?php
        $id = ""; 
    $hideForm = false;
    if($_SERVER["REQUEST_METHOD"]=="GET") {
        isset($_GET["id"]) ? $id = strtoupper(trim($_GET["id"])) : $id = "";
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "SELECT * FROM staff WHERE id ='$id'";
        $result = $conn->query($sql);
        if($record = $result->fetch_object()) {
            $id = $record->id;
            $name = $record->name;
            $gender = $record->gender;
            $positiom = $record->position;
            $email = $record->email;
            $phone = $record->phone;
                       
            
             $error['id'] = checkStaffID($id);
            $error['name'] = checkStaffName($name);
            $error['gender'] = checkGender($gender);
            $error['position'] = checkPosition($position);
            $error['email'] = checkEmail($email);
            $error['phone'] = checkPhone($phone);
            
            if(empty($error)) {
                $sql = "UPDATE staff SET name = ?, gender = ?, position = ?, email = ? , phone = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssssss', $name, $gender, $position, $email, $phone, $sid); 
                if($stmt->execute()) {
                    echo "<div><a href='display-member.php'>Back to list</a>Staff $name is updated<div>";
                } else {
                    echo "<div class='error'><a href='display-member.php'>Back to lists</a> unable to update records</div>";
                }
                $stmt->close();
            } else {
                echo "<ul class='error'>";
                foreach($error as $value) {
                    echo "<li>$value</li>";
                }
                echo '</ul>';
            }
            $result->free();
        } else {
            echo "<div class='error'>Unable to update records. [<a href='display-member.php'>Back to list</a>]</div>";
            $hideForm = true;
        }
        $conn->close();
    } else {
               
        $name = trim($_POST["name"]);                   
        isset($_POST['gender'])?$gender=$_POST['gender'] : $gender=NULL;
        $position = trim($_POST["position"]); 
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
    }
                ?>
                
                <?php 
                if($hideForm == false):
                    
                endif;
                ?>

 
    <body>
        

        <div class="form">
        <form action="update.php?id=<?=$contact['id']?>" method="POST">
        <table class="text-white">
                   <tr>
                  <td>Student ID:     
                      <input type="text" name="id" value="<?php echo $id?>"disabled /></td>
              </tr>
              <tr>
                  
                  <td></br>Student Name:     
                      <input type="text" name="name" value="<?php echo $name?>" /></td>
              </tr>
              <tr>
                  <td></br>Gender:      
                      <?php
                          $gender=getAllGender();
                          foreach ($gender as $girl => $female){
                              printf(" <input type='radio' name='gender'%s value='%s' />%s",($gender == $girl)?'checked':"",$girl,$female);
                          }
                          
                      ?>

                  </td>
              </tr>
              <tr>
                  <td></br>Program:     
                      <select name="program">
                          <option value="">--Select an option--</option>
                         <?php
                            $program = getAllPosition();
                            foreach ($position as $incharge => $pos) {
                                printf("<option value='%s'%s>%s</option>",$incharge,($position == $incharge)?'checked':" ",$pos);
                            }                    
                          ?>
                      </select></td>
              </tr>
              <tr>
                  <td></br>Student Email:     
                      <input type="email" name="email" value="<?php echo $email?>" /></td>
              </tr>
              <tr>
                  <td></br>Student Phone:     
                      <input type="text" name="phone" value="<?php echo $phone?>" /></td>
              </tr>
              </table>
        
    </div>
        </br>
        <input type='submit' value='update' name='btnYes'/>
        </form>
        <input type="button" value="Cancel" name="btnCancel" onclick="location='display-member.php'"/>
    </form>

          
    </div>

<hr class="p-7">

<footer class="bg-dark text-center text-white">

  <div class="container pt-4">

    <footer class="bg-dark text-center text-white">
    <section class="mb-2">

      <div class="row">

        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Links</h5>

          <ul class="list-unstyled mb-0">
      
              <a href="insert-member.php" class="nav-link text-white link-primary">Staff</a>
            </li>
          </ul>
        </div>


        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Contact Us</h5>

          <ul class="list-unstyled">
            <p>SBBC Human Resource Management</p>
            <p>Help Center</p>
            <li>
              <a class="text-white link-primary" href="mailto: scbc@gmail.com">scbc@gmail.com</a>
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
    </footer>
  </div>

  <hr style="color:rgb(97, 97, 97);background-color:rgb(37, 37, 37)">
  <div class="text-center pb-2 text-bg-dark">
    <p class="text-white"><small>@SCBC Human Resource Management</small></p>
  </div>
    </footer>
    </body>
</html>
