<?php

// Connexion à la BDD


// Chargement des dépendances Composer

?>

<table class="table table-hover">
    <thead class="bg-dark text-white ">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Categorie</th>
            <th scope="col">Date</th> 
            <th colspan="2" class="text-center">Update</th>           
        </tr>
    </thead>                
    <tbody>
        <?php 
            require_once '../connexion.php';
            require_once '../vendor/autoload.php';
            $error = null;

            if(isset($_POST['change'])) 
            {
                $limit = $_POST['limit'];
                $query = $db->query('SELECT posts.id, posts.title, categories.id AS category_id, categories.name, posts.created_at FROM posts INNER JOIN users ON users.id = user_id INNER JOIN categories ON categories.id = category_id ORDER BY created_at DESC LIMIT ;');

                // Recupère tous les résultats et je les stocke dans la variable "$articles"
                $articles = $query->fetchAll();
                foreach ($articles as $article)
                {
                    <tr class="text-start">                    
                    <th scope="row"><?php echo $article['id']; ?></th>                    
                    <td><?php echo $article['title']; ?></td>
                    <td><?php echo $article['name']; ?></td>
                    <td><?php echo date('d-F-Y', strtotime($article['created_at'])); ?></td>
                    <td class="m-auto">
                        <a href="delete.php?id=<?php echo $article['id']; ?>" type="button" title="delete" class="btn btn-outline-danger btnDelete" data-bs-toggle="modal" data-bs-target="#confDelete">Supprimer</a>
                    </td>  
                    <td class="m-auto">
                        <a href="edit.php?id=<?php echo $article['id']; ?>" type="button" class="btn btn-outline-primary">Editer</a>
                    </td> 
                }                 
            }
                                                 
            </tr>
           
        ?> 
    </tbody>  
</table>                  