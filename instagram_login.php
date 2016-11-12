<?php
session_start();

if (isset($_SESSION['user_info'])) {
    $title = "Logged in as " . $_SESSION['user_info']['data']['full_name'];
} else {
    $title = "Login With Instagram";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title><?php echo $title; ?></title>

    </head>
    <body>

        <?php
        if (isset($_SESSION['user_info'])) {
            $user_info = $_SESSION['user_info'];
            $full_name = $_SESSION['user_info']['data']['full_name'];
            $username = $_SESSION['user_info']['data']['username'];
            $bio = $_SESSION['user_info']['data']['bio'];
            $ID = $_SESSION['user_info']['data']['id'];
            $website = $_SESSION['user_info']['data']['website'];
            $media_count = $_SESSION['user_info']['data']['counts']['media'];
            $followers_count = $_SESSION['user_info']['data']['counts']['followed_by'];
            $following_count = $_SESSION['user_info']['data']['counts']['follows'];
            $profile_picture = $_SESSION['user_info']['data']['profile_picture'];
            ?>      
            <div align="center">
                <h2>Welcome <?php echo $full_name; ?>!</h2>
                <h4>Your username: <?php echo $username; ?></h4>
                <h4>Your bio: <?php echo $bio; ?></h4>
                <h4>Your Website: <a href="<?php echo $website; ?>"><?php echo $website; ?></a></h4>
                <h4>Media count: <?php echo $media_count; ?></h4>
                <h4>Followers count: <?php echo $followers_count; ?></h4>
                <h4>Following count: <?php echo $following_count; ?></h4>
                <h4>Your ID: <?php echo $ID; ?></h4>
                <h4><img src="<?php echo $profile_picture; ?>"></h4>
                <a href="logout.php" class="btn btn-info">Logout</a>
            </div>
            <?php
        } else {
            echo '<iframe src="https://www.instagram.com/accounts/logout/" width="188" height="258" scrolling="no" style="overflow:hidden; margin-top:-4px; margin-left:-4px; border:none;"></iframe>';
            echo '<h2 align=center> Login using instagram.</h2>';
            echo '<div align=center><a href="login.php" ><img src="instagram-login-button.png" /></a></div>';
            echo '<div align="center"><a href=index.php class="btn btn-info">Home</a></div>';
        }
        ?>

    </body>
</html>