<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
 //templates
 $templates = $query->limit('templates','*','id','desc',perpge['start'].','.perpge['perpage'],'i',$member->user_id,'user_id=?');
 $pagings = paging(perpge['screen']+1,ceil($query->num_rows('templates','*','i',$member->user_id,'user_id=?')/perpge['perpage'])+1,'?p=');

if(isset($_GET["delete"])){
       $id = $_GET["delete"];
       $data = $query->addquery('select','templates','*','i',$id,'id=?');
       if(!$data){
            echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
            exit;
       }
       //run campaign
        $query->addquery('update','templates','status=?','ii',[2,$id],'id=?');
       header("Location: ".do_config(14).'user/templates?p='.$_GET["p"].'&message=CAMPAIGN+IS+ACTIVE');
       exit;
}
?>
<?php define('eu_active','templates'); ?>
<?php do_winfo('TEMPLATES'); ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
    <!-- BREADCRUMB -->
    <nav class="bg-dark d-md-none">
      <div class="container-md">
        <div class="row align-items-center">
          <div class="col">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <span class="text-white">
                  Account
                </span>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                <span class="text-white">
                  General
                </span>
              </li>
            </ol>

          </div>
          <div class="col-auto">

            <!-- Toggler -->
            <div class="navbar-dark">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    </nav>
   <?php require_once ('setup-menu.php'); ?>
    <div class="col-12 col-md-9">
    <!-- Card -->
    <div class="card card-bleed shadow-light-lg mb-6">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">

                    <!-- Heading -->
                    <h4 class="mb-0">
                      <?php echo SITE_TITLE; ?>
                    </h4><hr>
                  </div>
                </div>
              </div>
              <div class="card-body">
                  <?php if(isset($_GET["message"])){ ?>
                  <div class="alert alert-warning"><?php echo $_GET["message"]; ?></div>
                  <?php }?>
						   <?php if($templates->num_rows == 0){ ?>
								    <div class="alert alert-warning text-uppercase">
								        <i class="fa fa-warning"></i> <?php echo _NO_RECORDS_WERE_FOUND;?>
								    </div>
						   <?php }else{ ?>
						   <div class="table-responsive">
						            <table class="table table-dark">
								       <thead class="thead-dark-hard text-uppercase">
								           <tr>
								              <th scope="col"> NAME</th>
								              <th scope="col"> LINK</th>
								              <th scope="col"> EDIT</th>
								              <th scope="col"> <?php echo _ACTIONS;?></th>
								           </tr>
								      </thead>
								      <tbody>
						   <?php } ?>
	                       <?php while($res=$templates->fetch_assoc()){ ?>
								        <tr>
                                          <td><?php echo $res['name'];?></td>
                                          <td>
                                              <a  class="btn btn-warning btn-sm" href="/form?user=<?php echo $res['user_id'];?>&ref=<?php echo $res['id'];?>"><i class="fa fa-eye"></i> VIEW</a>
                                          </td>
                                          <td>
                                              <a  class="btn btn-info btn-sm" href="/user/form?id=<?php echo $res['id'];?>"><i class="fa fa-pencil"></i> EDIT</a>
                                          </td>
                                          <td>
                                              <a  class="btn btn-danger btn-sm" href="?p=<?php echo $_GET["p"];?>&delete=<?php echo $res['id'];?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo date('M j Y g:i A', strtotime($res['created']));?> | DELETE">DELETE</a>
                                          </td>

                                        </tr>
						   <?php } ?>
                                      </tbody>
                                    </table>
                            </div>
                            <?php if($templates->num_rows > 0){ ?>
                                    <div class="text-center">
                                       <?php echo $paging;?>
                                    </div>
						   <?php } ?>
              </div>
    </div>
    </div>
</div>
    </div>
    </main>
    
<?php require_once 'ajax.js.php';?>
<?php require_once 'footer.php';?>