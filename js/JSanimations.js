//Intro animation
const tl = gsap.timeline({ defaults: { ease: "power1.out" } });

tl.to(".text", { y: "0%", duration: 1, stagger: 0.25 });
tl.to(".slider", { y: "-100%", duration: 1.5, delay: 0.5 });
tl.to(".intro", { y: "-100%", duration: 1 }, "-=1.25");
tl.fromTo("header", { opacity: 0 }, { opacity: 1, duration: 0.75 });
tl.fromTo("#logo", { opacity: 0 }, { opacity: 1, duration: 0.75 }, "-=0.75");
tl.fromTo(".bigText", { opacity: 0 }, { opacity: 1, duration: 0.75, stagger: 0.5});
tl.fromTo(".button", { opacity: 0 }, { opacity: 1, duration: 0.75 }, "-=0.5");

//Hamburger menu animation
const hamburger = document.querySelector('#hamburger');
const navLinks = document.querySelector('.navLinks');
const links = document.querySelectorAll('.links');

hamburger.addEventListener("click", () => {
    navLinks.classList.toggle("open");
});

for (i = 0; i < links.length; i++) {
    links[i].addEventListener("click", () => {
        navLinks.classList.toggle("open");
    });
}
