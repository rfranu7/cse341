<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randeep Ranu - CSE 341</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <?php 
            $page = "home";
            include($_SERVER['DOCUMENT_ROOT'].'/components/navbar.php'); 
        ?>
    </header>

    <main>
        <section class="first-row">
            <div class="textHolder">
                <h1>HELLO!</h1>
                <p>My name is Randeep Ranu</p>
                <a href="./?action=profile" class="btn">Learn More</a>
            </div>
            <img id="portrait-img" src="assets/images/randeep-portrait.png" data-src="alternate" alt="Randeep Ranu">
        </section>

        <section class="second-row">
            <h1>MY WORK</h1>
            <?php include($_SERVER['DOCUMENT_ROOT'].'/components/assignments.php'); ?>
        </section>
    </main>

    <footer><?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php'); ?></footer>

    <script src="assets/js/change-img.js"></script>
</body>
</html>