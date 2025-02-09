import React from "react";
import ReactDOM from "react-dom/client";
import "./tailwind.css"; // Import the Tailwind CSS file

// import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import BlogDashboard from "./components/BlogDashboard";
import Hero from "./components/Hero";
import Nav from "./components/Nav";
import Header from "./components/Header";
import Footer from "./components/Footer";

function App() {
    return (
        <>
        <Header/>
        <Nav/>
        <Hero/>
        <BlogDashboard/>
        <Footer/>
        </>
    );
}

ReactDOM.createRoot(document.getElementById("app")).render(<App />);
