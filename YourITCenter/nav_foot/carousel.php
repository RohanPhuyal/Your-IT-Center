<!-- carousel.php  -->
<style>
    .custom-cara img {
        height: 470px;
        object-fit: cover;
    }

    .custom-cara h5 {
        color: #de5832;
        font-weight: 800;
        font-family: 'Arial', sans-serif;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }

    .custom-cara p {
        color: #de5832;
        font-weight: 500;
        font-family: 'Arial', sans-serif;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    }
</style>
<div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner custom-cara">
        <div class="carousel-item active">
            <img src="img/slide1.jpg" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Razer Viper Mini</h5>
                <p>Best Budget Gaming Mouse</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/slide2.jpg" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>XPG Lancer DDR5 RAM</h5>
                <p>Best you can get</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/slide3.jpg" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Inter 13th Gen Processors</h5>
                <p>Speed Matters</p>
            </div>
        </div>
    </div>

    <!-- Carousel Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExample" data-slide-to="1"></li>
        <li data-target="#carouselExample" data-slide-to="2"></li>
    </ol>

    <!-- Carousel Controls -->
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div style="height: 25px;"></div>