import { technologyData } from "../../data.json";

const myTechnology = document.querySelector(".my-technology-container");

let carouselIndex = 0;
const handleCarousel = (index) => {
  carouselIndex = index;
  renderCarousel();
};

const renderCarousel = () => {
  const item = technologyData[carouselIndex];
  const dotButtons = technologyData
    .map((_, i) => {
      return `<button onclick="handleCarousel(${i})" class="dot-element" style="color:${
        carouselIndex === i ? "black" : "white"
      } ;background-color: ${carouselIndex === i ? "white" : "transparent"}">${
        i + 1
      }</button>`;
    })
    .join("");
  const showOneElement = `
            <div>
            <picture>
              <source media="(min-width: 48rem)" srcset="${item.srct}">
              <source media="(min-width: 80rem)" srcset=${item.srcd}">
              <img src="${item.srcm}" alt="${item.alt}" />
            </picture>
            </div>
          <div>
              <div class="dot-reverse-container">
                <div class="dot-container">
                  ${dotButtons}
                </div>
                <div>
                    <h3>${item.subtitle}</h3>
                    <h2>${item.title}</h2>
                    <p>${item.content}</p>
                </div>
              </div>
           </div>
          `;
  myTechnology.innerHTML = showOneElement;
};
window.addEventListener("DOMContentLoaded", function () {
  renderCarousel();
});
