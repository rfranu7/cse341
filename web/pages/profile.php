<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <header>
        <?php 
            $page = "profile";
            include($_SERVER['DOCUMENT_ROOT'].'/components/navbar.php'); 
        ?>
    </header>

    <main>
        <section class="image">
            <img src="assets/images/randeep-portrait.png" alt="Randeep Ranu">
        </section>

        <section class="profile">
            <div class="textHolder">
                <h1>Hi Visitor!</h1>
                <p>It's a great pleasure to know that you want to get to know more about me.</p>
                <p><strong>I am a student at Brigham Young University Idaho who is currently working towards getting a degree in Applied Technology.</strong></p>

                <p>
                    I also work as a Software Developer for a tech startup company in the Philippines for about 4 months now. I get to work on different projects 
                    (and programming languages depending on what the client needs) that helps me gain a lot of first hand experience in the development world.
                </p>
                
                <p>
                    I have enjoyed programming since being introduced to it back in 2013. I love the problem solving aspect that it has.
                </p>

                <p>
                    If I'm not coding, you would find me playing strategy, farming or any other business simulation games. I also enjoy playing fighting games whenever
                    I have friends over.
                </p>
            </div>
        </section>
    </main>

    <footer><?php include($_SERVER['DOCUMENT_ROOT'].'/components/footer.php'); ?></footer>

</body>
</html>