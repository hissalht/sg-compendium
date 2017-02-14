<?php
interface UserDatabase {
    /** Return a User object on success, FALSE otherwise */
    public function checkAuth($login, $password);
}
?>
