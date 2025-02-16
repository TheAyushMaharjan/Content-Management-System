import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Nav() {
  const [header, setHeader] = useState(null);

  useEffect(() => {
      const fetchData = async () => {
        try {
          const response = await axios.get('http://127.0.0.1:8000/setting/headerDisplay');
          console.log('Response Data:', response.data);
          const data = response.data;
          if (data && typeof data === 'object') {
            setHeader(data);
            localStorage.setItem('headerData', JSON.stringify(data));
          }
        } catch (error) {
          console.error('There was an error fetching the data!', error);
        }
      };

      fetchData();
  }, []);

  if (!header) {
    return null;
  }

  return (
    <nav className="bg-[#1f2323] text-white shadow-xl py-2">
      <div className="container mx-auto flex justify-between items-center">
        <div className="flex items-center">
          {header.image && (
            <img
              className="w-16 h-auto mr-4"
              src={header.image}
              alt="Header Logo"
              loading="lazy"
            />
          )}
          <p className="text-3xl font-semibold">{header.title}</p>
        </div>

        <div className="flex space-x-8">
          <a className="hover:text-[#aaad9b] transition duration-300 ease-in-out text-lg" href="/">Home</a>
          <a className="hover:text-[#aaad9b] transition duration-300 ease-in-out text-lg" href="/about">About</a>
          <a className="hover:text-[#aaad9b] transition duration-300 ease-in-out text-lg" href="/blogs">Blogs</a>
          <a className="hover:text-[#aaad9b] transition duration-300 ease-in-out text-lg" href="/contact">Contact</a>
        </div>
      </div>
    </nav>
  );
}


export default Nav;
