<main class="container">
    <?php if (!empty($search)) : ?>
        <h2><?= $countResulatSearch ?> résultat(s) pour le mot "<?= $search ?>"</h2>
    <?php elseif(!empty($session)) : ?>
        <h2><?= $countNbStudentSession ?> étudiant(s) dans la session <?= $session ?></h2>
    <?php else: ?>
        <h2>Toutes les étudiants</h2>
    <?php endif; ?>
    <table class="striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date de naissance</th>
            <th>Ville</th>
            <th>Détails</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arrayResultStudent as $student) : ?>
            <tr>
                <td><?= $student['stu_id'] ; ?></td>
                <td><?= $student['stu_lastname'] ; ?></td>
                <td><?= $student['stu_firstname'] ; ?></td>
                <td><?= $student['stu_email'] ; ?></td>
                <td><?= $student['stu_birthdate'] ; ?></td>
                <td><?= $student['cit_name'] ; ?></td>
                <td><a class="btn-floating btn-large waves-effect waves-light teal" href="student.php?id=<?= $student['stu_id'] ; ?>"><i class="material-icons">search</i></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination si ce n'est pas une recherche -->
    <?php if (empty($search) && empty($session)) : ?>
        <div class="row center-align">
            <ul class="pagination">
                <?php if ($page == 1) : ?>
                    <li class="disabled"><a href=""><i class="material-icons">first_page</i></a></li>
                    <li class="disabled"><a href=""><i class="material-icons">chevron_left</i></a></li>
                <?php else: ?>
                    <li><a href="list.php?page=1"><i class="material-icons">first_page</i></a></li>
                    <li><a href="list.php?page=<?= $page-1 ?>"><i class="material-icons">chevron_left</i></a></li>
                <?php endif; ?>

                <?php if( $page > 5 ) : ?>
                    <li>...</li>
                <?php endif; ?>

                <?php for ($i = $page-4; $i <= $page+4; $i++) : ?>
                    <?php if ($page == $i) : ?>
                        <li class="active"><a href="list.php?page=<?= $page ?>"><?= $page ?></a></li>
                    <?php elseif ($i > 0 && $i <= $numberPage) : ?>
                            <li class="waves-effect"><a href="list.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif;  ?>
                <?php endfor; ?>

                <?php if( $page < $numberPage - 4 ) : ?>
                    <li>...</li>
                <?php endif; ?>

                <?php if ($page == $numberPage) : ?>
                    <li class="disabled"><a href=""><i class="material-icons">chevron_right</i></a></li>
                    <li class="disabled"><a href=""><i class="material-icons">last_page</i></a></li>
                <?php else: ?>
                    <li><a href="list.php?page=<?= $page+1 ?>"><i class="material-icons">chevron_right</i></a></li>
                    <li><a href="list.php?page=<?= $numberPage ?>"><i class="material-icons">last_page</i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
</main>
