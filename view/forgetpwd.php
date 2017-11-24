<main class="container">
    <div class="row">
        <div id="infoForm" ></div>
    </div>
    <div class="row">
        <div class="col s12 l6 offset-l3 ">
            <div class="card white" style="padding: 10px;">

                <?php if ($resetValide === true): ?>
                <div class="card-content light-blue-text">
                    <span class="card-title">Réinitialiser votre mot de passe</span>
                </div>
                <form id="formResetPwd" method="post" action="" data-token='<?= $token ?>'>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" class="validate">
                            <label class="light-blue-text" for="password">Mot de passe</label>
                        </div>
                        <div class="input-field col s12">
                            <input name="passwordConfirm" id="passwordConfirm" type="password" class="validate">
                            <label class="light-blue-text" for="passwordConfirm">Confirmation Mot de passe</label>
                        </div>
                    </div>
                    <div class="row right-align">
                        <div class="card-action" style="border: none;">
                            <button class="btn waves-effect waves-light light-blue" type="submit" name="action" style="margin-top: 82px;">Réinitialiser mot de passe
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
                <?php else: ?>
                    <div class="card-content light-blue-text">
                        <span class="card-title">Mot de passe oublié</span>
                    </div>
                    <form id="formSendReset" method="post" action="">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="emailRecovery" id="emailRecovery" type="email" class="validate">
                                <label class="light-blue-text" for="emailRecovery">Email</label>
                            </div>
                        </div>
                        <div class="row right-align">
                            <div class="card-action" style="border: none;">
                                <button class="btn waves-effect waves-light light-blue" type="submit" name="action" style="margin-top: 82px;">Réinitialiser mot de passe
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

