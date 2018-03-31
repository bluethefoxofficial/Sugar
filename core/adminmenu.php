
<?php
include("core/json.php");
session_start();
?>
<style>
.navbar-light .navbar-nav .nav-link {
    color: rgba(<?php echo $navbarfontcolour; ?>);
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: rgba(<?php echo $bodycolour; ?>);
}
</style>
<link rel="icon" href="<?php echo $logo; ?>">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(<?php echo $navbarcolour; ?>) !important; color: rgba(<?php echo $navbarfontcolour; ?>)">
  <a class="navbar-brand" href="index.php"><?php print($name); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="users.php">manage users</a>
      </li>
    </ul>
  </div>
</nav>