"use strict"

window.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                document.querySelectorAll(".menu__item a").forEach((link) => {
                    link.classList.toggle("menu__item_active", link.getAttribute("href").replace("#", "") === entry.target.id && link.getAttribute("href").replace("#", "") !== "welcome")
                })
            }
        })
    }, {
        threshold: 0.7
    })

    document.querySelectorAll("section").forEach((section) => {
        observer.observe(section)
    })

})

const header = document.querySelector('.header');
const firstSection = document.querySelector('.welcome');

const headerHeight = header.offsetHeight;

function handleScroll() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const sectionTop = firstSection.offsetTop;
    const sectionBottom = sectionTop + firstSection.offsetHeight;

    // Проверяем, пересекает ли верхняя часть экрана первую секцию
    if (scrollTop >= sectionTop && scrollTop < sectionBottom) {
        header.classList.remove('scrolled');
    } else {
        header.classList.add('scrolled');
    }
}



window.addEventListener('scroll', handleScroll);


