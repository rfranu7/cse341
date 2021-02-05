<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habit Tracker</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <main>
        <div class="imageContainer">
            <img src="../images/logo-name.png" alt="Harry R Singh" class="logo">
        </div>
        <?php 
            if(isset($_SESSION['message'])) {
                echo '<p class="'.$_SESSION['status'].'">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            }
        ?>
        <form action="?action=registering" method="POST">
            <label for="firstName">First Name</label>
            <input id="firstName" name="firstName" type="text">
            
            <label for="lastName">Last Name</label>
            <input id="lastName" name="lastName" type="text">

            <label for="emailAddress">Email Address</label>
            <input id="emailAddress" name="emailAddress" type="text">
                    
            <label for="password">Password</label>
            <input id="password" name="password" type="password" >
                
            <button type="submit" class="btn btn-primary">Sign Up</button>
                
            <div class="text-center">
                Already have an account? <a href="?action=login" class="text-danger">Sign In Here</a>
            </div>
        </form>
    </main>

</body>
</html>