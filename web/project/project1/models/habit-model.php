<?php
    // MODEL FOR CONNECTION WITH USERS TABLE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/connect.php';
    
    // ============================================================
    // INSERT FUNCTIONS
    // ============================================================

    function addHabit($userid, $frequencyid, $habitname){
        $db = dbConnect();
        $sql = 'INSERT INTO habit (userid, frequencyid, habitname) VALUES (:userid, :frequencyid, :habitname)';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindValue(':frequencyid', $frequencyid, PDO::PARAM_INT);
        $stmt->bindValue(':habitname', $habitname, PDO::PARAM_STR);

        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowsChanged;
    }

    // ============================================================
    // UPDATE FUNCTIONS
    // ============================================================

    function updateHabit($habitid, $frequencyid, $habitname){
        $db = dbConnect();
        $sql = 'UPDATE habit SET frequencyid = :frequencyid, habitname = :habitname WHERE habitid = :habitid';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':habitid', $habitid, PDO::PARAM_INT);
        $stmt->bindValue(':frequencyid', $frequencyid, PDO::PARAM_INT);
        $stmt->bindValue(':habitname', $habitname, PDO::PARAM_STR);

        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();

        return $rowsChanged;
    }
    
    // ============================================================
    // READ FUNCTIONS
    // ============================================================

    function getHabitsByUser($userid) {
        $db = dbConnect();
        $sql = 'SELECT habitid, userid, habit.frequencyid, frequencyname, habitname FROM habit JOIN frequency ON habit.frequencyid = frequency.frequencyid WHERE userid = :userid';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;
    }
    

?>