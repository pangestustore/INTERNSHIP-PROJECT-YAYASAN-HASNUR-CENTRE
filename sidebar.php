{
    width: 250px;
    background: #f8f9fa; /* Light background for a clean look */
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    height: 100%;
    overflow-y: auto;
}

.nav-item {
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.nav-item a {
    color: #343a40; /* Darker text for better contrast */
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 10px 15px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
    width: 100%;
}

.nav-item a:hover, .nav-item a.active {
    background-color: #007bff; /* Bright blue for hover/active */
    color: #ffffff; /* White text on hover/active */
}

.nav-item i {
    margin-right: 15px;
    font-size: 18px;
    color: #007bff; /* Accent color for icons */
    transition: color 0.3s;
}

.nav-item a:hover i, .nav-item a.active i {
    color: #ff8c00; /* Bright orange for an active state */
}

.nav-item span {
    font-size: 18px;
    font-weight: 500;
}
