<?php
interface UserDatabase {
    /** Return a User object on success, FALSE otherwise */
    public function checkAuth($login, $password);
    public function loginIsAvailable($login);
    public function addUser($usern, $password);
}
?>
