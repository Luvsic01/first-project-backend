<main class="container">
    <?= $inform; ?>
    <div class="row">
        <h2>Ajouter un Student</h2>
        <form class="col s12" method="post" action="">
            <div class="row">
                <!-- nom -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input required name="firstname" id="firstname" type="text" class="validate" value="<?php echo $firstname; ?>">
                    <label for="firstname">First Name</label>
                </div>
                <!-- prenom -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input required name="lastname" id="lastname" type="text" class="validate" value="<?php echo $lastname; ?>">
                    <label for="lastname">Last Name</label>
                </div>
            </div>
            <div class="row">
                <!-- email -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">email</i>
                    <input required name="email" id="email" type="email" class="validate">
                    <label for="email">EMAIL</label>
                </div>
                <!-- birthdate -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">perm_contact_calendar</i>
                    <input required name="birthDate" id="birthDate" type="text" class="datepicker" value="">
                    <label for="birthdate">Date de naissance</label>
                </div>
            </div>
            <div class="row">
                <!-- ville -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">location_city</i>
                    <select required name="city" id="city">
                        <option value="" disabled selected>Ville</option>
                        <?php foreach ($arrayCity as $id=>$name) : ?>
                        <option value="<?= $id ?>"><?= $name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="city">Ville</label>
                </div>
                <!-- Sympathie -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">face</i>
                    <select required name="friendliness" id="friendliness">
                        <option value="" disabled selected>Sympathie</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <label for="friendliness">Sympathie</label>
                </div>
            </div>
            <div class="row">
                <!-- N° de session : -->
                <div class="input-field col s6">
                    <i class="material-icons prefix">poll</i>
                    <select required name="sesId" id="sesId">
                        <option value="" disabled selected>N° de session</option>
                        <?php foreach ($arraySession as $sesId=>$value) : ?>
                        <option value="<?= $sesId ?>"><?= $value[0] ?> - <?= $value[1] ?></option>
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

