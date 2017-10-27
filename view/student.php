<!--afficher les informations (id, nom, prénom, email, date de naissance, age, ville, sympathie, numéro et nom de session). Attention, l'affichage se fait dans la vue (view) et je ne veux pas de tableau (<table>)-->
<div class="container">
    <div class="row ">
        <div class="col s12 m6 ">
            <div class="card  teal lighten-2">
                <div class="card-content white-text">
                    <span class="card-title"><?= $resultStudent['stu_firstname'] ; ?> <?= $resultStudent['stu_lastname'] ; ?></span>
                    <ul>
                        <li>ID : <?= $resultStudent['stu_id'] ; ?></li>
                        <li>Prénom : <?= $resultStudent['stu_firstname'] ; ?></li>
                        <li>Nom : <?= $resultStudent['stu_lastname'] ; ?></li>
                        <li>Email : <?= $resultStudent['stu_email'] ; ?></li>
                        <li>Date de naissance : <?= $resultStudent['stu_birthdate'] ; ?></li>
                        <li>Age : <?= ageUser($resultStudent['stu_birthdate']) ; ?></li>
                        <li>Ville : <?= $resultStudent['cit_name'] ; ?></li>
                        <li>Sympathie : <?= $resultStudent['stu_friendliness'] ; ?></li>
                        <li>Nom session : <?= $resultStudent['tra_name'] ; ?></li>
                        <li>N° de session : <?= $resultStudent['ses_number'] ; ?></li>
                    </ul>
                </div>
                <div class="card-action">
                    <a href="#">This is a link</a>
                    <a href="#">This is a link</a>
                </div>
            </div>
        </div>
        <div class="col s12 m6 "><img class="responsive-img circle" src="http://gazettereview.com/wp-content/uploads/2016/03/facebook-avatar-700x441.jpg" alt=""></div>
    </div>
</div>