<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero Project Banner -->
<section class="project-hero py-5 position-relative text-white" style="background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1920&q=80') center/cover no-repeat;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('projects') ?>" class="text-white-50 text-decoration-none">Projects</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page"><?= $project['project_name'] ?></li>
                    </ol>
                </nav>
                <span class="badge bg-gold mb-3 px-3 py-2 fs-6" style="background: var(--accent-color)"><?= $project['category'] ?></span>
                <h1 class="display-3 fw-bold mb-3"><?= $project['project_name'] ?></h1>
                <p class="lead mb-4 fs-4"><i class="fas fa-map-marker-alt me-2 text-warning"></i> <?= $project['address'] ?></p>
                <div class="d-flex align-items-center gap-4 py-3 border-top border-white border-opacity-25">
                    <div>
                        <span class="small text-white-50 d-block">Starting Price</span>
                        <span class="fs-3 fw-bold">₹<?= number_format($project['starting_price'] / 100000, 1) ?> Lakhs</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end" data-aos="fade-left">
                <a href="#enquiryForm" class="btn btn-gradient btn-lg rounded-pill px-5 py-3 shadow-lg">Enquire Now</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-4">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Gallery -->
                <div class="gallery-section mb-5" data-aos="fade-up">
                    <h3 class="mb-4">Project Gallery</h3>
                    <div class="swiper projectGallerySwiper rounded-4 overflow-hidden mb-3">
                        <div class="swiper-wrapper">
                            <?php if(empty($images)): ?>
                                <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1200&q=80" class="w-100 rounded-4" alt="Default"></div>
                                <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1200&q=80" class="w-100 rounded-4" alt="Default"></div>
                                <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1582408921715-18e7806365c1?w=1200&q=80" class="w-100 rounded-4" alt="Default"></div>
                            <?php else: ?>
                                <?php foreach($images as $img): ?>
                                    <div class="swiper-slide">
                                        <img src="<?= base_url($img['image_path']) ?>" class="w-100 rounded-4" alt="Project Image">
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-button-next text-white"></div>
                        <div class="swiper-button-prev text-white"></div>
                    </div>
                    <div class="swiper thumbsSwiper">
                        <div class="swiper-wrapper">
                             <?php if(empty($images)): ?>
                                <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=400&q=80" class="rounded-3" alt="Thumb"></div>
                                <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=400&q=80" class="rounded-3" alt="Thumb"></div>
                                <div class="swiper-slide"><img src="https://images.unsplash.com/photo-1582408921715-18e7806365c1?w=400&q=80" class="rounded-3" alt="Thumb"></div>
                            <?php else: ?>
                                <?php foreach($images as $img): ?>
                                    <div class="swiper-slide"><img src="<?= base_url($img['image_path']) ?>" class="rounded-3" alt="Thumb"></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Overview -->
                <div class="overview mb-5" data-aos="fade-up">
                    <h3 class="mb-4">Project Overview</h3>
                    <div class="bg-white p-5 rounded-4 shadow-sm border">
                        <p class="text-secondary fs-5 lh-lg">
                            Welcome to <?= $project['project_name'] ?>, where luxury meets comfort. Located in the heart of <?= $project['address'] ?>, this project offers premium <?= strtolower($project['category']) ?> designed with modern aesthetics and top-notch quality. Whether you are looking for an investment or a place to call home, <?= $project['project_name'] ?> provides the perfect balance of serenity and urban convenience.
                        </p>
                        <div class="row g-4 mt-4">
                            <div class="col-md-4">
                                <div class="text-center p-3 rounded-4 bg-light">
                                    <i class="fas fa-home fa-2x text-primary mb-2"></i>
                                    <h6 class="mb-0">Total Units</h6>
                                    <p class="fw-bold mb-0 text-dark"><?= $project['number_of_units'] ?? 'N/A' ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 rounded-4 bg-light">
                                    <i class="fas fa-chart-area fa-2x text-primary mb-2"></i>
                                    <h6 class="mb-0">Status</h6>
                                    <p class="fw-bold mb-0 text-dark text-capitalize"><?= $project['status'] ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 rounded-4 bg-light">
                                    <i class="fas fa-map fa-2x text-primary mb-2"></i>
                                    <h6 class="mb-0">Location</h6>
                                    <p class="fw-bold mb-0 text-dark"><?= $project['address'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="location-map mb-5" data-aos="fade-up">
                    <h3 class="mb-4">Location on Google Maps</h3>
                    <div class="rounded-4 overflow-hidden shadow-sm" style="height: 400px; background: #eee;">
                        <?php if(!empty($project['latitude'])): ?>
                            <iframe 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY_HERE&q=<?= $project['latitude'] ?>,<?= $project['longitude'] ?>" allowfullscreen>
                            </iframe>
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light text-secondary">
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                                    <p>Map view available soon!</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="bg-white p-5 rounded-4 shadow-lg border-top border-5 border-primary" id="enquiryForm">
                        <h4 class="mb-4">Interested? Get in Touch</h4>
                        <form id="contactForm">
                            <?= csrf_field() ?>
                            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill px-3 py-2 bg-light border-0" placeholder="e.g. Rahul Sharma" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="tel" name="phone" class="form-control rounded-pill px-3 py-2 bg-light border-0" placeholder="e.g. +91 98765 43210" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill px-3 py-2 bg-light border-0" placeholder="e.g. rahul@example.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea name="message" class="form-control rounded-4 px-3 py-2 bg-light border-0" rows="4" placeholder="I'm interested in this project..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-gradient w-100 rounded-pill py-3">Submit Enquiry</button>
                        </form>
                        <div id="formStatus" class="mt-3 text-center small d-none"></div>
                    </div>

                    <div class="mt-4 bg-primary bg-opacity-10 p-4 rounded-4 text-center">
                        <p class="mb-2">Or contact us directly on WhatsApp</p>
                        <a href="https://wa.me/919876543210" class="text-success text-decoration-none fw-bold fs-5">
                            <i class="fab fa-whatsapp me-2"></i> +91 98765 43210
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .thumbsSwiper .swiper-slide {
        opacity: 0.4;
        cursor: pointer;
    }
    .thumbsSwiper .swiper-slide-thumb-active {
        opacity: 1;
        border: 2px solid var(--primary-color);
        padding: 2px;
    }
    .thumbsSwiper img {
        width: 100%;
        height: 80px;
        object-fit: cover;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var swiperThumbs = new Swiper(".thumbsSwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".projectGallerySwiper", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiperThumbs,
        },
    });

    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        const btn = $(this).find('button');
        const status = $('#formStatus');
        
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Submitting...');
        status.removeClass('d-none text-danger text-success').text('Processing...');

        $.ajax({
            url: '<?= base_url('projects/submitEnquiry') ?>',
            method: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                if(res.status === 'success') {
                    status.addClass('text-success').text(res.message);
                    $('#contactForm')[0].reset();
                } else {
                    status.addClass('text-danger').text(res.message);
                }
            },
            error: function() {
                status.addClass('text-danger').text('Something went wrong. Please try again.');
            },
            complete: function() {
                btn.prop('disabled', false).text('Submit Enquiry');
            }
        });
    });
</script>
<?= $this->endSection() ?>
