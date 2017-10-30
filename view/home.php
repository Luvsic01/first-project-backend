<main class="container">
<h2>Liste des Formations</h2>
    <?php foreach ($arrayFormation as $formation=>$arraySession) : ?>
        <h4><?= $formation ?></h4>
        <table>
            <thead>
            <tr>
                <th>Session n°</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Emplacement</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arraySession as $session) : ?>
                <tr>
                    <td>Session <?= $session['ses_number'] ?></td>
                    <td><?= $session['ses_start_date'] ?></td>
                    <td><?= $session['ses_end_date'] ?></td>
                    <td><?= $session['loc_name'] ?></td>
                    <td><a class="btn-floating waves-effect waves-light teal" href="list.php?session=<?= $session['ses_id'] ; ?>"><i class="material-icons">search</i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>

    <h2>Statistiques</h2>
    <h4>Etudiant par ville</h4>
    <table>
        <thead>
        <tr>
            <th>Ville</th>
            <th>Nombre d'étudiant</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arrayStatCity as $cityArray) : ?>
            <tr>
                <td><?= $cityArray['cit_name'] ?></td>
                <td><?= $cityArray['nbStudent'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
