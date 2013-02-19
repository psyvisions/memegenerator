<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="statics/css/styles.css" type="text/css" />
  </head>
  <body>
    <div id="container">
      
      <header>
        <img src="/statics/images/logo.png" style="height: 120px;"/>
        <nav>
          <ul id="menu">
            <li><a href="/">Home</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="/generate">Make your own!</a></li>
            <li><a href="/contact">Contact us</a></li>
          </ul>
        </nav>
      </header>
      <br class="clear" />
      
      <?php echo $contents; ?>
    </div>
  </body>
</html>