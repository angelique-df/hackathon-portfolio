window.addEventListener("scroll", () => {

    let header = document.querySelector('header');
    let aboutElement = document.querySelector('h2#about')
    let aboutStart = aboutElement.offsetTop;
    let mobileScreenSize = window.matchMedia("(max-width: 768px)")
    let desktopScreenSize = window.matchMedia("(min-width: 768px)")

    if (desktopScreenSize.matches) { // If media query matches
        if (window.scrollY > aboutStart) {
            header.style.fontSize = "1.3em";
        } else {
            header.style.fontSize = "2em";
        }
    } else if (mobileScreenSize.matches) {
        if (window.scrollY > aboutStart) {
            header.style.fontSize = "1em";
        } else {
            header.style.fontSize = "1.3em";
        }
    }

});