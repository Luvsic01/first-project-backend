<main class="container">
    <div class="row">
        <h4>Ajouter par lots</h4>
        <form class="col s12" method="post" action="" enctype="multipart/form-data">
            <?= $infoForm ?>
            <div class="file-field input-field">
                <!-- fichier -->
                <div class='file-field input-field col s6'>
                    <div class="btn">
                        <span>Fichier</span>
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                        <input type="file" name="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="file">
                    </div>
                </div>
                <!-- Select city -->
                <div class="input-field col s4">
                    <select name="sesId" id="sesId">
                        <option value="" disabled selected>N° de session</option>
                        <?php foreach ($arraySession as $key=>$value) : ?>
                                <option value="<?= $key ?>"><?= $value[0] ?> - <?= $value[1] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="sesId">N° de session</label>
                </div>
                <!--button submit -->
                <div class=" col s2" style="padding-top: 15px;">
                    <button class="btn waves-effect waves-light" type="submit">Envoyer
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
        <h4>Export de la Base de donnée</h4>
        <form class="col s12" method="post" action="" enctype="multipart/form-data">
            <div class="file-field input-field">
                <div class='col s10'><p>Exporter la BDD étudiante :</p></div>
                <input type="hidden" name="export" value="1" />
                <!--button submit -->
                <div class=" col s2" style="padding-top: 15px;">
                    <button class="btn waves-effect waves-light" type="submit">Export
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

