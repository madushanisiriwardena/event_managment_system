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

function save_service() {
  var name = document.getElementById("name");
  var pp_cost = document.getElementById("pp_cost");
  var pp_sale = document.getElementById("pp_sale");
  var pp_ad = document.getElementById("pp_ad");
  var description = document.getElementById("description");
  var category = document.getElementById("category").value;

  var f = new FormData();
  f.append("name", name.value);
  f.append("pp_cost", pp_cost.value);
  f.append("pp_sale", pp_sale.value);
  f.append("pp_ad", pp_ad.value);
  f.append("description", description.value);
  f.append("category", category);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Added Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/addServicesProcess.php", true);
  r.send(f);
}

function delete_service(id) {
  var f = new FormData();
  f.append("service", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Individual Service Removed Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/deleteServiceProcess.php", true);
  r.send(f);
}

function save_changes(id) {
  var name = document.getElementById("name");
  var pp_cost = document.getElementById("pp_cost");
  var pp_sale = document.getElementById("pp_sale");
  var pp_ad = document.getElementById("pp_ad");
  var description = document.getElementById("description");
  var category = document.getElementById("category").value;

  var f = new FormData();
  f.append("name", name.value);
  f.append("pp_cost", pp_cost.value);
  f.append("pp_sale", pp_sale.value);
  f.append("pp_ad", pp_ad.value);
  f.append("description", description.value);
  f.append("category", category);
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Updated Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/editServiceProcess.php", true);
  r.send(f);
}

function assign_service() {
  var service = document.getElementById("service").value;
  var vendor = document.getElementById("vendor").value;
  var price = document.getElementById("price").value;

  var f = new FormData();
  f.append("service", service);
  f.append("vendor", vendor);
  f.append("price", price);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Assigned Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/assignServiceProcess.php", true);
  r.send(f);
}

function changeImage() {
  var image = document.getElementById("imageuploader"); //file chooser
  var view = document.getElementById("prev"); //image tag

  image.onchange = function () {
    var file = this.files[0]; //image eka thiyana file path eka
    var url = window.URL.createObjectURL(file); //file location eka tempary url ekak lesa sakasima

    view.src = url; //img tag eke src ekata url eka laba dima
  };
}

function save_category() {
  var name = document.getElementById("name");
  var des = document.getElementById("description");
  var img = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("name", name.value);
  f.append("des", des.value);
  f.append("img", img.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Category Added Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/addCategoriesProcess.php", true);
  r.send(f);
}


function submit() {
  var name = document.getElementById("name");
  var des = document.getElementById("description");
  var img = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("name", name.value);
  f.append("des", des.value);
  f.append("img", img.files[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Category Added Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/addCategoriesProcess.php", true);
  r.send(f);
}


function save_category_changes(id) {
  var newName = document.getElementById("nc" + id);
  var newDes = document.getElementById("ncs" + id);
  var f = new FormData();
  f.append("category", id);
  f.append("nc", newName.value);
  f.append("ncs", newDes.value);

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

  r.open("POST", "backend/editCategoryProcess.php", true);
  r.send(f);
}

function create_package() {
  var category = document.getElementById("category").value;
  var name = document.getElementById("name").value;

  var f = new FormData();
  f.append("category", category);
  f.append("name", name);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Package Created Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/createPackageProcess.php", true);
  r.send(f);
}

function add_to_package() {
  var package = document.getElementById("package").value;
  var service = document.getElementById("service").value;

  var f = new FormData();
  f.append("package", package);
  f.append("service", service);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Service Added Successfully to Package");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/setServicesToPackagesProcess.php", true);
  r.send(f);
}

function add_venue() {
  var category = document.getElementById("category");
  var district = document.getElementById("district");
  var type = document.getElementById("type");
  var name = document.getElementById("name");
  var address = document.getElementById("address");
  var participants = document.getElementById("participants");
  var pp_cost = document.getElementById("pp_cost");
  var pp_sale = document.getElementById("pp_sale");
  var img = document.getElementById("imageuploader");

  var f = new FormData();
  f.append("category", category.value);
  f.append("district", district.value);
  f.append("type", type.value);
  f.append("name", name.value);
  f.append("address", address.value);
  f.append("participants", participants.value);
  f.append("pp_cost", pp_cost.value);
  f.append("pp_sale", pp_sale.value);
  f.append("img", img.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Venues Added Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/addVenuesPro.php", true);
  r.send(f);
}

function approve_quote(qid, cid) {
  var c = document.getElementById("comment" + qid).value;
  var ad = document.getElementById("ad" + qid).value;

  var f = new FormData();
  f.append("c", c);
  f.append("ad", ad);
  f.append("qid", qid);
  f.append("cid", cid);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Approval Successfull");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/approveQuotePro.php", true);
  r.send(f);
}

function decline_quote(qid, cid) {
  var c = document.getElementById("comment2" + qid).value;

  var f = new FormData();
  f.append("c", c);
  f.append("qid", qid);
  f.append("cid", cid);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Decline Successfull");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/declineQuotePro.php", true);
  r.send(f);
}

function confirm_pay(id) {
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
              swalWithBootstrapButtons
                .fire({
                  title: "success!",
                  text: "Payment Confirmed Successfully !",
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

        r.open("POST", "backend/confirmPayPro.php", true);
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

function decline_pay(id) {
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
        var comment = document.getElementById("comment" + id).value;

        var f = new FormData();
        f.append("id", id);
        f.append("comment", comment);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
          if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
              swalWithBootstrapButtons
                .fire({
                  title: "success!",
                  text: "Payment Declined Successfully !",
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

        r.open("POST", "backend/declinePayPro.php", true);
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

function complete_event(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Event Completed Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/completeEventPro.php", true);
  r.send(f);
}

function add_reply(id) {
  var comment = document.getElementById("comment" + id).value;

  var f = new FormData();
  f.append("id", id);
  f.append("comment", comment);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Reply Saved Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/addReplyPro.php", true);
  r.send(f);
}

function send_msg2(id) {
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

  r.open("POST", "backend/managerSendMsgPro.php", true);
  r.send(f);
}

function pay_vendor(id) {
  var img = document.getElementById("imageuploader" + id);
  var pay = document.getElementById("pay" + id).innerHTML;

  var f = new FormData();
  f.append("img", img.files[0]);
  f.append("id", id);
  f.append("pay", pay);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Payment Done Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
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

  r.open("POST", "backend/payVendorPro.php", true);
  r.send(f);
}

function pay_vendor_ad(id) {
  var img = document.getElementById("imageuploader" + id);
  var pay = document.getElementById("pay" + id).innerHTML;

  var f = new FormData();
  f.append("img", img.files[0]);
  f.append("id", id);
  f.append("pay", pay);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Payment Done Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
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

  r.open("POST", "backend/payVendorAdPro.php", true);
  r.send(f);
}

function activate_cat(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Category Activated Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
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

  r.open("POST", "backend/aCatPro.php", true);
  r.send(f);
}

function deactivate_cat(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Category Deactivated Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
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

  r.open("POST", "backend/dCatPro.php", true);
  r.send(f);
}

function activate_p(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Package Activated Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
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

  r.open("POST", "backend/aPackPro.php", true);
  r.send(f);
}

function deactivate_p(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      if (t == "1") {
        Swal.fire({
          title: "Success!",
          text: "Package Deactivated Successfully!",
          icon: "success",
        }).then((result) => {
          location.reload();
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

  r.open("POST", "backend/dPackPro.php", true);
  r.send(f);
}

function save_package_changes(id) {
  var name = document.getElementById("name" + id);
  var category = document.getElementById("category" + id);

  var f = new FormData();
  f.append("id", id);
  f.append("name", name.value);
  f.append("cat", category.value);

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

  r.open("POST", "backend/editPackageProcess.php", true);
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

function remove_vendor(id) {
  var f = new FormData();
  f.append("vendor", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Deactivated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/remove_vendors_process.php", true);
  r.send(f);
}

function active_vendor(id) {
  var f = new FormData();
  f.append("vendor", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Activated Successfully.");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/active_vendor_process.php", true);
  r.send(f);
}