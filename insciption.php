<?php

// Connexion à la BDD
require_once '../connexion.php';

// Chargement des dépendances Composer
require_once '../vendor/autoload.php';

// https://code.tutsplus.com/tutorials/create-a-php-login-form--cms-33261

$lastname = htmlspecialchars(strip_tags($_GET['lastname']));
$firstname = htmlspecialchars(strip_tags($_GET['firstname']));
$email = htmlspecialchars(strip_tags($_GET['email']));
$password = htmlspecialchars(strip_tags($_GET['password']));

$query = $db->prepare('INSERT INTO users (lastname, firstname, email, password, role, created_at) VALUES (:lastname, :firstname, :email, :password, :role, NOW())');

$query->bindValue(':lastname', $lastname);
$query->bindValue(':firstname', $firstname);
$query->bindValue(':email', $email, PDO::PARAM_STR);
$query->bindValue(':password', $password, , PDO::PARAM_STR);

$query->execute();

$user = $query->fetch();

dump($user);

if ($result) {
    echo '<p class="success">Your registration was successful!</p>';
} else {
    echo '<p class="error">Something went wrong!</p>';
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
        <script src="../js/delete.js" defer></script>
        <script src="JS/function.js"></script>
        <script src="JS/script.js" defer></script>
        <link rel="stylesheet" href="CSS/stlyle.css">
        <link rel="stylesheet" href="CSS/login.css">

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
                            Administration Philosophy. 
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
                                <li><a href="listarticles.php" title="Categories" class="text-secondary text-decoration-none">Articles</a></li>                            
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <div class="gradient"></div>

        <main>
            <div class="container w-50">
                <div class="row">
                    <div class="col">
                    <div class="col-12">
                <h1>Formulaire d'inscription</h1>                
                <p>Completez le formulaire ci-dessous :</p>
            </div>
            <div class="col-12 mb-3">
                <form>
                    <div class="mb-3">
                        <label for="lastName" class="form-label d-block">Nom</label>
                        <input type="text" lass="form-control" id="lastName" placeholder="Last Name">
                        <p class="erreur" id="lastNameError">Message d'erreur</p>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label d-block">Prénom</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First Name">
                        <p class="erreur" id="firstNameError">Message d'erreur</p>
                    </div>
                    <div class="mb-3">
                        <label for="nickName" class="form-label d-block">Pseudo (5 characters minimum)</label>
                        <input type="text" lass="form-control" id="nickName" placeholder="Nick Name">
                        <p class="erreur" id="nickNameError">Message d'erreur</p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label d-block email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="E-mail address">
                        <p class="erreur" id="emailError">Message d'erreur</p>
                    </div>

                    <!-- Mot de pass -->
                    <div class="mb-3">
                        <label for="password" class="form-label d-block">Mot de passe (8 characters minimum)</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Password">                            
                            <span class="input-group-text view-password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                  </svg>
                            </span>                            
                        </div>
                        <p class="erreur" id="passwordError">Message d'erreur</p>

                        <!-- Générer un mot de passe -->
                        <div is="generatePwd" class="d-flex align-items-center flex-row justify-centent">
                            <a href="#" id="generatePwd">Générer mot de passe</a>
                            <p id="resultPassword" class="pt-3 text-secondary"></p>
                        </div>
                    </div>

                    <!-- Verification password -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label d-block">Confirmer votre mot de pass</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmer mot de pass">
                            <span class="input-group-text view-password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                  </svg>
                            </span>                            
                        </div>
                        <p class="erreur" id="confirmPasswordError">Message d'erreur</p>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Valider</button>
                </form>
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