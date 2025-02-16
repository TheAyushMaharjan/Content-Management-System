import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Header() {
    const [header, setHeader] = useState(null);

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/setting/headerDisplay')
            .then((response) => {
                console.log('Response Data:', response.data);
                const data = response.data;
                if (data) {
                    setHeader(data);
                }
            })
            .catch((error) => {
                console.error('There was an error fetching the data!', error);
            });
    }, []);

    if (!header) {
        return null;
    }

    return (
        <div className="bg-gradient-to-r from-[#2b2b2b] to-[#454839] text-white">
            <div className="container flex justify-between items-center p-4 mx-auto">
                <div className="px-8 text-sm font-light">
                    <p>Email: <span className="text-[#a8b8a4]">{header.email}</span></p>
                </div>
                <div className="px-8 text-sm font-light">
                    <p>Contact: <span className="text-[#a8b8a4]">{header.contact}</span></p>
                </div>
            </div>
        </div>
    );
}

export default Header;
