<?php
include_once('database.php');
session_start();
$user_id = $_SESSION['user_id'];
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$user_check_query = "SELECT * FROM user WHERE user_id= $user_id";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
var_dump($user);
?>
<!DOCTYPE html>
<html>
   

<head>  
    <meta charset="UTF-8">
    <title>Profile Settings</title>
    <link rel="stylesheet" type="text/css" href="\style\style.css">
</head> 

<body>
    <form method="post" action="userpage.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" placeholder="<?php echo $user['username']; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" placeholder="<?php echo $user['email']; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1" value="">
        </div>
        <div class=" input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2" value="">
        </div>
        <div class=" input-group">
            <button type="submit" class="btn" name="reg_user">Update</button>
        </div> 
        <?php
        $username = $user['username'];
        $email = $user['email'];
        if (!empty($user['password_1'])) {
            $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
            $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
            $password = md5($user['password']);
            $update_profile = $mysqli->query("UPDATE user SET email = '$email', username = '$username', password = '$password' WHERE user_id = '$user_id'");
        } else {
            $update_profile = $mysqli->query("UPDATE user SET email = '$email', username = '$username' WHERE user_id = '$user_id'");
        }
        ?>
</body>

</html>