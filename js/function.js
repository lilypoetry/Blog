/**
 * FONCTION JS
 */

/**
 * Gestion des erreurs du formulaire
 * @param {string} message
 * @param {boolean} error
 * @param {string} id
 */

const isError = (message, success, id) => {
    // Récupère le champs input
    const input = document.querySelector(`#${id}`);

    // Récupère la balise contenant le message d'eereur
    const messageError = document.querySelector(`#${id}Error`);

    // Affiche une erreur
    input.style.border = "2px solid red";
    messageError.innerText = message;
    messageError.style.display = "block";

    // Affiche un succès
    if (success) {
        input.style.border = "2px solid green";
        messageError.style.display = "none";
    }
}

/**
 * Vérifie que la donnée reçue ne soit pas vide
 */
const notEmpty = (value) => {
    // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators
    if (typeof value !== "string" || value.length === 0) {
        return false;
    }
    return true;
}

/**
 * Vérifier la longeur d'une chaîne de caractère
 * @param {string} value chaîne des caractère à évaluer
 * @param {int} min longeur min à atteindre
 * @returns {boolean}
 */
const isLength = (value, min) => {
    return value.length >= min;
}


/**
 * Vérifier la validité d'une email adresse
 * @param {string} value 
 * @returns {boolean}
 */

const isEmail = (value) => {
    const emailValide = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,10}$/;
    return emailValide.test(value);    
}

/**
 * Vérifier si deux chînes de caractères correspondent
 * @param {string|int} value 
 * @param {string|int} confirmValue
 * @returns {boolean}
 */
const isEqual = (value, confirmValue) => {
    return value === confirmValue;    
}    

/**
 * Affiche/cache le mot de passe
 * @param {Element} element
 * @returns {string}
 */

let showHidePassword = (element) => {
    // if ternaire
    return (element.type === "password") ? "text" : "password";

    /*
    if (element.type === "password") {
        element.type = "text";
    }
    else {
        element.type = "password";
    }
    return type;
    */
}

/**
 * Générer un mot de passe aléatoire (membuat password acak)
 */
const generatePassword = (min = 18) => {
    const letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@&-_!?$#=+*,;:.";
    let password = "";
    for (let i = 0; i < min; i++) {
        password += letters.charAt(Math.floor(Math.random() * letters.length));
    } 
    return password;
}