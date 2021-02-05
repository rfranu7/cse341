<?php 
    // Main Controller

    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/account-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/log-model.php';

    // Create or access session
    session_start();

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){

        case "login":
            include $_SERVER['DOCUMENT_ROOT'] . '/project/project1/login.php';
        break;

        case "logging":
            // Get input
            $email = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
            $userPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Filter inputs
            $userEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

            if (empty($userEmail) || empty($userPassword)){
                $_SESSION['message'] = 'Please provide information for all empty form fields.';
                $_SESSION['status'] = "error";
                header("Location: ./?action=login");
                exit;
            }

            $userData = getClient($userEmail);
            $hashcheck = password_verify($userPassword, $userData['userpassword']);
            if (!$hashcheck) {
                $_SESSION['message'] = 'Please check your password and try again.';
                $_SESSION['status'] = "error";
                header("Location: ./?action=login");
                exit;
            }

            // SET SESSION STATUS
            $_SESSION['loggedIn'] = TRUE;
            array_pop($userData);
            $_SESSION['userData'] = $userData;

            addLog($_SESSION['userData']['userid'], "Client has logged in.");

            // SEND BACK TO HOME PAGE
            header("Location: ../");
        break;

        case "register":
            include $_SERVER['DOCUMENT_ROOT'] . '/project/project1/register.php';
        break;

        case "registering":
            // filter and store data
            $userFirstname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
            $userLastname = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
            $userPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $userEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
            $existingEmail = checkDuplicateEmail($userEmail);

            if ($existingEmail === 1) {
                $_SESSION['message'] = 'That email address already exists. Do you want to <a href="./?action=login" class="text-danger">login</a> instead?';
                $_SESSION['status'] = "info";
                header("Location: ./?action=register");
                exit;
            }

            // check for missing data
            if (empty($userFirstname) || empty($userLastname) || empty($userEmail) || empty($userPassword)) {
                $_SESSION['message'] = 'please provide information for all empty form fields';
                $_SESSION['status'] = "error";
                $_SESSION['sticky'] = array("userFirstname" => $userFirstname, "userLastname" => $userLastname, "userEmail" => $email);
                header("Location: ./?action=register");
                exit;
            } 

            // Hash the password
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

            // send the data
            $regOutcome = regClient($userFirstname, $userLastname, $userEmail, $hashedPassword);

            // check results
            if ($regOutcome === 1){
                $_SESSION['message'] = 'Registration successful. Please use your email and password to login.';
                $_SESSION['status'] = "success";

                addLog(1, $userFirstname.' '.$userLastname.' has registered on our system');
                header('Location: ./?action=login');
                exit;
            }

            else {
                $_SESSION['message'] = 'Sorry, '.$userFirstname.', but your registration failed. Please try again.';
                $_SESSION['status'] = "error";
                addLog(1, $userFirstname.' '.$userLastname.' has failed to registered on our system');
                header("Location: ./?action=register");
                exit;
            }
        break;

        case "logout":
            session_destroy();
            $_SESSION['message'] = 'You have logged out successfully';
            $_SESSION['status'] = "success";
            header("Location: ./?action=login");
        break;

        default:
            include $_SERVER['DOCUMENT_ROOT'] . '/project/project1/login.php';
        break;
    }


?>