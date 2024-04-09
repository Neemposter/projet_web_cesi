//https://developer.mozilla.org/fr/docs/Web/API/Storage


function confirmLogout() {
  if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
    window.location.href = "logout.php";
  }
}

