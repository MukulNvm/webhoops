<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix  Mockup</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: white;
        }

        .header {
            background-color: #141414;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            width: 120px;
        }

        .header button {
            background-color: #e50914;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .hero {
            position: relative;
            height: 80vh;
            background: url('https://assets.nflxext.com/ffe/siteui/vlv3/8f36b1b2-5d38-44d3-a8a8-0a35b3010b32/582c5c64-a708-4e32-a2f8-c4d08f84dd88/IN-en-20230717-popsignuptwoweeks-perspective_alpha_website_medium.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero .content {
            color: white;
            max-width: 600px;
        }

        .hero .content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero .content p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .hero .content button {
            background-color: #e50914;
            color: white;
            padding: 15px 30px;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        .footer {
            background-color: #141414;
            padding: 40px;
            text-align: center;
            color: #757575;
        }

        .footer a {
            color: #757575;
            margin: 0 15px;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg" alt="Netflix Logo">
        <button>Sign In</button>
    </header>

    <section class="hero">
        <div class="content">
            <h1>Unlimited movies, TV shows, and more.</h1>
            <p>Watch anywhere. Cancel anytime.</p>
            <button>Get Started</button>
        </div>
    </section>

    <footer class="footer">
        <div>
            <a href="#">FAQ</a>
            <a href="#">Help Center</a>
            <a href="#">Terms of Use</a>
            <a href="#">Privacy</a>
        </div>
        <p>&copy; 2024 Netflix, Inc.</p>
    </footer>
</body>
</html>
