<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habit Tracker</title>
    <link rel="stylesheet" href="../css/account-settings.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>
<body>

    <header>
        <div class="imageContainer">
            <a href="/project/project1/">
                <img src="../images/logo.png" alt="Harry R Singh" class="logo">
            </a>
        </div>
        <div class="menu">
            <a href="./" class="btn btn-transparent"><i class="fas fa-users-cog fa-lg"></i></a>
            <form>
                <!-- <button class="btn btn-transparent" id="addHabitToggle"><i class="fas fa-plus-circle fa-lg"></i></button> -->
            </form>
            <a href="?action=logout">
                <button class="btn btn-transparent"><i class="fas fa-sign-out-alt fa-lg"></i></button>
            </a>
        </div>
    </header>

    <main>

        <?php 
            if(isset($_SESSION['message'])) {
                echo '<p class="'.$_SESSION['status'].' text-center">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            }
        ?>
        
        <form action="?action=update-account" method="post">
            <h1>Update Profile</h1>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" <?php if(isset($_SESSION['userData']['firstname'])) { echo 'value="'.$_SESSION['userData']['firstname'].'"'; } ?>>
            
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" <?php if(isset($_SESSION['userData']['lastname'])) { echo 'value="'.$_SESSION['userData']['lastname'].'"'; } ?>>
            
            <label for="emailAddress">Email Address</label>
            <input type="text" name="emailAddress" id="emailAddress" <?php if(isset($_SESSION['userData']['emailaddress'])) { echo 'value="'.$_SESSION['userData']['emailaddress'].'"'; } ?>>

            <div class="button-placeholder">
                <button class="btn btn-start">Update Profile</button>
            </div>
        </form>

        <form action="?action=update-password" method="post">
            <h1>Update Password</h1>
            <label for="oldPassword">Old Password</label>
            <input type="password" name="oldPassword" id="oldPassword">
            
            <label for="newPassword">New Password</label>
            <input type="password" name="newPassword" id="newPassword">

            <div class="button-placeholder">
                <button class="btn btn-start">Update Password</button>
            </div>
        </form>
        
        
    </main>

</body>
</html>