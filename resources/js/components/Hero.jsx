import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Hero() {
    const [gallerySetup, setGallerySetup] = useState([]);
    const [error, setError] = useState(null);
    const [currentIndex, setCurrentIndex] = useState(0);

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/gallerySetup/galleryDisplay')
            .then((response) => {
                console.log('Response Data:', response.data);
                const data = response.data.data; 
                if (Array.isArray(data) && data.length > 0) {
                    setGallerySetup(data);
                } else {
                    setError('No data available');
                }
            })
            .catch((err) => {
                console.error('Error fetching data:', err);
                setError('Failed to load data');
            });
    }, []);

    useEffect(() => {
        if (gallerySetup.length > 0) {
            const interval = setInterval(() => {
                setCurrentIndex((prevIndex) => (prevIndex + 1) % gallerySetup.length);
            }, 5000); 

            return () => clearInterval(interval);
        }
    }, [gallerySetup, currentIndex]);

    return (
        <div className="w-full h-[80vh] flex items-center justify-center bg-white p-8">
            {error ? (
                <p className="text-red-500 text-center font-bold text-lg w-full">
                    {error}
                </p>
            ) : (
                gallerySetup.length > 0 && (
                    <div className="flex flex-col md:flex-row max-w-6xl w-full h-full items-center gap-8">
                        <div className="flex md:w-2/3 flex-col gap-1 p-1">
                            <div className="text-left">
                                <h2 className="text-4xl font-bold">
                                    {gallerySetup[currentIndex].title}
                                </h2>
                            </div>
                            <div className="text-left">
                                <p className="text-2xl">
                                    {gallerySetup[currentIndex].slug}
                                </p>
                            </div>
                        </div>
                        <div className="flex-1 flex justify-center items-center">
                            {gallerySetup[currentIndex].image && (
                                <img 
                                    className="w-full md:w-100 rounded-lg object-cover"
                                    src={gallerySetup[currentIndex].image} 
                                    alt={gallerySetup[currentIndex].title} 
                                />
                            )}
                        </div>
                    </div>
                )
            )}
        </div>
    );
}

export default Hero;