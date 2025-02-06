import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import BlogDashboard from "./components/BlogDashboard";

function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<BlogDashboard />} />
            </Routes>
        </Router>
    );
}

ReactDOM.createRoot(document.getElementById("app")).render(<App />);
