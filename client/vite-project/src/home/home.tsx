import React from "react";
import Carousel from "../components/carousel";
import "../styles/home.css"; // Make sure to create this file if it doesn't exist

export default function Home() {
  return (
    <div className="home-container">
      <section className="hero-section py-10">
        <div className="container mx-auto px-4">
          <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-center mb-8">
            SPACE TOURISM
          </h1>
          <p className="text-center max-w-3xl mx-auto mb-12">
            Embark on a journey beyond Earth with our premium space tours.
            Explore the wonders of our solar system like never before.
          </p>
        </div>
      </section>

      <section className="destination-section py-10 bg-gray-900">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl md:text-4xl font-bold text-center mb-8">
            DESTINATIONS
          </h2>
          <Carousel type="destinations" />
        </div>
      </section>

      <section className="crew-section py-10">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl md:text-4xl font-bold text-center mb-8">
            MEET YOUR CREW
          </h2>
          <Carousel type="crew" />
        </div>
      </section>

      <section className="technology-section py-10 bg-gray-900">
        <div className="container mx-auto px-4">
          <h2 className="text-3xl md:text-4xl font-bold text-center mb-8">
            SPACE TECHNOLOGY
          </h2>
          <Carousel type="technology" />
        </div>
      </section>
    </div>
  );
}
