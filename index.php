<?php
require_once('./libs/Validator.php');
require_once('./models/Model.php');
require_once('./templates/header.php');


if (isset($_GET['id'])) {
        $db = new Model();
        $form = $db->show($_GET['id']);
        $hobby = explode(',', $form[0]->hobby);
    }
    ?>

            <form id="infoForm" method="post" action="index.php" class="pt-5">
                <div class="form-group">
                    <label for="name">Név: </label>
                    <input type="hidden" name="id" id="id" value="<?= isset($form[0]->id) ? $form[0]->id : '' ?>"/>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Az ön neve"
                           value="<?= isset($form[0]->name) ? $form[0]->name : ''?>"/>
                </div>
                <div class="form-group">
                    <label for="email">Email cím:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email cím"
                           value="<?= isset($form[0]->email) ? $form[0]->email : ''?>"/>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Telefonszám:</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="pl.: 06702855484"
                           value="<?= isset($form[0]->phonenumber) ? $form[0]->phonenumber : ''?>" />
                    <small id="phoneNumberHelp" class="form-text text-muted">Kérem csak számjegyeket adjon meg. </small>
                </div>
                <div class="form-group">
                    <label for="birthDate">Születési dátum:</label>
                    <input type="date" class="form-control" id="birthDate" name="birthDate" placeholder="pl.: 1985. 05. 11."
                           value="<?= isset($form[0]->birthdate) ? $form[0]->birthdate : ''?>" />
                </div>
                <label>Rendelkezik jogosítvánnyal?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="licence"
                           value="igen" <?= (isset($form[0]) && $form[0]->licence == 1) ? "checked" : "" ?>/>
                    <label class="form-check-label" for="exampleRadios1">
                        igen
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="licence"
                           value="nem" <?= (isset($form[0]) && $form[0]->licence == 0) ? "checked" : "" ?>/>
                    <label class="form-check-label" for="exampleRadios2">
                        nem
                    </label>
                </div>
                <div class="form-group">
                    <label>Kedvenc hobbijai:</label>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input hobby" name="hobby[]"
                               value="kerékpározás" <?= (isset($hobby) && in_array("kerékpározás", $hobby)) ? "checked" : "" ?> />
                        <label class="form-check-label" for="kerékpározás">kerékpározás</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input hobby" name="hobby[]"
                               value="túrázás" <?= (isset($hobby) && in_array("túrázás", $hobby)) ? "checked" : "" ?> />
                        <label class="form-check-label" for="túrázás">túrázás</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input hobby" name="hobby[]"
                               value="hegymászás" <?= (isset($hobby) && in_array("hegymászás", $hobby)) ? "checked" : "" ?> />
                        <label class="form-check-label" for="hegymászás">hegymászás</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input hobby" name="hobby[]"
                               value="programozás" <?= (isset($hobby) && in_array("programozás", $hobby)) ? "checked" : "" ?> />
                        <label class="form-check-label" for="programozás">programozás</label>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input hobby" name="hobby[]"
                               value="egyéb" <?= (isset($hobby) && in_array("egyéb", $hobby)) ? "checked" : "" ?> />
                        <label class="form-check-label" for="egyéb">egyéb</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">mentés</button>
            </form>

            <div class="table-responseive">
                <table class="table table-striped table-bordered table-sm mt-5 text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Név</th>
                        <th>Email</th>
                        <th>Telefonszám</th>
                        <th>Születési dátum</th>
                        <th>Jogosítvány</th>
                        <th>Hobby</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="results">

                    </tbody>
                </table>
            </div>

<?php require_once('./templates/footer.php'); ?>
