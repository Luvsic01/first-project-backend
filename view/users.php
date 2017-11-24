<main class="container">
    <div class="row">
        <table class="highlight col s12">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Date de création</th>
                <th>Dernière modification</th>
                <th>Rôle</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allUsers as $user) : ?>
                <tr>
                    <td><?= $user['usr_id'] ; ?> </td>
                    <td><?= $user['usr_email'] ; ?></td>
                    <td><?= $user['usr_date_creation'] ; ?></td>
                    <td><?= $user['usr_updated'] ; ?></td>
                    <td class="">
                        <form class="row" method="post" action="" >
                            <input type="hidden" name="id" value="<?= $user['usr_id'] ; ?>" />
                            <select class="col s6" name="role" id="role">
                                <?php if ($user['usr_role'] === "admin") : ?>
                                    <option value="admin" class="active selected" selected>Admin</option>
                                    <option value="user">User</option>
                                <?php else: ?>
                                    <option value="user" class="active selected" selected>User</option>
                                    <option value="admin">Admin</option>
                                <?php endif; ?>
                            </select>
                            <button class="col btn waves-effect waves-light light-blue" type="submit" name="action" style="margin: 10px 15px;">Mettre à jour
                                <i class="material-icons left">update</i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>