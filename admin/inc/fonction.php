<?php

 /**
 * Upload d'une image
 * 
 * @param array $picture contient la superglobale $_FILES
 * @param string $path contient le chemin où sera téléversé le fichier
 * @param $maxSize poids maximum autorisé du fichier
 * 
 * @return array
 */

function uploadPicture(array $picture, string $path, int $maxSize = 1): array {

    // Poids max. du fichier
    // 1Mo = 1048576 octets
    $maxSize *= 1048576;

    // Tableau de vérification des extension et types MIME
    $typeExt = [
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif'
    ];

    // Extention de l'éxtension du fichier
    $ext = strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION));
    
    // Vérification et upload
    if (array_key_exists($ext, $typeExt) && in_array($picture['type'], $typeExt)) {
        
        // Vérification du poids max. de l'image
        if ($picture['size'] <= $maxSize) {

            // Génère un nom unique pour l'image
            $newName = md5(time()). ".$ext";

            // Upload de l'image
            move_uploaded_file(
                $picture['tmp_name'],
                "$path/$newName"
            );

            // Retourne le nom de l'image
            return ['filename' => $newName];           

        }
        else {
            return ['error' =>'Le poids de l\'image dépasse les 1Mo'];            
        }
    }
    else {
        return ['error' =>'Ce fichier n\'est pas une image'];
    } 

}
