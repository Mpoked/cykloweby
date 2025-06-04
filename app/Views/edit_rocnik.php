<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Upravit ročník závodu</h3>
                </div>
                
                <div class="card-body">
                    <form action="<?= base_url('zavod/uprav_rocnik/' . $rocnik->id) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_zavodu" value="<?= $rocnik->id_race ?>">

                        <div class="mb-3">
                            <label for="nazev" class="form-label">Název ročníku</label>
                            <input type="text" class="form-control" id="nazev" name="real_name" 
                                   value="<?= old('real_name', $rocnik->real_name) ?>" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rok" class="form-label">Ročník</label>
                                    <input type="number" class="form-control" id="rok" name="year" 
                                           value="<?= old('year', $rocnik->year) ?>" min="1900" max="2100" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="zeme" class="form-label">Země</label>
                                    <input type="text" class="form-control" id="zeme" name="country" 
                                           value="<?= old('country', $rocnik->country) ?>" maxlength="2" required>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="zacatek" class="form-label">Datum začátku</label>
                                    <input type="date" class="form-control" id="zacatek" name="start_date" 
                                           value="<?= old('start_date', $rocnik->start_date) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="konec" class="form-label">Datum konce</label>
                                    <input type="date" class="form-control" id="konec" name="end_date" 
                                           value="<?= old('end_date', $rocnik->end_date) ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
    <label for="kategorie" class="form-label">Kategorie</label>
    <select class="form-select" id="kategorie" name="uci_tour" required>
        <option value="">-- Vyberte kategorii --</option>
        <?php foreach ($kategorie as $kat): ?>
            <option value="<?= $kat['id'] ?>" 
                <?= old('uci_tour', $rocnik->uci_tour) == $kat['id'] ? 'selected' : '' ?>>
                <?= esc($kat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo závodu</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept=".jpg, .png, .jpeg">
                            <div class="form-text">Max. velikost 2MB (JPG, PNG)</div>
                            <?php if($rocnik->logo): ?>
                                <div class="mt-2">
                                    <img src="<?= base_url('obrazky/logo/' . $rocnik->logo) ?>" alt="Aktuální logo" width="100">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="smazat_logo" name="smazat_logo">
                                        <label class="form-check-label" for="smazat_logo">
                                            Smazat současné logo
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('zavod/info/' . $rocnik->id_race) ?>" class="btn btn-secondary me-md-2">Zpět</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Uložit změny
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>