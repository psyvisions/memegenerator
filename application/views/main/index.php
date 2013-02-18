<section>
  <?php foreach($memes as $meme) { ?>
    <div class="meme" style="margin-left: 15px;">
      <h2><?php echo $meme['title']; ?></h2>
      <p><?php echo $meme['date']; ?></p>
      <img src="/statics/memes/created/<?php echo $meme['id']; ?>.jpg" style="margin-left: 15px;"/>
      <p>
        <?php echo $meme['text']; ?>
      </p>
    </div>
  <?php } ?>
</section>