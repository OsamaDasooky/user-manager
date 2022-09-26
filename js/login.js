let btn = document.getElementById("login");

btn.addEventListener("click", function (e) {
  e.preventDefault();

  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  fetch("http://localhost/curd_task_3/php/login.php", {
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
          location.href = "../curd_task_3/php/admin.php";
        } else if (res.role != "admin") {
          location.href = "../curd_task_3/php/profile.php";
        }
      }
    });
});
