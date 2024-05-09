import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    //a supprimer plus tard
    connect() {
        console.log("Hello, Stimulus!");
    }

    createGame() {
        // Redirection ou ouvrir un formulaire pour créer une partie
        window.location.href = '/game/create'; // Exemple de redirection
    }

    joinGame() {
        // Redirection ou ouvrir un formulaire pour rejoindre une partie
        window.location.href = '/game/join'; // Exemple de redirection
    }
}
