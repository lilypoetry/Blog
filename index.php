<?php

    // Connexion à la BDD
    require_once 'connexion.php';

    // Chargement des dépendances Composer
    require_once 'vendor/autoload.php';

    // Passe la requête SQL
    $query = $db->query('SELECT posts.id, posts.title, posts.content, posts.cover, posts.created_at, posts.category_id, categories.name AS category FROM posts INNER JOIN categories ON categories.id = posts.category_id ORDER BY posts.created_at DESC');

    // Recupère tous les résultats et je les stock dans la variables "$articles"
    $articles = $query->fetchAll();

    // dump($articles);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Philosophy.</title>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="js/carousel.js" defer></script>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <!-- Placer sa feuille de style CSS en dernière position -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header class="bg-dark py-4">
            <div class="container">

                <!-- Ligne -->
                <div class="row">
                    <!-- Titre du site -->
                    <div class="col-6 col-lg-12 text-start text-lg-center">
                        <a href="#" title="Philo..." class="text-white text-decoration-none h1 logo">
                            Philosophy.
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
                            <ul class="d-flex align-items-center justify-content-center gap-5 py-3">
                                <li><a href="index.php" title="Home" class="text-secondary text-decoration-none">Home</a></li>
                                <li><a href="categories.php" title="Categories" class="text-secondary text-decoration-none">Categories</a></li>
                                <li><a href="#" title="Styles" class="text-secondary text-decoration-none">Styles</a></li>
                                <li><a href="#" title="About" class="text-secondary text-decoration-none">About</a></li>
                                <li><a href="#" title="Contact" class="text-secondary text-decoration-none">Contact</a></li>
                                <li><a href="login.php" title="Log in" class="text-secondary text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle text-white" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                </a></li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Carousel -->
                    <div class="col-12">
                        <div class="row d-flex align-items-center slider">
                            <!-- Flèche de gauche -->
                            <div class="col-lg-3 d-none d-lg-block text-end">                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left text-white" viewBox="0 0 16 16">
                                    <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                                </svg>
                            </div>

                            <!-- Image du carousel -->
                            <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                                <img src="images/slide/01.jpg" alt="Image du slide" class="w-100 rounded carousel-img">
                            </div>

                            <!-- Flèche de droite -->
                            <div class="col-lg-3 d-none d-lg-block text-start">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-right text-white" viewBox="0 0 16 16">
                                    <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                                </svg>                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="gradient"></div>

        <main class="py-5">
            <div class="container">
                <div class="row">

                <?php foreach($articles as $article): ?>
                    <!-- Colonne contenant un article -->
                    <div class="col-12 col-lg-6 pb-5">

                        <!-- L'article -->
                        <article>
                            <?php
                                // Pour afficher l'article quand on click sur l'image, par un id 
                                // nom de la page suivi par "?id=<?php echo $article['id'];"
                            ?>
                            <a href="article.php?id=<?php echo $article['id']; ?>" title="<?php echo $article['title']; ?>" class="text-dark text-decoration-none">
                                <img src="images/upload/<?php echo $article['cover']; ?>" alt="<?php $article['title']; ?>" class="w-100 rounded">
                                <h1 class="pt-2"><?php echo $article['title']; ?></h1>
                            </a>
                            <p class="text-secondary">                                                                
                                <?php 
                                    $timestamp = strtotime($article['created_at']);
                                    echo date('F d, Y', $timestamp); 
                                ?>
                            </p>

                            <!-- Truncate (couper) le texte -->
                            <p class="py-2">
                                <?php echo mb_strimwidth($article['content'], 0, 200, '...'); ?>
                            </p>
                            <div class="d-flex align-items-center gap-2">
                                <a href="categories.php?category_id=<?php echo $article['category_id']; ?>" title="<?php echo $article['category_id']; ?>" class="badge rounded-pill bg-primary text-decoration-none">
                                    <?php echo $article['category']; ?>
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
 
                </div>
            </div>
        </main>

        <footer class="bg-dark py-4">
            <div class="container">
                <p class="m-0 text-white">&copy; Copyright Philosophy 2022</p>
            </div>
        </footer>
    </body>
</html>