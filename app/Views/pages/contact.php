<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="py-5 bg-primary text-white" style="margin-top: -1px;">
    <div class="container py-5 text-center">
        <h1 class="display-3 mb-3" data-aos="fade-up">Contact Us</h1>
        <p class="lead opacity-75" data-aos="fade-up" data-aos-delay="100">Have questions? We're here to help you find your dream property.</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <h2 class="mb-4">Get in Touch</h2>
                <p class="text-secondary mb-5">Fill out the form and our team will get back to you within 24 hours. We are committed to providing the best service for your real estate needs.</p>
                
                <div class="d-flex align-items-center mb-4 p-4 bg-white rounded-4 shadow-sm border-start border-5 border-primary">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-4">
                        <i class="fas fa-map-marker-alt text-primary fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Our Office</h5>
                        <p class="text-secondary mb-0">123 Real Estate St, OMR Road, Chennai, TN</p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 p-4 bg-white rounded-4 shadow-sm border-start border-5 border-success">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-4">
                        <i class="fab fa-whatsapp text-success fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">WhatsApp</h5>
                        <p class="text-secondary mb-0">+91 98765 43210</p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 p-4 bg-white rounded-4 shadow-sm border-start border-5 border-warning">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-4">
                        <i class="fas fa-envelope text-warning fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Email Us</h5>
                        <p class="text-secondary mb-0">info@harxaproperties.com</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="bg-white p-5 rounded-5 shadow-lg border">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-pill px-4 mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-pill px-4 mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('contact/submit') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Full Name</label>
                                <input type="text" name="name" class="form-control rounded-pill px-4 py-3 bg-light border-0" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Phone Number</label>
                                <input type="tel" name="phone" class="form-control rounded-pill px-4 py-3 bg-light border-0" placeholder="+91 98765 43210" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-pill px-4 py-3 bg-light border-0" placeholder="john@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Message</label>
                                <textarea name="message" class="form-control rounded-4 px-4 py-3 bg-light border-0" rows="5" placeholder="How can we help you?" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-gradient btn-lg w-100 rounded-pill py-3">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-5" data-aos="fade-up">Visit Our Office</h2>
        <div class="rounded-5 overflow-hidden shadow-lg border" style="height: 450px;" data-aos="fade-up">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15545.966440656096!2d80.2090113!3d13.067439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5267da34b1ed6b%3A0x6a053229b3c4293e!2sChennai%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1680000000000!5m2!1sen!2sin" 
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
