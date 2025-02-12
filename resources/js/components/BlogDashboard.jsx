import React, { useEffect, useState } from 'react';
import axios from 'axios';

function BlogDashboard() {
  const [blogSetup, setBlogSetup] = useState(null);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(true);  // Added loading state
  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    const cachedData = localStorage.getItem('blogData');  // Fixed typo here
    if (cachedData) {
      setBlogSetup(JSON.parse(cachedData));
      setLoading(false);  // Set loading to false once data is retrieved from localStorage
    } else {
      axios
        .get('http://127.0.0.1:8000/blogSetup/frontDisplay')
        .then((response) => {
          const blogsData = response.data.data;
          if (Array.isArray(blogsData) && blogsData.length > 0) {
            setBlogSetup(blogsData);
            localStorage.setItem('blogData', JSON.stringify(blogsData));  // Cache data in localStorage
            setLoading(false);  // Set loading to false after data fetch
          } else {
            setError('No blog data available');
            setLoading(false);  // Set loading to false if no data
          }
        })
        .catch((err) => {
          console.log('Error fetching data:', err);
          setError('Error fetching data');
          setLoading(false);  // Set loading to false after error
        });
    }
  }, []);

  if (loading) {
    return <div className="flex justify-center items-center h-screen">Loading blog setup...</div>;  // Show loading state
  }
  
  if (error) {
    return <div className="text-red-500 text-center font-bold my-10">{error}</div>;  // Show error if data fetch fails
  }

  return (
    <div name="blog" className="w-full px-4 sm:px-8 bg-gradient-to-b from-black to-[#454839] py-8">
      {/* Title Section Centered Above */}
      <div className="flex justify-center mb-8">
        <h1 className="text-4xl font-semibold p-10 text-gray-100">Blogs</h1>
      </div>
  
      {/* Blog Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        {blogSetup && blogSetup.length > 0 ? (
          blogSetup.map((blog, index) => (
            <div
              key={index}
              className="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer"
            >
              <div className="bg-gray-100 p-4">
                <h2 className="text-2xl font-bold text-gray-800 mb-2">{blog.title}</h2>
                <p className="text-gray-500 text-sm mb-4">{`Author: ${blog.author}`}</p>
              </div>
              <div className="p-4">
                {blog.image && (
                  <img
                    className="object-cover w-full h-64 rounded-lg mx-auto my-4"
                    src={blog.image}
                    alt={blog.title}
                    loading="lazy"
                  />
                )}
              </div>
              <div className="bg-gray-100 p-4 border-t border-gray-200 text-right">
                <button className="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-800 transition-colors w-32">
                  Read More
                </button>
              </div>
            </div>
          ))
        ) : (
          <div className="text-gray-500 text-center font-bold my-10">No blogs available</div>
        )}
      </div>
    </div>
  );
  
}

export default BlogDashboard;
