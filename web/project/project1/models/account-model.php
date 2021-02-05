<?php
    // MODEL FOR CONNECTION WITH USERS TABLE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/connect.php';
    
    // ============================================================
    // INSERT FUNCTIONS
    // ============================================================

    function regClient($firstName, $lastName, $emailAddress, $userPassword){
        $db = dbConnect();
        $sql = 'INSERT INTO users (emailAddress, userPassword, firstName, lastName)
            VALUES (:emailAddress, :userPassword, :firstName, :lastName)';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':emailAddress', $emailAddress, PDO::PARAM_STR);
        $stmt->bindValue(':userPassword', $userPassword, PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);

        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowsChanged;
    }
    
    // ============================================================
    // READ FUNCTIONS
    // ============================================================

    function getClient($emailAddress) {
        $db = dbConnect();
        $sql = 'SELECT userId, emailAddress, firstName, lastName, userRole, resetToken, tokenExpire, userPassword FROM users WHERE emailAddress = :emailAddress';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':emailAddress', $emailAddress, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;
    }

    // ============================================================
    // HELPER FUNCTIONS
    // ============================================================

    function checkDuplicateEmail($emailAddress) {
        $db = dbConnect();
        $sql = 'SELECT emailAddress FROM users WHERE emailAddress = :emailAddress';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':emailAddress', $emailAddress, PDO::PARAM_STR);

        $stmt->execute();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();

        if(empty($matchEmail)) {
            return 0;
        }
        else {
            return 1;
        }
    }
    

?>