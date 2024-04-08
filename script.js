//https://developer.mozilla.org/fr/docs/Web/API/Storage

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

function confirmDeletion() {
  if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ?")) {
    window.location.href = "profil/delete.php";
  }
}


