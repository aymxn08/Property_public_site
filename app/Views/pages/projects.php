<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="py-5 bg-primary text-white" style="margin-top: -1px;">
    <div class="container py-5 text-center">
        <h1 class="display-3 mb-3" data-aos="fade-up">Find Your Perfect Property</h1>
        <p class="lead opacity-75" data-aos="fade-up" data-aos-delay="100">Browse through our exclusive listings of plots, villas, and apartments.</p>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <!-- Filters -->
        <div class="row mb-5 g-3 align-items-end" data-aos="fade-up">
            <div class="col-md-3">
                <label class="form-label fw-bold">Property Type</label>
                <select class="form-select rounded-pill px-3 shadow-sm" id="filterType">
                    <option value="">All Types</option>
                    <?php foreach($types as $type): ?>
                        <option value="<?= $type['type_name'] ?>" <?= $currentType == $type['type_name'] ? 'selected' : '' ?>><?= $type['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Location</label>
                <input type="text" class="form-control rounded-pill px-3 shadow-sm" id="filterLocation" placeholder="e.g. Chennai" value="<?= $currentLocation ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Sort By</label>
                <select class="form-select rounded-pill px-3 shadow-sm" id="filterSort">
                    <option value="">Newest First</option>
                    <option value="price_low" <?= $currentSort == 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                    <option value="price_high" <?= $currentSort == 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-gradient w-100 rounded-pill py-2" onclick="applyFilters()">
                    <i class="fas fa-filter me-2"></i> Apply Filters
                </button>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="row g-4">
            <?php if(empty($projects)): ?>
                <div class="col-12 text-center py-5">
                    <img src="https://illustrations.popsy.co/blue/home-decoration.svg" alt="Empty" style="width: 300px;">
                    <h3 class="mt-4 text-secondary">No projects found matching your criteria.</h3>
                    <a href="<?= base_url('projects') ?>" class="btn btn-outline-primary mt-3">Reset Filters</a>
                </div>
            <?php else: ?>
                <?php foreach($projects as $i => $project): ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 100 ?>">
                        <div class="property-card">
                            <div class="card-img-wrapper">
                                <span class="badge-price">from ₹<?= number_format($project['starting_price'] / 100000, 1) ?> L</span>
                                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=80" alt="<?= $project['project_name'] ?>">
                            </div>
                            <div class="p-4">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 mb-2"><?= $project['category'] ?></span>
                                <h4 class="mb-2"><?= $project['project_name'] ?></h4>
                                <p class="text-secondary small mb-3"><i class="fas fa-map-marker-alt me-1"></i> <?= $project['address'] ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                                    <span class="fw-bold text-primary fs-5">₹<?= number_format($project['starting_price'] / 100000, 1) ?> L+</span>
                                    <a href="<?= base_url('project/'.$project['slug']) ?>" class="btn btn-outline-gold btn-sm rounded-pill px-4">Details</a>
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

<?= $this->section('scripts') ?>
<script>
    function applyFilters() {
        const type = $('#filterType').val();
        const location = $('#filterLocation').val();
        const sort = $('#filterSort').val();
        
        let url = '<?= base_url('projects') ?>?';
        if(type) url += 'type=' + encodeURIComponent(type) + '&';
        if(location) url += 'location=' + encodeURIComponent(location) + '&';
        if(sort) url += 'sort=' + encodeURIComponent(sort);
        
        window.location.href = url;
    }
</script>
<?= $this->endSection() ?>
