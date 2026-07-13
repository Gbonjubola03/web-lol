<?php require_once ('header.php'); ?>
<?php
 //pages list
 $articles = $query->limit('articles','*','id','desc',perpge['start'].','.perpge['perpage']);
 $pagings = paging(perpge['screen']+1,ceil($query->num_rows('articles','*')/perpge['perpage'])+1,'?p=');
 
if(isset($_GET["deactivate"])){
    
    $id = $_GET["deactivate"];
       
    $query->addquery('update','articles','status=?','ii',[2,$id],'id=?');
    
    header("Location: ".do_config(14).'admin/articles?p='.$_GET["p"].'&message=Record+was+updated');
    exit;
}
if(isset($_GET["activate"])){
    
    $id = $_GET["activate"];
       
    $query->addquery('update','articles','status=?','ii',[1,$id],'id=?');
    
    header("Location: ".do_config(14).'admin/articles?p='.$_GET["p"].'&message=Record+was+updated');
    exit;
}
?>
<?php define('pg_active','articles'); ?>
<?php do_winfo('ARTICLES'); ?>
  
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fa fa-files-o"></i> <?php echo SITE_TITLE;?></h1>
          <p></p>
        </div>
        <?php require_once ('powerdby.php'); ?>
      </div>


        <div class="tile p-0">
       <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='pages'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/articles">
                      <i class="fa fa-files-o"></i> ARTICLES
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link<?php if(pg_active=='addpage'){?> active<?php }?>" href="<?php echo do_config(14); ?>admin/add-article">
                      <i class="fa fa-plus-circle"></i> ADD ARTICLES
                  </a>
              </li>
      </ul>
   </div>
      <div class="row user">
        
        <div class="col-md-9">
         <div class="bs-component">
          <div class="card">
              <h4 class="card-header">ARTICLES LIST </h4>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12">
               <table class="table table-hover">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th><i class="fa fa-bars"></i> TITLE</th>
                           <th><i class="fa fa-calendar"></i> DATE</th>
                           <th><i class="fa fa-check"></i> VIEW</th>
                           <th><i class="fa fa-share"></i> ACTION</th>
                       </tr>
                   </thead>
                   <tbody>
                   <?php while($res=$articles->fetch_assoc()){ ?>
                     <tr>
                           <td><?php echo $res['id'];?></td>
                           <td><small><b><?php echo $res['title'];?></b></small></td>
                           <td><small><b><?php echo date('M j Y g:i A', strtotime($res['created']));?></b></small></td>
                           <td>
                            <a href="<?php echo do_config(14).'article/'.$res['link'];?>/" class="badge badge-info"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="CHECK LIVE PAGE"><i class="fa fa-eye"></i> VIEW</a>
                         </td>
                           <td>
                       <?php if($res['status'] == 1){ ?>
                            <a href="<?php echo do_config(14).'admin/articles?deactivate='.$res['id'];?>" class="badge badge-danger">DEACTIVATE</a>
                       <?php }elseif($res['status'] == 2){ ?>
                            <a href="<?php echo do_config(14).'admin/articles?activate='.$res['id'];?>" class="badge badge-success">ACTIVATE</a>
                       <?php } ?>
                           </td>
                           <td>
                            <a href="<?php echo do_config(14).'admin/aredit?id='.$res['id'];?>" class="badge badge-warning"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="STATUS: <?php if($res['status']==1){ echo 'ACTIVE'; }else{ echo 'INACTIVE';};?>">EDIT</a>
                           </td>
                       </tr>
                   <?php } ?>
              </tbody>
            </table>
                   <?php if($articles->num_rows == 0){ ?>
                           <div class="alert alert-danger"><i class="fa fa-times"></i> NO RECORDS WAS FOUND</div>
                   <?php } ?>
               </div>
                  </div>
              </div>
              <div class="card-footer text-center">
                <?php if($articles->num_rows > 0){ ?>
                     <div class="text-center">
                        <?php echo $pagings; ?>
                     </div>
                <?php } ?>
          </div>
          </div>
        </div>
          </div>
      </div>
    </main>
<?php require_once ('footer.php'); ?>