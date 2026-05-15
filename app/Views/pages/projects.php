<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Hero -->
<section class="py-5 text-white position-relative" style="background: linear-gradient(135deg, #0f172a, #1E3A8A); margin-top:-1px;">
    <div class="container py-5 text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">Find Your Perfect Property</h1>
        <p class="lead opacity-75" data-aos="fade-up" data-aos-delay="100">Browse verified listings from top builders across India.</p>
    </div>
    <div style="position:absolute;bottom:0;left:0;right:0;height:55px;background:var(--bg-color);clip-path:ellipse(55% 100% at 50% 100%);"></div>
</section>

<section class="py-5">
    <div class="container py-4">

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
                <label class="form-label fw-bold small text-uppercase text-muted">Location</label>
                <input type="text" name="location" class="form-control rounded-pill px-3" placeholder="e.g. Chennai" value="<?= esc($currentLocation ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-uppercase text-muted">Min Price (₹)</label>
                <input type="number" name="min_price" class="form-control rounded-pill px-3" placeholder="500000" value="<?= esc($minPrice ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold small text-uppercase text-muted">Max Price (₹)</label>
                <input type="number" name="max_price" class="form-control rounded-pill px-3" placeholder="10000000" value="<?= esc($maxPrice ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Sort By</label>
                <div class="d-flex gap-2">
                    <select name="sort" class="form-select rounded-pill px-3">
                        <option value="">Newest First</option>
                        <option value="price_low"  <?= ($currentSort ?? '') == 'price_low'  ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="price_high" <?= ($currentSort ?? '') == 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                        <option value="popular"    <?= ($currentSort ?? '') == 'popular'    ? 'selected' : '' ?>>Most Popular</option>
                    </select>
                    <button type="submit" class="btn btn-gradient rounded-pill px-4"><i class="fas fa-filter"></i></button>
                </div>
            </div>
        </form>

        <!-- Results header -->
        <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
            <h5 class="mb-0 fw-bold"><?= count($projects) ?> Properties Found</h5>
            <a href="<?= base_url('projects') ?>" class="btn btn-sm btn-outline-secondary rounded-pill">Clear All</a>
        </div>

        <!-- Projects grid -->
        <div class="row g-4">
            <?php if (empty($projects)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-home fa-4x text-muted opacity-25 d-block mb-4"></i>
                    <h4 class="text-muted">No properties found matching your criteria.</h4>
                    <a href="<?= base_url('projects') ?>" class="btn btn-outline-primary mt-3 rounded-pill">Reset Filters</a>
                </div>
            <?php else: ?>
                <?php foreach ($projects as $i => $p): ?>
                    <?php
                        $thumb = !empty($p['thumb'])
                            ? base_url('uploads/projects/' . $p['thumb'])
                            : 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=80';
                        $priceStart = $p['price_start'] ?? 0;
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
                                <p class="text-secondary small mb-2"><i class="fas fa-map-marker-alt me-1 text-primary"></i><?= esc($p['address']) ?></p>
                                <!-- Builder badge -->
                                <?php if (!empty($p['company_name'])): ?>
                                    <p class="mb-3">
                                        <a href="<?= base_url('builders/' . $p['company_slug']) ?>" class="text-decoration-none small" style="color:#64748b;">
                                            <i class="fas fa-building me-1"></i><?= esc($p['company_name']) ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">₹<?= $priceStart >= 100000 ? number_format($priceStart / 100000, 1) . ' L+' : number_format($priceStart) ?></span>
                                    <a href="<?= base_url('project/' . $p['slug']) ?>" class="btn btn-outline-gold btn-sm rounded-pill px-4">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
