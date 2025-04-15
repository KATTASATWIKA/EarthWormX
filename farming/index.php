<?php
// Check if the "page" query parameter is set
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'login') {
        header("Location: login.php"); 
        exit();
    }
    if ($_GET['page'] === 'Newhere?') {
        header("Location: register.php"); 
        exit();
    }
    if ($_GET['page'] === 'Educational Resources') {
        header("Location: educationalresources.html"); 
        exit();
    }
}
?>

<!doctype html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, intial-scale=1">
<title>Custom Coding</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

<style>
  /*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
General Configurations
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/* {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

html {
  font: normal 16px sans-serif;
  color: #555;
}

ul,
nav {
  list-style: none;
}

.navbar {
  width: 100%;
  height: 4rem;
  background-color: rgba(9, 40, 5, 1.0);; /* Dark theme color */
  color: #fbfbfb; /* Light cream text */
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: fixed;
  top: 0; /* Set to 0 for correct positioning */
  left: 0; /* Ensure it stretches from the left */
  z-index: 3;
  padding: 0 2rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  animation: slideDown 1s ease-out forwards; /* Slide-down animation */
}

.navbar .title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #fbfbfb;
  text-transform: uppercase;
  transition: color 0.3s ease;
}

.navbar .title:hover {
  color: #d4af37; /* Gold on hover */
}

.navbar .links {
  display: flex;
  gap: 1.5rem;
}

.navbar .links a {
  text-decoration: none;
  color: #fbfbfb;
  padding: 0.5rem 1rem;
  transition: all 0.3s ease;
}

.navbar .links a:hover {
  background-color: #333;
  border-radius: 0.5rem;
  color: #d4af37; /* Gold on hover */
}

/* Optional: Add some padding to the top of the body to avoid overlap with the fixed navbar */
body {
  padding-top: 4rem; /* Adjust based on your navbar height */
}


  @keyframes slideDown {
    from {
      top: -4rem;
    }

    to {
      top: 0;
    }
  }


  section {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 100px;
  }

  /*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
Header Configurations
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

  header {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 10;
    width: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 35px 100px 0;
    -webkit-animation: 1s fadein 0.5s forwards;
    animation: 1s fadein 0.5s forwards;
    opacity: 0.5;
    color: white;
  }

  @-webkit-keyframes fadein {
    100% {
      opacity: 1;
    }
  }

  @keyframes fadein {
    100% {
      opacity: 1;
    }
  }

  header h2 {
    font-family: "Quicksand, sans-serif";
    color: white;
  }

  header nav {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-right: -15px;
  }

  header nav li {
    margin: 0 15px;
    color: white;
  }

  @media (max-width: 1000px) {
    header {
      padding: 20px 50px;
    }
  }


  @media (max-width: 700px) {
    header {
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      -ms-flex-direction: column;
      flex-direction: column;
    }

    header h2 {
      margin-bottom: 15px;
    }
  }



  /*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
Cover and Image Animation configuration
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/
  .hero {
    position: relative;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    min-height: 100vh;
    color: white;
  }

  .hero .background-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  z-index: -1;
  background-color: #0a0b0b;
  animation: 15s change 1s infinite forwards;
}

.hero .background-image::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Black with 50% opacity */
  z-index: 1; /* Ensure it overlays the background image */
}


  @keyframes change {
    0% {
      background-image: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);
    }

    25% {
      background-image: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);
    }

    50% {
      background-image: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);

    }

    75% {
      background-image: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);

    }

    100% {
      background-image: url(https://images.unsplash.com/photo-1498408040764-ab6eb772a145?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y3JvcHN8ZW58MHx8MHx8fDA%3D);

    }
  }

  .hero h1 {
    font: bold 60px "Open Sans", sans-serif;
    margin-bottom: 20px;
    color: white;
  }

  .hero h3 {
    font: normal 28px "Open Sans", sans-serif;
    margin-bottom: 40px;
    color: white;
  }

  .hero a.btn {
    padding: 20px 46px;
  }

  .hero-content-area {
    opacity: 0;
    margin-top: 100px;
    -webkit-animation: 1s slidefade 1s forwards;
    animation: 1s slidefade 1s forwards;
  }

  @-webkit-keyframes slidefade {
    100% {
      opacity: 1;
      margin: 0;
    }
  }

  @keyframes slidefade {
    100% {
      opacity: 1;
      margin: 0;
    }
  }


  .grid {
    width: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
  }

  hr {
    width: 100%;
    height: 2px;
    background-color: #3f51b5;
    border: 0;
    margin-bottom: 50px;
  }



  @media (max-width: 800px) {

    .hero {
      min-height: 600px;
    }

    .hero h1 {
      font-size: 52px;
    }

    .hero h3 {
      font-size: 18px;
    }

    .hero a.btn {
      padding: 15px 40px;
    }

  }


  /*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
Section Configurations
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/
  section h3.title {
    text-transform: capitalize;
    font: bold 32px "Open Sans", sans-serif;
    margin-bottom: 30px;
    text-align: center;
  }


  .destinations .grid li {
    height: 350px;
    padding: 20px;
    background-clip: content-box;
    background-size: cover;
    background-position: center;
  }

  .destinations .grid li.small {
    -ms-flex-preferred-size: 30%;
    flex-basis: 30%;
  }

  .destnations .grid li.large {
    -ms-flex-preferred-size: 70%;
    flex-basis: 70%;
  }







  /*---------------------
  Contact Section
---------------------*/

  .contact {
    background-color: #f7f7f7;
  }

  .contact form {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;

    max-width: 800px;
    width: 80%;
  }

  .contact form input {
    padding: 15px;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    margin-right: 30px;
    font-size: 18px;
    color: #555;
  }

  .contact form .btn {
    padding: 18px 42px;
  }


  @media (max-width: 800px) {

    .contact form input {
      -ms-flex-preferred-size: 100%;
      flex-basis: 100%;
      margin: 0 0 20px 0;
    }

  }




  /*-------------
  Footer
-------------*/

  footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    text-align: center;
    color: #fff;
    background-color: #414a4f;
    padding: 60px 0;
  }

  footer ul {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 25px;
    font-size: 32px;
  }

  footer ul li {
    margin: 0 8px;
  }

  footer ul li:first-child {
    margin-left: 0;
  }

  footer ul li:last-child {
    margin-right: 0;
  }

  footer p {
    text-transform: uppercase;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.6);
    margin-bottom: 10px;
  }

  footer p a {
    color: #fff;
  }

  @media (max-width: 700px) {

    footer {
      padding: 80px 15px;
    }

  }
</style>

</head>

<body>
  <header>
    <div class="navbar">
      <div class="title">EARTHWORMX</div>
      <div class="links">
      <a href="?page=login">Login</a>
      <a href="?page=Newhere?">New here?</a>
      <a href="?page=Educational Resources">Educational Resources</a>
       </div>
    </div>
  </header>

  <section class="hero">
    <div class="background-image" style="background-image: url(/crop.png)"></div>
    <div class="hero-content-area">
      <h1>EarthWormX</h1>
      <h3> Cultivating Growth from Seed to Sale</h3>
    </div>

  </section>
</body>

</html>