@aware(['page'])
<main>
    <section id="Content1">
        <img src="../images/Contact.jpg" alt="section1-image-bg" />
        <div class="tagline-text">
          <h2 class="animate">Contact us</h2>
          <p class="contact-desc">
            Experience the open road! Our Customer Service team is at your
            service, helping you with any questions or requests related to our
            wide range of motorcycles, no matter where you are.
          </p>
          <div class="buttons">
            <button class="inquire-button" onclick="toggleInquireSection()">
              INQUIRE
            </button>
            <button
              class="check-location-button"
              onclick="toggleMapSection()"
            >
              CHECK LOCATION
            </button>
          </div>
        </div>
      </div>
    </section>

    <section id="Content2">
      <div class="heading">
        <h2 class="brandName">GET IN TOUCH</h2>
        <p class="brandDescription">
          Please contact us using the information below.
        </p>
      </div>
      <div class="row">
        <div class="contact-col">
          <h2>Contact Information</h2>
          <div>
            <i class="ri-building-fill"></i>
            <span>
              <h5>Head Office</h5>
              <p>Lian, Batangas</p>
            </span>
          </div>
          <div>
            <i class="ri-phone-fill"></i>
            <span>
              <h5>Our Contacts</h5>
              <p>+639123456789</p>
            </span>
          </div>
          <div>
            <i class="ri-mail-fill"></i>
            <span>
              <h5>Email</h5>
              <p>email123@gmail.com</p>
            </span>
          </div>
          <div>
            <i class="ri-time-fill"></i>
            <span>
              <h5>Office Hours</h5>
              <p>Monday - Sunday</p>
              <p>8:00 am - 5:00pm</p>
            </span>
          </div>
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
        </div>
        <div class="contact-col">
          <h2>Send us your Message or Complaint</h2>
           <div class="form-wrapper">
          <form action="">
            <label for="name">Name:</label>
            <input type="text" placeholder="Name" required>
            <label for="name">Email:</label>
            <input type="email" placeholder="Email" required>
            <label for="name">Message or Complaint
            <textarea rows="8" placeholder="Message"></textarea>
            <input type="submit" name="" value="Send" />
          </form>
          </div>
        </div>
        </div>
      </div>
    </section>

<section id="Content3">
    <div class="container">
      <h2>Look Us on the Map</h2>
      <div class="map-container">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1827.4434493536141!2d120.73022125830036!3d13.945656663193368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bda2df3c56e6cf%3A0xde994034e08b1924!2sSTI%20College%20Balayan!5e0!3m2!1sen!2sph!4v1691129700540!5m2!1sen!2sph" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <section id="Content4">
    <h2>Frequently Ask Questions</h2>
    <ul id="accordion">
      <li>
        <label for="first">Question 1? <span>&#x3e;</span></label>
        <input type="checkbox" name="accordion" id="first">
        <div class="content">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias inventore earum nobis quia velit dolorem dicta voluptates nostrum architecto voluptatibus dolorum aliquid quisquam, laudantium placeat illo non reprehenderit quibusdam natus.
          </p>
        </div>
      </li>
      <li>
        <label for="second">Question 2? <span>&#x3e;</span></label>
        <input type="checkbox" name="accordion" id="second">
        <div class="content">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam culpa, illum sit est soluta beatae eligendi? Ratione, ea illo nesciunt doloribus error expedita repellendus magni esse modi, dignissimos, tenetur laborum!
          </p>
        </div>
      </li>
      <li>
        <label for="third">Question 3? <span>&#x3e;</span></label>
        <input type="checkbox" name="accordion" id="third">
        <div class="content">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quia tempora et consequatur voluptates perspiciatis blanditiis est fuga dicta hic harum sed doloribus eveniet amet expedita iusto, odio maiores alias.
          </p>
        </div>
      </li>
    </ul>
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
        <li><a href="../html/application.html">Products</a></li>
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