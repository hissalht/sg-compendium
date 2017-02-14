<form action="<?php echo $this->router->getComboSubmissionURL(); ?>" method="POST">
    <label for="character">Character : </label>
    <select name="character" id="character">
<?php
foreach(Combo::CHARACTERS as $char){
    echo "<option value=\"" . $char . "\">". $char . "</option>\n";
}
?>
    </select>
</form>
