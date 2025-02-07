import React from "react";

function Nav() {
  return (
    <nav className="bg-white shadow-md py-4">
      <div className="container mx-auto px-8 flex justify-between items-center">
        <div className="logo">
          <span className="text-3xl font-bold text-[#BD2B26]">Logo</span>
        </div>
        <div className="links">
          <ul className="flex space-x-8">
            <li className="hover:text-[#BD2B26] transition duration-300 ease-in-out">
              <a href="/">Home</a>
            </li>
            <li className="hover:text-[#BD2B26] transition duration-300 ease-in-out">
              <a href="/about">About</a>
            </li>
            <li className="hover:text-[#BD2B26] transition duration-300 ease-in-out">
              <a href="/blogs">Blogs</a>
            </li>
            <li className="hover:text-[#BD2B26] transition duration-300 ease-in-out">
              <a href="/contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}

export default Nav;