import { readFile } from "fs/promises";

const crewData = JSON.parse(
  await readFile(new URL("../../data.json", import.meta.url))
);

const myCrew = document.querySelector(".my-crew-container");
let carouselIndex = 0;
const handleCarousel = (index) => {
  carouselIndex = index;
  renderCarousel();
};
const renderCarousel = () => {
  const item = crewData[carouselIndex];
  const dotButtons = crewData
    .map((_, i) => {
      return `<button onclick="handleCarousel(${i})" class="dot-element" style="background-color: ${
        carouselIndex === i ? "white" : "gray"
      }"></button>`;
    })
    .join("");
  const showOneElement = `
            <div class='picture-container'>
              <picture>
                <source media="(min-width: 768px)" srcset="${item.srct}">
                <source media="(min-width: 1280px)" srcset=${item.srcd}">
                <img src="${item.srcm}" alt="${item.alt}" />
              </picture>
            </div>
          <div>
              <div class="dot-reverse-container">
                <div class="dot-container">
                  ${dotButtons}
                </div>
                <h3>${item.subtitle}</h3>
                <h2>${item.title}</h2>
                <p>${item.content}</p>
              </div>
           </div>

        `;
  myCrew.innerHTML = showOneElement;
};
window.addEventListener("DOMContentLoaded", function () {
  renderCarousel();
});
