let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');

}


const roleTitleElement = document.getElementById("roleTitle");
const roleTitles = ["Role Finder", "Role Changer", "Role Improver"];
let currentIndex = 0;
const delay = 3000;

function switchRoleTitle() {
    roleTitleElement.classList.remove("fade-in");
    setTimeout(() => {
        roleTitleElement.classList.add("fade-in");
        setTimeout(() => {
            roleTitleElement.addEventListener('transitionend', function(event) {
                roleTitleElement.style.visibility = "hidden";
                roleTitleElement.textContent = roleTitles[currentIndex];
                roleTitleElement.style.visibility = "visible";
                currentIndex = (currentIndex + 1) % roleTitles.length;
            }, { once: true });
        }, 250);
    }, 500);
}

setInterval(switchRoleTitle, delay);