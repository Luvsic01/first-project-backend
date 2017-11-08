<main class="container">
    <div class="row">
        <?php if (!empty($_POST)): ?>
            <div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'><?= $infoForm ?></div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col s12 l6 offset-l3 ">
            <div class="card white" style="padding: 10px;">
                <div class="card-content teal-text">
                    <span class="card-title">Mot de passe oublié</span>
                </div>
                <form method="post" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="emailRecovery" id="emailRecovery" type="email" class="validate">
                            <label class="teal-text" for="emailRecovery">Email</label>
                        </div>
                    </div>
                    <div class="row right-align">
                        <div class="card-action" style="border: none;">
                            <button class="btn waves-effect waves-light" type="submit" name="action" style="margin-top: 82px;">Réinitialiser mot de passe
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

