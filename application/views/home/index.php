<section id="home" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <!-- <img src="<?php //echo base_url('./assets/template/frontend/'); ?>assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in"> -->
            <img src="<?php echo base_url('./assets/picture/home.png'); ?>" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up"><?php echo $content->name; ?></h3>
            <p data-aos="fade-up" data-aos-delay="100">
            <?php echo $content->description; ?>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="product" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Produk Kami</h2>
          <p> </p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12">
            <!-- <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Semua Produk</li>
            </ul> -->
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        
          <?php foreach($product as $product): ?>
          <div class="col-lg-6 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="<?php echo base_url('./assets/picture/'.$product->image); ?>" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="<?php echo base_url('product/'.$product->id); ?>" title="Info Lebih Lanjut"><i class="icofont-link"></i></a>
              </div>
              <div class="portfolio-info">
                <h4><?php echo $product->name; ?></h4>
                <!-- <p>Web</p> -->
              </div>
            </div>
          </div>

          <?php endforeach; ?>
        </div>

      </div>
    </section><!-- End Portfolio Section -->


    <section id="terms" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <!-- <img src="<?php //echo base_url('./assets/template/frontend/'); ?>assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in"> -->
            <!-- <img src="<?php //echo base_url('./assets/picture/home.png'); ?>" class="img-fluid" alt="" data-aos="zoom-in"> -->
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 data-aos="fade-up"><?php echo $terms->name; ?></h3>
            <p data-aos="fade-up" data-aos-delay="100">
            <?php echo $terms->description; ?>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Hubungi Kami</h2>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Alamat Kami:</h4>
                <p><?php echo $contact->address; ?></p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email</h4>
                <p><?php echo $contact->email; ?></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Telepon:</h4>
                <p><?php echo $contact->phone; ?></p>
              </div>

              <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe> -->
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->