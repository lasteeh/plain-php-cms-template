<h1>signup page</h1>
<form action="<?php echo ROOT_URL ?>/signup" method="post">
  <input type="email" placeholder="email" name="email" required>
  <input type="password" placeholder="password" name="password" required>
  <input type="password" placeholder="password confirmation" name="password_confirmation" required>
  <button type="submit">signup</button>
</form>