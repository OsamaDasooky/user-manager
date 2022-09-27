let btn = document.getElementById("login");
let loginG = document.getElementById("loginG");
btn.addEventListener("click", function (e) {
  e.preventDefault();

  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  fetch("http://localhost/user-manager/php/login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `email=${email}&password=${password}`,
  })
    .then((response) => response.json())
    .then((res) => {
      if (res == false) {
        alert("password or email is incorrect");
      } else {
        if (res.role == "admin") {
          location.href = "../user-manager/php/admin.php";
        } else if (res.role != "admin") {
          location.href = "../user-manager/php/profile.php";
        }
      }
    });
});
loginG.addEventListener("click", function (e) {
  fetch("http://localhost/user-manager/php/redirect.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `email=${email}`,
  })
    .then((response) => response.text())
    .then((res) => {
      location.href = res;
    });
});
