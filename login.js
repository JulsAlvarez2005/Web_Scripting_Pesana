document.getElementById("loginForm").addEventListener("submit", function(e) {
  const username = document.querySelector("input[name='username']").value;
  const password = document.querySelector("input[name='password']").value;

  if (!username || !password) {
    e.preventDefault();
    alert("Both fields are required!");
  }
});