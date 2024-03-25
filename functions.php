<?php

// Fichier utilisé pour regrouper les fonctions utiles

function checkExists ($field, $param, $pdo) {
    $sql = "SELECT * FROM users WHERE $field = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$param]);

    if ($stmt->rowCount() > 0) {
        return true; 
    } else {
        return false;
    }
}