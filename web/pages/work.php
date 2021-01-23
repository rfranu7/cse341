<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Work</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <header>
        <?php 
            $page = "work";
            include($_SERVER['DOCUMENT_ROOT'].'/components/navbar.php'); 
        ?>
    </header>

    <main>
        <section class="work">
            <h1>MY WORK</h1>
            <?php include($_SERVER['DOCUMENT_ROOT'].'/components/assignments.php'); ?>
        </section>
    </main>

    <footer><?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php'); ?></footer>

</body>
</html>