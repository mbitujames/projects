'use strict';

/* element toggle function */

const elemToggleFunc = function (elem) { elem.classList.toggle("active"); }

/* navbar toggle */

const navbar = document.querySelector("[data-navbar]");
const overlay = document.querySelector("[data-overlay]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");

const navElemArr = [overlay, navCloseBtn, navOpenBtn];

/* close navbar when click on any navbar link */

for (let i = 0; i < navbarLinks.length; i++) { navElemArr.push(navbarLinks[i]); }

/*add event on all elements for toggling navbar*/

for (let i = 0; i < navElemArr.length; i++) {
  navElemArr[i].addEventListener("click", function () {
    elemToggleFunc(navbar);
    elemToggleFunc(overlay);
  });
}

/* header active state */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {
  window.scrollY >= 400 ? header.classList.add("active")
    : header.classList.remove("active");
}); 
//code for filter functionality
function filterFunction() {
  const sortBy = document.getElementById("sortby").value;
  const propertyCards = document.querySelectorAll(".property-card");

  propertyCards.forEach((card) => {
    if (sortBy === "property-type") {
      card.style.display = "block";
    } else {
      if (card.dataset.propertyType === sortBy) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    }
  });
}
/* Js for the dropdown in profile*/
document.getElementById('dropdown-btn').addEventListener('click', function() {
  document.getElementById('dropdown-content').classList.toggle('show');
});

window.onclick = function(event) {
  if (!event.target.matches('.header-bottom-actions-btn')) {
    var dropdowns = document.getElementsByClassName('dropdown-content');
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
