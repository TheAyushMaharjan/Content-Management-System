import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Footer() {
  const [footer, setFooter] = useState(null); // Initialize footer state

  useEffect(() => {
    axios.get('http://127.0.0.1:8000/setting/headerDisplay')
      .then((response) => {
        console.log('Response data:', response.data);
        const data = response.data;
        if (data) {
          setFooter(data); // Set footer data directly without loading state
        }
      })
      .catch((error) => {
        console.error('There was an error fetching the data:', error);
      });
  }, []); // Empty dependency array ensures the data is fetched once on mount

  if (!footer) {
    return null; // If no footer data is available, render nothing
  }

    return (
        <>
            <div name='footer' className="frame bg-black">
                <div className="container mx-auto py-8 px-4">
                    <div className="element flex items-start p-4  text-white">

                        <div className="vision flex-1">
                                <p className="text-xl font-bold">Vision</p>
                              <div className="content">
                                <p>{footer.content}</p>
                            </div>
                        </div>

                        <div className="links flex-1 px-8">
                            <p className="head pb-1 text-xl font-semibold">Links</p>
                            <div className=" flex flex-col link-items space-y-2">
                                <a href="" className="home text-white hover:text-gray-400">Home</a>
                                <a href="" className="about text-white hover:text-gray-400">About</a>
                                <a href="" className="blog text-white hover:text-gray-400">Blog</a>
                                <a href="" className="contact text-white hover:text-gray-400">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </>
    )
}

export default Footer