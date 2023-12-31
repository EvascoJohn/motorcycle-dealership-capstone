@aware(['page'])
<!DOCTYPE html>
<html>
  <head>
    <!-- Meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- External CSS files -->
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/terms-condition.css" />
    <link rel="stylesheet" href="../css/media-queries.css" />
    <!-- Google Fonts -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    />
    <!-- Remix Icon CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <!-- Title -->
    <title>Terms & Condition</title>
  </head>

  <body>
    
    <header>
      <!-- Brand logo Text -->
      <a href="../html/index.html" class="logo">BrandName</a>
      <!-- Navigation bar -->
      <ul class="navbar">
        <li><a href="../html/index.html">Home</a></li>
        <li><a href="../html/products.html">Products</a></li>
        <li><a href="../html/application.html">Application</a></li>
        <li><a href="../html/about.html">About</a></li>
        <li><a href="../html/contact.html">Contact Us</a></li>
      </ul>
      <!-- User registration and menu icon -->
      <div class="main">
        <a href="#" class="user"
          >Log In<i class="ri-account-circle-fill"></i
        ></a>
        <div class="ri-menu-line" id="menu-icon"></div>
      </div>
    </header>

    <main>
      <section id="Content1">
          <img src="../images/agreement.jpg" alt="section1-image-bg" />
          <div class="tagline-text">
            <h2 class="animate">Terms & Condition</h2>
            <p class="contact-desc">
                By accessing and using our services, you agree to abide by our Terms and Conditions, forming a reliable foundation for a seamless experience.
            </p>
            <div class="buttons">
              <button class="inquire-button" onclick="toggleInquireSection()">
                READ MORE
              </button>
            </div>
          </div>
        </div>
      </section>

      <section id="Content2">
        <div class="heading">
          <h1 class="Title">Privacy Policy</h1>
          <p class="content">
            This Privacy Policy describes how we collect, use, and protect your personal information when you interact with our website. By using our website, you consent to the collection and use of your personal information as described in this Privacy Policy.
          </p>
        </div>
      </section>
    </main>

    <!--Footer Design-->
    <footer>
      <div class="content">
        <div class="row1 box">
          <div class="upper">
            <div class="topic">BrandName</div>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet,
              deleniti enim eum itaque voluptas saepe provident atque voluptate
              tempore deserunt at exercitationem soluta.
            </p>
          </div>
        </div>

        <div class="row2 box">
          <li><a href="../html/index.html">Home</a></li>
          <li><a href="../html/products.html">Products</a></li>
          <li><a href="../html/application.html">Application</a></li>
          <br />
          <li><a href="../html/privacy-policy.html">Privacy Policy</a></li>
          <li><a href="../html/Terms-and-condition.html">Terms &amp Condition</a></li>
          <li><a href="../html/contact.html">FAQs</a></li>
        </div>

        <div class="row3 box">
          <div class="topic">Contact us</div>
          <div class="phone">
            <a href="#"><i class="ri-phone-fill"></i>+6391234567</a>
          </div>
          <div class="email">
            <a href="#"><i class="ri-mail-fill"></i>group5@email.com</a>
          </div>
          <div class="address">
            <a href="#"><i class="ri-navigation-fill"></i>Lian, Batangas</a>
          </div>
        </div>

        <div class="row4 box">
          <div class="topic">Sign up to our Newsletter</div>
          <form action="#">
            <input type="text" placeholder="Enter email address" required="" />
            <input type="submit" name="" value="Send" />
            <div class="media-icons">
              <a href="http://facebook.com" target="_blank"
                ><i class="ri-facebook-fill ri-1x"></i
              ></a>
              <a href="http://instagram.com" target="_blank"
                ><i class="ri-instagram-fill ri-1x"></i
              ></a>
              <a href="http://twitter.com" target="_blank"
                ><i class="ri-twitter-fill ri-1x"></i
              ></a>
              <a href="http://messenger.com" target="_blank"
                ><i class="ri-messenger-fill ri-1x"></i
              ></a>
            </div>
          </form>
        </div>
      </div>
      <div class="bottom">
        <p>Copyright © 2023 <span>BrandName</span> Made by Group5</p>
      </div>
    </footer>

    <!--JS Link-->
    <script type="text/javascript" src="../javascript/script.js"></script>

  </body>
</html>
