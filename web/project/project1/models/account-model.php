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
        $id = $db->lastInsertId();
        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();

        return array("id" => $id, "count" => $rowCount);
    }

    // ============================================================
    // UPDATE FUNCTIONS
    // ============================================================

    function updateClient($userid, $firstName, $lastName, $emailAddress) {
        $db = dbConnect();
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, emailaddress = :emailaddress WHERE userid = :userid';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':emailaddress', $emailAddress, PDO::PARAM_STR);
        
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $rowCount;
    }

    function updatePassword($userid, $userPassword) {
        $db = dbConnect();
        $sql = 'UPDATE users SET userpassword = :userpassword WHERE userid = :userid';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':userpassword', $userPassword, PDO::PARAM_STR);
        
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $rowCount;
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