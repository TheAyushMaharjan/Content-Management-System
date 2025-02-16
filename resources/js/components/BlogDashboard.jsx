import React, { useEffect, useState } from 'react';
import axios from 'axios';

function BlogDashboard() {
  const [blogSetup, setBlogSetup] = useState(null);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(true);
  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    const cachedData = localStorage.getItem('blogData');
    if (cachedData) {
      setBlogSetup(JSON.parse(cachedData));
      setLoading(false);
    } else {
      axios
        .get('http://127.0.0.1:8000/blogSetup/frontDisplay')
        .then((response) => {
          const blogsData = response.data.data;
          if (Array.isArray(blogsData) && blogsData.length > 0) {
            setBlogSetup(blogsData);
            localStorage.setItem('blogData', JSON.stringify(blogsData));
            setLoading(false);
          } else {
            setError('No blog data available');
            setLoading(false);
          }
        })
        .catch((err) => {
          console.log('Error fetching data:', err);
          setError('Error fetching data');
          setLoading(false);
        });
    }
  }, []);

  if (loading) {
    return <div className="flex justify-center items-center h-screen text-lg font-medium text-white">Loading blogs...</div>;
  }

  if (error) {
    return <div className="text-red-500 text-center font-bold my-10">{error}</div>;
  }

  return (
    <div className="bg-gradient-to-b from-[#333] to-[#1f2323] py-8">
      <div className="text-center text-white mb-8">
        <h1 className="text-4xl font-semibold mb-6">Blogs</h1>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 px-6 md:px-16">
        {blogSetup.map((blog, index) => (
          <div key={index} className="bg-white shadow-xl rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer">
            <div className="bg-gray-100 p-4">
              <h2 className="text-2xl font-semibold text-gray-800">{blog.title}</h2>
              <p className="text-sm text-gray-600 mb-4">{`Author: ${blog.author}`}</p>
            </div>
            {blog.image && (
              <img className="object-cover w-full h-64 rounded-t-lg" src={blog.image} alt={blog.title} loading="lazy" />
            )}
            <div className="bg-gray-100 p-4 text-center">
              <button className="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-800 transition-colors">
                Read More
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default BlogDashboard;
