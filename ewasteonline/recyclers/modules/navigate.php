<div id="navigation">
    <?php 
         $sql="select * from recycler Where recyclerKey='$recycler_uname'";
    $navres=mysqli_fetch_assoc($dbconnect->query($sql));
        
    ?>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <div class="navbar-brand">Recyclers | Pannel</div>
    </div>
          <div class="navbar-collapse collapse" id="mainNav">
              <div class="subnav">
            <div class="width_100 container-fluid">
                <form class="navbar-form" role="search" id="search" method="POST" action="search.php">
                    <div class="input-group width_100">
                        <input type="text" class="form-control inputround" name="searchtxt" placeholder="Search E-waste Device Here">
                     <span class="input-group-btn">
                        <input type="submit" class="btn btn-default  inputround" name="search" value="search"/>
                    </span>
                    </div>
                </form>
            </div>
                <div>
                <ul class="nav navbar-nav">
                   <li><img class="img-circle img-custom" src="<?=$navres['image'];?>"></li>
                    <li><p class="pstyle"><?=$navres['recyclerEmail'];?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
              </div>
              </div>
            </div>

        

    </nav>

</div>