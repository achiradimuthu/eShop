function changeView() {
    var signupBox = document.getElementById("signupBox");
    var signinBox = document.getElementById("SigninBox");

    signupBox.classList.toggle("d-none");
    signinBox.classList.toggle("d-none");
}

function signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    //alert(fname.value);
    //alert(lname.value);
    //alert(email.value);
    //alert(password.value);
    //alert(mobile.value);
    //alert(gender.value);

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (this.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("msg").innerHTML = "";
                changeView();
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    };

    r.open("POST", "signup_proccess.php", true);
    r.send(form);
}


function signin() {
    var email2 = document.getElementById("email2");
    var password2 = document.getElementById("password2");
    var remember_me = document.getElementById("remember_me");

    var form = new FormData();
    form.append("email2", email2.value);
    form.append("password2", password2.value);
    form.append("remember_me", remember_me.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                email2.innerHTML = " ";
                password2.innerHTML = " ";
                window.location = "home.php";

            } else {
                var msg2 = document.getElementById("msg2");
                msg2.innerHTML = text;
                password2.innerHTML = " ";

            }
        }
    };

    r.open("POST", "signin_proccess.php", true);
    r.send(form);
}

var bm;

function fogot_password() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (this.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Verification code is sent to your email.Please Check the email");

                var m = document.getElementById("fogotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(text);
            }
        }
    };

    r.open("GET", "fogot_password_proccess.php?email=" + email.value, true);
    r.send();
}


function showPassword1() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
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

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }
}


function resetPassword() {
    var e = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var formData = new FormData();
    formData.append("e", e.value);
    formData.append("np", np.value);
    formData.append("rnp", rnp.value);
    formData.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;


            if (text == "Password is updated") {
                alert(text);
                bm.hide();

            } else {
                alert(text);
            }
        }
    };
    r.open("POST", "resetPassword.php", true);
    r.send(formData);
}


function signOut() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "home.php";
            }
        }
    };

    r.open("GET", "signOutProccess.php", true);
    r.send();
}

function changeImg() {
    var image = document.getElementById("profileimg");
    var previwe = document.getElementById("preview0");

    image.onchange = function() {
        var file0 = this.files[0];

        var url0 = window.URL.createObjectURL(file0);

        previwe.src = url0;
    }
}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var addline1 = document.getElementById("addline1");
    var addline2 = document.getElementById("addline2");
    var usercity = document.getElementById("usercity");
    var image = document.getElementById("profileimg");

    var formData = new FormData();
    formData.append("fname", fname.value);
    formData.append("lname", lname.value);
    formData.append("mobile", mobile.value);
    formData.append("addline1", addline1.value);
    formData.append("addline2", addline2.value);
    formData.append("usercity", usercity.value);
    formData.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    };

    r.open("POST", "update_profile_proccess.php", true);
    r.send(formData);

}

function ChangeProductImage() {
    var image = document.getElementById("imageUplorder");
    var view = document.getElementById("prev");

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;
    }
}

function AddProduct() {
    var catogery = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");

    var condition;
    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }

    var color;
    if (document.getElementById("clr1").checked) {
        color = 1;
    } else if (document.getElementById("clr2").checked) {
        color = 2;
    } else if (document.getElementById("clr3").checked) {
        color = 3;
    } else if (document.getElementById("clr4").checked) {
        color = 4;
    } else if (document.getElementById("clr5").checked) {
        color = 5;
    } else if (document.getElementById("clr6").checked) {
        color = 6;
    }

    var quantity = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delevery_within_colombo = document.getElementById("dwc");
    var delevery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("desc");
    var image = document.getElementById("imageUplorder");

    var f = new FormData();
    f.append("c", catogery.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("co", condition);
    f.append("col", color);
    f.append("qty", quantity.value);
    f.append("p", price.value);
    f.append("dwc", delevery_within_colombo.value);
    f.append("doc", delevery_outof_colombo.value);
    f.append("dsc", description.value);
    f.append("img", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert(text);
            } else {
                document.getElementById("msg").innerHTML = text;
            }
        }
    };

    r.open("POST", "add_product_proccess.php", true);
    r.send(f);
}

function changeStatus(id) {
    var productId = id;
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLabel = document.getElementById("checkLabel" + productId);

    var status;
    if (statusChange.checked) {
        status = 1;
    } else {
        status = 0;
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Deactivated") {
                statusLabel.innerHTML = "Make your product Active";
            } else if (text == "Activated") {
                statusLabel.innerHTML = "Make your product Deactivate";
            }
        }
    };

    r.open("GET", "statusChangeProccess.php?p=" + productId + "&s=" + status, true);
    r.send();
}

function addFilters() {
    var search = document.getElementById("s");

    var age;
    if (document.getElementById("n").checked) {
        age = 1;
    } else if (document.getElementById("o").checked) {
        age = 2;
    } else {
        age = 0;
    }

    var qty;
    if (document.getElementById("l").checked) {
        qty = 1;
    } else if (document.getElementById("h").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var condition;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    } else {
        condition = 0;
    }

    var f = new FormData();
    f.append("search", search.value);
    f.append("age", age);
    f.append("qty", qty);
    f.append("condition", condition);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            document.getElementById("sort").innerHTML = text;
        }
    };

    r.open("POST", "sortProccess.php", true);
    r.send(f);
}

function clearFilters() {
    var search = document.getElementById("s");
    document.getElementById("n").value = null;

}

function sendId(id) {
    var id1 = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "updateProduct.php";
            } else {

            }
        }
    };

    r.open("GET", "sendProductProccess.php?id=" + id1, true);
    r.send();
}

function updateProduct() {
    var ti = document.getElementById("ti");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageUplorder");

    var form = new FormData();
    form.append("t", ti.value);
    form.append("qty", qty.value);
    form.append("c", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("desc", desc.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    };

    r.open("POST", "updateProccess.php", true);
    r.send(form);
}

function advancedSearch(x) {
    var searchtxt = document.getElementById("s1");
    var catogery = document.getElementById("ca1");
    var brand = document.getElementById("br1");
    var model = document.getElementById("mo1");
    var condition = document.getElementById("co1");
    var colour = document.getElementById("col1");
    var pricefrom = document.getElementById("pf1");
    var priceto = document.getElementById("pt1");
    var sort = document.getElementById("sort");

    var form = new FormData();
    form.append("page", x);
    form.append("s", searchtxt.value);
    form.append("ca", catogery.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("con", condition.value);
    form.append("col", colour.value);
    form.append("pf", pricefrom.value);
    form.append("pt", priceto.value);
    form.append("sort", sort.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("results").innerHTML = text;
        }
    };

    r.open("POST", "advancedSearchProccess.php", true);
    r.send(form);

}

function basic_search(x) {
    var searchText = document.getElementById("basic_search_txt").value;
    var searchSelect = document.getElementById("basic_search_select").value;

    var form = new FormData();
    form.append("page", x);
    form.append("st", searchText);
    form.append("ss", searchSelect);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = text;
        }
    };

    r.open("POST", "basicSearchProccess.php", true);
    r.send(form);
}

function loadmainimg(id) {
    var pid = id;
    var img = document.getElementById("pimg" + pid).src;
    var mainimg = document.getElementById("mainimg");

    mainimg.style.backgroundImage = "url(" + img + ")";
}

function increase(qty) {
    var qty1 = qty;
    var input = document.getElementById("qty_box");
    // alert(input.value);

    if (input.value < qty1) {
        var newvalue = parseInt(input.value) + 1;
        input.value = newvalue.toString();
    } else {
        alert("maximum quntity has achived");
    }
}

function dicrease(qty) {
    var qty1 = qty;
    var input = document.getElementById("qty_box");
    // alert(qty1);

    if (input.value > '1') {
        var newvalue = parseInt(input.value) - 1;
        input.value = newvalue.toString();
    } else {
        alert("minimum quntity has achived");
    }
}

function addToWatchlist(id) {
    var wid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("New product has added to the watchlist");
                document.getElementById("heart" + id).style.color = "red";

                window.location = "home.php";
            } else if (text == "success2") {
                alert("product has removed from the watchlist");
                document.getElementById("heart" + id).style.color = "white";

                window.location = "home.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "addToWatchlistProccess.php?id=" + wid, true);
    r.send();
}

function deleteFromWatchlist(id) {
    var pid = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "watchlist.php";
            } else {
                alert(text);
            }
        }
    };

    r.open("GET", "deleteWatchlistProccess.php?id=" + pid, true);
    r.send();
}

//cart
function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Please signin first") {
                alert(text);
                window.location = "index.php";
            } else {
                alert(text);
            }
        }
    };

    r.open("GET", "addToCartProccess.php?id=" + id, true);
    r.send();
}

function printInvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function viewRecent() {
    var massege_box = document.getElementById("massege_box");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            alert(text);
        }
    };

    r.open("GET", "viewRecentMsgProccess.php", true);
    r.send();
}

var k;

function adminVerification() {
    var email = document.getElementById("email");

    var form = new FormData();
    form.append("email", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {

                var verification_model = document.getElementById("verification_model");
                k = new bootstrap.Modal(verification_model);

                k.show();

            } else {
                alert(text);
            }
        }
    };

    r.open("POST", "adminVerificationProccess.php", true);
    r.send(form);
}

function verify() {
    var vcode = document.getElementById("vcode").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "admin_panel.php";
            } else {
                alert(text);
            }
        }
    };

    r.open("GET", "verifyProccess.php?vcode=" + vcode, true);
    r.send();
}

var mm;

function viewMsgModel() {
    var m = document.getElementById("viewmsgmodel");
    mm = new bootstrap.Modal(m);
    mm.show();
}

var pm;

function viewProductModel(id) {
    var m = document.getElementById("viewproductdiv" + id);
    pm = new bootstrap.Modal(m);
    pm.show();
}

var cm;

function addNewCatogery() {
    var m = document.getElementById("addcatogerymodel");
    cm = new bootstrap.Modal(m);
    cm.show();
}

var cvm;

function catogeryVerifyModel() {
    var m = document.getElementById("addcatogeryverificationmodel");
    cvm = new bootstrap.Modal(m);
    cm.hide();
    cvm.show();
}

function productBlock(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            window.location = "manage_products.php";
        }
    };

    r.open("GET", "productBlockProccess.php?id=" + id, true);
    r.send();
}

function changeInvoiceId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == 1) {
                document.getElementById("btn" + id).innerHTML = "Packing";
            } else if (t == 2) {
                document.getElementById("btn" + id).innerHTML = "Dispatch";
            } else if (t == 3) {
                document.getElementById("btn" + id).innerHTML = "Shipping";
            } else if (t == 4) {
                document.getElementById("btn" + id).innerHTML = "Deliverd";
                document.getElementById("btn" + id).classList = "disabled";

            }
        }
    }

    r.open("GET", "changeInvoiceIdProcess.php?id=" + id, true);
    r.send();
}

function viewMessages(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("chat_box").innerHTML = t;
        }
    }

    r.open("GET", "viewMessagesProccess.php?email=" + email, true);
    r.send();

}

function sendMsg() {
    var reciver_mail = document.getElementById("rmail");
    var msg_txt = document.getElementById("msgTxt");

    var form = new FormData();
    form.append("r", reciver_mail.innerHTML);
    form.append("m", msg_txt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location = "massege.php";
            } else {
                alert(t);
            }


        }
    }

    r.open("POST", "sendMessagesProccess.php", true);
    r.send(form);

}

function saveFeed(id) {
    var type;

    if (document.getElementById("r1").checked) {
        type = 1;
    } else if (document.getElementById("r2").checked) {
        type = 2;
    } else if (document.getElementById("r3").checked) {
        type = 3;
    }

    var email = document.getElementById("e").value;
    var feedback = document.getElementById("f".value);

    var pid = id;

    var form = new FormData();
    form.append("t", type);
    form.append("e", email);
    form.append("f", feedback);
    form.append("i", pid);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "singleProductView.php?id=" + pid;
            } else {
                alert(text);
            }
        }
    }

    r.open("POST", "saveFeedbackProccess.php", true);
    r.send(form);
}