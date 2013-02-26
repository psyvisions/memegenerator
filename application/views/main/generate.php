<h2>
  Create your own!
</h2>

<form action="/meme/create" method="post" enctype="multipart/form-data">
  <div>
    Introduce a Title:
    <input type="text" name="title" maxsize="65" />
  </div>
  <div>
    Introduce Title to Image:
    <input type="text" name="text" maxsize="65" />
  </div>
  <div>
    Introduce Message to Image:
    <input type="text" name="message" maxsize="65" />
  </div>
  <div>
    Choose an Image:
    <input type="file" name="fondo" />
  </div>
  <div>
    <input type="submit" value="Create" />
  </div>
</form>