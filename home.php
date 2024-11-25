<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/home.css">
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
            <div class="our-gallery-section">
                <span class="our-gallery-heading">Our Gallery</span>
                <div class="our-gallery">
                    <div class="gallery-grid" onclick="location.href='innerGallery.php'">
                        <img class="gallery-image" src="./IMAGES/_.jpeg" alt="">
                        <div class="gallery-grid-info">
                            <div class="gallery-title">
                                Mullet
                            </div>
                            <div class="gallery-description">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa asperiores obcaecati dolores voluptatum, repellendus dolorum. Totam, libero unde molestiae at nesciunt illum id explicabo incidunt numquam similique, eveniet corrupti natus.
                            </div>
                        </div>
                    </div>
                    <div class="gallery-grid" onclick="location.href='innerGallery.php'">
                        <img class="gallery-image" src="./IMAGES/_.jpeg" alt="">
                        <div class="gallery-grid-info">
                            <div class="gallery-title">
                                Mullet
                            </div>
                            <div class="gallery-description">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa asperiores obcaecati dolores voluptatum, repellendus dolorum. Totam, libero unde molestiae at nesciunt illum id explicabo incidunt numquam similique, eveniet corrupti natus.
                            </div>
                        </div>
                    </div>
                    <div class="gallery-grid" onclick="location.href='innerGallery.php'">
                        <img class="gallery-image" src="./IMAGES/_.jpeg" alt="">
                        <div class="gallery-grid-info">
                            <div class="gallery-title">
                                Mullet
                            </div>
                            <div class="gallery-description">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa asperiores obcaecati dolores voluptatum, repellendus dolorum. Totam, libero unde molestiae at nesciunt illum id explicabo incidunt numquam similique, eveniet corrupti natus.
                            </div>
                        </div>
                    </div>
                    <div class="gallery-grid" onclick="location.href='innerGallery.php'">
                        <img class="gallery-image" src="./IMAGES/_.jpeg" alt="">
                        <div class="gallery-grid-info">
                            <div class="gallery-title">
                                Mullet
                            </div>
                            <div class="gallery-description">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa asperiores obcaecati dolores voluptatum, repellendus dolorum. Totam, libero unde molestiae at nesciunt illum id explicabo incidunt numquam similique, eveniet corrupti natus.
                            </div>
                        </div>
                    </div>
                </div>
                <button class="visit-gallery-button" onclick="location.href='gallery.php'">Visit Gallery</button>
            </div>

            <!-- <div class="our-barbers-section">
                <span class="our-barbers-heading">Meet your barbers</span>
                <div class="our-barbers">
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Corte de cabelo masculino, barbear masculino na barbearia _ Foto Premium.jpeg" alt="">
                        <a class="barbers-link" href="https://www.youtube.com/results?search_query=give+link+on+the+hover+image">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Corte de cabelo masculino, barbear masculino na barbearia _ Foto Premium.jpeg" alt="">
                    </div>
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Corte de cabelo masculino, barbear masculino na barbearia _ Foto Premium.jpeg" alt="">
                    </div>
                    <div class="barbers-grid">
                        <img class="barbers-image" src="./IMAGES/Corte de cabelo masculino, barbear masculino na barbearia _ Foto Premium.jpeg" alt="">
                    </div>
                </div>
            </div> -->

            
        </div>
    </div>
    <?php include "footer.php" ?>
</body>
</html>