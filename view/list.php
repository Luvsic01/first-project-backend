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
                    <a class="btn-floating btn-large waves-effect waves-light red" href="student.php?id=<?= $student['stu_id'] ; ?>"><i class="material-icons">search</i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
