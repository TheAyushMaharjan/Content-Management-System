import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Hero() {
    const [gallerySetup, setGallerySetup] = useState([]);  // Holds gallery data
    const [error, setError] = useState(null);  // To capture any errors
    const [currentIndex, setCurrentIndex] = useState(0);  // To track current image index

    // Fetch gallery data and cache it in localStorage
    useEffect(() => {
        const cachedData = localStorage.getItem('galleryData');
        if (cachedData) {
            setGallerySetup(JSON.parse(cachedData));  // Use cached data if available
        } else {
            axios.get('http://127.0.0.1:8000/gallerySetup/galleryDisplay')
                .then((response) => {
                    const data = response.data.data;
                    if (Array.isArray(data) && data.length > 0) {
                        setGallerySetup(data);
                        localStorage.setItem('galleryData', JSON.stringify(data));  // Cache the data
                    } else {
                        setError('No data available');
                    }
                })
                .catch((err) => {
                    console.error('Error fetching data:', err);
                    setError('Failed to load data');
                });
        }
    }, []);

    // Auto-slide the gallery content
    useEffect(() => {
        if (gallerySetup.length > 0) {
            const interval = setInterval(() => {
                setCurrentIndex((prevIndex) => (prevIndex + 1) % gallerySetup.length);
            }, 5000);

            return () => clearInterval(interval);  // Clean up interval on unmount
        }
    }, [gallerySetup]);

    // If there's no gallery data or there's an error, show the error message
    if (error) {
        return <p className="text-red-500 text-center font-bold text-lg w-full">{error}</p>;
    }

    // Render the gallery content
    return (
        <div name='home' className="w-full h-[80vh] flex items-center justify-center bg-gradient-to-b from-[#454839] to-black p-8">
            {gallerySetup.length > 0 && (
                <div className="column flex">
                    <div className="flex flex-col md:flex-row max-w-6xl w-full h-full items-center gap-8">
                        <div className="flex md:w-2/3 flex-col gap-4 p-1"> 
                            <div className="text-left">
                                <h2 className="text-4xl font-bold text-gray-100">
                                    {gallerySetup[currentIndex].title}
                                </h2>
                            </div>
                            <div className="text-left">
                                <p className="text-2xl text-gray-100">
                                    {gallerySetup[currentIndex].slug}
                                </p>
                            </div>
                
                            {/* Button positioned below the title */}
                            <div className="btn mt-4"> 
                                <button className="bg-[#00d5e7] text-white px-6 py-2 rounded-md hover:bg-[#009db0] transition-colors duration-300">
                                    Contact Us
                                </button>
                            </div>
                        </div>
                
                        <div className="flex-1 flex justify-center items-center">
                            {/* Lazy loading image */}
                            {gallerySetup[currentIndex].image && (
                                <img
                                    className="w-full md:w-100 rounded-lg object-cover"
                                    src={gallerySetup[currentIndex].image}
                                    alt={gallerySetup[currentIndex].title}
                                    loading="lazy"  // Lazy load the image
                                />
                            )}
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}

export default Hero;
