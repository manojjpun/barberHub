<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php" ?>
    <div class="home-layout-container">
        
        <div class="middle-section">
            <div class="video-section">
                <video class="video-showcase" src="./IMAGES/7697129-hd_1920_1080_30fps.mp4" muted loop autoplay></video>
                <span class="slogan-heading">Snip, Style, Schedule - Your Hair, Your Time.</span>
                <span class="slogan-description">Say goodbye to waiting! Book your haircut appointments effortlessly with our online barber system.</span>
                <button class="appointment-button">Make an appointment</button>
            </div>

            <div class="our-barbers-section">
                <span class="our-barbers-heading">Meet your barbers</span>
                <div class="our-barbers">
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Justin Lister.jpeg" alt="">
                        <!-- <i class="fa-brands fa-instagram"></i> -->
                    </div>
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Justin Lister.jpeg" alt="">
                        <!-- <i class="fa-brands fa-instagram"></i> -->
                    </div>
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Justin Lister.jpeg" alt="">
                        <!-- <i class="fa-brands fa-instagram"></i> -->
                    </div>
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Justin Lister.jpeg" alt="">
                        <!-- <i class="fa-brands fa-instagram"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>
</html>