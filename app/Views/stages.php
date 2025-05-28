<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container py-5">
    <h1 class="mb-4 text-center">Etapy závodu</h1>

    <?php if (!empty($stages)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Etapa</th>
                        <th>Datum</th>
                        <th>Start</th>
                        <th>Cíl</th>
                        <th>Délka</th>
                        <th>Typ etapy</th>
                        <th>Převýšení</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($stages as $stage): ?>
                        <tr>
                            <td><?= esc($stage['number']) ?></td>
                            <td><?= date('j. n. Y', strtotime($stage['date'])) ?></td>
                            <td><?= esc($stage['departure']) ?></td>
                            <td><?= esc($stage['arrival']) ?></td>
                            <td><?= number_format($stage['distance'], 1) ?> km</td>
                            <td>
                                <?= esc($stage['parcour_type_text'] ?? 'Neznámý') ?>
                                <?php if (!empty($stage['icon'])): ?>
                                    <i class="<?= esc($stage['icon']) ?>"></i>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($stage['vertical_meters']) ?> m</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Pro tento závod zatím nejsou dostupné žádné etapy.</div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>