<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>educaTech</title>
    <link rel="stylesheet" href="css/menuBar.css">
    <link rel="stylesheet" href="css/styleContent.css">
</head>
<body>
    @include('partials.header')
    <div class="flex">
        <div class="content">
            <div class="profile">
                <div class="photo"><img src="img/profile.png" alt=""></div>
            </div>
            <div class="link-section">
                <div class="main-link">Link útiles</div>
                <div class="other-links">
                    <a href="#"><img src="img/level.png" alt="">Primero de secundaria</a>
                    <a href="#"><img src="img/calendar.png" alt="">Calendario de examen</a>
                    <a href="#"><img src="img/minedu.png" alt="">Aprendo en casa</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="slider">
                <div class="slide active"><a href="#"><img src="img/banner1.jpg" alt=""></a></div>
                <div class="slide"><a href="#"><img src="img/banner2.jpg" alt=""></a></div>
                <div class="slide"><a href="#"><img src="img/banner3.jpg" alt=""></a></div>
                <div class="slide"><a href="#"><img src="img/banner4.jpg" alt=""></a></div>
            </div>

            <div class="indicator">

            </div>
        </div>
        <!--Controls-->
<!--        <div class="controls">-->
<!--            <div class="prev"><</div>-->
<!--            <div class="next">></div>-->
<!--        </div>-->
        <!--Indicators-->
    </div>
    <div class="footer">
        <div class="content-footer">
            <p>Copyright 2019 educatech.org</p>
        </div>
    </div>

    <script src="js/slider.js"></script>
</body>
</html>

