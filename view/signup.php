<main class="container">
    <div class="row">
        <?php if ($formInscriptOk && !empty($_POST)) : ?>
            <div class='container green lighten-2 white-text' style='margin-top: 15px;padding: 5px'><?= $infoForm ?></div>
        <?php elseif (!empty($_POST)): ?>
            <div class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'><?= $infoForm ?></div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col s12 l6 offset-l3 ">
            <div class="card light-blue lighten-2" style="padding: 10px; height: 470px;">
                <div class="card-content white-text">
                    <span class="card-title">Inscription</span>
                </div>
                <form method="post" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="email" id="email" type="email" class="validate white-text" style="border-color: white;">
                            <label class="white-text" for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" class="validate white-text" data-delay="50" style="border-color: white; margin-bottom: 0;">
                            <label class="white-text" for="password">Password</label>
                        </div>
                        <p style="color: white; text-align: right; height: 20px; font-size: 10px; font-style: italic; margin-right: 15px;">8 caractères minimun, 1 Majuscule et 1 Minuscule</p>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="passwordConfimation" id="passwordConfimation" type="password" class="validate white-text" style="border-color: white;">
                            <label class="white-text" for="passwordConfimation">Confirmation Password</label>
                        </div>
                    </div>
                    <div class="row right-align">
                        <div class="card-action" style="border: none;">
                            <button class="btn waves-effect waves-light white light-blue-text" type="submit" name="action">Inscription
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

