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
        <select class="form-select" id="rok" name="year" required>
            <option value="" disabled selected>-- Vyberte ročník --</option>
            <?php 
            $currentYear = date('Y');
            $startYear = 1900;
            $endYear = $currentYear;
            
            for ($year = $endYear; $year >= $startYear; $year--) {
                echo "<option value=\"$year\">$year</option>";
            }
            ?>
        </select>
    </div>
</div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="zeme" class="form-label">Země</label>
                                    <select class="form-select" id="zeme" name="country" required>
                                        <option value="" disabled selected>-- Vyberte zemi --</option>
                                        <?php 
                                        // Get unique country codes from cyklo_race table
                                        $db = \Config\Database::connect();
                                        $countries = $db->table('cyklo_race')
                                                      ->select('country')
                                                      ->distinct()
                                                      ->where('country IS NOT NULL')
                                                      ->where("country != ''")
                                                      ->orderBy('country', 'ASC')
                                                      ->get()
                                                      ->getResultArray();
                                        
                                        // Simple country code to name mapping
                                        $countryNames = [
                                            'au' => 'Austrálie',
                                            'nz' => 'Nový Zéland',
                                            've' => 'Venezuela',
                                            // Add more mappings as needed
                                        ];
                                        
                                        foreach ($countries as $country): 
                                            $code = strtolower($country['country']);
                                            $name = $countryNames[$code] ?? strtoupper($code);
                                        ?>
                                            <option value="<?= strtoupper($code) ?>"><?= $name ?> (<?= strtoupper($code) ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
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
                                <option value="" disabled selected>-- Vyberte kategorii --</option>
                                <?php foreach ($kategorie as $kat): ?>
                                    <option value="<?= $kat['id'] ?>"><?= esc($kat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo závodu</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept=".jpg, .png, .jpeg">
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