window.onload = () => {
    let body = document.body; // Sélectionne le corps du document
    let getTheme = localStorage.getItem("theme");
    let cssLink = document.querySelector('link[href*=".css"]');
    if (cssLink) {
      let href = cssLink.getAttribute("href");
      if (getTheme != null) {
        if (getTheme == "dark") {
          let newHref = href.replace(".css", "_dark.css");
          cssLink.setAttribute("href", newHref);
        }
        else{
            let newHref = href.replace("_dark.css", ".css");
          cssLink.setAttribute("href", newHref);
        }
        console.log(getTheme); // Affiche le thème dans la console
      } else {
        getTheme = "light"; // Par défaut, définir la classe du corps sur 'light'
      }
    }
  };
  

document.getElementById("theme").addEventListener("click", function () {
  var body = document.body; // Sélectionne le corps du document

  // Si le thème stocké est "clair"
  if (getTheme="light") {
    // Remplace la classe "light" par "dark"
    localStorage.setItem("theme", "dark"); // Stocke le thème dans le stockage local
  } else {
    localStorage.setItem("theme", "light"); // Stocke le thème dans le stockage local
  }
});