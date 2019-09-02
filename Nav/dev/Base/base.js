let logo = "<img src='../Images/title.png' id='title' />";
let footer = "Created and maintained by <a href='https://steamcommunity.com/id/zeseductivebanana' style='text-decoration: none; color: #C6C2BA;'>Mew_</a>";

let topNavOuter = [
    "<a href='index.html'>Home</a>",
    "<a href=''>Tools</a>",
    "<a href=''>Files</a>",
    "<a href='games.html'>Games</a>",
    "<a href=''>Upload</a>",
    "<a href='admin/admin.php' style='float: right'>Admin</a>",
    "<a href='' style='float: right'>About</a>"
];

function GenerateFooter() {
    document.getElementById('footer').innerHTML = footer;

}

function GenerateLogo() {
    document.getElementById('logo').innerHTML = logo;

}

function GenerateNavbar() {
    let navbar = document.getElementById('navbar');

    for (let i = 0; i < topNavOuter.length; i++) {
        var node = document.createElement("a", topNavOuter[i], ""   );
        navbar.append(node);

        node.outerHTML = topNavOuter[i];

    }
}

GenerateFooter();
GenerateLogo();
GenerateNavbar();