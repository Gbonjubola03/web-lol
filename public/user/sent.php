<?php require_once (dirname(dirname(__FILE__)).'/preload.php'); ?>
<?php require_once 'header.php';?>
<?php
  if(isset($_GET['id']) || !empty(trim($_GET['id']))){
      $msg_id = $_GET['id'];
      $message = $query->addquery('select','messages','*','i',$_GET['id'],'id=?');
      $replies = $query->limit('messages','*','id','asc','0,20','i',$msg_id,'parent_id=?');
      if($message->isread == 2){
          $query->addquery('update','messages','isread=?','ii',[1,$msg_id],'id=?');
      }
      $query->addquery('update','messages','isread=?','iii',[1,"$msg_id,$member->user_id"],'parent_id=?,reciever_user_id=?');
  }
  
  //messages
  $messages = $query->limit('messages','*','id','desc',perpge['start'].','.perpge['perpage'],'ii',"$member->user_id,0",'sender_user_id=?,parent_id=?');
  $pagings = paging(perpge['screen']+1,ceil($query->num_rows('messages','*','ii',"$member->user_id,0",'sender_user_id=?,parent_id=?')/perpge['perpage'])+1,'?p=');
?>
<?php do_winfo('SENT'); ?>
<?php define('eu_active','messages'); ?>
   <title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>
   <link rel="stylesheet" href="<?php echo do_config(14);?>assets/landkit/css/message.css">
   <div class="container"><br><br>
    <div class="panel messages-panel">
        <div class="contacts-list">

            <div class="inbox-categories">
                <div class="active">
                    <a href="/user/messages" class="active">
                       <i class="fa fa-envelope"></i> INBOX
                    </a>
                </div>
                <div class="active">
                    <a href="/user/sent" class="active">
                       <i class="fa fa-send"></i> SENT
                    </a>
                </div>
            </div><br>
            <div class="tab-content">
                <div id="inbox" class="contacts-outter-wrapper tab-pane active">
                    <div class="contacts-outter">
						<?php if($messages->num_rows == 0){ ?>
						<div class="text-center text-uppercase"><br>
						    <b><small><i class="fa fa-warning"></i> <?php echo _NO_RECORDS_WERE_FOUND;?></small></b>
						 </div>
						<?php } ?>
                        <ul class="list-unstyled contacts">
                        <?php while($res=$messages->fetch_assoc()){ ?>
                        <a href="<?php echo do_config(14);?>user/reply?id=<?php echo $res['id'];?>">
                            <li class="active">
                            <?php if($member->user_id == $res['user_id']){ ?>
                                <div class="message-count"><?php echo do_countmsgsender($res['id']); ?></div>
                                <img alt="avatar" class="img-circle medium-image" src="<?php  echo do_config(14);?><?php echo do_user($res['reciever_user_id'],'avatar');?>">

                                <div class="vcentered info-combo">
                                    <h3 class="no-margin-bottom name"> <?php echo do_user($res['reciever_user_id'],'username');?> </h3>
                                    <h6> <?php echo $res['message'];?></h6>
                                </div>
                            <?php }else{ ?>
                                <div class="message-count"><?php echo do_countmsg($res['id']); ?></div>
                                <img alt="avatar" class="img-circle medium-image" src="<?php  echo do_config(14);?><?php echo do_user($res['sender_user_id'],'avatar');?>">

                                <div class="vcentered info-combo">
                                    <h3 class="no-margin-bottom name"> <?php echo do_user($res['sender_user_id'],'username');?> </h3>
                                    <h6> <?php echo $res['message'];?></h6>
                                </div>
                            <?php } ?>
                            
                                <div class="contacts-add">
                                    <span class="message-time"> 
                                    <small><?php echo get_time_ago(strtotime($res['created'])); ?></small>
                                    </span>
                                </div>
                            </li>
                            </a>
                        <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane message-body active" id="inbox-message-1">
                <div class="message-top">
                    <a href="/user/dashboard" class="btn btn btn-warning new-message">
                         <i class="fa fa-user-circle"></i> USER AREA
                    </a>
                    <div class="new-message-wrapper">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Send message to...">
                            <a class="btn btn-danger close-new-message" href="#"><i class="fa fa-times"></i></a>
                        </div>

                        <div class="chat-footer new-message-textarea">
                            <textarea class="send-message-text"></textarea>
                            <label class="upload-file">
                                <input type="file" required="">
                                <i class="fa fa-paperclip"></i>
                            </label>
                            <button type="button" class="send-message-button btn-info"> <i class="fa fa-send"></i> </button>
                        </div>
                    </div>
                </div>

                <div class="message-chat">
                    <div class="chat-body">
					<?php if(!isset($_GET['id']) || empty(trim($_GET['id']))){ ?>
						<div class="text-center text-uppercase"><br>
						    <b><small><i class="fa fa-times"></i> NO MESSAGE WAS SELECETD</small></b>
						 </div>
					<?php }else{ ?>
                        <div class="message <?php if($message->user_id == $member->user_id){?>my-message<?php }else{ ?>info<?php } ?>">
                            <img alt="avatar" class="img-circle medium-image" src="<?php  echo do_config(14);?><?php echo do_user($message->user_id,'avatar');?>">

                            <div class="message-body text-uppercase">
                                <div class="message-info">
                                    <h4> <?php echo do_user($message->user_id,'username');?></h4>
                                    <h5> <i class="fa fa-clock-o"></i> <?php echo get_time_ago(strtotime($message->created)); ?> </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    <?php echo $message->message;?> 
                                    <?php if($message->user_id == $member->user_id){?>
                                       <?php if($message->isread == 1){?><br>
                                        <small><i class="fa fa-check-circle"></i> Seen</small>
                                       <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <br>
                        </div>
                    <?php while($res=$replies->fetch_assoc()){ ?>
                        <div class="message <?php if($res['user_id'] == $member->user_id){?>my-message<?php }else{ ?>info<?php } ?>">
                            <img alt="avatar" class="img-circle medium-image" src="<?php  echo do_config(14);?><?php echo do_user($res['user_id'],'avatar');?> ">

                            <div class="message-body text-uppercase">
                                <div class="message-body-inner">
                                    <div class="message-info">
                                        <h4> <?php echo do_user($res['user_id'],'username');?></h4>
                                        <h5> <i class="fa fa-clock-o"></i> <?php echo get_time_ago(strtotime($res['created'])); ?> </h5>
                                    </div>
                                    <hr>
                                    <div class="message-text">
                                        <?php echo $res['message'];?> 
                                    <?php if($res['user_id'] == $member->user_id){?>
                                       <?php if($res['isread'] == 1){?><br>
                                        <small>
                                            <i class="fa fa-check-circle"></i> Seen
                                        </small>
                                        <?php }elseif($res['isread'] == 2){ ?><br>
                                        <small style="font-size:8;">
                                            <i class="fa fa-times"></i> Not read
                                        </small>
                                       <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    <?php } ?>
            <!-- 
                        <div class="message my-message">
                            <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">

                            <div class="message-body">
                                <div class="message-body-inner">
                                    <div class="message-info">
                                        <h4> Dennis Novac </h4>
                                        <h5> <i class="fa fa-clock-o"></i> 2:28 PM </h5>
                                    </div>
                                    <hr>
                                    <div class="message-text">
                                        Thanks, I think I will use this for my next dashboard system.
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="message info">
                            <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> Elon Musk </h4>
                                    <h5> <i class="fa fa-clock-o"></i> 2:32 PM </h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                    Hah, too late, I already bought it and my team is impleting the new design right now.
                                </div>
                            </div>
                            <br>
                        </div>
            -->

						<?php } ?>
                    </div>
				<?php if(isset($_GET['id']) || !empty(trim($_GET['id']))){ ?>
                    <form id="message_form" autocomplete="false" method="POST">
                    <div class="chat-footer">
                            <input type="hidden" name="csrfToken" value="<?php echo csrf_token();?>" />
		                    <input type="hidden" name="message" value="message" />
		                    <input type="hidden" name="messageid" value="<?php echo $message->id;?>" />
		                    <input type="hidden" name="sender_user_id" value="<?php echo $message->sender_user_id;?>" />
		                    <input autocomplete="false" name="hidden" type="text" style="display:none;">
		                    
		                    <textarea class="send-message-text" name="message"></textarea>
		                    <button onclick="messageForm();" id="message-button" type="button" class="send-message-button btn-info">
		                        <span id="icon-button"><i class="fa fa-send"></i></span>
		                        <span id="button-loader" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
		                    </button>
                    </div>
		              </form><br>
		              <div class="col-md-10">
		              <!-- ALERTS RESPONSE HERE-->
		              <span id="message-response" class="text-uppercase"></span>
		              <!-- ALERTS RESPONSE END HERE -->
		              </div>

				<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div> 


</div>
    </div>
    </main>
<?php require_once 'ajax.js.php';?>
    <!-- JAVASCRIPT -->
    <script src="<?php echo do_config(14);?>assets/custom/js/jquery.min.js"></script>
    <script src="<?php echo do_config(14);?>assets/custom/js/jquery-ui.js"></script>
    <script src="<?php echo do_config(14);?>assets/custom/js/popper.js"></script>
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <!-- Vendor JS -->
    <script src="<?php echo do_config(14);?>assets/landkit/js/vendor.bundle.js"></script>
    <!-- Theme JS -->
    <script src="<?php echo do_config(14);?>assets/landkit/js/theme.bundle.js"></script>