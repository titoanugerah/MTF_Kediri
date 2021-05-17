
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
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
