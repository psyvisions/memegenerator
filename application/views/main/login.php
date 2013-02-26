<h3>Please login using your username and password</h3>

<?php if($login_failed) { ?>
  <div class="notice-error">
    Either username or password does not match. Try again.
  </div>
<?php } ?>

<div id="login">
  <form method="post" action="/meme/signin">
    <div>
      <label for="username">Username: </label><br/>
      <input type="text" name="username" id="username" class="input_text" />
    </div>
    <div>
      <label for="password">Password: </label><br>
      <input type="password" name="password" id="password" class="input_text" />
    </div>
    <div>
      <input type="submit" value="Ingresar" class="input_submit" />
    </div>
  </form>
</div>
<div>
  <h5>Do not have an account? Sign up <a href="/signup">Here</a></h5>
</div>