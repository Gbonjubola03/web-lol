<?php require_once 'preload.php';?>
<?php require_once (dirname(__FILE__)).'/incs/header.php';?>
<?php
  if(!isset($_GET['link'])){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
  $articlelink = $_GET['link'];
  $article = $query->addquery('select','articles','*','s',$articlelink,'link=?');
  if(!$article){
      echo '<br> <h2 class="text-center">ERROR: NOT FOUND</h2><br>';
      require_once (dirname(__FILE__)).'/incs/footer.php';
      exit;
  }
  $related = $query->normal("select * from ".dbperfix."articles WHERE status='1' ORDER BY id desc LIMIT 0,3");
?>
    <?php do_winfo($article->title); ?>

    <!-- Title -->
    <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?> </title>
    <!-- SECTION -->
    <div class="row">
        <div class="col-md-9">
        <div class="row justify-content-center pt-5 pt-md-5">
          <div class="col-12 col-md-10 col-lg-9 col-xl-8">
            <br><h3 class="fw-bold text-uppercase">
              <?php echo $article->title?>
            </h3><hr>

            <!-- Fugure -->
            <figure class="figure mb-7">
              <!-- Image -->
              <img class="figure-img img-fluid rounded lift lift-lg" src="<?php echo $article->preview?>" alt="preview" onerror="this.style.display='none';">
           
              <img class="figure-img img-fluid rounded lift lift-lg" src="<?php echo do_config(14).$article->preview?>" alt="preview" onerror="this.style.display='none';">
            </figure>
            <!-- Text -->
            <p>
              <?php echo $article->content?>
            </p>
          </div>
        </div> <!-- / .row -->
        <div class="row justify-content-center pt-5 pt-md-5 pb-8 pb-md-11">
          <div class="col-12 col-md-10 col-lg-9 col-xl-8">
            <!-- Meta -->
            <div class="row align-items-center py-5 border-top border-bottom">
              <div class="col-auto">
                <!-- Avatar -->
                <div class="avatar avatar-lg">
                <img src="<?php echo do_user($article->user_id,'avatar');?>" alt="avatar" class="avatar-img rounded-circle" onerror="this.style.display='none';">
              
                <img src="<?php echo do_config(14);?><?php echo do_user($article->user_id,'avatar');?>" alt="avatar" class="avatar-img rounded-circle" onerror="this.style.display='none';">
                </div>
              </div>
              <div class="col ms-n5">
                <!-- Name -->
                <h6 class="text-uppercase mb-0">
                  <?php echo do_user($article->user_id,'username');?> <i class="fa fa-dot-circle-o"></i>
                </h6>
                <!-- Date -->
                <time class="fs-sm text-body-secondary" datetime="2019-05-20">
                   <?php echo get_time_ago(strtotime($article->created));?>
                </time>
              </div>
              <div class="col-auto">
                <!-- Share -->
                <span class="h6 text-uppercase text-body-secondary d-none d-md-inline me-4">
                  Share:
                </span>
                <!-- Icons -->
                <ul class="d-inline list-unstyled list-inline list-social">
                  <li class="list-inline-item list-social-item me-3">
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo do_config(14).'service/'.$article->link?>/&media=&description=<?php echo $article->title?>" class="text-decoration-none" target="_blank" onclick="return !window.open(this.href, 'Pinterest', 'width=560,height=300')">
                      <img src="<?php echo do_config(14);?>assets/img/instagram.svg" class="list-social-icon" alt="" onerror="this.style.display='none';">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item me-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo do_config(14).'service/'.$article->link?>/" class="text-decoration-none" target="_blank" onclick="return !window.open(this.href, 'Facebook', 'width=560,height=300')">
                      <img src="<?php echo do_config(14);?>assets/img/facebook.svg" class="list-social-icon" alt="" onerror="this.style.display='none';">
                    </a>
                  </li>
                  <li class="list-inline-item list-social-item me-3">
                    <a href="https://twitter.com/intent/tweet?url=<?php echo do_config(14).'service/'.$article->link?>/&text=<?php echo $article->title?>" class="text-decoration-none" target="_blank" onclick="return !window.open(this.href, 'Twitter', 'width=560,height=300')">
                    
                    <img src="<?php echo do_config(14);?>assets/img/twitter.svg" class="list-social-icon" alt="" onerror="this.style.display='none';">
                    </a>
                  </li>
                </ul>
              </div>
              <div class="row">
              <div class="text-center">
                <div class="col-md-12">
                </div>
              </div>
              </div>
            </div>

          </div>
        </div> <!-- / .row -->
        </div>
        <div class="col-md-3">
            <div class="col-md-12 card card-bleed">
           </div>
        </div>
    </div>

    <!-- ARTICLES -->
    <section class="pt-1 pt-md-10 bg-light">
      <div class="container">
        <div class="row align-items-center mb-5">
          <div class="col-12 col-md">

            <!-- Heading -->
            <h3 class="mb-0">
              RELATED ARTICLES
            </h3>
          </div>
          <div class="col-12 col-md-auto">

            <!-- Button -->
            <a href="#!" class="btn btn-sm btn-outline-gray-300 d-none d-md-inline">
              VIEW ALL
            </a>

          </div>
        </div> <!-- / .row -->
        <div class="row">
        <div class="col-ld-12">
            <?php if($related->num_rows == 0){ ?>
            <div class="alert alert-warning text-uppercase">
                <i class="fa fa-warning"></i> <?php echo _NO_RECORDS_WERE_FOUND;?>
            </div>
            <?php } ?>
        </div>
        <?php while($res=$related->fetch_assoc()){ ?>
          <div class="col-12 col-md-6 col-lg-4 d-flex">
            <!-- Card -->
            <div class="card mb-6 mb-lg-0 shadow-light-lg lift lift-lg">
              <!-- Image -->
              <a class="card-img-top" href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>/">
                <!-- Image -->
                <img src="<?php echo $res['preview'];?>" alt="preview" class="card-img-top" onerror="this.style.display='none';">
              
               <img src="<?php echo do_config(14);?><?php echo $res['preview'];?>" alt="preview" class="card-img-top" onerror="this.style.display='none';">
                <!-- Shape -->
                <div class="position-relative">
                  <div class="shape shape-bottom shape-fluid-x text-white">
                    <svg viewBox="0 0 2880 480" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2160 0C1440 240 720 240 720 240H0v240h2880V0h-720z" fill="currentColor"/></svg>  
                  </div>
                </div>
              </a>
              <!-- Body -->
              <a class="card-body" href="<?php echo do_config(14);?>article/<?php echo $res['link'];?>">
                <!-- Heading -->
                <h5>
                  <?php echo $res['title'];?>
                </h5>
              </a>
              <!-- Meta -->
              <a class="card-meta mt-auto" href="<?php echo do_config(14);?>profile/<?php echo do_user($res['user_id'],'username');?>/">
                <!-- Divider -->
                <hr class="card-meta-divider">
                <!-- Avatar -->
                <div class="avatar avatar-sm me-2">
                <img src="<?php echo do_user($res['user_id'],'avatar');?>" alt="avatar" class="avatar-img rounded-circle" onerror="this.style.display='none';">
             
                  <img src="<?php echo do_config(14);?><?php echo do_user($res['user_id'],'avatar');?>" alt="avatar" class="avatar-img rounded-circle" onerror="this.style.display='none';">
                </div>
                <!-- Author -->
                <h6 class="text-uppercase text-body-secondary me-2 mb-0">
                  <?php echo do_user($res['user_id'],'username');?>
                </h6>
                <!-- Date -->
                <p class="h6 text-uppercase text-body-secondary mb-0 ms-auto">
                  <time datetime="2019-05-02"><?php echo get_time_ago(strtotime($res['created']));?></time>
                </p>
              </a>
            </div>

          </div>
        <?php } ?>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </section>
    
<?php require_once 'ajax.js.php';?>
<?php require_once (dirname(__FILE__)).'/incs/footer.php';?>