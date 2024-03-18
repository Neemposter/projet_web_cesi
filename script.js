//https://developer.mozilla.org/fr/docs/Web/API/Storage


window.onload = () => {
// Sélectionne le corps du document
    let getTheme = localStorage.getItem("theme");
    let cssLink = document.querySelector('link[href*=".css"]');
    if (cssLink) {
        let href = cssLink.href;
        if (getTheme != null) {

            // Définit la classe du corps en fonction du thème stocké
            if (getTheme == "dark") {
                let newHref = href.replace(".css", "_dark.css");
                cssLink.setAttribute("href", newHref);
// Coche la case si le thème est sombre
            }
            console.log(getTheme); // Affiche le thème dans la console
        }
    }
};
const myButton = document.getElementById('myButton');

myButton.addEventListener("click", function () {
     // Sélectionne le corps du document
     
    let getTheme = localStorage.getItem("theme");
    // Si le thème stocké est "clair"
    if (getTheme == "light") {
         // Remplace la classe "light" par "dark"
        myButton.textContent = "Light";
        localStorage.setItem("theme", "dark"); // Stocke le thème dans le stockage local
        // Stocke l'état de la case à cocher
    } else {
        myButton.textContent = "Dark";
        localStorage.setItem("theme", "light"); // Stocke le thème dans le stockage local
    }
});

const menuToggle = document.querySelector(".menu-toggle");
const sidebar = document.querySelector(".sidebar");

menuToggle.addEventListener("click", () => {
  sidebar.classList.toggle("open");
});

function confirmLogout() {
  if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
    window.location.href = "logout.php";
  }
}
