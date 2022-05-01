/*
Vérification d’un formulaire
Partie #1
Créer un formulaire HTML contenant les champ suivants :
nom, prénom, pseudo, email, mot de passe, confirmer le mot de passe et un
bouton « Valider les informations ».
Partie #2
Avec du Javascript, effectuer en temps réel, les vérifications suivantes :
1. Nom et prénom : les champ ne soient pas vides ;
2. Pseudonyme : le champ ne soit pas vide et que le pseudo comporte au
minimum 5 caractères ;
3. Email : le champ ne soit pas vide et que celle-ci soit correct ;
4. Mot de passe : le champ ne soit pas vide et qu’il comporte au minimum 6
caractères ;
5. Confirmation du mot de passe : le champ ne soit pas vide et correspond au
mot de passe.
En cas d’erreur de l’un des champ, entourer le champ d’une bordure rouge et
afficher un message d’erreur en conséquence sous celui-ci.
À l’inverse, si celui-ci correct, entourer le champ d’une bordure verte.
Partie #3
Sur les champ « mot de passe » et « confirmer mot de passe », ajouter une icône
en forme d’oeil.
Quand on clic sur l’icône, fait en sorte que le mot de passe écrit dans le champ
concerné, devienne visible.
Au second clic sur la même icône, le mot de passe redevient caché.
Partie #4
Proposer un générateur de mot de passe remplissant les critères suivants :
• Contiens minimum 12 caractères ;
• Contiens au moins une lettre en capitale ;
• Contiens au moins un nombre ;
• Contiens au moins un caractère spécial ;
• Pas d’espaces ;
Disposer un bouton vers le champ « Mot de passe » et à chaque clique sur celui-
ci, un mot de passe respectant les critères s’affiche en dessous de ce champ.
*/

// Sélectionner le champs texte du nom
const lastName = document.querySelector("#lastName");

// Applique un écouteur d'évènement sur les changements
// effectués dans les champs

lastName.addEventListener(`input`, () => {
  // Vérifier si le champs est vide ou pas
    const response = notEmpty(lastName.value);
    
    // Gestion de l'erreur
    isError("Votre nom est obligatoire", response, "lastName");   
});

// First Name
const firstName = document.querySelector("#firstName");

firstName.addEventListener(`input`, () => {
  // Vérifier si le champs est vide ou pas
    const response = notEmpty(firstName.value);  
     
    
    // Gestion de l'erreur
    isError("Votre prénom est obligatoire", response, "firstName");
});

// Pseudo
const nickName = document.querySelector("#nickName");

nickName.addEventListener(`input`, () => {
    const response = notEmpty(nickName.value);
    isError("Votre pseudo est obligatoire", response, "nickName");

    if (response) {
      const length = isLength(nickName.value, 5);
      isError("Le pseudo doit comporter 5 caractère min", length, "nickName")
    }
});

/**
 * Vérification email adresse
 */
const email = document.querySelector("#email"); 
email.addEventListener(`input`, () =>{
  const response = notEmpty(email.value);
  isError("Votre email n'est pas valable", response, "email");

  if (response) {
    const emailValide = isEmail(email.value);
    isError("Votre email n'est pas valable", emailValide, "email");
  }
});

/**
 * Vérification password
 */
 const password = document.querySelector("#password");
 password.addEventListener(`input`, () => {
   const response = notEmpty(password.value);
   isError("Le mot de passe est obligatoire", response, "password");
 
   if (response) { 
     const length = isLength(password.value, 6)
     isError("Le mot de passe doit comporter 6 caractères min", length, "password");    
   }
 });
 

/**
 * Confirmation de password
 */
const confirmPassword = document.querySelector("#confirmPassword");
confirmPassword.addEventListener(`input`, () => {
  const response = notEmpty(confirmPassword.value);
  isError("Le mot de passe est obligatoire", response, "confirmPassword");

  if (response) { 
    const equal = isEqual(password.value, confirmPassword.value)
    isError("Le mot de passe est different", equal, "confirmPassword");    
  }
});

// Empêche de coller une valeur dans le champs (copy paste password)
confirmPassword.addEventListener("paste", (event) => {
  event.preventDefault();
});


// Sélection toutes les élements ayant la classes CSS "view-password"
const eyes = document.querySelectorAll(".view-password");

// Applique un écouteur d'évenement à chaque éléments récupérérs
eyes.forEach(eye => {
  eye.addEventListener("click", () => {
    // Appelle une fonction permettant de faire apparaitre/disparaitre
    // le mot de pass

    // "previousElementSibling" permet de récupérer l'élément du DOM, 
    // pour pouvoir clicquer sur la casse de limage l'oeil (pas)
    // viser que sur l'oeil (input - le sibling de span)
    let input = eye.previousElementSibling;
    let type = showHidePassword(input);
    input.type = type;  
    });
  });

  // Sélection le lien permettant de lancer la génération du mot de passe
  const link = document.querySelector(`#generatePwd`);
  link.addEventListener("click", () => {
    const passGenerate = generatePassword(12);

    const result = document.querySelector("#resultPassword")
    result.innerText = passGenerate;

  });