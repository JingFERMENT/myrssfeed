<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>My RSS Feed</title>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="p-5">
                <!-- INPUT Radio Nombre d’articles -->
                <div class="mb-5">
                    <p>Nombre d’articles affichés sur la page d’accueil et sur les pages complètes</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="6" name="numberItems" value="6" <?= (isset($numberItems) && $numberItems == 6) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="6">6</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="9" name="numberItems" value="9" <?= (isset($numberItems) && $numberItems == 9) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="9">9</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="12" name="numberItems" value="12" <?= (isset($numberItems) && $numberItems == 12) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="12">12</label>
                    </div>
                    <small class="form-text text-danger"><?= $error['numberItems'] ?? '' ?></small>
                </div>


                <!-- INPUT Checkbox Sujet -->
                <div class="mb-5">
                    <label class="mt-3">Selectionnez vos sujets : </label>
                    <?php
                    foreach (TOPICS as $value) {
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="selectedTopics[]" id="<?= $value ?>" value="<?= $value ?>" <?= (isset($selectedTopics) && in_array($value, $selectedTopics)) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="<?= $value ?>">
                                <?= $value ?>
                            </label>
                        </div>
                    <?php
                    }
                    ?>
                    <small class="form-text text-danger"><?= $error['selectedTopics'] ?? '' ?></small>
                </div>
                <!-- Bouton de validation -->
                <button type="submit" class="btn btn-primary mb-2">Je valide</button>
            </form>

                <p><?= $_COOKIE['numberItems'] ?? 'Aucun cookie'?></p>           
                <p><?= $_COOKIE['selectedTopics'] ?? 'Aucun cookie'?></p>

        </div>
    </div>
</body>

</html>