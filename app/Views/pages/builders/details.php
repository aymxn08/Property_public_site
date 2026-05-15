<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$logoUrl = !empty($company['logo']) ? 'http://localhost:8081/uploads/logos/' . $company['logo'] : '';
?>

<!-- Builder Hero -->
<section class="py-5 position-relative" style="background: linear-gradient(135deg, #0f172a, #1E3A8A); margin-top:-1px;">
    <div class="container py-4">
        <div class="row align-items-center g-4" data-aos="fade-up">
            <div class="col-auto">
                <?php if ($logoUrl): ?>
                    <img src="<?= $logoUrl ?>" alt="<?= esc($company['company_name']) ?>" style="width:100px;height:100px;object-fit:contain;background:white;border-radius:18px;padding:10px;border:2px solid rgba(255,255,255,0.15);">
                <?php else: ?>
                    <div style="width:100px;height:100px;background:linear-gradient(135deg,#3B82F6,#1E3A8A);border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;color:white;font-family:'Outfit',sans-serif;">
                        <?= strtoupper(substr($company['company_name'], 0, 2)) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col text-white">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2" style="font-size:13px;opacity:0.7;">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-white text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('builders') ?>" class="text-white text-decoration-none">Builders</a></li>
                        <li class="breadcrumb-item active text-white"><?= esc($company['company_name']) ?></li>
                    </ol>
                </nav>
                <h1 class="fw-bold mb-1"><?= esc($company['company_name']) ?></h1>
                <?php if (!empty($company['address'])): ?>
                    <p class="mb-2 opacity-75"><i class="fas fa-map-marker-alt me-1"></i><?= esc($company['address']) ?></p>
                <?php endif; ?>
                <p class="mb-3 opacity-75 small" style="max-width:600px;"><?= esc($company['about'] ?: 'A trusted real estate developer.') ?></p>
                <div class="d-flex gap-2 flex-wrap">
                    <?php if (!empty($company['contact_number'])): ?>
                        <a href="tel:<?= $company['contact_number'] ?>" class="btn btn-sm btn-light rounded-pill px-3"><i class="fas fa-phone-alt me-1 text-primary"></i><?= esc($company['contact_number']) ?></a>
                        <a href="https://wa.me/91<?= preg_replace('/\D/', '', $company['contact_number']) ?>" class="btn btn-sm btn-success rounded-pill px-3" target="_blank"><i class="fab fa-whatsapp me-1"></i>WhatsApp</a>
                    <?php endif; ?>
                    <?php if (!empty($company['email'])): ?>
                        <a href="mailto:<?= $company['email'] ?>" class="btn btn-sm btn-outline-light rounded-pill px-3"><i class="fas fa-envelope me-1"></i>Email</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div style="position:absolute;bottom:0;left:0;right:0;height:50px;background:var(--bg-color);clip-path:ellipse(55% 100% at 50% 100%);"></div>
</section>

<!-- Filters + Projects -->
<section class="py-5">
    <div class="container py-3">
        <!-- Filters -->
        <form method="get" action="" class="row g-3 align-items-end mb-5 p-4 bg-white rounded-4 shadow-sm border" data-aos="fade-up">
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Property Type</label>
                <select name="type" class="form-select rounded-pill px-3">
                    <option value="">All Types</option>
                    <?php foreach ($types as $t): ?>
                        <option value="<?= esc($t['type_name']) ?>" <?= $currentType == $t['type_name'] ? 'selected' : '' ?>><?= esc($t['type_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-uppercase text-muted">Min Price (₹)</label>
                <input type="number" name="min_price" class="form-control rounded-pill px-3" placeholder="e.g. 500000" value="<?= esc($minPrice) ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-uppercase text-muted">Max Price (₹)</label>
                <input type="number" name="max_price" class="form-control rounded-pill px-3" placeholder="e.g. 5000000" value="<?= esc($maxPrice) ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-uppercase text-muted">Sort By</label>
                <select name="sort" class="form-select rounded-pill px-3">
                    <option value="">Newest First</option>
                    <option value="price_low" <?= $currentSort == 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                    <option value="price_high" <?= $currentSort == 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                    <option value="popular" <?= $currentSort == 'popular' ? 'selected' : '' ?>>Most Popular</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-gradient rounded-pill flex-fill"><i class="fas fa-filter me-1"></i>Apply</button>
                <a href="<?= base_url('builders/' . $company['slug']) ?>" class="btn btn-outline-secondary rounded-pill px-3">Clear</a>
            </div>
        </form>

        <!-- Grid -->
        <?php if (empty($projects)): ?>
            <div class="text-center py-5" data-aos="fade-up">
                <i class="fas fa-home fa-4x text-muted opacity-25 d-block mb-4"></i>
                <h4 class="text-muted">No projects match your filters.</h4>
                <a href="<?= base_url('builders/' . $company['slug']) ?>" class="btn btn-outline-primary mt-3 rounded-pill">Reset Filters</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($projects as $i => $p): ?>
                    <?php
                        $thumb = !empty($p['thumb'])
                            ? base_url('uploads/projects/' . $p['thumb'])
                            : base_url('img/placeholder-property.jpg');
                        $priceStart = $p['price_start'] ?? 0;
                        $priceEnd   = $p['price_end'] ?? 0;
                    ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 80 ?>">
                        <div class="property-card h-100">
                            <a href="<?= base_url('project/' . $p['slug']) ?>" class="card-img-wrapper text-decoration-none">
                                <span class="badge-price">from ₹<?= $priceStart >= 100000 ? number_format($priceStart / 100000, 1) . ' L' : number_format($priceStart) ?></span>
                                <img src="<?= $thumb ?>" alt="<?= esc($p['project_name']) ?>">
                                <span class="position-absolute bottom-0 start-0 m-3 badge rounded-pill px-3" style="background:rgba(30,58,138,0.85);color:white;font-size:11px;"><?= esc($p['category']) ?></span>
                            </a>
                            <div class="p-4">
                                <h5 class="mb-1 fw-bold text-dark">
                                    <a href="<?= base_url('project/' . $p['slug']) ?>" class="text-decoration-none text-dark hover-primary"><?= esc($p['project_name']) ?></a>
                                </h5>
                                <p class="text-secondary small mb-3"><i class="fas fa-map-marker-alt me-1 text-primary"></i><?= esc($p['address']) ?></p>
                                <?php if ($priceEnd && $priceEnd != $priceStart): ?>
                                    <p class="small text-muted mb-3">₹<?= number_format($priceStart) ?> – ₹<?= number_format($priceEnd) ?></p>
                                <?php endif; ?>
                                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary fs-6">₹<?= $priceStart >= 100000 ? number_format($priceStart / 100000, 1) . ' L+' : number_format($priceStart) ?></span>
                                    <a href="<?= base_url('project/' . $p['slug']) ?>" class="btn btn-outline-gold btn-sm rounded-pill px-4">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
