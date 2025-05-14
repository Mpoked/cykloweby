<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<h1>cau</h1>

<div class="row mt-5">
    <?php
    foreach ($typkomponent as $row) {
        ?>
        <div class="card col-4 me-5 mb-3">
            <div class="card-body">
                <?php
                    echo "<h3>".anchor("komponent/".$row->url, $row->typKomponent)."</h3>";
               
                ?>
            </div>
        </div>
        <?php
    }
?>

<?= $this->endSection(); ?>

