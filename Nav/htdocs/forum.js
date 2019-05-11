let sidebarOpen = false;

function saveState(){
  localStorage.setItem("sidebarOpen", sidebarOpen);

}

function loadState(){
  let sidebarState = localStorage.getItem("sidebarOpen");
  if (sidebarState == null)
  {
    setState(false);
    return true;

  }
  setState(sidebarState);

}

function setState(open){
  console.log(open);
  if (open === "true") {
    openNav();
    sidebarOpen = true;

  }
  else if (open === "false") {
    closeNav();
    sidebarOpen = false;

  }
  saveState(sidebarOpen);

}

function toggleNav() {
  if (sidebarOpen)
  {

  } else {
    
  }
}

function openNav() {
  document.getElementById("sidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.getElementById("openbtn").style.left = "250px";

}

function closeNav() {
  document.getElementById("sidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.getElementById("openbtn").style.left = "0";

}

loadState();