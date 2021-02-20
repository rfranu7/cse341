<?php
    // MODEL FOR CONNECTION WITH USERS TABLE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/connect.php';

    // ============================================================
    // INSERT FUNCTIONS
    // ============================================================

    function addProgressSuccess($habitid, $progressday, $progressresult) {
        $db = dbConnect();
        $sql = 'INSERT INTO progress (habitid, progressday, progressresult) VALUES (:habitid, :progressday, :progressresult)';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':habitid', $habitid, PDO::PARAM_INT);
        $stmt->bindValue(':progressday', $progressday, PDO::PARAM_STR);
        $stmt->bindValue(':progressresult', $progressresult, PDO::PARAM_BOOL);

        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $rowCount;
    }
    
    // ============================================================
    // READ FUNCTIONS
    // ============================================================

    function getProgressByHabit($habitid) {
        $db = dbConnect();
        $sql = 'SELECT progressid, habitid, progressday, progressresult FROM progress WHERE habitid = :habitid ORDER BY progressday DESC LIMIT 6';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':habitid', $habitid, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;
    }

    function getProgressByToday($habitid, $day) {
        $db = dbConnect();
        $sql = 'SELECT progressid, habitid, progressday, progressresult FROM progress WHERE habitid = :habitid AND progressday = :progressday';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':habitid', $habitid, PDO::PARAM_INT);
        $stmt->bindValue(':progressday', $day, PDO::PARAM_STR);

        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        return $data;
    }

    function getProgressByDate($habitid, $startDate, $endDate) {
        $db = dbConnect();
        $sql = 'SELECT progressid, habitid, progressday, progressresult FROM progress WHERE habitid = :habitid 
        AND progressday BETWEEN :startDate AND :endDate';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':habitid', $habitid, PDO::PARAM_INT);
        $stmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);

        $stmt->execute();
        $count = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $count;
    }

    function isTodayComplete($habitid, $day) {
        $db = dbConnect();
        $sql = 'SELECT progressid, habitid, progressday, progressresult FROM progress WHERE habitid = :habitid AND progressday = :progressday';

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':habitid', $habitid, PDO::PARAM_INT);
        $stmt->bindValue(':progressday', $day, PDO::PARAM_STR);

        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $rowCount;
    }
    

?>