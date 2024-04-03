function changeRole() {
  var selectedRole = document.getElementById("role");
  var nimLabel = document.getElementById("nimLabel");
  var nim = document.getElementById("nim");
  var cardSubtitle = document.getElementById("card-subtitle");

  if (selectedRole.value === "admin") {
    nimLabel.textContent = "Username";
    nim.setAttribute("name", "username");
    cardSubtitle.textContent = 'Silakan log in untuk mengelola laporan';    
  } else {
    nimLabel.textContent = "NIM";
    nim.setAttribute("name", "nim");
    cardSubtitle.textContent = 'Silakan log in untuk mengajukan laporan';
  }
}
