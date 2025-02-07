import React from "react";
import ReactDOM from "react-dom/client";
import "./tailwind.css"; // Import the Tailwind CSS file

// import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import BlogDashboard from "./components/BlogDashboard";
import Hero from "./components/Hero";
import Nav from "./components/Nav";

function App() {
    return (
        <>
        <Nav/>
        <Hero/>
        <BlogDashboard/>
        </>
    );
}

ReactDOM.createRoot(document.getElementById("app")).render(<App />);
