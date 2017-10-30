<main class="container">
    <?= $inform; ?>
    <div class="row">
        <?php if (!empty($id)) : ?>
            <h2>Modifier un étudiant</h2>
        <?php else : ?>
            <h2>Ajouter un étudiant</h2>
        <?php endif; ?>
        <form class="col s12" method="post" action="">
            <div class="row">
                <!-- nom -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="firstname" id="firstname" type="text" class="validate" value="<?php echo $firstname; ?>">
                    <label for="firstname">Prenom</label>
                </div>
                <!-- prenom -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="lastname" id="lastname" type="text" class="validate" value="<?php echo $lastname; ?>">
                    <label for="lastname">Nom</label>
                </div>
            </div>
            <div class="row">
                <!-- email -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">email</i>
                    <input name="email" id="email" type="email" class="validate" value="<?php echo $email; ?>">
                    <label for="email">EMAIL</label>
                </div>
                <!-- birthdate -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input name="birthDate" id="birthDate" type="text" class="datepicker" value="<?php echo $birthDate; ?>">
                    <label for="birthdate">Date de naissance</label>
                </div>
            </div>
            <div class="row">
                <!-- ville -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">location_city</i>
                    <select name="city" id="city">
                        <option value="">Ville</option>
                        <?php foreach ($arrayCity as $id=>$name) : ?>
                            <?php if ($cityId == $id) : ?>
                                <option value="<?= $id ?>" class="active selected" selected><?= $name ?></option>
                            <?php else: ?>
                                <option value="<?= $id ?>" ><?= $name ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <label for="city">Ville</label>
                </div>
                <!-- Sympathie -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">face</i>
                    <select name="friendliness" id="friendliness">
                        <option value="">Sympathie</option>
                        <?php for ($i=1; $i<=5; $i++) : ?>
                            <?php if ($friendliness == $i) : ?>
                                <option value="<?=$i?>" class="active selected" selected><?=$i?></option>
                            <?php else: ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </select>
                    <label for="friendliness">Sympathie</label>
                </div>
            </div>
            <div class="row">
                <!-- N° de session : -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">poll</i>
                    <select name="sesId" id="sesId">
                        <option value="" disabled selected>N° de session</option>
                        <?php foreach ($arraySession as $key=>$value) : ?>
                            <?php if ($sesId == $key) : ?>
                                <option value="<?= $key ?>" class="active selected" selected><?= $value[0] ?> - <?= $value[1] ?></option>
                            <?php else: ?>
                                <option value="<?= $key ?>"><?= $value[0] ?> - <?= $value[1] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <label for="sesId">N° de session</label>
                </div>
                <!--button submit -->
                <div class="right-align col s6" style="margin-top: 30px;">
                    <button class="btn waves-effect waves-light" type="submit">Envoyer
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

