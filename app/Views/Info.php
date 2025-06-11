<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Ročníky závodu</h1>
    <a href="<?= base_url('zavod/pridej_rocnik/' . $id_zavodu) ?>" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Přidat ročník
    </a>
</div>

<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($zavody as $zavod): 
            $zacatek_zavodu = strtotime($zavod->start_date);
            $zacatek_zavodu = date("j.n.Y", $zacatek_zavodu);

            $konec_zavodu = strtotime($zavod->end_date);
            $konec_zavodu = date("j.n.Y", $konec_zavodu);
        ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($zavod->real_name) ?></h5>
                        <span class="fi fi-<?= esc(strtolower($zavod->country)) ?>"></span> <br>
                        <?php if($zavod->logo): ?>
                            <img src="<?= base_url("obrazky/logo/".$zavod->logo) ?>" alt="Logo závodu" width="90px" height="auto">
                        <?php endif; ?>
                        
                        <?php if($konec_zavodu == $zacatek_zavodu): ?>
                            <p class="card-text"><strong>Datum:</strong> <?= esc($zacatek_zavodu) ?></p>
                        <?php else: ?>
                            <p class="card-text"><strong>Začátek:</strong> <?= esc($zacatek_zavodu) ?></p>
                            <p class="card-text"><strong>Konec:</strong> <?= esc($konec_zavodu) ?></p>
                        <?php endif; ?>
                        
                        <p class="card-text"><strong>Ročník:</strong> <?= esc($zavod->year) ?></p>
                        <p class="card-text"><strong>Druh UCI:</strong> <?= esc($zavod->name ?? '-') ?></p>
                        <p class="card-text"><strong>Počet etap:</strong> <?= esc($zavod->pocet ?? '0') ?></p>
                        
                        <div class="d-flex gap-2">
                            <a href="<?= base_url("stages/".$zavod->id) ?>" class="btn btn-primary">Etapy</a>
                            <a href="<?= base_url("zavod/edit_rocnik/".$zavod->id) ?>" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Editovat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>