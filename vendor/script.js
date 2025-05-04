function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        location.reload();
      }
    }
  };

  r.open("GET", "../signout.php", true);
  r.send();
}

function approve_req(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Approved Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/approveReq.php", true);
  r.send(f);
}

function decline_req(id) {
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
        cancelButtonText: "No",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {

          var f = new FormData();
          f.append("id", id);

          var r = new XMLHttpRequest();
          r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
              var t = r.responseText;
              if (t == "1") {
                alert("Service Declined Successfully");
                location.reload();
              } else {
                alert(t);
              }
            }
          };

          r.open("POST", "backend/declineReq.php", true);
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

function approve_req_ad(id) {
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
          var f = new FormData();
          f.append("id", id);

          var r = new XMLHttpRequest();
          r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
              var t = r.responseText;
              if (t == "1") {
                alert("Service Approved Successfully");
                location.reload();
              } else {
                alert(t);
              }
            }
          };
          r.open("POST", "backend/approveReqAd.php", true);
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

function decline_req_ad(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Declined Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/declineReqAd.php", true);
  r.send(f);
}

function start_task(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Started Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/startTask.php", true);
  r.send(f);
}

function complete_task(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Completed Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/completeTask.php", true);
  r.send(f);
}

function start_task_ad(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Started Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/startTaskAd.php", true);
  r.send(f);
}

function complete_task_ad(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Completed Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/completeTaskAd.php", true);
  r.send(f);
}

function confirm_payment_vendor(id){
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Payment Confirmed Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/confirmPayVendor.php", true);
  r.send(f);
}

function confirm_payment_vendor_ad(id){
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Payment Confirmed Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/confirmPayVendorAd.php", true);
  r.send(f);
}

function update_profile(id){
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var mobile = document.getElementById("mobile");
  var cpw = document.getElementById("cpw");
  var npw = document.getElementById("npw");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("email", email.value);
  f.append("mobile", mobile.value);
  f.append("cpw", cpw.value);
  f.append("npw", npw.value);
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Updated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/updateProfileProcess.php", true);
  r.send(f);
}