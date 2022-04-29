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
 * Déclaration de variable à NULL.
 * Elles serviront à remplir le formulaire des données soumies
 * par l'utilisateur.
 */
$title = null;
$content = null;
$category = null;
$error = null;

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
            && !empty($_FILES['cover'])
            && $_FILES['cover']['error'] === 0
        ) {

            // Upload l'image sur le serveur
            require_once 'inc/fonction.php';
            $upload = uploadPicture($_FILES['cover'], '../images/upload', 1);

            // Si la variable $upload ne contient pa "erreur", 
            // alors on peut effectuer l'insertion en BDD
            if (empty($upload['error'])) {
                $fileName = $upload['filename'];
                
                // Insertion en BDD
                // Temporarement on donne user_id = 1;
                $query = $db->prepare('INSERT INTO posts (user_id, category_id, title, content, cover, created_at) VALUES (1, :category_id, :title, :content, :cover, NOW())');

                $query->bindValue(':category_id', $idCategory, PDO::PARAM_INT);
                $query->bindValue(':title', $title);
                $query->bindValue(':content', $content);
                $query->bindValue(':cover', $fileName);
                $query->execute();

                // Redirection vers la page d'accueil de l'administration
                header('Location: admin.php?succesAdd=1');    
            }
            else {
                // Sinon, on transfère l'eereur à la variable "error" pour l'afficher
                // au dessus du formulaire
                $error = $upload['error'];
            }
        }
        else {            
            $error = 'Tous les champs sont obligatoires';
        }
}

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
                                <li><a href="index.php" title="Home" class="text-secondary text-decoration-none">Home</a></li>
                                <li><a href="categories.php" title="Categories" class="text-secondary text-decoration-none">Categories</a></li>
                                <li><a href="#" title="Styles" class="text-secondary text-decoration-none">Styles</a></li>
                                <li><a href="#" title="About" class="text-secondary text-decoration-none">About</a></li>
                                <li><a href="#" title="Contact" class="text-secondary text-decoration-none">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="gradient"></div>

        <main class="pt-5">

            <div class="container">                
                <h3 class="py-3">Formulaire creation d'article</h3>
                
                <!-- Affichage d'une erreur formulaire si nécessaire -->
                <?php if($error !== null): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data" class="py-4">
                    <div class="row">
                        <div class="col">
                            <div class="form-group pt-3">
                                <label for="user_id" class="form-label">Identifiant</label>
                                <input type="text" name="user_id" class="form-control" id="user_id" placeholder="user_id">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group pt-3">
                                <label for="category" class="form-label">Categories</label>
                                <select class="form-control" id="category" name="category">                       
                                    <option>Choisir une catégorie</option> 

                                    <!-- Liste des catégories -->
                                    <?php foreach($categories as $categorie): ?>                
                                        <option value="<?php echo $categorie['id']; ?>" <?php echo ($category !== null && $category == $categorie['id']) ? 'selected' : ''; ?>>
                                            <?php echo $categorie['name']; ?>
                                        </option> 
                                    <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>
                        <div class="col">
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
                        <div class="col">
                            <div class="form-group py-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="content" rows="10">
                                    <?php echo $content; ?>
                                </textarea>                
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
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