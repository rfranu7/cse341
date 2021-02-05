<?php
    // MODEL FOR CONNECTION WITH USERS TABLE
    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/project1/models/connect.php';
    
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
    

?>