/**
 * Supression d'article via modal Bootstrap
 */

// Récupère le bouton de suppression d'un article
const btnDelete = document.querySelectorAll('.btnDelete');

// Boucle sur tous les boutons comportant la classe CSS "btnDelete"
btnDelete.forEach(btn => 
{
    // Ecouteur d'évènement sur le bouton au click
    btn.addEventListener('click', (event) => 
    {
        event.preventDefault();

        // Récupère al'attribut href
        const href = btn.href;
        const modalDelete = document.querySelector('.btnDeleteModal');
        modalDelete.href = href;
        console.log('bvsguh');
        // Récupération de la modal 'copy from Bootstrap'
        // var myModal = new bootstrap.Modal(document.getElementById('confDelete'), options)
        const myModal = new bootstrap.Modal(document.querySelector('#confDelete'));
        
        // Ouverture de la modal
        myModal.show();
    });
});

 


