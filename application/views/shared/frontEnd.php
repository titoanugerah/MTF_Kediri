<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MTF Kota Kediri</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url('./assets/template/frontend/'); ?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Ninestars - v2.3.1
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="<?php echo base_url(); ?>"><span>MTF Kota Kediri</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="<?php echo base_url('./assets/template/frontend/'); ?>index.html"><img src="<?php echo base_url('./assets/template/frontend/'); ?>assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#home">Beranda</a></li>
          <li><a href="#product">Produk</a></li>
          <li><a href="#terms">Syarat</a></li>
          <li><a href="<?php echo base_url('referral'); ?>">Referral</a></li>
          <li class="drop-down"><a href="#">Lain Lain</a>
            <ul>
              <li><a href="<?php echo base_url('program'); ?>#">Program Of The Month</a></li>
              <li><a href="<?php if(!$this->session->userdata('isLogin')){ echo $this->session->flashdata('link');} else { echo base_url('dashboard');} ?>">Dashboard</a></li>
            </ul>
          </li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  
  <main id="main">

    <?php $this->load->view($viewName); ?>

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-contact" data-aos="fade-up" data-aos-delay="100">
            <h3><?php echo $this->config->item('site_full_name');?></h3>
            <p>
                <?php echo $contact->address; ?>
                <br><br>
              <strong>Telepon:</strong> <?php echo $contact->phone; ?><br>
              <strong>Chat:</strong> <a target="_blank" href="https://wa.me/<?php echo $contact->whatsapp; ?>?text=Saya%20ingin%20menanyakan%20lebih%20lanjut%20mengenai%20MTF"><?php echo $contact->whatsapp.' ('.$contact->name.')'; ?></a> <br>
              
              <strong>Email:</strong><?php echo $contact->email; ?><br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="200">
            <h4>Link</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url(''); ?>">Beranda</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('product'); ?>">Produk</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('terms'); ?>">Syarat</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('referral'); ?>">Mapping Referral</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('program'); ?>">Program Of The Month</a></li>
            </ul>
          </div>

         
          <div class="col-lg-4 col-md-6 footer-links" data-aos="fade-up" data-aos-delay="400">
            <h4>Tetap Terhubung Bersama Kami</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="<?php echo base_url('./assets/template/frontend/'); ?>#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="<?php echo base_url('./assets/template/frontend/'); ?>#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="<?php echo base_url('./assets/template/frontend/'); ?>#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="<?php echo base_url('./assets/template/frontend/'); ?>#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="<?php echo base_url('./assets/template/frontend/'); ?>#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Mandiri Tunas Finance Kota Kediri</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/ -->
        Designed by <a href="<?php echo base_url('./assets/template/frontend/'); ?>https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="<?php echo base_url('./assets/template/frontend/'); ?>#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url('./assets/template/frontend/'); ?>assets/js/main.js"></script>

</body>

</html>