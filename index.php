<?php
// Connexion à la base de données
try { // Test les instructions dans ce bloc
$db = new PDO(
    'mysql:host=localhost;dbname=gaulois;charset=utf8',
    'root',
    ''
);
}
catch (Exception $e) { // retourne une exception dans $e si il y a une erreur
    die("Erreur: ' . " . $e->getMessage()); // Retourne uniquementle message d'erreur (ce qui n'affichera pas le mot de passe)
}

//Faire une requête SQL :
$personnagesStatement = $db->prepare("SELECT * FROM personnage"); // Contient un objet PDOStatement qui contiens la requête
$personnagesStatement->execute(); // Execute la requête

$personnages = $personnagesStatement->fetchAll(); // 'Cherche' les résulats de la requête et les stock dans $personnage

// Affiche le résultatde la requête

$result = "
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Image</th>
                <th>Lieu</th>
                <th>Spécialité</th>
            </tr>
        </thead>
        <tbody>";

foreach ($personnages as $personnage)
{
    $result .= "
    <tr>
        <td>" . $personnage["id_personnage"] . "</td>
        <td>" . $personnage["nom_personnage"] . "</td>
        <td>" . $personnage["adresse_personnage"] . "</td>
        <td>" . $personnage["image_personnage"] . "</td>
        <td>" . $personnage["id_lieu"] . "</td>
        <td>" . $personnage["id_specialite"] . "</td>
    </tr>";
}

$result .= "
        </thead>
    <table>";

echo $result;