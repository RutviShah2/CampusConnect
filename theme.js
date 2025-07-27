function toggleTheme() {
  const body = document.body;
  const currentTheme = body.getAttribute("data-theme");
  body.setAttribute("data-theme", currentTheme === "light" ? "dark" : "light");
}
// Apply saved theme on page load
(function() {
  const savedTheme = localStorage.getItem('cc_theme');
  if (savedTheme) {
    document.body.setAttribute('data-theme', savedTheme);
  }
})();

function toggleTheme() {
  const body = document.body;
  const currentTheme = body.getAttribute("data-theme");
  const newTheme = currentTheme === "light" ? "dark" : "light";
  body.setAttribute("data-theme", newTheme);
  localStorage.setItem('cc_theme', newTheme); // Save theme
}
