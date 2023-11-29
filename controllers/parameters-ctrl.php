<?php
define('TOPICS', ['Europe', 'Ameriques', 'Afrique', 'Asie-Pacifique', 'Proche-Orient']);
define('ITEMS', ['6', '9', '12']);

if ($_COOKIE['numberItems'] == true) {
    $numberItems = $_COOKIE['numberItems'];
}

if ($_COOKIE['selectedTopics'] == true) {
    $selectedTopics = json_decode($_COOKIE['selectedTopics']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $error = [];

    // INPUT "Nombre d’articles affichés"
    $numberItems = intval(filter_input(INPUT_POST, 'numberItems', FILTER_SANITIZE_NUMBER_INT));
    if (empty($numberItems)) {
        $error['numberItems'] = "Merci de sélectionner le nombre d'actualités à afficher";
    } else {
        $isOk = filter_var($numberItems, FILTER_VALIDATE_INT, array("options" => array("min_range" => 6, "medium_range" => 9, "max_range" => 12)));
        if (!$isOk) {
            $error["numberItems"] = "La sélection n'est pas valide";
        } else {
            setcookie('numberItems', $numberItems, (time() + 365 * 24 * 3600), '/');
        }
    }


    // INPUT selectedTopics "Selectionnez vos sujets"
    $selectedTopics = filter_input(INPUT_POST, 'selectedTopics', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);

    if (empty($selectedTopics) || count($selectedTopics) !== 3) {
        $error['selectedTopics'] = "Merci de sélectionner 3 sujets.";
    } else {
        foreach ($selectedTopics as $value) {
            // Vérification si la valeur de mon tableau 'selectedTopics' est dans mon tableau 'TOPICS'
            if (!in_array($value, TOPICS)) {
                $error['selectedTopics'] = "La valeur sélectionnée n'est pas valide.";
            }
        }

        if (empty($error)) {
            // Stocker les sujets sélectionnés dans le cookie
            setcookie('selectedTopics', json_encode($selectedTopics), (time() + 365 * 24 * 3600), '/');
        }
    }

}
include __DIR__ . '/../views/parameters.php';
