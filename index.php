<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Font1|Font2&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <style>
        body,
        h1,
        h2,
        p {
            margin: 0;
            padding: 0;
        }

        .full-screen {
            font-family: Arial, sans-serif;
            background-image: url(blur2.jpg);
            color: #333;
            background-repeat: no-repeat;
            width: 100vw;
            padding: 20px;
            height: 100vh;

        }

        .full-screen {
            height: 100vh;
        }

        header {
            background-color: #ddd;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #7098da;
        }

        h1 {
            font-size: 36px;
        }

        nav ul {
            list-style: circle;
        }

        nav li {
            display: inline;
            margin-right: 10px;
        }

        nav a {
            text-decoration: none;
            color: #7098da;
            font-weight: bold;
            transition: color 0.3s;
            font-family: Georgia, serif;
            padding: 5px;
        }

        nav a:hover {
            color: #ff6600;
        }

        .hero {
            text-align: center;
            padding: 100px 0;
            color: #7098da;
        }

        h2 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .hero-button:hover {
            background-color: #e65200;
        }

        .feature i {
            font-size: 24px;
            margin-right: 10px;
            color: #0078d4;
        }

        .features {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-around;
        }

        .feature {
            flex: 0 1 calc(33.33% - 20px);
            margin: 20px;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            background: linear-gradient(45deg, #fff 50%, #ddd 50%);
        }

        .feature h3 {
            font-size: 24px;
            margin: 10px 0;
        }

        .feature p {
            font-size: 22px;
            font: weight 50px;
            font-family: Georgia, serif;
        }

        .about {
            background-color: #f7f7f7;
            padding: 80px;
            text-align: left;
            position: relative;
            height: 100vh;
            background-repeat: no-repeat;
        }

        .about h2 {
            font-size: 36px;
        }

        .about p {
            font-size: 20px;
            margin-top: 20px;
        }



        .image-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            height: 100vh;
            background: linear-gradient(45deg, #f7f7f7 50%, #ddd 50%);
            transition: all 0.3s;
        }

        .image-container {
            flex: 1;
            text-align: center;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            margin: 10px;
            border-radius: 10px;
        }

        .image-3 {
            max-width: 1500px;
            height: auto;
            margin: 10px;
        }

        .feature-image {
            max-width: 300px;
            height: auto;
            margin: 10px;
            background-color: #7098da;
        }

        .image-5 {
            max-width: 200px;
            height: auto;
            margin: 10px;
        }

        .description-container {
            flex: 1;
            text-align: right;
            padding: 20px;
        }

        .description-container h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: right;
        }

        .description-container p {
            margin-bottom: 10px;
            text-align: right;
            font-family: Georgia, serif;
            font-size: 20px;
            max-width: 800px;
        }

        .feature-image img {
            width: 100%;
            height: 100%;
            margin: 10px;
        }

        .about-features {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            height: 100vh;
            background: linear-gradient(45deg, #f7f7f7 50%, #ddd 50%);
            transition: all 0.3s;
        }

        .feature-image img {
            max-width: 300px;
            height: auto;
            margin: 10px;
            transition: all 0.3s;
        }

        .feature-text {
            flex: 1;
            padding: 20px;
            text-align: right;
            transition: all 0.3s;
        }

        .feature-text h2 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: right;
        }

        .feature-text p {
            font-size: 18px;
            margin-bottom: 10px;
            text-align: right;
            font-family: 'Font1', sans-serif;
        }

        .read-more {
            text-decoration: none;
            color: #0078d4;
            font-weight: bold;
            transition: color 0.3s;
            margin-top: 10px;
            display: inline-block;
            margin-left: 20px;
        }

        .read-more:hover {
            color: #e65200;
        }

        .about {
            background: linear-gradient(45deg, #f7f7f7 50%, #ddd 50%);
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .about-content {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100vh;
            justify-content: center;
            flex: 1;
            padding: 20px;
        }

        .about-text h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .about-text p {
            font-size: 20px;
            max-width: 800px;
            font-family: Georgia, serif;
        }

        .about-image {
            flex: 1;
        }

        .about-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background: linear-gradient(45deg, #f7f7f7 50%, #ddd 50%);
            color: black;
            padding: 20px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .footer div {
            margin: 10px;
            flex: 1;
        }

        .navbar-links a {
            color: black;
            text-decoration: none;
            font-family: Arial, sans-serif;
        }

        .social-media a {
            color: black;
            text-decoration: none;
            margin: 5px;
        }

        .about-us p {
            font-family: Arial, sans-serif;
        }

        .contact-us p {
            font-family: Arial, sans-serif;

        }
    </style>
    <title>PTA Website</title>
</head>

<body>
    <header>
        <div class="header-container">
            <h1>Parent's Teacher's Association</h1>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Programs</a></li>
                    <li><a href="#Aboutus">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="full-screen">
        <div class="hero">
            <h2>Welcome to PTA</h2>
            <p>Join us in supporting students' education</p>
        </div>

        <div class="features">
            <div class="feature">
                <h3><i class="icon fa fa-graduation-cap"></i>Parent and Teacher collabration</h3>
                <p> PTAs promote collaboration and communication between parents and teachers. </p>
                <a href="#Aboutus" class="read-more">Read More</a>
            </div>

            <div class="feature">
                <h3><i class="icon fa fa-university"></i>Support for Education</h3>
                <p> PTAs often organize various activities and initiatives to support the educational institution.</p>
                <a href="#Aboutus" class="read-more">Read More</a>
            </div>

            <div class="feature">
                <h3><i class="icon fa fa-globe"></i>Community Engagement</h3>
                <p> PTAs often extend their efforts to engage the broader community. </p>
                <a href="Aboutus" class="read-more">Read More</a>
            </div>
        </div>
    </div>
    <div class="image-section">
        <div class="image-container">
            <div class="image-3">
                <img src="5.jpg" alt="Image 1" />
            </div>
        </div>
        <div class="description-container">
            <h2>A few words abour our Association</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error rem iusto voluptate ipsa? Tempora,
                voluptatem necessitatibus mollitia, consequuntur omnis illo impedit, quia similique corporis
                voluptatibus deleniti incidunt consequatur autem ipsam?</p>
            <p></p>
            <p></p>
        </div>
    </div>
    </div>


    <div class="about" id="Aboutus">
        <div class="about-content">
            <div class="about-text">
                <h2>About P.T.A</h2>
                <p>The Parent’s Teacher’s Association Website is an integral and exclusive component of College
                    infrastructure, serving as the central hub for managing student data and enabling seamless
                    communication among administrators, teachers, and parents within our college community. This
                    dedicated platform is tailored to meet the specific needs and objectives of College, providing a
                    comprehensive solution for efficient data management, communication, and enhancing the overall
                    educational experience for our students.</p>
            </div>
            <div class="about-image">
                <img src="4.jpg" alt="About Us Image">
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="about-us">
                <h3>About Us</h3>
                <p>The College Management System project aims to create a seamless and efficient platform for college
                    administrators, teachers, and parents to manage and access crucial academic information.
                </p>
            </div>

            <div class="links">
                <h3>Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="social-media">
                <h3>Social Media</h3>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

            <div class="contact-us">
                <h3>Contact Us</h3>
                <p><i class="fas fa-phone"></i>Email: pta123@example.com</p>
                <p><i class="far fa-envelope"></i>Phone: 123456789</p>
            </div>
        </div>
    </footer>
</body>

</html>