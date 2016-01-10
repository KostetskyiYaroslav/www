/**
 * Created by HP on 20.11.2015.
 */
function validateName(){
    var $first = document.getElementById("userFName").value;
    if($first == "" || $first.length <= 4 ){
        document.getElementById("userFName").style.background="red";
    }
}

function createUser(){
    var firstName = document.getElementById("first-name").value;
    var lastName = document.getElementById("last-name").value;
    var userLogin = document.getElementById("user-login").value;
    var userPassword = document.getElementById("user-password").value;

    $.ajax({
        type: "PUT",
        url: "../include/Controller/UserController.php?firstName="+firstName+"&lastName="+lastName+"&login="+userLogin+"&password="+userPassword
    });

    window.alert("You have successfully signed up!");
    window.location.replace("../html/login.html");
}

function createSubscription() {
    var receiver = document.getElementById("subscription-receiver").value;
    var type = document.getElementById("subscription-type").value;

    $.ajax({
        type: "PUT",
        url: "../include/Controller/SubscriptionController.php?receiver="+receiver+"&type="+type
    });

    window.alert("You have successfully subscribed!");
    window.location.replace("subscription_view.html");
}

function authorization(){
    var login = document.getElementById("user-login").value;
    var password   = document.getElementById("user-password").value;

    $.ajax({
        type: "GET",
        url: "../include/Controller/UserLoginController.php?logout=false&login="+login+"&password="+password
    });

    window.alert("Welcome, "+login+"!");
    window.location.replace("../html/index.html");
}

function logout(){

    $.ajax({
        type:"GET",
        url: "../include/Controller/UserLoginController.php?logout=true"
    });
    window.location.replace("../html/login.html");
}

function confirmLogOut(){

    var r = window.confirm("Are you really want Log Out?");

    if (r == true)
        logout();
    
}

function getJsonData(){

    var subscriptions = null;

    var request = $.ajax({
        type: "GET",
        url: "../include/Controller/SubscriptionController.php"
    }).done(function (data) {

        subscriptions = JSON.parse(data);
        var $numbObject = Object.keys(subscriptions).length;

        if($numbObject >= 2) {
            var i = 0;

            while ($numbObject != 0) {
                addRowInTable(subscriptions[i][0]);

                ++i;
                --$numbObject;
            }
        } else if($numbObject == 1) {

            addRowInTable(subscriptions[0]);

        } else
            alert("No subscriptions found!");

    });
}

function addRowInTable(subscription) {

    if(subscription){
        var id          = subscription.id;
        var type        = subscription.type;
        var receiver    = subscription.receiver;
        var status      = subscription.status;

      /*  var $newReceiver = document.getElementById('new-receiver').value;
        var $newType = document.getElementById('new-type').value;*/

        var style = "btn-floating btn-small waves-effect waves-light red";

        $('.table-body.subscription').append('<tr>'         +
            '<th id="id"> '         + id        + '</th>'   +
            '<th id="receiver">'    + receiver  + '</th>'   +
            '<th id="type"> '       + type      + '</th>'   +
            '<th id="status">'      + status    + '</th>'   +
            '<th id="delete">'      +
                '<a class="' + style + '" onclick="confirmRemove(' + id + ')">' + '<i class="material-icons">delete</i>' + '</a>' +
            '</th>' +
            '<th id="update">' +
                '<a class="' + style + '" onclick="processUpdating(' + id + ')">' + '<i class="material-icons">system_update_alt</i>' + '</a>' +
            '</th>' +
            '</tr>' +
            '<tr id="subscription-update-' + id + '" hidden>' +
            '<th> </th>' +
            '<th id="new-receiver"> ' +
                '<input placeholder="' + receiver   + '" id="new-receiver" type="text" class="validate">' +
            '</th>' +
            '<th id="new-type"> ' +
                '<input placeholder="' + type       + '" id="new-type" type="text" class="validate">' +
            '</th>' +
                '<th> <a class="waves-effect waves-light btn-small" onclick="updateSubscription()">Update</a></th>>' +
            '</tr>'
            );
    }
}

function changeVisible(){
}

function processUpdating($id){
    document.getElementById("subscription-update-"+$id).style.visibility = "visible";

    var $newReceiver = document.getElementById("new-receiver").value;
    var $newType = document.getElementById("new-type").value;

    updateSubscription($id, $newReceiver, $newType);
}

function updateSubscription($id, $newReceiver, $newType){

    $.ajax({
        type: "OPTIONS",
        url: "../include/Controller/SubscriptionController?id=" + $id + "&receiver=" + $newReceiver + "&type=" + $newType
    });

    document.getElementById("subscription-update-"+$id).style.visibility = "hidden";
}

function confirmRemove($id){
    var choice = window.confirm("Are you really want delete this Subscribe?");

    if (choice == true) {
        removeSubscription($id);

    }
}

function removeSubscription($id){

    $.ajax({
        type: "DELETE",
        url: "../include/Controller/SubscriptionController.php?id=" + $id
    });
    getJsonData();
}