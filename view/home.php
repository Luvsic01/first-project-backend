<main class="container">
<h1>Liste des Formations</h1>
    <?php foreach ($arrayFormation as $formation=>$arraySession) : ?>
        <h3><?= $formation ?></h3>
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
                    <td><a class="btn-floating btn-large waves-effect waves-light teal" href="list.php?session=<?= $session['ses_id'] ; ?>"><i class="material-icons">search</i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</main>
