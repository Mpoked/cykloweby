<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class=" justify-content-between align-items-center mb-4">
    <h1>Ročníky závodu</h1>
    <a href="<?= base_url('zavod/pridej_rocnik/' . $id_zavodu) ?>" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Přidat ročník
    </a>



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
                        <span class="fi fi-<?= esc($zavod->country) ?> "></span> <br>
                        <img src="<?=base_url("obrazky/logo/". $zavod->logo)?>" alt="" width="90px" height="auto" srcset="">
                        <p class="card-text"><strong>Země:</strong> <?= esc($zavod->country ?? '-') ?></p>
                        <p class="card-text"><strong>Ročník:</strong> <?= esc($zavod->year ?? '-') ?></p>
                        <p class="card-text"><strong>Začátek:</strong> <?= esc($zacatek_zavodu ?? '-') ?></p>
                        <p class="card-text"><strong>Konec:</strong> <?= esc($konec_zavodu ?? '-') ?></p>
                        <p class="card-text"><strong>Druh UCI:</strong> <?= esc($zavod->name ?? '-') ?></p>
                        <p class="card-text"><strong>Počet etap:</strong> <?= esc($zavod->pocet ?? '-') ?></p>
                        <a href="<?= base_url("stages/".$zavod->id) ?>" class="btn btn-primary" target="">Etapy</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
</div>


<?= $this->endSection(); ?>

