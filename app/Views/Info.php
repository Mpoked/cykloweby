<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<h1 class="mb-4 text-center">Závody</h1>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($zavody as $zavod): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($zavod->real_name) ?></h5>
                        <p class="card-text"><strong>Země:</strong> <?= esc($zavod->country ?? '-') ?></p>
                        <p class="card-text"><strong>Ročník:</strong> <?= esc($zavod->year ?? '-') ?></p>
                        <p class="card-text"><strong>Začátek:</strong> <?= esc($zavod->start_date ?? '-') ?></p>
                        <p class="card-text"><strong>Konec:</strong> <?= esc($zavod->end_date ?? '-') ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>

