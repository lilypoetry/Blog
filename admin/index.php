<?php

// Verifier si l'access Admin
require_once 'checkAdmin.php';

// Connexion à la BDD
require_once '../connexion.php';

// Chargement des dépendances Composer
require_once '../vendor/autoload.php';

$query = $db->query('SELECT posts.id, posts.title, categories.id AS category_id, categories.name, posts.created_at FROM posts INNER JOIN users ON users.id = user_id INNER JOIN categories ON categories.id = category_id ORDER BY created_at DESC;');

// Recupère tous les résultats et je les stocke dans la variable "$listeArticles"
$articles = $query->fetchAll();

// dump($articles);

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
        <script src="../js/delete.js" defer></script>

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
                        <a href="#" title="Philo..." class="text-white text-decoration-none h1 logo">
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
                                <li><a href="index.php" title="Categories" class="text-secondary text-decoration-none">Articles</a></li>                            
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="gradient"></div>

        <main>
            <div class="container">
                <div class="row pt-5 pb-3">
                    <div class="col">
                        <h3 class="">Gestion des articles</h3>
                    </div>
                    <div class="col text-end">
                        <p class="text-end ">
                            <a href="../admin/add.php" type="button" class="btn btn-outline-primary">
                                + article
                            </a>
                        </p>                
                    </div>
                </div>

                <?php if (isset($_GET['successAdd'])): ?>
                    <div class="alert alert-success mb-4">
                        L'article à bien été ajouté !
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['successDelete'])): ?>
                    <div class="alert alert-success mb-4">
                        L'article à bien été supprimé !
                    </div>
				<?php endif; ?>

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
                        <?php foreach($articles as $article): ?>
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
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>  
                </table>  

                <div class="form-inline text-end">
                    <form action="" method="post">
                        <table>
                            <th>
                                <label for="">Limit row :</label> 
                            </th> 
                            <th>
                                <input type="number" class="form-control" min="0" style="width:100px" required="required" name="limit"/>
                            </th>
                            <th>
                                <button class="btn btn-primary" name="change">>></button>
                            </th>
                        </table>
                    </form>
                </div>
                <?php include_once 'limit.php'; ?>

                <!-- Confirmation de suppression -->
                    
                <!-- Modal -->
                <div class="modal fade" id="confDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Êtes vous sûr de suprimer cette article ?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <a href="#" class="btn btn-danger btnDeleteModal">Oui</a>
                            </div>
                        </div>
                    </div>
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