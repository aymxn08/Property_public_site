<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden" style="height: 100vh; min-height: 600px;">
    <!-- Parallax Background -->
    <div class="hero-bg position-absolute top-0 start-0 w-100 h-100" style="background: url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat; transform: scale(1.1); z-index: -1;"></div>
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to bottom, rgba(30, 58, 138, 0.7), rgba(15, 23, 42, 0.9)); z-index: -1;"></div>

    <div class="container h-100 d-flex align-items-center">
        <div class="row w-100">
            <div class="col-lg-8" data-aos="fade-up">
                <h1 class="display-2 text-white mb-4">Find Your <span style="color: var(--accent-color)">Dream</span> Property</h1>
                <p class="lead text-white-50 mb-5 fs-4">Experience premium living with Harxa Properties. Browse through our verified plots, villas, and apartments.</p>
                
                <div class="search-bar p-3 bg-white rounded-5 shadow-lg d-flex flex-column flex-md-row gap-3">
                    <div class="flex-grow-1 px-3 py-2 d-flex align-items-center border-end border-light">
                        <i class="fas fa-search text-secondary me-3"></i>
                        <input type="text" class="form-control border-0 shadow-none px-0" placeholder="Search by project name or location...">
                    </div>
                    <div class="flex-grow-1 px-3 py-2 d-flex align-items-center">
                        <i class="fas fa-map-marker-alt text-secondary me-3"></i>
                        <select class="form-select border-0 shadow-none px-0">
                            <option selected>All Locations</option>
                            <option>Chennai</option>
                            <option>Tambaram</option>
                            <option>Vandalur</option>
                            <option>OMR</option>
                        </select>
                    </div>
                    <button class="btn btn-gradient rounded-pill px-5 py-3">
                        Explore Projects
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property Types Section -->
<section class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase tracking-widest">Categories</span>
            <h2 class="display-4">Explore by Property Type</h2>
            <div class="mx-auto mt-3" style="width: 80px; height: 4px; background: var(--accent-color); border-radius: 2px;"></div>
        </div>

        <div class="row g-4">
            <?php 
            $types = [
                ['name' => 'Plots', 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=400&q=80', 'slug' => 'plots'],
                ['name' => 'Apartments', 'img' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&q=80', 'slug' => 'apartments'],
                ['name' => 'Villas', 'img' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=400&q=80', 'slug' => 'villas'],
                ['name' => 'Farmland', 'img' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=400&q=80', 'slug' => 'farmland']
            ];
            foreach($types as $i => $type): ?>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                    <a href="<?= base_url('projects/'.$type['slug']) ?>" class="text-decoration-none">
                        <div class="property-type-card position-relative overflow-hidden rounded-4 shadow-sm" style="height: 350px;">
                            <img src="<?= $type['img'] ?>" class="w-100 h-100 object-fit-cover transition-all" alt="<?= $type['name'] ?>">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);"></div>
                            <div class="content position-absolute bottom-0 start-0 p-4 w-100 text-white">
                                <h4 class="mb-0 fs-3 fw-bold"><?= $type['name'] ?></h4>
                                <span class="small opacity-75">View Projects <i class="fas fa-arrow-right ms-2 scale-hover"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <span class="text-primary fw-bold text-uppercase">Featured</span>
                <h2 class="display-4">Recent Projects</h2>
            </div>
            <a href="<?= base_url('projects') ?>" class="btn btn-outline-gold mb-2">View All Projects</a>
        </div>

        <div class="row">
            <?php if(empty($featuredProjects)): ?>
                <div class="col-12 text-center py-5">
                    <img src="https://illustrations.popsy.co/blue/home-decoration.svg" alt="Empty" style="width: 250px;">
                    <h3 class="mt-4 text-secondary">New projects coming soon!</h3>
                </div>
            <?php else: ?>
                <?php foreach($featuredProjects as $i => $project): ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                        <div class="property-card">
                            <div class="card-img-wrapper">
                                <span class="badge-price">from ₹<?= number_format($project['starting_price'] / 100000, 1) ?> L</span>
                                <img src="https://images.unsplash.com/photo-1582408921715-18e7806365c1?w=800&q=80" alt="<?= $project['project_name'] ?>">
                            </div>
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3"><?= $project['category'] ?></span>
                                    <span class="text-secondary small"><i class="fas fa-map-marker-alt me-1"></i> <?= $project['address'] ?></span>
                                </div>
                                <h4 class="mb-2"><?= $project['project_name'] ?></h4>
                                <p class="text-secondary small mb-4">Luxurious living with modern amenities and prime location in <?= $project['address'] ?>.</p>
                                <a href="<?= base_url('project/'.$project['slug']) ?>" class="btn btn-gradient w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 bg-white overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="text-primary fw-bold text-uppercase">Why Harxa?</span>
                <h2 class="display-4 mb-4">We help you find the best property.</h2>
                <div class="row g-4 mt-2">
                    <div class="col-sm-6">
                        <div class="p-4 rounded-4 bg-light h-100 transition-all hover-lift">
                            <i class="fas fa-shield-alt fa-2x text-primary mb-3"></i>
                            <h5>Trusted Developers</h5>
                            <p class="small text-secondary mb-0">We only list properties from verified and trusted developers.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 rounded-4 bg-light h-100 transition-all hover-lift">
                            <i class="fas fa-check-circle fa-2x text-warning mb-3"></i>
                            <h5>Verified Listings</h5>
                            <p class="small text-secondary mb-0">Every project goes through a rigorous quality check.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 rounded-4 bg-light h-100 transition-all hover-lift">
                            <i class="fas fa-tag fa-2x text-success mb-3"></i>
                            <h5>Best Pricing</h5>
                            <p class="small text-secondary mb-0">Get exclusive deals and the best market pricing through us.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-4 rounded-4 bg-light h-100 transition-all hover-lift">
                            <i class="fas fa-headset fa-2x text-danger mb-3"></i>
                            <h5>Expert Support</h5>
                            <p class="small text-secondary mb-0">Our consultants are available 24/7 to guide you.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-5 shadow-2xl" alt="Why Choose Us">
                    <div class="position-absolute bottom-0 start-0 bg-primary p-4 rounded-4 m-4 text-white shadow-lg d-none d-md-block" data-aos="zoom-in" data-aos-delay="400">
                        <h2 class="fw-bold mb-0">15+</h2>
                        <p class="mb-0">Years of Excellence</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background: #F1F5F9;">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase">Testimonials</span>
            <h2 class="display-4">What Our Clients Say</h2>
        </div>

        <div class="swiper testimonialSwiper pb-5" data-aos="fade-up">
            <div class="swiper-wrapper">
                <?php 
                $testimonials = [
                    ['name' => 'Rahul Sharma', 'text' => 'Harxa Properties helped me find the perfect plot for my dream home. The process was smooth and transparent.'],
                    ['name' => 'Priya Patel', 'text' => 'Exceptional service and support. They guided me through every step of the villa purchase. Highly recommended!'],
                    ['name' => 'Amit Kumar', 'text' => 'Looking for apartments was stressful until I found Harxa. Their verified listings gave me peace of mind.'],
                    ['name' => 'Sneha Reddy', 'text' => 'The team is professional and knowledgeable. They understood my requirements and showed me exactly what I wanted.']
                ];
                foreach($testimonials as $t): ?>
                <div class="swiper-slide">
                    <div class="bg-white p-5 rounded-4 shadow-sm text-center h-100">
                        <div class="mb-4">
                            <img src="https://i.pravatar.cc/150?u=<?= urlencode($t['name']) ?>" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: cover;" alt="<?= $t['name'] ?>">
                        </div>
                        <div class="mb-3 text-warning">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="fst-italic text-secondary mb-4">"<?= $t['text'] ?>"</p>
                        <h5 class="fw-bold mb-0"><?= $t['name'] ?></h5>
                        <small class="text-primary">Verified Client</small>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<style>
    .hero-section {
        background-attachment: fixed;
    }
    
    .property-type-card img {
        transition: transform 0.8s ease;
    }
    
    .property-type-card:hover img {
        transform: scale(1.15);
    }
    
    .hover-lift:hover {
        transform: translateY(-8px);
        background: white !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }
    
    .scale-hover {
        transition: transform 0.3s ease;
    }
    
    .property-type-card:hover .scale-hover {
        transform: translateX(5px);
    }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .swiper-pagination-bullet-active {
        background: var(--primary-color) !important;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Parallax effect on Hero
    gsap.to(".hero-bg", {
        scrollTrigger: {
            trigger: ".hero-section",
            start: "top top",
            end: "bottom top",
            scrub: true
        },
        y: 100
    });

    // Testimonial Slider
    new Swiper(".testimonialSwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
    });
</script>
<?= $this->endSection() ?>
