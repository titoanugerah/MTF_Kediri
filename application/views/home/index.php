<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php $firstPage = 1; foreach($promo as $promo) : ?>
    <div class="carousel-item <?php if($firstPage==1){echo "active"; $firstPage=0; }?>">
      <a href="<?php echo base_url('page/'.$promo->id); ?>">
        <img class="d-block w-100" src="<?php echo base_url('./assets/picture/'.$promo->image); ?>">
      </a>
    </div>
    <?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


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
</section>

<section id="product" class="portfolio">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Produk Kami</h2>
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
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="terms" >
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2><?php echo $terms->name; ?></h2>
    </div>

    <div class="row justify-content-between">
      <div class="col-lg-6 pt-5 pt-lg-0">
        <p data-aos="fade-up" data-aos-delay="100">
        <?php echo $terms->description; ?>
        </p>
      </div>
    </div>
  </div>
</section>

<section id="program" >
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Program Of The Month</h2>
    </div>


</section>


<section id="wira" class="contact">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Mandiri Wira</h2>
    </div>

    <div class="row">

        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="name">Nama</label>
              <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Mohon masukan nama yang valid" />
              <div class="validate"></div>
            </div>
            <div class="form-group col-md-3">
              <label for="name">No KTP</label>
              <input type="text" class="form-control" name="ktp" id="ktp" data-rule="minlen:16" data-msg="Mohon masukan KTP yang valid" />
              <div class="validate"></div>
            </div>
          <div class="form-group col-md-3">
            <label for="name">NPWP</label>
              <input type="text" class="form-control" name="npwp" id="npwp" data-rule="minlen:16" data-msg="Mohon masukan nomor NPWP yang valid" />
            <div class="validate"></div>
          </div>
          <div class="form-group col-md-3">
            <label for="name">Nomor Rekening</label>
              <input type="text" class="form-control" name="rekening" id="rekening"  />
            <div class="validate"></div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="name">Nomor Handphone</label>
              <input type="text" class="form-control" name="hp" id="hp" data-rule="minlen:10" data-msg="Mohon masukan nomor HP yang valid" />
            <div class="validate"></div>
          </div>
          <div class="form-group col-md-3">
            <label for="name">Alamat Lengkap</label>
              <input type="text" class="form-control" name="alamat" id="alamat" />
            <div class="validate"></div>
          </div>
          <div class="form-group col-md-3">
            <label for="name">Email</label>
              <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Mohon masukan alamat email yang valid"/>
            <div class="validate"></div>
          </div>
          <div class="form-group col-md-3">
            <label for="name">Pekerjaan</label>
              <input type="email" class="form-control" name="pekerjaan" id="pekerjaan"/>
            <div class="validate"></div>
          </div>

        </form>
          <div class="text-center"><button type="submit">Daftar</button></div>
      </div>

    </div>

  </div>
</section>