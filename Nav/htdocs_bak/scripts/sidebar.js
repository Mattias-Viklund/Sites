let sidebarOpen = "no";
function saveState() {
  localStorage.setItem("sidebarOpen", sidebarOpen);

}

function loadState() {
  let sidebarState = localStorage.getItem("sidebarOpen");
  if (sidebarState == null)
    return;

  if (sidebarState == "yes")
    setState("open");
  else if (sidebarState == "no")
    setState("closed");

}   

function setState(open) {
  if (open === "open") {
    openNav();
    sidebarOpen = "yes";

  }
  else if (open === "closed") {
    closeNav();
    sidebarOpen = "no";

  }
  saveState(sidebarOpen);

}

function toggleNav() {
  if (sidebarOpen == "yes") {
    setState("closed");

  } else {
    setState("open");

  }
}

var sidebarSize="250px";

function openNav() {
  document.getElementById("sidebar").style.width = sidebarSize;
  document.getElementById("main").style.marginLeft = sidebarSize;
  document.getElementById("openbtn").style.left = sidebarSize;

}

function closeNav() {
  document.getElementById("sidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.getElementById("openbtn").style.left = "0";

}

loadState();