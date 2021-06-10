<?php
/*

bluethefox search bar the default searchbar plugin in sugar image board (SIB).

*/
?>

<form class="d-flex" action="search.php">
        <input class="form-control me-2" name="q" type="search" placeholder="Search" value="<?php if($_GET['q']){echo $_GET['q'];} ?>" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
</form>