<form action="<?php echo ROOT_URL ?>/images" method="post" enctype="multipart/form-data">
  <input type="file" name="images[]" accept="image/*" autocomplete="off" multiple required>
  <button type="submit">upload image(s)</button>
</form>