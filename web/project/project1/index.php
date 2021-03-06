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

        case "add-habit":
            $habitName = filter_input(INPUT_POST, 'habitName', FILTER_SANITIZE_STRING);
            $frequencyId = filter_input(INPUT_POST, 'frequencyId', FILTER_SANITIZE_NUMBER_INT);
            $habitid = filter_input(INPUT_POST, 'habitid', FILTER_SANITIZE_NUMBER_INT);

            if (empty($habitName) || empty($frequencyId)){
                $_SESSION['message'] = 'Please provide information for all empty form fields.';
                $_SESSION['status'] = "error";
                header("Location: ./?action=home");
                exit;
            }

            if(empty($habitid)) {
                $outcome = addHabit($_SESSION['userData']['userid'], $frequencyId, $habitName);
            } else {
                $outcome = updateHabit($habitid, $frequencyId, $habitName);
            }

            // check results
            if ($outcome === 1){
                if(empty($habitid)) {
                    $_SESSION['message'] = 'Habit successfully added';
                    addLog($_SESSION['userData']['userid'], $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' added a new habit.');
                } else {
                    $_SESSION['message'] = 'Habit successfully updated';
                    addLog($_SESSION['userData']['userid'], $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' updated a habit.');
                }
                $_SESSION['status'] = "success";

                header('Location: ./?action=home');
                exit;
            }

            else {
                if(empty($habitid)) {
                    $_SESSION['message'] = 'We have encountered an error while trying to add your new habit';
                    addLog($_SESSION['userData']['userid'], $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' failed to add a new habit.');
                } else {
                    $_SESSION['message'] = 'We have encountered an error while trying to update your new habit';
                    addLog($_SESSION['userData']['userid'], $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' failed to update a new habit.');
                }
                $_SESSION['status'] = "error";
                
                header("Location: ./?action=home");
                exit;
            }
        break;

        case "update-goal":
            $habitId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $progressDay = date('Y/m/d H:i:s');
            $progressResult = 'true';
            $userId = $_SESSION['userData']['userid'];

            if (empty($habitId)){
                $_SESSION['message'] = 'Please provide information for all empty form fields.';
                $_SESSION['status'] = "error";
                header("Location: ./");
                exit;
            }
            
            $isTodayComplete = isTodayComplete($habitId, $progressDay);

            if($isTodayComplete >= 1) {
                $_SESSION['message'] = 'Your progress for today has already been recorded';
                $_SESSION['status'] = "info";

                header('Location: ./');
                exit;
            }

            $outcome = addProgressSuccess($habitId, $progressDay, $progressResult);

            // check results
            if ($outcome === 1){
                $_SESSION['message'] = 'Result successfuly saved';
                $_SESSION['status'] = "success";

                addLog($userId, $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' has updated progress.');
                header('Location: ./');
                exit;
            }

            else {
                $_SESSION['message'] = 'Sorry, '.$userFirstname.', but your registration failed. Please try again.';
                $_SESSION['status'] = "error";
                addLog($userId, $_SESSION['userData']['firstname'].' '.$_SESSION['userData']['lastname'].' failed to updated progress.');
                header("Location: ./");
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