function register() {
  var category = document.getElementById("category");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var password2 = document.getElementById("password2");

  var f = new FormData();
  f.append("category", category.value);
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("mobile", mobile.value);
  f.append("email", email.value);
  f.append("password", password.value);
  f.append("password2", password2.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Registration Successfull! Verify your email an Login!",
          icon: "success",
        }).then((result) => {
          window.location = "login.php";
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "registerProcess.php", true);
  r.send(f);
}

function login() {
  var email = document.getElementById("email");
  var password = document.getElementById("password");

  var f = new FormData();
  f.append("email", email.value);
  f.append("password", password.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "admin/index.php";
        });
      } else if (t == "2") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "index.php";
        });
      } else if (t == "3") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "vendor/index.php";
        });
      } else if (t == "4") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "manager/index.php";
        });
      } else if (t == "5") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "coordinator/index.php";
        });
      } else if (t == "6") {
        var m = document.getElementById("VerifyModal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        }).then((result) => {
          location.reload();
        });
      }
    }
  };
  r.open("POST", "loginProcess.php", true);
  r.send(f);
}

function logout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        alert("Logged out Successfully!");
        location.reload();
      }
    }
  };

  r.open("GET", "../signout.php", true);
  r.send();
}

function account_data_save() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("mobile", mobile.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        alert("Changes Saved Successfully!");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "../saveProfilePro.php", true);
  r.send(f);
}

function goToQuote(pid, cid) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        if (cid == "5") {
          window.location = "wedding.php?id=" + pid;
        } else if (cid == "6") {
          window.location = "birthday.php?id=" + pid;
        }
      } else {
        alert("Please Login to Continue");
        window.location = "login.php";
      }
    }
  };

  r.open("POST", "checklogin.php", true);
  r.send();
}

function submit_wed_quote(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Are you sure to Submit?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        var bride = document.getElementById("bride").value;
        var groom = document.getElementById("groom").value;
        var date_time = document.getElementById("dt").value;
        var participants = document.getElementById("p").value;
        var type = document.getElementById("type").value;
        var lpp = document.getElementById("lpp").value;
        var loc = document.getElementById("loc").value;
        var location = document.getElementById("location").value;
        var ad = document.getElementById("ad").value;
        var tot = document.getElementById("tot").innerHTML;

        var f = new FormData();
        f.append("bride", bride);
        f.append("groom", groom);
        f.append("date_time", date_time);
        f.append("participants", participants);
        f.append("type", type);
        f.append("lpp", lpp);
        f.append("loc", loc);
        f.append("location", location);
        f.append("ad", ad);
        f.append("pid", id);
        f.append("tot", tot);

        var selectedServices = [];
        var checkboxes = document.querySelectorAll(
          'input[type="checkbox"][id^="check"]'
        );
        checkboxes.forEach(function (checkbox) {
          if (checkbox.checked) {
            selectedServices.push(checkbox.value);
          }
        });
        f.append("selected_services", JSON.stringify(selectedServices));

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
          if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
              swalWithBootstrapButtons
                .fire({
                  title: "success!",
                  text: "Quotation Submitted Successfuly !",
                  icon: "success",
                })
                .then((result) => {
                  window.location = "account/pendingEvents.php";
                });
            } else if (t == "2") {
              alert("Please login to continue");
              window.location = "login.php";
            } else {
              swalWithBootstrapButtons.fire({
                title: "Error",
                text: t,
                icon: "error",
              });
            }
          }
        };
        r.open("POST", "submitWedQuote.php", true);
        r.send(f);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire({
          title: "Cancelled",
          text: "You cancelled the operation",
          icon: "error",
        });
      }
    });
}

function delete_quote(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, Delete This!",
      cancelButtonText: "No, cancel!",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        var f = new FormData();
        f.append("qid", id);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
          if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "1") {
              swalWithBootstrapButtons
                .fire({
                  title: "success!",
                  text: "Quotation Deleted Successfuly !",
                  icon: "success",
                })
                .then((result) => {
                  location.reload();
                });
            } else {
              swalWithBootstrapButtons.fire({
                title: "Error",
                text: t,
                icon: "error",
              });
            }
          }
        };

        r.open("POST", "../delete_quote_Process.php", true);
        r.send(f);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire({
          title: "Cancelled",
          text: "You cancelled the operation",
          icon: "error",
        });
      }
    });
}

function pay_slip_up(id, s) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Are you sure to Submit?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        var name = document.getElementById("info");
        var price = document.getElementById("price");
        var img = document.getElementById("imageuploader");

        var f = new FormData();
        f.append("info", name.value);
        f.append("price", price.value);
        f.append("id", id);
        f.append("status", s);
        f.append("img", img.files[0]);

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
          if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
              swalWithBootstrapButtons
                .fire({
                  title: "success!",
                  text: "Payment Slip Submitted Successfuly !",
                  icon: "success",
                })
                .then((result) => {
                  window.history.back();
                });
            } else {
              swalWithBootstrapButtons.fire({
                title: "Error",
                text: t,
                icon: "error",
              });
            }
          }
        };

        r.open("POST", "../uploadPaySlipPro.php", true);
        r.send(f);
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: "Cancelled",
          text: "You cancelled the operation",
          icon: "error",
        });
      }
    });
}

function add_feedback(id) {
  var des = document.getElementById("des" + id).value;
  var r = document.getElementById("rate" + id).value;

  var f = new FormData();
  f.append("id", id);
  f.append("feed", des);
  f.append("r", r);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Feedback Submitted Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "../addFeedbackPro.php", true);
  r.send(f);
}

function send_msg(id) {
  var msg = document.getElementById("msg").value;

  var f = new FormData();
  f.append("id", id);
  f.append("msg", msg);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "sendMsgPro.php", true);
  r.send(f);
}

var bm;
function forgotPassword() {
  var email = document.getElementById("email");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        Swal.fire({
          title: "Success!",
          text: "Verification code has sent to your Email. Please check your inbox",
          icon: "success",
        });

        var m = document.getElementById("forgotPasswordModal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("GET", "forgetpassword.php?e=" + email.value, true);
  r.send();
}
function showPassword() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (np.type == "password") {
    np.type = "text";
    npb.innerHTML = "Hide";
  } else {
    np.type = "password";
    npb.innerHTML = "Show";
  }
}

function showPassword2() {
  var rnp = document.getElementById("rnp");
  var rnpb = document.getElementById("rnpb");

  if (rnp.type == "password") {
    rnp.type = "text";
    rnpb.innerHTML = "Hide";
  } else {
    rnp.type = "password";
    rnpb.innerHTML = "Show";
  }
}

function resetPassword() {
  var email = document.getElementById("email");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var f = new FormData();
  f.append("e", email.value);
  f.append("n", np.value);
  f.append("r", rnp.value);
  f.append("v", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        Swal.fire({
          title: "Success!",
          text: "Your Password Updated",
          icon: "success",
        });

        bm.hide();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "resetPasswordProcess.php", true);
  r.send(f);
}

function submit_birth_quote(id) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Are you sure to Submit?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        var name = document.getElementById("name").value;
        var date_time = document.getElementById("dt").value;
        var participants = document.getElementById("p").value;
        var type = document.getElementById("type").value;
        var lpp = document.getElementById("lpp").value;
        var loc = document.getElementById("loc").value;
        var location = document.getElementById("location").value;
        var ad = document.getElementById("ad").value;
        var tot = document.getElementById("tot").innerHTML;

        var f = new FormData();
        f.append("name", name);
        f.append("date_time", date_time);
        f.append("participants", participants);
        f.append("type", type);
        f.append("lpp", lpp);
        f.append("loc", loc);
        f.append("location", location);
        f.append("ad", ad);
        f.append("pid", id);
        f.append("tot", tot);

        var selectedServices = [];
        var checkboxes = document.querySelectorAll(
          'input[type="checkbox"][id^="check"]'
        );
        checkboxes.forEach(function (checkbox) {
          if (checkbox.checked) {
            selectedServices.push(checkbox.value);
          }
        });
        f.append("selected_services", JSON.stringify(selectedServices));

        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
          if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
              swalWithBootstrapButtons
                .fire({
                  title: "success!",
                  text: "Quotation Submitted Successfuly !",
                  icon: "success",
                })
                .then((result) => {
                  window.location = "account/pendingEvents.php";
                });
            } else if (t == "2") {
              alert("Please login to continue");
              window.location = "login.php";
            } else {
              swalWithBootstrapButtons.fire({
                title: "Error",
                text: t,
                icon: "error",
              });
            }
          }
        };
        r.open("POST", "submitBirthQuote.php", true);
        r.send(f);
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: "Cancelled",
          text: "You cancelled the operation",
          icon: "error",
        });
      }
    });
}

function verify_account() {
  var email = document.getElementById("email").value;
  var vc = document.getElementById("vc2").value;

  var f = new FormData();
  f.append("email", email);
  f.append("verify", vc);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "index.php";
        });
      } else if (t == "2") {
        Swal.fire({
          title: "Success!",
          text: "Login Successfull!",
          icon: "success",
        }).then((result) => {
          window.location = "vendor/index.php";
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error...",
          text: t,
        });
      }
    }
  };

  r.open("POST", "verifyAccount.php", true);
  r.send(f);
}
