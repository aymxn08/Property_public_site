<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1E3A8A 100%); margin-top:-1px;">
    <div class="container py-5">
        <div class="text-center" data-aos="fade-up">
            <span class="badge px-3 py-2 mb-3 fs-6 rounded-pill" style="background:rgba(245,158,11,0.2);color:#F59E0B;border:1px solid rgba(245,158,11,0.3);">
                <i class="fas fa-building me-2"></i>Trusted Developers
            </span>
            <h1 class="display-3 fw-bold mb-3">Top Property Builders</h1>
            <p class="lead opacity-75 mb-0">Browse verified developers and explore their exclusive project portfolios</p>
        </div>
    </div>
    <div style="position:absolute;bottom:0;left:0;right:0;height:60px;background:var(--bg-color);clip-path:ellipse(55% 100% at 50% 100%);"></div>
</section>

<!-- Builders Grid -->
<section class="py-5">
    <div class="container py-4">
        <?php if (empty($companies)): ?>
            <div class="text-center py-5">
                <i class="fas fa-building fa-4x text-muted opacity-25 mb-4 d-block"></i>
                <h4 class="text-muted">No builders registered yet.</h4>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($companies as $i => $c): ?>
                    <?php $logoUrl = !empty($c['logo']) ? 'http://localhost:8081/uploads/logos/' . $c['logo'] : ''; ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
                        <div class="builder-card h-100 d-flex flex-column">
                            <!-- Logo / Avatar -->
                            <a href="<?= base_url('builders/' . $c['slug']) ?>" class="builder-card-header text-decoration-none">
                                <?php if ($logoUrl): ?>
                                    <img src="<?= $logoUrl ?>" alt="<?= esc($c['company_name']) ?>" class="builder-logo">
                                <?php else: ?>
                                    <div class="builder-logo-placeholder">
                                        <span><?= strtoupper(substr($c['company_name'], 0, 2)) ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="builder-verified"><i class="fas fa-check-circle"></i> Verified</div>
                            </a>

                            <!-- Info -->
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h4 class="mb-1 fw-bold">
                                    <a href="<?= base_url('builders/' . $c['slug']) ?>" class="text-decoration-none text-dark hover-primary"><?= esc($c['company_name']) ?></a>
                                </h4>
                                <?php if (!empty($c['address'])): ?>
                                    <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt me-1 text-primary"></i><?= esc($c['address']) ?></p>
                                <?php endif; ?>
                                <p class="text-secondary small mb-3 lh-base flex-grow-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                    <?= esc($c['about'] ?: 'Premium real estate developer committed to quality and excellence.') ?>
                                </p>

                                <!-- Stats -->
                                <div class="d-flex gap-3 mb-3">
                                    <div class="stat-pill"><i class="fas fa-home me-1"></i><?= $c['project_count'] ?> Projects</div>
                                    <div class="stat-pill"><i class="fas fa-envelope me-1"></i><?= $c['enquiry_count'] ?> Enquiries</div>
                                </div>

                                <!-- Contact -->
                                <div class="d-flex gap-2 mt-3 border-top pt-3">
                                    <?php if (!empty($c['contact_number'])): ?>
                                        <a href="tel:<?= $c['contact_number'] ?>" class="btn btn-sm btn-outline-primary rounded-pill flex-fill">
                                            <i class="fas fa-phone-alt me-1"></i>Call
                                        </a>
                                        <a href="https://wa.me/91<?= preg_replace('/\D/', '', $c['contact_number']) ?>" class="btn btn-sm btn-success rounded-pill flex-fill" target="_blank">
                                            <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('builders/' . $c['slug']) ?>" class="btn btn-sm btn-gradient rounded-pill flex-fill text-white text-decoration-none text-center" style="line-height:24px;">View Projects <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.builder-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(0,0,0,0.05);
}
.builder-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(30,58,138,0.15);
}
.builder-card-header {
    background: linear-gradient(135deg, #f8fafc, #eff6ff);
    padding: 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e2e8f0;
}
.builder-logo {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 14px;
    background: white;
    padding: 8px;
    border: 1px solid #e2e8f0;
}
.builder-logo-placeholder {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1E3A8A, #3B82F6);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
    font-family: 'Outfit', sans-serif;
}
.builder-verified {
    font-size: 12px;
    color: #059669;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    padding: 4px 10px;
    border-radius: 50px;
    font-weight: 600;
}
.stat-pill {
    font-size: 12px;
    color: #64748b;
    background: #f1f5f9;
    padding: 4px 10px;
    border-radius: 50px;
    font-weight: 500;
}
</style>

<?= $this->endSection() ?>
