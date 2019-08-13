function getComment(id, location){
    //Redirect to comment
    //console.log(window.location.hostname);
    console.log(location);
    console.log(window.location.href);
    window.location.href = "/comment?post="+id;

}