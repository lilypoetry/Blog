<?php

// Connexion à la BDD
require_once '../connexion.php';

// Chargement des dépendances Composer
require_once '../vendor/autoload.php';


/**
 * Seléctinner l'article en BDD selon l'ID reçue par l'URL
 */
$id = htmlspecialchars(strip_tags($_GET['id']));

$query = $db->prepare('SELECT title, content, cover, category_id FROM posts WHERE id = :id;');
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();

$article = $query->fetch();
dump($article);

unset($article);

public function delete($id){
    $post = Post::find($id);
    $post::where('id', $id)->first()->delete();
    // $post->destroy($id);
    return redirect('home/faqs');
}

 Route::get('/post/delete/{id}','PostController@delete')->name('post.delete');
            
<a href="{{ route('post.delete', $post->id) }}" class="btn btn-Danger">Delete</a>
                    