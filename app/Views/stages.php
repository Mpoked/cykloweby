<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Etapy závodu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4">Etapy závodu</h1>

    <?php if (!empty($stages)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
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
                <tbody>
                    <?php foreach ($stages as $stage): ?>
                        <tr>
                            <td><?= esc($stage['number']) ?></td>
                            <td><?= date('d. m. Y', strtotime($stage['date'])) ?></td>
                            <td><?= esc($stage['departure']) ?></td>
                            <td><?= esc($stage['arrival']) ?></td>
                            <td><?= esc($stage['distance']) ?> km</td>
                            <td><?= esc($stage['parcour_type']) ?></td>
                            <td><?= esc($stage['vertical_meters']) ?> m</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Pro tento závod zatím nejsou dostupné žádné etapy.</div>
    <?php endif; ?>
</div>

</body>
</html>