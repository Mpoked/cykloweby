<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<h1 class="mb-4 text-center">Závody</h1>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($zavody as $zavod): 
            // Předpoklad, že start_date a end_date jsou ve formátu YYYY-MM-DD
            $zacatek_zavodu = strtotime($zavod->start_date ?? null);
            $zacatek_zavodu = $zacatek_zavodu ? date("j.n.Y", $zacatek_zavodu) : '-';

            $konec_zavodu = strtotime($zavod->end_date ?? null);
            $konec_zavodu = $konec_zavodu ? date("j.n.Y", $konec_zavodu) : '-';
            ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($zavod->race_name ?? '-') ?></h5>
                        <p class="card-text"><strong>Ročník:</strong> <?= esc($zavod->year ?? '-') ?></p>
                        <p class="card-text"><strong>Počet etap:</strong> <?= esc($zavod->stage_count ?? 0) ?></p>
                        <p class="card-text"><strong>Začátek:</strong> <?= esc($zacatek_zavodu) ?></p>
                        <p class="card-text"><strong>Konec:</strong> <?= esc($konec_zavodu) ?></p>
                        <a href="<?= base_url("stages/".$zavod->id) ?>" class="btn btn-primary">Etapy</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection(); ?>