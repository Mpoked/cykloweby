<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Přidat nový ročník závodu</h3>
                </div>
                
                <div class="card-body">
                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('zavod/pridej_rocnik') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_zavodu" value="<?= $id_zavodu ?>">

                        <div class="mb-3">
                            <label for="nazev" class="form-label">Název ročníku</label>
                            <input type="text" class="form-control" id="nazev" name="real_name" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rok" class="form-label">Ročník</label>
                                    <input type="number" class="form-control" id="rok" name="year" min="1900" max="2100" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="zeme" class="form-label">Země (CZ, FR...)</label>
                                    <input type="text" class="form-control text-uppercase" id="zeme" name="country" maxlength="2" required>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="zacatek" class="form-label">Datum začátku</label>
                                    <input type="date" class="form-control" id="zacatek" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="konec" class="form-label">Datum konce</label>
                                    <input type="date" class="form-control" id="konec" name="end_date" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kategorie" class="form-label">Kategorie</label>
                            <select class="form-select" id="kategorie" name="uci_tour" required>
                                <option value="">-- Vyberte kategorii --</option>
                                <?php foreach ($kategorie as $kat): ?>
                                    <option value="<?= $kat['id'] ?>"><?= esc($kat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo závodu</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            <div class="form-text">Max. velikost 2MB (JPG, PNG)</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('zavod/info/' . $id_zavodu) ?>" class="btn btn-secondary me-md-2">Zpět</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Přidat ročník
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>