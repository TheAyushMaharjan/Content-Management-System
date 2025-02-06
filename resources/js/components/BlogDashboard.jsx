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
        console.log('Response Data:', response.data); // Log response data
        const blogsData = response.data.data;  // Access 'data' directly, not 'blogsData'
        if (Array.isArray(blogsData) && blogsData.length > 0) {
          setBlogSetup(blogsData);
        } else {
          setError('No blog data available');
        }
      })
      .catch((err) => {
        console.log('Error fetching data:', err);  // Log the error details
        setError(err.message || 'Error fetching data');
      })
      .finally(() => setLoading(false));
  }, []);

  if (loading) return <div>Loading blog setup...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="dashboard">
      {blogSetup && blogSetup.length > 0 ? (
        blogSetup.map((blog, index) => (
          <div key={index} className="card">
            <div className="card-header">
              <h2>{blog.title}</h2>
              <p className="author">Author: {blog.author}</p>
            </div>
            <div className="card-body">
              <p className="slug">{blog.slug}</p>
              <div className="content">
                <p>{blog.content}</p>
              </div>
              {blog.image && (
            <img className="blog-image" src={blog.image} alt={blog.title} />
)}

            </div>
            <div className="card-footer">
              <button>Read More</button>
            </div>
          </div>
        ))
      ) : (
        <div>No blogs available</div>
      )}
      
      <style>{`
        .dashboard {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          padding: 20px;
        }

        .card {
          width: 300px;
          margin: 20px;
          background-color: #fff;
          border-radius: 8px;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          overflow: hidden;
          transition: transform 0.3s ease-in-out;
        }

        .card:hover {
          transform: scale(1.05);
        }

        .card-header {
          background-color: #f5f5f5;
          padding: 20px;
          text-align: center;
        }

        .card-header h2 {
          margin: 0;
          font-size: 1.5rem;
          color: #333;
        }

        .card-header .author {
          margin: 10px 0;
          font-size: 1rem;
          color: #555;
        }

        .card-body {
          padding: 20px;
          color: #333;
        }

        .slug {
          font-style: italic;
          font-size: 1.1rem;
          margin-bottom: 10px;
          color: #777;
        }

        .content {
          font-size: 1rem;
          line-height: 1.5;
          margin-bottom: 20px;
        }

        .blog-image {
          width: 100%;
          height: auto;
          border-radius: 8px;
          margin-top: 15px;
        }

        .card-footer {
          background-color: #f5f5f5;
          padding: 10px;
          text-align: center;
        }

        .card-footer button {
          background-color: #007bff;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s;
        }

        .card-footer button:hover {
          background-color: #0056b3;
        }
      `}</style>
    </div>
  );
}

export default BlogDashboard;
