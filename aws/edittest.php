<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $program= isset($_POST['position']) ? $_POST['position'] : '';
       
        $stmt = $pdo->prepare('UPDATE staff SET id = ?, name = ?, email = ?, phone = ?, gender = ?, position = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $gender, $position, $_GET['id']]);
        $msg = 'Updated Successfully!Returning to the List...';header("Refresh:3; url=displaytest.php");
    }
    
    $stmt = $pdo->prepare('SELECT * FROM staff WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>


<div class="content update">
	<h2 style="margin-left:45%;font-family: Arial">Update Staff <?=$contact['id']?></h2>
    <form action="edittest.php?id=<?=$contact['id']?>" method="post" style="background-color: lightblue;width:600px;height:500px;margin-left: 30%;padding-left: 60px;padding-top: 40px;border-radius: 5px">
        <b> <label for="id">Staff ID</label></b>
                <b><label for="name"style="margin-left: 300px">Name</label></b>
        <br><br>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id" style="border:grey solid;border-radius: 5px">
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name"style="margin-left: 150px;border:grey solid;border-radius: 5px">
        <br><br>
        <b><label for="email">Email</label></b>
                <b>  <label for="phone"style="margin-left: 300px">Gender</label></b>
        <br><br>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$contact['email']?>" id="email"style="border:grey solid;border-radius: 5px;">
        <select type="radio" name="gender" placeholder="Male" value="<?=$contact['gender']?>" id="gender"style="margin-left: 165px;border:grey solid;border-radius: 5px">
        <option value="F">Female</option>
        <option value="M">Male</option>
        </select>
        <br><br>
        <b> <label for="phone">Phone</label></b>
        <b><label for="position"style="margin-left: 300px">Position</label></b>
        <br><br>
        <input type="text" name="phone" placeholder="00000000" value="<?=$contact['phone']?>" id="phone"style="border:grey solid;border-radius: 5px">
        <select type="radio" name="position" placeholder="---" value="<?=$contact['position']?>" id="position" style="margin-left: 150px;border:grey solid;border-radius: 5px">
            <option value="CEO">Chief Executive Officer</option>    
            <option value="MD">Managing Director</option>    
            <option value="ST">Staff</option>    
            <option value="MN">Manager</option>
        </select>
        <br><br>
        <input type="submit" value="Update"style="background-color: lightgreen;border-radius: 6px">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

