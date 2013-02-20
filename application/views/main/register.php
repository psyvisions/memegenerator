<?php if($errormessage) { ?>
  <div class="notice-error">
    <?php echo $errormessage; ?>
  </div>
<?php } ?>


<div id="login">
  <form method="post" action="/register">
    <div>
      <label for="username">Username: </label><br/>
      <input type="text" name="username" id="username" class="input_text" />
    </div>
    <div>
      <label for="password">Password: </label><br>
      <input type="password" name="password" id="password" class="input_text" />
    </div>
    <div>
      <input type="submit" value="Sign Up!" class="input_submit" />
    </div>
  </form>
</div>
<div>
  <h5>Already have an account? Sign in <a href="/login">Here</a></h5>
</div>