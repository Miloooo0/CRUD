 <style>
        .carousel {
            width: 50vw;
            left: 25vw;
            overflow: hidden;
            position: relative;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel img {
            width: 1000;
            object-fit: cover;
            object-position: center;
        }

        /* Botones indicadores */
        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .indicator {
            width: 12px;
            height: 12px;
            background-color: gray;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .indicator.active {
            background-color: white;
        }
    </style>
</head>
<body>

    <div class="carousel">
        <div class="carousel-inner">
            <img src="https://r4.wallpaperflare.com/wallpaper/706/534/469/movie-scenes-joker-2019-movie-hd-wallpaper-f6fa8809aa76889f2d68c3803db27ef5.jpg" alt="Imagen 1">
            <img src="https://w.wallhaven.cc/full/ox/wallhaven-ox5me5.jpg" alt="Imagen 2">
            <img src="https://w.wallhaven.cc/full/47/wallhaven-47mgo9.png" alt="Imagen 3">
        </div>
        <div class="carousel-indicators"></div>
    </div>

    <script>
        const images = document.querySelectorAll('.carousel img');
        const indicatorsContainer = document.querySelector('.carousel-indicators');
        const carouselInner = document.querySelector('.carousel-inner');

        let currentIndex = 0;
        let interval;

        function createIndicators() {
            images.forEach((_, index) => {
                const indicator = document.createElement('div');
                indicator.classList.add('indicator');
                if (index === 0) indicator.classList.add('active');
                indicator.addEventListener('click', () => goToSlide(index));
                indicatorsContainer.appendChild(indicator);
            });
        }

        function updateCarousel() {
            const offset = -currentIndex * 1000; // Desplaza el carrusel un 100% del ancho de la imagen por cada slide
            carouselInner.style.transform = `translateX(${offset}px)`;
            document.querySelectorAll('.indicator').forEach((indicator, i) => {
                indicator.classList.toggle('active', i === currentIndex);
            });
        }

        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
            resetInterval();
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % images.length;
            updateCarousel();
        }

        function startAutoSlide() {
            interval = setInterval(nextSlide, 5000);
        }

        function resetInterval() {
            clearInterval(interval);
            startAutoSlide();
        }

        window.addEventListener('load', () => {
            createIndicators();  // Crear los indicadores después de que las imágenes se hayan cargado
            startAutoSlide();
        });
    </script>

</body>
</html>
