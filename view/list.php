<div class="container">
    <h2>Toutes les étudiants</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date de naissance</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arrayResultStudent as $student) : ?>
            <tr>
                <td>
                    <?= $student['stu_id'] ; ?>
                </td>
                <td>
                    <?= $student['stu_lastname'] ; ?>
                </td>
                <td>
                    <?= $student['stu_firstname'] ; ?>
                </td>
                <td>
                    <?= $student['stu_email'] ; ?>
                </td>
                <td>
                    <?= $student['stu_birthdate'] ; ?>
                </td>
                <td>
                    <a class="btn-floating btn-large waves-effect waves-light teal" href="student.php?id=<?= $student['stu_id'] ; ?>"><i class="material-icons">search</i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row center-align">
        <ul class="pagination">
            <?php if ($page == 1) : ?>
                <li class="disabled"><a href=""><i class="material-icons">chevron_left</i></a></li>
            <?php else: ?>
                <li><a href="list.php?page=<?= $page-1 ?>"><i class="material-icons">chevron_left</i></a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i<=$numberPage; $i++) : ?>
                <?php if ($page == $i) : ?>
                    <li class="active"><a href="list.php?page=<?= $page ?>"><?= $page ?></a></li>
                <?php else: ?>
                    <!--todo finir la paginagtion-->
                    <?php // if ($i > $page-5 || $i < $page+5) : ?>
                        <li class="waves-effect"><a href="list.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php // endif; ?>
                <?php endif;  ?>
            <?php endfor; ?>

            <?php if ($page == $numberPage) : ?>
                <li class="disabled"><a href=""><i class="material-icons">chevron_right</i></a></li>
            <?php else: ?>
                <li><a href="list.php?page=<?= $page+1 ?>"><i class="material-icons">chevron_right</i></a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
