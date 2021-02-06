<?php 
    // Main Controller

    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/frequency-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/habit-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/progress-model.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/log-model.php';

    // Create or access session
    session_start();

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    if(!isset($_SESSION['loggedIn'])) {
        header('Location: ./accounts/?action=login');
    }

    switch ($action){
        case "logs":
            if($_SESSION['userData']['userRole'] == 23) {
                include $_SERVER['DOCUMENT_ROOT'] . '/project/project1/logs.php';
            } else {
                include $_SERVER['DOCUMENT_ROOT'] . '/project/project1/home.php';
            }
        break;

        case "add-habit":
            $habitName = filter_input(INPUT_POST, 'habitName', FILTER_SANITIZE_STRING);
            $frequencyId = filter_input(INPUT_POST, 'frequencyId', FILTER_SANITIZE_NUMBER_INT);

            if (empty($habitName) || empty($frequencyId)){
                $_SESSION['message'] = 'Please provide information for all empty form fields.';
                $_SESSION['status'] = "error";
                header("Location: ./?action=home");
                exit;
            }

            $outcome = addHabit($_SESSION['userData']['userid'], $frequencyId, $habitName);

            // check results
            if ($regOutcome === 1){
                $_SESSION['message'] = 'Registration successful. Please use your email and password to login.';
                $_SESSION['status'] = "success";

                addLog($_SESSION['userData']['userid'], $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' added a new habit.');
                header('Location: ./?action=login');
                exit;
            }

            else {
                $_SESSION['message'] = 'Sorry, '.$userFirstname.', but your registration failed. Please try again.';
                $_SESSION['status'] = "error";
                addLog($_SESSION['userData']['userid'], $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' failed to add a new habit.');
                header("Location: ./?action=register");
                exit;
            }
        break;

        default:     
            $frequencies = getAllFrequency();
            $habits = getHabitsByUser($_SESSION['userData']['userid']);
            include $_SERVER['DOCUMENT_ROOT'] . '/project/project1/home.php';
        break;
    }


?>