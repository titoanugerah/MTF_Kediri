  <img src="<?php echo base_url('./assets/picture/'.$content->image); ?>" class="img-fluid" style="width:3000px">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-12 pt-5 pt-lg-0">
        <h3 data-aos="fade-up"><?php echo $content->name; ?></h3>
        <p data-aos="fade-up" data-aos-delay="100">
        <?php echo $content->description; ?>
        </p>
      </div>
    </div>
  </div>
