<main class="container">
    <div class="row">
        <?php if (!empty($_POST)): ?>
            <div id="infoForm" class='container red lighten-2 white-text' style='margin-top: 15px;padding: 5px'><?= $infoForm ?></div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col s12 l6 offset-l3 ">
            <div class="card white" style="padding: 10px;">
                <div class="card-content light-blue-text">
                    <span class="card-title">Connection</span>
                </div>
                <form method="post" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="email" id="email" type="email" class="validate">
                            <label class="light-blue-text" for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" class="validate" data-delay="50">
                            <label class="light-blue-text" for="password">Password</label>
                        </div>
                    </div>
                    <div class="row right-align">
                        <a href="forgetpwd.php" style="color: cornflowerblue; text-align: right; height: 20px; font-size: 12px; font-style: italic; margin-right: 15px;">Mots de passe oublié</a>
                    </div>
                    <div class="row right-align">
                        <div class="card-action" style="border: none;">
                            <button class="btn waves-effect waves-light light-blue" type="submit" name="action" style="margin-top: 82px;">Connection
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

