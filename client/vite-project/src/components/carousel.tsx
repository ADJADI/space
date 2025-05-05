import React, { useState, useEffect } from "react";
import useDataSpace from "../hooks/dataSpace";
import { Destination, CrewMember, Technology } from "../types/data";
import "../styles/carousel.css";

interface CarouselProps {
  type: "destinations" | "crew" | "technology";
}

export default function Carousel({ type }: CarouselProps) {
  const [currentIndex, setCurrentIndex] = useState(0);
  const { data, loading, error, changeType } = useDataSpace();

  useEffect(() => {
    changeType(type);
  }, [type, changeType]);

  useEffect(() => {
    setCurrentIndex(0);
  }, [data]);

  if (loading)
    return (
      <div className="flex justify-center items-center h-40">Loading...</div>
    );
  if (error) return <div className="text-red-500">Error: {error}</div>;
  if (!data || data.length === 0) return <div>No data available</div>;

  const handleNext = () => {
    setCurrentIndex((prevIndex) => (prevIndex + 1) % data.length);
  };

  const handlePrev = () => {
    setCurrentIndex((prevIndex) => (prevIndex - 1 + data.length) % data.length);
  };

  const renderContent = () => {
    const currentItem = data[currentIndex];

    if (!currentItem) return null;

    if (type === "destinations") {
      const item = currentItem as Destination;
      return (
        <div className="carousel-item">
          <img src={item.srcm} alt={item.alt || item.title} />
          <h2>{item.title}</h2>
          <p>{item.content}</p>
          <div className="flex justify-between mt-4">
            <div>
              <p className="text-sm text-gray-500">AVG. DISTANCE</p>
              <p className="text-xl">{item.km}</p>
            </div>
            <div>
              <p className="text-sm text-gray-500">EST. TRAVEL TIME</p>
              <p className="text-xl">{item.days}</p>
            </div>
          </div>
        </div>
      );
    }

    if (type === "crew") {
      const item = currentItem as CrewMember;
      return (
        <div className="carousel-item">
          <img src={item.srcm} alt={item.alt || item.title} />
          <p className="text-gray-500">{item.subtitle}</p>
          <h2>{item.title}</h2>
          <p>{item.content}</p>
        </div>
      );
    }

    if (type === "technology") {
      const item = currentItem as Technology;
      return (
        <div className="carousel-item">
          <img src={item.srcm} alt={item.alt || item.title} />
          <p className="text-gray-500">{item.subtitle}</p>
          <h2>{item.title}</h2>
          <p>{item.content}</p>
        </div>
      );
    }

    return null;
  };

  return (
    <div className="carousel-container my-8">
      <div className="relative">
        {renderContent()}

        <div className="flex justify-center mt-4 space-x-2">
          {data.map((_, index) => (
            <button
              key={index}
              onClick={() => setCurrentIndex(index)}
              className={`w-3 h-3 rounded-full ${
                index === currentIndex ? "bg-white" : "bg-gray-400"
              }`}
              aria-label={`Go to slide ${index + 1}`}
            />
          ))}
        </div>

        <div className="flex justify-between mt-4">
          <button
            onClick={handlePrev}
            className="bg-gray-800 text-white px-4 py-2 rounded"
            aria-label="Previous slide"
          >
            Prev
          </button>
          <button
            onClick={handleNext}
            className="bg-gray-800 text-white px-4 py-2 rounded"
            aria-label="Next slide"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  );
}
