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

function assign_vendor(id) {
  var vendor = document.getElementById("vendor" + id).value;
  var date = document.getElementById("date" + id).innerHTML;

  var f = new FormData();
  f.append("vendor", vendor);
  f.append("date", date);
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Vendor Assigned Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/assignVendorPro.php", true);
  r.send(f);
}

function assign_vendor_ad(id) {
  var vendor = document.getElementById("vendor" + id).value;
  var date = document.getElementById("date" + id).innerHTML;

  var f = new FormData();
  f.append("vendor", vendor);
  f.append("date", date);
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("Vendor Assigned Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/assignVendorProAd.php", true);
  r.send(f);
}

function finished(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("This Service is Completetd Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/finishPro.php", true);
  r.send(f);
}

function finished_ad(id) {
  var f = new FormData();
  f.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.status == 200 && r.readyState == 4) {
      var t = r.responseText;
      if (t == "1") {
        alert("This Service is Completetd Successfully");
        location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "backend/finishProAd.php", true);
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

  r.open("POST", "backend/coordinatorSendMsgPro.php", true);
  r.send(f);
}

function checkV() {
  var date = document.getElementById("date").value;
  if (date == 0) {
    alert("Please select a Date");
  } else {
    window.location = "vendorAvailability.php?date="+date;
  }
}

function schedule(){
  var from = document.getElementById("m1").value;
  var to = document.getElementById("m2").value;
  if (from == 0) {
    alert("Please select a From Date");
  } else if (to == 0) {
    alert("Please select a To Date");
  } else {
    window.location = "schedule.php?from="+from+"&to="+to;
  }
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