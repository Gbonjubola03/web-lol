<?php require_once ('header.php'); ?>
<?php
// Fix the pagination variables
$perpge = pages();
$announcements = $query->limit('announcements','*','id','desc',$perpge['start'].','.$perpge['perpage']);
$pagings = paging($perpge['screen']+1,ceil($query->num_rows('announcements','*')/$perpge['perpage'])+1,'?p=');

if(isset($_GET["deactivate"])){
    $id = $_GET["deactivate"];
    $query->addquery('update','announcements','status=?','ii',[2,$id],'id=?');
    header("Location: ".do_config(14).'admin/announcements?p='.$_GET["p"].'&message=Record+was+updated');
    exit;
}
if(isset($_GET["activate"])){
    $id = $_GET["activate"];
    $query->addquery('update','announcements','status=?','ii',[1,$id],'id=?');
    header("Location: ".do_config(14).'admin/announcements?p='.$_GET["p"].'&message=Record+was+updated');
    exit;
}
?>
<?php define('pg_active','announcements'); ?>
<?php do_winfo('ANNOUNCEMENTS'); ?>
<title><?php echo SITE_TITLE.' '.do_config(8).' '.do_config(1); ?></title>

<style>
  /* Modern Cyberpunk Admin Theme */
  .app-content {
    background-color: #121212;
    color: #e0e0e0;
    padding: 20px;
  }
  
  .app-title {
    background: linear-gradient(90deg, rgba(0,0,0,0.8) 0%, rgba(33,33,33,0.8) 100%);
    border-left: 4px solid var(--primary-color, #00ff41);
    padding: 15px 20px;
    margin-bottom: 25px;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  }
  
  .app-title h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 24px;
    margin: 0;
    color: var(--primary-color, #00ff41);
    text-shadow: 0 0 10px rgba(0,255,65,0.5);
    letter-spacing: 1px;
  }
  
  .app-title h1 i {
    margin-right: 10px;
    animation: pulse 2s infinite;
  }
  
  @keyframes pulse {
    0% { opacity: 0.7; }
    50% { opacity: 1; }
    100% { opacity: 0.7; }
  }
  
  .card {
    background-color: #1a1a1a;
    border: 1px solid #333;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    overflow: hidden;
    transition: all 0.3s ease;
  }
  
  .card:hover {
    box-shadow: 0 15px 30px rgba(0,255,65,0.1);
    transform: translateY(-5px);
  }
  
  .card-header {
    background: linear-gradient(90deg, #1a1a1a 0%, #2a2a2a 100%);
    color: var(--primary-color, #00ff41);
    font-family: 'Orbitron', sans-serif;
    font-size: 18px;
    padding: 15px 20px;
    border-bottom: 1px solid #333;
    position: relative;
    overflow: hidden;
  }
  
  .card-header:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-color, #00ff41), transparent);
  }
  
  .card-body {
    padding: 20px;
  }
  
  .table {
    color: #e0e0e0;
    background-color: transparent;
    border-collapse: separate;
    border-spacing: 0 5px;
  }
  
  .table thead th {
    background-color: #2a2a2a;
    color: var(--primary-color, #00ff41);
    border: none;
    padding: 12px 15px;
    font-family: 'Roboto Mono', monospace;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  .table thead th:first-child {
    border-radius: 5px 0 0 5px;
  }
  
  .table thead th:last-child {
    border-radius: 0 5px 5px 0;
  }
  
  .table tbody tr {
    background-color: #222;
    transition: all 0.3s ease;
    margin-bottom: 5px;
  }
  
  .table tbody tr:hover {
    background-color: #2a2a2a;
    transform: scale(1.01);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }
  
  .table tbody td {
    border: none;
    padding: 12px 15px;
    vertical-align: middle;
    position: relative;
  }
  
  .table tbody tr td:first-child {
    border-radius: 5px 0 0 5px;
  }
  
  .table tbody tr td:last-child {
    border-radius: 0 5px 5px 0;
  }
  
  .badge {
    font-family: 'Roboto Mono', monospace;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: 500;
    border-radius: 3px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }
  
  .badge:before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255,255,255,0.1);
    transform: rotate(45deg);
    z-index: 0;
    transition: all 0.6s ease;
    opacity: 0;
  }
  
  .badge:hover:before {
    opacity: 1;
  }
  
  .badge i {
    margin-right: 5px;
  }
  
  .badge-info {
    background-color: #0288d1;
    color: white;
    box-shadow: 0 2px 5px rgba(2,136,209,0.3);
  }
  
  .badge-info:hover {
    background-color: #0277bd;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(2,136,209,0.4);
  }
  
  .badge-danger {
    background-color: #d32f2f;
    color: white;
    box-shadow: 0 2px 5px rgba(211,47,47,0.3);
  }
  
  .badge-danger:hover {
    background-color: #c62828;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(211,47,47,0.4);
  }
  
  .badge-success {
    background-color: #388e3c;
    color: white;
    box-shadow: 0 2px 5px rgba(56,142,60,0.3);
  }
  
  .badge-success:hover {
    background-color: #2e7d32;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(56,142,60,0.4);
  }
  
  .badge-warning {
    background-color: #f57c00;
    color: white;
    box-shadow: 0 2px 5px rgba(245,124,0,0.3);
  }
  
  .badge-warning:hover {
    background-color: #ef6c00;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(245,124,0,0.4);
  }
  
  .alert-danger {
    background-color: rgba(211,47,47,0.1);
    color: #ff5252;
    border: 1px solid rgba(211,47,47,0.2);
    border-radius: 5px;
    padding: 15px;
    display: flex;
    align-items: center;
    font-family: 'Roboto Mono', monospace;
  }
  
  .alert-danger i {
    font-size: 20px;
    margin-right: 10px;
    animation: shake 1s ease-in-out;
  }
  
  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-5px); }
    40%, 80% { transform: translateX(5px); }
  }
  
  .card-footer {
    background-color: #1a1a1a;
    border-top: 1px solid #333;
    padding: 15px;
  }
  
  /* Pagination styling */
  .pagination {
    display: inline-flex;
    background-color: #222;
    border-radius: 30px;
    padding: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }
  
  .pagination a, .pagination span {
    color: #e0e0e0;
    padding: 8px 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    border-radius: 20px;
    margin: 0 2px;
    font-family: 'Roboto Mono', monospace;
    font-size: 14px;
  }
  
  .pagination a:hover {
    background-color: #333;
    color: var(--primary-color, #00ff41);
  }
  
  .pagination .active {
    background-color: var(--primary-color, #00ff41);
    color: #121212;
    box-shadow: 0 0 10px rgba(0,255,65,0.5);
  }
  
  /* Add a glowing effect to the table rows */
  .table tbody tr:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--primary-color, #00ff41), transparent);
    opacity: 0;
    transition: all 0.3s ease;
  }
  
  .table tbody tr:hover:after {
    opacity: 0.5;
  }
  
  /* Add a terminal-like cursor effect to the title */
  .card-header:after {
    content: '|';
    display: inline-block;
    color: var(--primary-color, #00ff41);
    animation: blink 1s infinite;
    margin-left: 5px;
  }
  
  @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
  }
</style>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-bullhorn"></i> <?php echo SITE_TITLE;?> - Announcements</h1>
      <p>Manage your system announcements</p>
    </div>
    <?php require_once ('powerdby.php'); ?>
  </div>
  
  <div class="row user">
    <div class="col-md-3">
      <?php require_once ('an-menu.php'); ?>
    </div>
    <div class="col-md-9">
      <div class="bs-component">
        <div class="card">
          <h4 class="card-header">ANNOUNCEMENTS LIST</h4>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <?php if(isset($_GET['message'])): ?>
                <div class="alert alert-success mb-4">
                  <i class="fa fa-check-circle"></i> <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
                <?php endif; ?>
                
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th width="5%">#</th>
                        <th width="35%"><i class="fa fa-bars"></i> TITLE</th>
                        <th width="20%"><i class="fa fa-calendar"></i> DATE</th>
                        <th width="15%"><i class="fa fa-check"></i> VIEW</th>
                        <th width="15%"><i class="fa fa-share"></i> ACTION</th>
                        <th width="10%"><i class="fa fa-edit"></i> EDIT</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if($announcements->num_rows > 0): ?>
                        <?php while($res=$announcements->fetch_assoc()): ?>
                          <tr>
                            <td><?php echo $res['id'];?></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <?php if(isset($res['preview']) && !empty($res['preview'])): ?>
                                  <div class="announcement-img mr-2">
                                    <img src="<?php echo $res['preview'];?>" alt="" width="40" height="40" class="rounded" onerror="this.style.display='none'">
                                  </div>
                                <?php endif; ?>
                                <div>
                                  <span class="d-block font-weight-bold"><?php echo htmlspecialchars($res['title']);?></span>
                                  <small class="text-muted"><?php echo substr(strip_tags($res['content']), 0, 50);?>...</small>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex flex-column">
                                <span><?php echo date('M j, Y', strtotime($res['created']));?></span>
                                <small class="text-muted"><?php echo date('g:i A', strtotime($res['created']));?></small>
                              </div>
                            </td>
                            <td>
                            <a href="<?php echo do_config(14).'announcement/'.$res['link'];?>/" class="badge badge-info" data-toggle="tooltip" data-placement="bottom" title="Check live page">
                                <i class="fa fa-eye"></i> VIEW
                              </a>
                            </td>
                            <td>
                              <?php if($res['status'] == 1): ?>
                                <a href="<?php echo do_config(14).'admin/announcements?deactivate='.$res['id'].'&p='.($perpge['screen']+1);?>" class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Set to inactive">
                                  <i class="fa fa-times-circle"></i> DEACTIVATE
                                </a>
                              <?php elseif($res['status'] == 2): ?>
                                <a href="<?php echo do_config(14).'admin/announcements?activate='.$res['id'].'&p='.($perpge['screen']+1);?>" class="badge badge-success" data-toggle="tooltip" data-placement="bottom" title="Set to active">
                                  <i class="fa fa-check-circle"></i> ACTIVATE
                                </a>
                              <?php endif; ?>
                            </td>
                            <td>
                              <a href="<?php echo do_config(14).'admin/anedit?id='.$res['id'];?>" class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Status: <?php echo ($res['status']==1) ? 'ACTIVE' : 'INACTIVE';?>">
                                <i class="fa fa-edit"></i> EDIT
                              </a>
                            </td>
                          </tr>
                        <?php endwhile; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6">
                            <div class="alert alert-danger">
                              <i class="fa fa-times"></i> NO RECORDS WERE FOUND
                            </div>
                          </td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-center">
            <?php if($announcements->num_rows > 0): ?>
              <div class="text-center">
                <?php echo $pagings; ?>
              </div>
            <?php endif; ?>
            
            <div class="mt-3">
              <a href="<?php echo do_config(14).'admin/add-announcement';?>" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Add New Announcement
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  // Initialize tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    
    // Add hover effects to table rows
    $('.table tbody tr').hover(
      function() {
        $(this).find('td').css('background-color', '#2a2a2a');
      },
      function() {
        $(this).find('td').css('background-color', '');
      }
    );
    
    // Add a subtle animation to the card
    $('.card').addClass('animated fadeIn');
    
    // Add a glitch effect to the title on hover
    $('.card-header').hover(
      function() {
        $(this).addClass('glitch');
        setTimeout(() => {
          $(this).removeClass('glitch');
        }, 1000);
      }
    );
  });
  
  // Add a matrix-like effect to the background of the card on click
  $('.card').on('click', function(e) {
    if ($(e.target).is('a, button, input') || $(e.target).closest('a, button, input').length) {
      return;
    }
    
    const x = e.pageX - $(this).offset().left;
    const y = e.pageY - $(this).offset().top;
    
    const ripple = $('<span class="ripple"></span>');
    ripple.css({
      left: x + 'px',
      top: y + 'px'
    });
    
    $(this).append(ripple);
    
    setTimeout(() => {
      ripple.remove();
    }, 800);
  });
  
  // Add this CSS for the ripple effect
  const style = document.createElement('style');
  style.textContent = `
    .ripple {
      position: absolute;
      border-radius: 50%;
      background-color: rgba(0, 255, 65, 0.2);
      transform: scale(0);
      animation: ripple 0.8s linear;
      pointer-events: none;
      width: 100px;
      height: 100px;
      margin-left: -50px;
      margin-top: -50px;
    }
    
    @keyframes ripple {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
    
    .glitch {
      animation: glitch 0.3s linear infinite;
    }
    
    @keyframes glitch {
      0% {
        transform: translate(0);
      }
      20% {
        transform: translate(-2px, 2px);
      }
      40% {
        transform: translate(-2px, -2px);
      }
      60% {
        transform: translate(2px, 2px);
      }
      80% {
        transform: translate(2px, -2px);
      }
      100% {
        transform: translate(0);
      }
    }
    
    .animated {
      animation-duration: 1s;
      animation-fill-mode: both;
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .fadeIn {
      animation-name: fadeIn;
    }
  `;
  document.head.appendChild(style);
</script>

<?php require_once ('footer.php'); ?>
