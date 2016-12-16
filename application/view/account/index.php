<div class="account">
  <h3>Account Dashboard</h3>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#dashboard">Edit Listings</a></li>
    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#Messages">Messages
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a data-toggle="tab" href="#all">All</a></li>
      <li><a data-toggle="tab" href="#unread">Unread</a></li>
      <li><a data-toggle="tab" href="#read">Read</a></li>
    </ul>
  </li>
  </ul>
 <div class="tab-content">
     <a href="../listing-detail/index.php"></a>
    <div id="dashboard" class="tab-pane fade in active">
      <h3>Listings</h3>
      <?php require APP . 'view/dashboard/index.php';?>

    </div>
    <div id="all" class="tab-pane fade">
      <h3>All Messages</h3>
      <?php require APP . 'view/message_center/index.php';?>
    
    </div>
    <div id="unread" class="tab-pane fade">
      <h3>Unread Messages</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="read" class="tab-pane fade">
      <h3>Read Messages</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>
