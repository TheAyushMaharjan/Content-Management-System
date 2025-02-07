import React, { useEffect, useState } from 'react';
import axios from 'axios';

function BlogDashboard() {
  const [blogSetup, setBlogSetup] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');

  // Fetch blog setup data when component mounts.
  useEffect(() => {
    axios.get('http://127.0.0.1:8000/blogSetup/frontDisplay')
      .then((response) => {
        console.log('Response Data:', response.data); 
        const blogsData = response.data.data;  
        if (Array.isArray(blogsData) && blogsData.length > 0) {
          setBlogSetup(blogsData);
        } else {
          setError('No blog data available');
        }
      })
      .catch((err) => {
        console.log('Error fetching data:', err);  
        setError(err.message || 'Error fetching data');
      })
      .finally(() => setLoading(false));
  }, []);

  if (loading) return <div className="flex justify-center items-center h-screen">Loading blog setup...</div>;
  if (error) return <div className="text-red-500 text-center font-bold my-10">{error}</div>;

  return (
    <div className="container mx-auto px-8 py-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      {blogSetup && blogSetup.length > 0 ? (
        blogSetup.map((blog, index) => (
          <div 
            key={index} 
            className="bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer"
          >
            <div className=" bg-gray-100 p-4">
              <h2 className="text-2xl font-bold text-gray-800 mb-2">{blog.title}</h2>
              <p className="text-gray-500 text-sm mb-4">{`Author: ${blog.author}`}</p>
            </div>
            <div className="p-4">
              {blog.image && (
                <img 
                  className="object-cover w-full h-64 rounded-lg mx-auto my-4" 
                  src={blog.image} 
                  alt={blog.title} 
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
        <div className="text-gray-500 text-center font-bold my-10">
          No blogs available
        </div>
      )}
    </div>
  );
}

export default BlogDashboard;