/**
 * La requête pour afficher l'article depuis BDD SQL 'blog'
 */
SELECT 
	posts.id, posts.title, posts.content, posts.cover, posts.created_at, 
    categories.name AS category
FROM posts
INNER JOIN categories ON categories.id = posts.category_id
ORDER BY posts.created_at DESC;


/* Pour afficher "l'article" sur la page article by ID */

SELECT 
    posts.id, posts.title, posts.content, posts.cover, posts.created_at, 
    categories.name AS category,
    users.firstname, users.lastname    
FROM posts 
INNER JOIN categories ON categories.id = posts.category_id 
INNER JOIN users ON users.id = posts.user_id
WHERE posts.id = ?
ORDER BY posts.created_at DESC;


/* requête pour page categories */
SELECT 
    posts.id, posts.title, posts.content, posts.cover, posts.created_at, posts.category_id,
    categories.name AS category 
FROM posts 
INNER JOIN categories ON categories.id = posts.category_id 
WHERE categories.id = posts.category_id
ORDER BY categories.name ASC;


/* requête pour la table admin */
SELECT 
	users.id, 
    posts.title,
    posts.created_at
FROM posts 
INNER JOIN users ON users.id = user_id 
ORDER BY posts.created_at ASC;


/* requête pour insertion de neauveau article far formulaire dans DBB SQL */
INSERT INTO posts (user_id, category_id, title, content, cover, created_at) 
VALUES (:user_id, :category_id, :title, :content, :cover, NOW()) ;


stok sementara

$idUser = htmlspecialchars(strip_tags($_POST['user_id']));
$cover = htmlspecialchars(strip_tags($_POST['cover']));


$query = $db->prepare('INSERT INTO posts (users.id, category_id, title, content, cover, created_at) VALUES (:users.id, :category_id, :title, :content, :cover, NOW())');

$query->bindValue(':users_id', $idUser, PDO::PARAM_INT);
$query->bindValue(':category_id', $idCategory, PDO::PARAM_INT);
$query->bindValue(':title', $title);
$query->bindValue(':content', $content);

$query->execute();

$categories = $query->fetchAll();

dump($categories);

// listarticles.php
SELECT posts.id, posts.title, categories.id AS category_id, categories.name, posts.created_at 
FROM posts 
INNER JOIN users ON users.id = user_id 
INNER JOIN categories ON categories.id = category_id 
ORDER BY users.id ASC;

// edit.php
UPDATE posts 
SET title = :title, content = :content, cover = :cover, category_id = :category 
WHERE id = :id

// delete.php
DELETE FROM posts WHERE id = :id;