let btn = document.getElementById("Register");

btn.addEventListener("click", function (e) {
  e.preventDefault();

  let email = document.getElementById("email").value;
  let fullName = document.getElementById("fullName").value;
  let password = document.getElementById("password").value;
  let cPassword = document.getElementById("cPassword").value;
  let mobile = document.getElementById("mobile").value;
  let birthday = document.getElementById("birthday").value;

  // check if email valid
  const emailValid = Validation.EmailValidation(email);
  // check if user name valid
  const usernameValid = Validation.NameValidation(fullName);
  // check if password match
  const PasswordValidation = Validation.PasswordValidation(password);
  const matchPassword = Validation.MatchPassword(password, cPassword);
  const mobileValidation = Validation.mobileValidation(mobile);
  const dateValidation = Validation.calculateRemainTime(birthday);

  if (
    emailValid &&
    usernameValid &&
    PasswordValidation &&
    mobileValidation &&
    dateValidation &&
    matchPassword
  ) {
    fetch("http://localhost/curd_task_3/php/register.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
      },
      body: `email=${email}&password=${password}&fullName=${fullName}&mobile=${mobile}&birthday=${birthday}`,
    })
      .then((response) => response.json())
      .then((res) => {
        if (res.role != "member") {
          location.href = "../curd_task_3/php/admin.php";
        } else {
          location.href = "../curd_task_3/php/profile.php";
        }
      });
  }
});

class Validation {
  static EmailValidation(email) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
      return true;
    }
    alert("inValid email ");
    return false;
  }

  static NameValidation(name) {
    let strname = name.split(" ");
    if (/^[a-zA-Z\s]*$/.test(name) && name != "" && strname.length > 3) {
      return true;
    }
    alert("inValid Name ");
    return false;
  }
  //"^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
  static PasswordValidation(password) {
    if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(password)) {
      return true;
    }
    alert("inValid Password ");
    return false;
  }

  static MatchPassword(password, confirmPassword) {
    if (
      password == confirmPassword &&
      password != "" &&
      confirmPassword != ""
    ) {
      return true;
    }
    alert("inMatch Password ");
    return false;
  }

  static mobileValidation(mobile) {
    if (/^\+?\d{10,14}$/.test(mobile)) {
      return true;
    }
    alert("inValid mobile ");
    return false;
  }

  static calculateRemainTime(dateAsString) {
    let date1 = new Date();
    let date2 = new Date(dateAsString);
    let time = date1.getTime() - date2.getTime();
    let days = time / (1000 * 3600 * 24);
    if (Math.floor(Math.abs(days)) > 5840) return true;
    else {
      alert("your age less than allowed");
      return false;
    }
  }
}
