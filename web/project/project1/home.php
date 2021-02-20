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
            <a href="/project/project1/">
                <img src="images/logo.png" alt="Harry R Singh" class="logo">
            </a>
        </div>
        <div class="menu">
            <a href="./accounts/" class="btn btn-transparent"><i class="fas fa-users-cog fa-lg"></i></a>
            <form>
                <button class="btn btn-transparent" id="addHabitToggle"><i class="fas fa-plus-circle fa-lg"></i></button>
            </form>
            <a href="./accounts/?action=logout">
                <button class="btn btn-transparent"><i class="fas fa-sign-out-alt fa-lg"></i></button>
            </a>
        </div>
    </header>

    <?php 
            if(isset($_SESSION['message'])) {
                echo '<p class="'.$_SESSION['status'].' text-center">'.$_SESSION['message'].'</p>';
                unset($_SESSION['message']);
                unset($_SESSION['status']);
            }
        ?>

    <main>
        <?php 
            foreach ($habits as $habit) {
                $lastDaily = array(date('Y-m-d', strtotime('-6 days')),date('Y-m-d', strtotime('-5 days')),date('Y-m-d', strtotime('-4 days')),date('Y-m-d', strtotime('-3 days')),date('Y-m-d', strtotime('-2 days')),date('Y-m-d', strtotime('-1 days')));
                $lastWeekly = array(date('Y-m-d', strtotime('-6 weeks')),date('Y-m-d', strtotime('-5 weeks')),date('Y-m-d', strtotime('-4 weeks')),date('Y-m-d', strtotime('-3 weeks')),date('Y-m-d', strtotime('-2 weeks')),date('Y-m-d', strtotime('-1 weeks')));
                $lastMonthly = array(date('Y-m-d', strtotime('-6 months')),date('Y-m-d', strtotime('-5 months')),date('Y-m-d', strtotime('-4 months')),date('Y-m-d', strtotime('-3 months')),date('Y-m-d', strtotime('-2 months')),date('Y-m-d', strtotime('-1 months')));

                echo '<div class="box">
                        <div class="box-header">
                            <p>'.$habit['habitname'].'</p>
                            <p class="editHabitToggle" data-name="'.$habit['habitname'].'" data-frequency="'.$habit['frequencyid'].'" data-id="'.$habit['habitid'].'"><i class="fas fa-ellipsis-h"></i></p>
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
                            if(count($progress)>1) {
                                $progress = array_reverse($progress);
                            }
                            
                            for ($i=0; $i < 6 ; $i++) { 

                                if($habit['frequencyname'] == 'Daily') {
                                    $progress = getProgressByToday($habit['habitid'], $lastDaily[$i]);
                                    $date = date('M d, Y', strtotime($lastDaily[$i]));

                                } else if($habit['frequencyname'] == 'Weekly') {
                                    $start =  date('Y-m-d', strtotime('last Sunday', strtotime($lastWeekly[$i])));
                                    $end = date('Y-m-d', strtotime('this Saturday', strtotime($lastWeekly[$i])));
                                    $date = date('M d, Y', strtotime($lastWeekly[$i]));

                                    $progress = getProgressByDate($habit['habitid'], $start, $end);
                                } else if($habit['frequencyname'] == 'Monthly') {
                                    $start =  date('Y-m-01', strtotime($lastMonthly[$i]));
                                    $end = date('Y-m-d', strtotime('last day of this month', strtotime($lastMonthly[$i])));
                                    $date = date('M d, Y', strtotime($lastMonthly[$i]));
                                    
                                    $progress = getProgressByDate($habit['habitid'], $start, $end);
                                }

                                if($progress >= 1) {
                                    echo '<i class="far fa-smile" title="'.$date.'"></i>';
                                } else {
                                    echo '<i class="far fa-sad-cry" title="'.$date.'"></i>';
                                }
                            }

                            if($habit['frequencyname'] == 'Daily') {
                                $thisProgress = getProgressByToday($habit['habitid'], $day);

                            } else if($habit['frequencyname'] == 'Weekly') {
                                $start =  date('Y-m-d', strtotime('last Sunday', strtotime($day)));
                                $end = date('Y-m-d', strtotime('this Saturday', strtotime($day)));

                                $thisProgress = getProgressByDate($habit['habitid'], $start, $end);
                            } else if($habit['frequencyname'] == 'Monthly') {
                                $start =  date('Y-m-01', strtotime($day));
                                $end = date('Y-m-d', strtotime('last day of this month', strtotime($day)));
                                
                                $thisProgress = getProgressByDate($habit['habitid'], $start, $end);
                            }
                            $date = date('M d, Y', strtotime($day));

                            if($thisProgress >= 1) {
                                echo '<i class="far fa-smile" title="'.$date.'"></i>';
                            } else {
                                echo '<i class="fas fa-spinner" title="'.$date.'"></i>';
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
            <form action="?action=add-habit" method="POST" id="habitForm">
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
        const editBtn = document.querySelectorAll(".editHabitToggle");

        const habitForm = document.getElementById("habitForm");
        const habitName = document.getElementById("habitName");
        const frequencyId = document.getElementById("frequencyId");

        addBtn.addEventListener("click", (e) => {
            e.preventDefault();
            modal.style.display = "block";
        });

        editBtn.forEach(element => {
            element.addEventListener("click", (e) => {
                e.preventDefault();

                const hidden = document.createElement('input');
                hidden.setAttribute("type", "hidden");
                hidden.setAttribute("name", "habitid");

                console.log(frequencyId.options);
                for(var i=0; i<frequencyId.length; i++) {
                    if(frequencyId.options[i].value == '') {
                        frequencyId.options[i].removeAttribute("selected");
                    } else if(frequencyId.options[i].value == e.target.parentElement.dataset.frequency) {
                        frequencyId.options[i].setAttribute("selected", "true");
                    }
                };

                habitName.value = e.target.parentElement.dataset.name;
                hidden.value = e.target.parentElement.dataset.id;
                habitForm.appendChild(hidden);

                modal.style.display = "block";
            });
        });

        window.addEventListener("click", (e) => {
            if (e.target == modal) {
                habitForm.reset();
                frequencyId.options[0].setAttribute("selected", "true");
                modal.style.display = "none";
            }
        });
    </script>

</body>
</html>