<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<h1 class="mb-4 text-center">Závody</h1>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($races as $race): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($race->default_name) ?></h5>
                        <p class="card-text"><strong>Země:</strong> <?= esc($race->country ?? '-') ?></p>
                        <p class="card-text"><strong>Typ:</strong> <?= esc($race->type ?? '-') ?></p>
                        <a href="<?= base_url("Info/".$race->id) ?>" class="btn btn-primary" target="">Tož bližší info ne</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $pager->links() ?>

<?= $this->endSection(); ?>

