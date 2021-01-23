<?php 
    // Main Controller

    // Create or access session
    session_start();

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action){
        case "profile":
            include $_SERVER['DOCUMENT_ROOT'] . '/pages/profile.php';
        break;
        
        case "work":
            include $_SERVER['DOCUMENT_ROOT'] . '/pages/work.php';
        break;

        case "shopping-cart":
            header('Location: /assignments/week3/');
        break;

        default:        
            include $_SERVER['DOCUMENT_ROOT'] . '/pages/home.php';
        break;
    }


?>