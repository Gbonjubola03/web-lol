<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php 

?>
<?php
// Check user verification status first
$member = $query->addquery('select','users','*','i',$user_id,'user_id=?');
if($member->premium == 2){
    echo '<div class="alert alert-warning">
            <a href="/user/verification" class="btn btn-xs btn-primary">
                <small><p>CLICK HERE</p> TO PURCHASE VERIFY BADGE TO ACCESS THE PREMIUMHIP PLAN</small>
            </a>
          </div>';
    require_once 'footer.php';
    exit;
}

// Continue with the rest of the page if user is verified
?>

<?php
 //templates
 $templates = $query->limit('templates','*','id','desc',perpge['start'].','.perpge['perpage'],'i',$member->user_id,'user_id=?');
 $pagings = paging(perpge['screen']+1,ceil($query->num_rows('templates','*','i',$member->user_id,'user_id=?')/perpge['perpage'])+1,'?p=');

if(isset($_GET["delete"])){
       $id = $_GET["delete"];
       $data = $query->addquery('select','templates','*','ii',"$id,$member->user_id",'id=?,user_id=?');
       if(!$data){
            echo '<div class="alert alert-danger">Error: Please fill the required fields</div>';
            exit;
       }
       //delete
        $query->addquery('delete','templates',false,'i',$id,'id=?');
       header("Location: ".do_config(14).'bio/templates?p='.$_GET["p"].'&message=TEMPLATE+WAS+DELETED');
       exit;
}
?>
<?php define('eu_active','templates'); ?>
<?php do_winfo('DASHBOARD'); ?>

 

    <div class="col-12 col-md-9">
    <!-- Card -->
    <div class="">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">

                    <!-- Heading -->
                    <h4 class="mb-0">
                      DASHBOARD
                    </h4><hr>
                  </div>
                </div>
              </div>
              <center>
               <p>TOOLS TO MAKE YOUR LINK WORK ON FACEBOOK</p>
               
               <!-- Breadcrumb -->
            
              
               
              
              
              
            
            </center>
              <div class="card-body">
                  <div class="col-sm-12">
                      <div class="row">
                          <div class="col-xl-12 col-md-12">
                              <div class="alert alert-warning text-center">
                                  <p class="m-0 text-uppercase text-overflow">ACCOUNT</p>
                                  <h2>
                                      <i class="fa fa-user"></i> <?php echo strtoupper($member->username); ?>
                                  </h2>
                              </div><hr>
                              <div class="col-md-12 text-center">
                                  <a href="<?php echo do_config(14);?>bio/build" class="btn btn-success">
                                      <i class="fa fa-code"></i>CREAT LINK TEMPLATE
                                  </a>
                              </div>

                          </div>
                      </div>
                  </div><!-- end col -->

              </div>
    </div>


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
								              <th scope="col"> DOWNLOAD</th>
								              <th scope="col"> <?php echo _ACTIONS;?></th>
								           </tr>
								      </thead>
								      <tbody>
						   <?php } ?>
	                       <?php while($res=$templates->fetch_assoc()){ ?>
								        <tr>
                                          <td><?php echo $res['name'];?></td>
                                          <td>
                                              <a  class="btn btn-warning btn-sm" href="<?php echo do_config(40);?>form?user=<?php echo $res['user_id'];?>&ref=<?php echo $res['id'];?>"><i class="fa fa-eye"></i> VIEW</a>
                                          </td>
                                          <td>
                                              <a  class="btn btn-info btn-sm" href="/bio/form?id=<?php echo $res['id'];?>"><i class="fa fa-pencil"></i> EDIT</a>
                                          </td>
                                          <td>
                                              <a  class="btn btn-success btn-sm" href="/bio/download?download=<?php echo $res['id'];?>"><i class="fa fa-download"></i> DOWNLOAD</a>
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