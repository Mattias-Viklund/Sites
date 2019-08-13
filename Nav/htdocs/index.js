let logo = "<img src='images/title.png' id='title' />";
let footer = "Created and maintained by <a href='https://steamcommunity.com/id/zeseductivebanana' style='text-decoration: none; color: #C6C2BA;'>Mew_</a>";

let topNav = [
    "<a href='index.html'>Home</a>",
    "<a href=''>Files</a>",
    "<a href='games.html'>Games</a>",
    "<a href=''>Upload</a>",
    "<a href='admin/admin.php' style='float: right'>Admin</a>",
    "<a href='' style='float: right'>About</a>"];

function GenerateFooter() {
    document.getElementById('footerText').innerHTML = footer;

}

function GenerateLogo() {
    document.getElementById('logo').innerHTML = logo;

}

function GenerateNavbar() {
    let navbar = document.getElementById('navbar');

    for (let i = 0; i < topNav.length; i++)
    {
        navbar.appendChild(document.createElement("a", "", topNav[i]));

    }
}

GenerateFooter();
GenerateLogo();
GenerateNavbar();