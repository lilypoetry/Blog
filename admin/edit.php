<?php

// Connexion à la BDD
require_once '../connexion.php';

// Chargement des dépendances Composer
require_once '../vendor/autoload.php';

/**
 * Sélection de toutes les catégories en BDD
 */
$query = $db->query('SELECT * FROM categories ORDER BY name');
$categories = $query->fetchAll();
// dump($categories);

/**
 * Seléctionner l'article en BDD selon l'ID reçue par l'URL
 */
$id = htmlspecialchars(strip_tags($_GET['id']));

$query = $db->prepare('SELECT id, title, content, cover, category_id FROM posts WHERE id = :id;');
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

$article = $query->fetch();
// dump($article);

$title = $article['title'];
$content = $article['content'];
$category = $article['category_id'];
$cover = $article['cover'];
$error = null;

// Code pour fonctionner le button "Enregistrer" la modification
/**
 * Si la superglobale $_POST n'est pas vide, alors j'effectue
 * les vérifications nécessaires et l'insertion en BDD
 */
if (!empty($_POST)) {
    // Nettoyage des données
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $content = htmlspecialchars(strip_tags($_POST['content']));
    $category = htmlspecialchars(strip_tags($_POST['category']));

        // Vérifie que mes champs soient bien remplis
        if (
            !empty($title)
            && !empty($content)
            && !empty($category)
        ) {

            // Est-ce que je reçois une image ?
            if (!empty($_FILES['cover']) && $_FILES['cover']['error'] === 0) 
            {
                // Supression de l'ancienne image et upload de la nouvelle image
                unlink("../images/upload/{$article['cover']}");

                    // Upload l'image sur le serveur
                    require_once 'inc/fonction.php';
                    $upload = uploadPicture($_FILES['cover'], '../images/upload', 1);
                    dump($upload); // pour verifier les erreurs
                    
                    // Si je reçois une ereur lors de l'upload, je retourne l'erreur
                    // à ma variable "$error" afin de l'afficher au dessus du formulaire
                    if (!empty($upload['error'])) {
                        $error = $upload['error'];                    
                    }
                    else {
                        $cover = $upload['filename'];
                    }
            }
            // Miss à jour en BD si la variable "error" est égale à NULL
            if ($error === null) {
                $query = $db->prepare('UPDATE posts SET title = :title, content = :content, cover = :cover, category_id = :category WHERE id = :id');
                $query->bindValue(':title', $title);
                $query->bindValue(':content', $content);
                $query->bindValue(':cover', $cover);
                $query->bindValue(':category', $category, PDO::PARAM_INT);
                $query->bindValue(':id', $id, PDO::PARAM_INT);
                $query->execute();
            }
            
        }
        else {            
            $error = 'Le titre, le contenu et la catégorie sont obligatoires';
        }
}

/**
 * Déclaration de variable à NULL.
 * Elles serviront à remplir le formulaire des données soumies
 * par l'utilisateur.
*/


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Placer sa feuille de style CSS en dernière position -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <header class="bg-dark py-4">
            <div class="container">

                <!-- Ligne -->
                <div class="row">
                    <!-- Titre du site -->
                    <div class="col-6 col-lg-12 text-start text-lg-center">
                        <a href="index.php" title="Philo..." class="text-white text-decoration-none h1 logo">
                            Philosophy. <span class="text-danger fs-4">Administration</span>
                        </a>
                    </div>

                    <!-- Menu burger -->
                    <div class="col-6 d-block d-lg-none text-end">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>

                    <!-- Navigation -->
                    <div class="col-12 d-none d-lg-block">
                        <nav>
                            <ul class="d-flex align-items-center justify-content-center gap-5 pt-3 m-0">
                                <li><a href="../index.php" title="Home" class="text-secondary text-decoration-none">Home</a></li>
                                <li><a href="listarticles.php" title="Home" class="text-secondary text-decoration-none">Articles</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="gradient"></div>

        <main class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col text-start">
                        <h3 class="py-3">Article à editer</h3>
                    </div>
                </div>                
                
                <!-- Affichage d'une erreur formulaire si nécessaire -->
                <?php if($error !== null): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div> 
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data" class="py-4 w-60 mx-auto">
                    <div class="row">
                        <div class="col">
                            <div class="form-group pt-3">
                                <label for="user_id" class="form-label">Identifiant</label>
                                <input type="text" name="user_id" class="form-control" id="user_id" placeholder="user_id">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group py-3">
                                <label for="category" class="form-label">Categories</label>
                                <select class="form-control" id="category" name="category">                       
                                    <option value="">Choisir une catégorie</option> 

                                        <!-- Liste des catégories -->
                                        <?php foreach($categories as $categorie): ?>                
                                            <option value="<?php echo $categorie['id']; ?>" <?php echo ($category !== null && $category == $categorie['id']) ? 'selected' : ''; ?>>
                                                <?php echo $categorie['name']; ?>
                                            </option> 
                                        <?php endforeach; ?>   
                                </select>
                            </div>
                        </div>
                       
                        <div class="col d-flex">
                            <div class="form-group pt-3">  
                                <label for="cover" class="form-label">Image du couverture</label>              
                                <input type="file" name="cover" class="form-control">
                                <p class="form-text">L'image ne doit pas dépasser 1Mo.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group pb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" id="title" placeholder="title">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group py-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="content" rows="10">
                                    <?php echo $content; ?>
                                </textarea>                
                            </div>
                        </div>
                        <div class="col-3 py-5">
                            <img src="../images/upload/<?php echo $cover; ?>" alt="<?php echo $cover; ?>" class="img-fluid rounded 50%">
                        </div>
                    </div>
                    <button class="btn btn-primary">Enregistrer</button>                    
                </form>        
            </div>
        </main>

        <footer class="bg-dark py-4">
                <div class="container">
                    <p class="m-0 text-white">&copy; Copyright Philosophy 2022</p>
                </div>
        </footer>
    </body>
</html>