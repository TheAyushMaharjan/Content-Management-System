import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Nav() {
  const [header, setHeader] = useState(null);  // Initialize header state as null

  useEffect(() => {
    // Check if the data is already in localStorage
    const cachedHeader = localStorage.getItem('headerData');
    if (cachedHeader) {
      setHeader(JSON.parse(cachedHeader));  // Use cached data if available
    } else {
      // Fetch the data if it's not cached
      const fetchData = async () => {
        try {
          const response = await axios.get('http://127.0.0.1:8000/setting/headerDisplay');
          console.log('Response Data:', response.data);

          const data = response.data;
          if (data && typeof data === 'object') {
            setHeader(data);  // Set the header data into the state
            // Cache the header data for future use
            localStorage.setItem('headerData', JSON.stringify(data));
          }
        } catch (error) {
          console.error('There was an error fetching the data!', error);
        }
      };

      fetchData();
    }
  }, []);

  if (!header) {
    return null; // If no header data is available, render nothing
  }

  return (
    <nav className="bg-[#454839] shadow-md py-1">
      <div className="container mx-auto flex justify-between items-center">
        <div className="right flex items-center">
          <div className="logo">
            {/* Display header image if it exists */}
            {header.image && (
              <img
                className="w-[30px] md:w-[50px] lg:w-[70px] h-auto"
                src={header.image}
                alt="Header Logo"
                loading="lazy"  // Lazy load the image
              />
            )}
          </div>
          <div className="title">
            <p className='title text-[#aaad9b] text-2xl'>{header.title}</p>
          </div>
        </div>




        <div className="links">
          <ul className="flex space-x-8">
            <li className="hover:text-[#aec762] text-[#f8fff8] transition duration-300 ease-in-out">
              <a href="/">Home</a>
            </li>
            <li className="hover:text-[#aec762] text-[#f8fff8] transition duration-300 ease-in-out">
              <a href="/about">About</a>
            </li>
            <li className="hover:text-[#aec762] text-[#f8fff8] transition duration-300 ease-in-out">
              <a href="/blogs">Blogs</a>
            </li>
            <li className="hover:text-[#aec762] text-[#f8fff8] transition duration-300 ease-in-out">
              <a href="/contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

export default Nav;
