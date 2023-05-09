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
	<h2>Update Member<?=$contact['id']?></h2>
    <form action="edittest.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id">
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name">
        <label for="email">Email</label>
        <label for="phone">gender</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$contact['email']?>" id="email">
        <select type="radio" name="gender" placeholder="Male" value="<?=$contact['gender']?>" id="gender">
        <option value="F">Female</option>
        <option value="M">Male</option>
        </select>
        <label for="phone">Phone</label>
        <label for="program">Position</label>
        <input type="text" name="phone" placeholder="00000000" value="<?=$contact['phone']?>" id="phone">
        <select type="radio" name="position" placeholder="---" value="<?=$contact['position']?>" id="position">
            <option value="CEO">Chief Executive Officer</option>    
            <option value="MD">Managing Director</option>    
            <option value="ST">Staff</option>    
            <option value="MN">Manager</option>
        </select>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

