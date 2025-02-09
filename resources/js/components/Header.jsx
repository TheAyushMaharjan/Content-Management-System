import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Header() {
    const [header, setHeader] = useState(null);  // Initialize header state as null

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/setting/headerDisplay')
            .then((response) => {
                console.log('Response Data:', response.data);
                const data = response.data;  // Assuming response.data is an object, not an array
                if (data) {
                    setHeader(data);  // Set the header data into the state
                }
            })
            .catch((error) => {
                console.error('There was an error fetching the data!', error);
            });
    }, []);

    if (!header) {
        return null; // If no header data is available, render nothing
    }

    return (
        <>
            <div className="component bg-black">
                <div className="container flex items-center p-2 "> {/* Added padding here */}
                    <div className="1 px-8">
                        <p className="email text-[#fffff5]">Email: {header.email}</p>
                    </div>
                    <div className="2">
                        <p className="contact text-[#fffff5]">Contact: {header.contact}</p>
                    </div>
                </div>
            </div>
        </>
    );
}

export default Header;
