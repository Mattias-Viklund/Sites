function isSubscribed() {
    let subscribed = document.getElementById("subscribed").title;
    let button = document.getElementById("subscribe");
    let ret = document.title;
    let sub = subscribed == "yes" ? "no" : "yes";

    if (subscribed == "yes") {
        button.innerText = "-Unsubscribe";
        subscribe = function(){
            console.log("Unsubscribed!");
            window.location.href = "../../subscribe.php?sub="+sub+"&ret="+ret;

        }
    } else {
        button.innerText = "+Subscribe";
        subscribe = function(){
            console.log("Subscribed!");
            window.location.href = "../../subscribe.php?sub="+sub+"&ret="+ret;

        }
    }
}

isSubscribed();