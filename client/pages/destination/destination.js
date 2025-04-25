import { destinationData } from "../../data.json";
console.log(destinationData, "destinationData");
const myDestination = document.querySelector(".my-destination-container");

let carouselIndex = 0;
const handleCarousel = (index) => {
  carouselIndex = index;
  renderCarousel();
};

console.log(destinationData, "destinationData");

const renderCarousel = () => {
  const item = destinationData[carouselIndex];
  const dotButtons = destinationData
    .map((item, i) => {
      return `<button onclick="handleCarousel(${i})" class="dot-element" style="borderBottom: ${
        carouselIndex === i ? "solid 2px" : "none"
      }">${item.title}</button>`;
    })
    .join("");
  const showOneElement = `
                <picture>
                  <source media="(min-width: 768px)" srcset="${item.srct}">
                  <source media="(min-width: 1280px)" srcset=${item.srcd}">
                  <img src="${item.srcm}" alt="${item.alt}" />
                </picture>
                <div class='body-container'>
                <div class="dot-container">
                  ${dotButtons}
                </div>
                <h2>${item.title}</h2>
                <p>${item.content}</p> 
                <div>
                <div class="">
                    <h4>AVG. DISTANCE</h4>
                    <span>${item.km} KM</span>
                </div>
                <div>
                    <h4>EST. TRAVEL TIME</h4>
                    <span>${item.days}</span>
                </div>
                </div>
                </div>
            `;
  myDestination.innerHTML = showOneElement;
};
window.addEventListener("DOMContentLoaded", function () {
  renderCarousel();
});
