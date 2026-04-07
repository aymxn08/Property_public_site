<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Harxa Properties' ?> | Premium Real Estate Portal</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- AOS.js CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1E3A8A;
            --accent-color: #F59E0B;
            --bg-color: #F8FAFC;
            --text-color: #1F2937;
            --text-light: #6B7280;
            --glass-bg: rgba(255, 255, 255, 0.8);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        /* sticky Header */
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 1rem 0;
            z-index: 1000;
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-color) !important;
            margin: 0 0.5rem;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Buttons */
        .btn-gradient {
            background: linear-gradient(135deg, var(--primary-color), #3B82F6);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 58, 138, 0.4);
            color: white;
        }

        .btn-outline-gold {
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-gold:hover {
            background: var(--accent-color);
            color: white;
        }

        /* Cards */
        .property-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .property-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 240px;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .property-card:hover .card-img-wrapper img {
            transform: scale(1.1);
        }

        .badge-price {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            z-index: 10;
        }

        /* Footer */
        footer {
            background: #0F172A;
            color: white;
            padding: 5rem 0 2rem;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: white;
        }

        .footer-link {
            color: #94A3B8;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            margin-bottom: 0.8rem;
        }

        .footer-link:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-city"></i>
                HARXA PROPERTIES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('projects/explore') ?>">Explore</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('projects') ?>">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('contact') ?>">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <a href="tel:+919876543210" class="text-decoration-none text-dark fw-bold">
                        <i class="fas fa-phone-alt text-primary"></i> +91 98765 43210
                    </a>
                    <a href="https://wa.me/919876543210" class="btn btn-gradient">
                        <i class="fab fa-whatsapp"></i> Chat
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        <div class="container text-center text-md-start">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="footer-logo">HARXA</div>
                    <p class="text-secondary">Find your dream home with Harxa Properties. We provide premium real estate solutions with verified listings and expert support.</p>
                    <div class="d-flex gap-3 mt-4 justify-content-center justify-content-md-start">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <h5 class="mb-4">Quick Links</h5>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Featured Projects</a>
                    <a href="#" class="footer-link">Latest Listings</a>
                    <a href="#" class="footer-link">Testimonials</a>
                </div>
                <div class="col-md-2">
                    <h5 class="mb-4">Services</h5>
                    <a href="#" class="footer-link">Residential</a>
                    <a href="#" class="footer-link">Commercial</a>
                    <a href="#" class="footer-link">Consultancy</a>
                    <a href="#" class="footer-link">Management</a>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-4">Contact Info</h5>
                    <p class="text-secondary"><i class="fas fa-map-marker-alt me-2"></i> 123 Real Estate St, Chennai, TN</p>
                    <p class="text-secondary"><i class="fas fa-envelope me-2"></i> info@harxaproperties.com</p>
                    <p class="text-secondary"><i class="fas fa-phone-alt me-2"></i> +91 98765 43210</p>
                </div>
            </div>
            <hr class="my-5 border-secondary">
            <div class="text-center text-secondary small">
                © <?= date('Y') ?> Harxa Properties. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <script>
        // Init AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar Scroll Effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });

        // Smooth Scrolling
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if( target.length ) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
