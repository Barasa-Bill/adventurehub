<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdventureHub - Explore the World</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --deep-blue: #1A3E72;
            --ocean-teal: #2D9D9A;
            --sand-beige: #F5F0E6;
            --sunshine-yellow: #FFC857;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--sand-beige);
            color: #333;
            line-height: 1.6;
        }
        
        .nav {
            background-color: var(--deep-blue);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 0;
            padding: 0;
        }
        
        .nav li {
            margin: 0 15px;
        }
        
        .nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .nav a:hover {
            color: var(--sunshine-yellow);
            background-color: rgba(255,255,255,0.1);
        }
        
        h1, h2, h3 {
            color: var(--deep-blue);
            font-weight: 700;
        }
        
        h1 {
            text-align: center;
            margin: 2rem 0 1rem;
            font-size: 2.5rem;
        }
        
        h2 {
            text-align: center;
            margin: 3rem 0 2rem;
            font-size: 2rem;
            position: relative;
        }
        
        h2:after {
            content: "";
            display: block;
            width: 100px;
            height: 4px;
            background-color: var(--ocean-teal);
            margin: 10px auto;
        }
        
        .hero-text {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 3rem;
            font-size: 1.2rem;
            color: #555;
        }
        
        .package-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            padding: 0 2rem;
            margin-bottom: 4rem;
        }
        
        .package {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            max-width: 600px;
            width: 100%;
        }
        
        .package:hover {
            transform: translateY(-10px);
        }
        
        .package-images {
            display: flex;
            gap: 10px;
            padding: 10px;
            background-color: #f8f9fa;
        }
        
        .package-images img {
            width: 50%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }
        
        .package-images img:hover {
            transform: scale(1.03);
        }
        
        .package-content {
            padding: 1.5rem;
        }
        
        .package h3 {
            color: var(--ocean-teal);
            margin-bottom: 1rem;
        }
        
        .package p {
            margin-bottom: 1.5rem;
        }
        
        .price {
            font-weight: bold;
            color: var(--deep-blue);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            display: block;
        }
        
        .btn-book {
            background-color: var(--ocean-teal);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        
        .btn-book:hover {
            background-color: #24827f;
            color: white;
        }
        
        footer {
            background-color: var(--deep-blue);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        footer p {
            margin: 0;
        }
        
        @media (max-width: 768px) {
            .nav ul {
                flex-direction: column;
                align-items: center;
            }
            
            .nav li {
                margin: 5px 0;
            }
            
            .package {
                max-width: 100%;
            }
            
            .package-images {
                flex-direction: column;
            }
            
            .package-images img {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>    
            <li><a href="destinations.php">Destinations</a></li>
            
           
            <li><a href="login.php">Login</a></li>
        </ul>   
    </nav> 
    
    <div class="container">
        <h1>Welcome to AdventureHub</h1>
        <p class="hero-text">Your gateway to breathtaking destinations and unforgettable travel experiences. Explore our exclusive holiday packages tailored just for you!</p>
        
        <h2>Top Travel Packages</h2>
        
        <div class="package-container">
            <div class="package">
                <div class="package-images">
                    <a href="book.html"><img src="maldives.jpg" alt="Maldives Beach"></a>
                    <a href="book.html"><img src="maldives1.jpg" alt="Maldives Resort"></a>
                </div>
                <div class="package-content">
                    <h3>Exotic Beach Getaway - Maldives</h3>
                    <p>Relax on white sandy beaches, experience overwater bungalows, and enjoy crystal-clear waters.</p>
                    <span class="price">Price: $1,500 per person</span>
                    <a href="book.html" class="btn-book">Book Now <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="package">
                <div class="package-images">
                    <a href="book.html"><img src="kenya1.jpg" alt="Kenya Safari"></a>
                    <a href="book.html"><img src="kenya2.jpg" alt="Wildlife"></a>
                </div>
                <div class="package-content">
                    <h3>African Safari Adventure - Kenya</h3>
                    <p>Embark on a thrilling wildlife safari in the Masai Mara and witness the Great Migration.</p>
                    <span class="price">Price: $2,200 per person</span>
                    <a href="book.html" class="btn-book">Book Now <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="package">
                <div class="package-images">
                    <a href="book.html"><img src="paris1.jpg" alt="Paris"></a>
                    <a href="book.html"><img src="italy1.jpg" alt="Italy"></a>
                </div>
                <div class="package-content">
                    <h3>European Cultural Tour - France & Italy</h3>
                    <p>Explore Parisian landmarks, enjoy Italian cuisine, and visit historical sites.</p>
                    <span class="price">Price: $2,800 per person</span>
                    <a href="book.html" class="btn-book">Book Now <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <p>© 2025 AdventureHub| Your Journey, Our Priority</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>