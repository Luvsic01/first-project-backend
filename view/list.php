<main class="container">
    <!-- Affichage du titre en fonction du type de demande-->
    <?php if (!empty($search)) : ?>
        <h2><?= $countResulatSearch ?> résultat(s) pour le mot "<?= $search ?>"</h2>
    <?php elseif(!empty($session)) : ?>
        <h2><?= $countNbStudentSession ?> étudiant(s) dans la session <?= $session ?></h2>
    <?php else: ?>
        <h2>Touts les étudiants</h2>
    <?php endif; ?>
    <div class="row">
        <form method="get" action="" class="valign-wrapper">
            <div class="col s6"></div>
            <div class="col s2">
                <label>Résultats par page</label>
                <select name="nbPage" class="browser-default">
                    <option value="" disabled selected>--</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col s2">
                <label>Filtré par session</label>
                <select name="session" class="browser-default">
                    <option value="" disabled selected>--</option>
                    <?php foreach ($arraySession as $key=>$value) : ?>
                        <?php if ($sesId == $key) : ?>
                            <option value="<?= $key ?>" class="active selected" selected><?= $value[0] ?> - <?= $value[1] ?></option>
                        <?php else: ?>
                            <option value="<?= $key ?>"><?= $value[0] ?> - <?= $value[1] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col s2">
                <button class="btn waves-effect waves-light" type="submit" style="margin-top: 20px;">Filtrer
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
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
                <td>
                    <!-- button view student -->
                    <a class="btn-floating waves-effect waves-light green" href="student.php?id=<?= $student['stu_id'] ; ?>"><i class="material-icons">search</i></a>
                    <!-- button edit -->
                    <a class="btn-floating waves-effect waves-light blue" href="add.php?id=<?= $student['stu_id'] ; ?>"><i class="material-icons">mode_edit</i></a>
                    <!-- Modal Trigger delete -->
                    <a class="btn-floating waves-effect waves-light red modal-trigger" href="#modal<?= $student['stu_id'] ; ?>"><i class="material-icons">delete</i></a>
                    <!-- Modal Structure -->
                    <div id="modal<?= $student['stu_id'] ; ?>" class="modal">
                        <div class="modal-content">
                            <h4>Êtes-vous sûr de vouloir supprimer définitivement <?= $student['stu_lastname'] ; ?> <?= $student['stu_firstname'] ; ?>?</h4>
                            <p>Toute suppression est definitive.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Non</a>
                            <?php if (isset($pagination['page'])) : ?>
                                <a href="delete.php?id=<?= $student['stu_id'] ; ?>&page=<?= $pagination['page'] ?>" class="modal-action modal-close waves-effect waves-green btn-flat">Oui</a>
                            <?php else: ?>
                                <a href="delete.php?id=<?= $student['stu_id'] ; ?>" class="modal-action modal-close waves-effect waves-green btn-flat">Oui</a>
                            <?php endif; ?>
                        </div>
                    </div> <!-- Fin Modal-->
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination si ce n'est pas une recherche -->
    <?php if (empty($search) && empty($session)) : ?>
        <div class="row center-align">
            <ul class="pagination">
                <?php if ($pagination["page"] == 1) : ?>
                    <li class="disabled"><a href=""><i class="material-icons">first_page</i></a></li>
                    <li class="disabled"><a href=""><i class="material-icons">chevron_left</i></a></li>
                <?php else: ?>
                    <li><a href="list.php?page=1&nbPage=<?= $pagination["limit"] ?>"><i class="material-icons">first_page</i></a></li>
                    <li><a href="list.php?page=<?= $pagination["page"]-1 ?>&nbPage=<?= $pagination["limit"] ?>"><i class="material-icons">chevron_left</i></a></li>
                <?php endif; ?>

                <?php if( $pagination["page"] > 5 ) : ?>
                    <li>...</li>
                <?php endif; ?>

                <?php for ($i = $pagination["page"]-4; $i <= $pagination["page"]+4; $i++) : ?>
                    <?php if ($pagination["page"] == $i) : ?>
                        <li class="active"><a href="list.php?page=<?= $pagination["page"] ?>&nbPage=<?= $pagination["limit"] ?>"><?= $pagination["page"] ?></a></li>
                    <?php elseif ($i > 0 && $i <= $pagination["numberPage"]) : ?>
                        <li class="waves-effect"><a href="list.php?page=<?= $i ?>&nbPage=<?= $pagination["limit"] ?>"><?= $i ?></a></li>
                    <?php endif;  ?>
                <?php endfor; ?>

                <?php if( $pagination["page"] < $pagination["numberPage"] - 4 ) : ?>
                    <li>...</li>
                <?php endif; ?>

                <?php if ($pagination["page"] == $pagination["numberPage"]) : ?>
                    <li class="disabled"><a href=""><i class="material-icons">chevron_right</i></a></li>
                    <li class="disabled"><a href=""><i class="material-icons">last_page</i></a></li>
                <?php else: ?>
                    <li><a href="list.php?page=<?= $pagination["page"]+1 ?>&nbPage=<?= $pagination["limit"] ?>"><i class="material-icons">chevron_right</i></a></li>
                    <li><a href="list.php?page=<?= $pagination["numberPage"] ?>&nbPage=<?= $pagination["limit"] ?>"><i class="material-icons">last_page</i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
</main>