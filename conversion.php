<?php

function validerFormulaire($donnees) {
    $erreurs = array();

    $date = isset($donnees['date']) ? $donnees['date'] : '';
    $nom = isset($donnees['nom']) ? $donnees['nom'] : '';
    $age = isset($donnees['age']) ? $donnees['age'] : '';
    $email = isset($donnees['email']) ? $donnees['email'] : '';
    $telephone = isset($donnees['telephone']) ? $donnees['telephone'] : '';

    if (empty($date)) {
        $erreurs[] = "La date est obligatoire.";
    }

    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    if (empty($age)) {
        $erreurs[] = "L'âge est obligatoire.";
    } elseif (!ctype_digit($age) || $age <= 0) {
        $erreurs[] = "L'âge doit être un nombre entier positif.";
    }

    if (empty($email)) {
        $erreurs[] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email n'est pas valide.";
    }

    if (empty($telephone)) {
        $erreurs[] = "Le téléphone est obligatoire.";
    } elseif (!preg_match("/^[0-9]{10}$/", $telephone)) {
        $erreurs[] = "Le téléphone doit contenir 10 chiffres.";
    }

    return $erreurs;
}

$donneesFormulaire = array(
    'date' => '2024-01-29',
    'nom' => 'John Doe',
    'age' => '30',
    'email' => 'john.doe@example.com',
    'telephone' => '1234567890'
);

$erreurs = validerFormulaire($donneesFormulaire);

if (empty($erreurs)) {
    echo "Les données du formulaire sont valides.";
} else {
    echo "Erreurs : " . implode(', ', $erreurs);
}

?>
