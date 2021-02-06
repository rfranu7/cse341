<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habit Tracker</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>
<body>

    <header>
        <div class="imageContainer">
            <img src="images/logo.png" alt="Harry R Singh" class="logo">
        </div>
        <div class="menu">
            <form>
                <button class="btn btn-transparent" id="addHabitToggle"><i class="fas fa-plus-circle fa-lg"></i></button>
            </form>
            <form action="/project/project1/accounts/?action=logout">
                <button class="btn btn-transparent"><i class="fas fa-sign-out-alt fa-lg"></i></button>
            </form>
        </div>
    </header>

    <main>
        <?php 
            foreach ($habits as $habit) {
                echo '<div class="box">
                        <div class="box-header">
                            <p>'.$habit['habitname'].'</p>
                        </div>
                        <div class="box-body">
                            <div class="goal">
                                <p>GOAL: <span>'.$habit['frequencyname'].'</span></p>
                                <p>STREAK: <span>'.$habit['frequencyname'].'</span></p>
                            </div>

                            <div class="complete">
                                <form action="./?action=update-goal" method="POST">
                                    <input type="hidden" name="id" value="'.$habit['habitid'].'">
                                    <button class="btn btn-start">Complete</button>
                                </form>
                            </div>
                        </div>
                        <div class="box-footer">';
                            $day = date('Y-m-d');
                            $progress = getProgressByHabit($habit['habitid']);
                            $progressToday = getProgressByToday($habit['habitid'], $day);
                            if(count($progress)>1) {
                                $progress = array_reverse($progress);
                            }
                            
                            for ($i=0; $i < 6 ; $i++) { 
                                if(isset($progress[$i]['progressresult']) && $progress[$i]['progressresult']) {
                                    echo '<i class="far fa-smile"></i>';
                                } else {
                                    echo '<i class="far fa-sad-cry"></i>';
                                }
                            }

                            if(isset($progressToday['progressresult']) && $progressToday['progressresult']) {
                                echo '<i class="far fa-smile"></i>';
                            } else {
                                echo '<i class="fas fa-spinner"></i>';
                            }
                        echo '</div>
                    </div>';
            }
        ?>
        
        
    </main>

    <!-- MODALS -->
    <div id="addHabitModal" class="modal">
        <div class="modal-content">
            <h2>Add Habit</h2>
            <form action="?action=add-habit" method="POST">
                <label for="habitName">Habit</label>
                <input id="habitName" name="habitName" type="text">

                <label for="frequencyId">Frequency</label>
                <select name="frequencyId" id="frequencyId">
                    <option value="" selected disabled>Please select frequency of your habit</option>
                    <?php 
                        foreach($frequencies as $frequency) {
                            echo '<option value="'.$frequency['frequencyid'].'">'.$frequency['frequencyname'].'</option>';
                        }
                    ?>
                </select>
                    
                <button type="submit" class="btn btn-primary">Add Habit</button>
            </form>
        </div>
    </div>
    <!-- END MODALS -->

    <script>
        const modal = document.getElementById("addHabitModal");
        const addBtn = document.getElementById("addHabitToggle");

        addBtn.addEventListener("click", (e) => {
            e.preventDefault();
            modal.style.display = "block";
        });

        window.addEventListener("click", (e) => {
            if (e.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>

</body>
</html>