<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/meme/statics/css/styles.css" type="text/css" />
    <script type="text/javascript" src="/meme/statics/js/jquery.js"></script>
    <?php if(isset($js_scripts)) print_js($js_scripts); ?>
  </head>
  <body>
    <div id="container">
      
      <header style="position: relative;">
        <img src="/meme/statics/images/logo.png" style="height: 120px;"/>
        <div id="user_bar">
          <?php if($username) { ?>
            Welcome! <?php echo $username; ?> | <a href="/meme/logout">Logout</a>
          <?php } else { ?>
            <a href="/meme/login">Login</a>
          <?php } ?>
        </div>
        
        <nav>
          <ul id="menu">
            <li><a href="/meme/">Home</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="/meme/generate">Make your own!</a></li>
            <li><a href="/meme/contact">Contact us</a></li>
          </ul>
        </nav>
      </header>
      <br class="clear" />
      
      <?php echo $contents; ?>
    </div>
  </body>
</html>