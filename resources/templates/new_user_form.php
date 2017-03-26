<form action="<?php $this->router->getNewUserURL() ?>" method="POST" id="new-user">
    <div class="field">
        <label for="name">Your name</label>
        <input type="text" name="<?php echo UserBuilder::NAME_REF; ?>"
                id="name" value="<?php echo $userData[UserBuilder::NAME_REF]; ?>">
    </div>

    <div class="field">
        <label for="login">Your login</label>
        <input type="text" name="<?php echo UserBuilder::LOGIN_REF; ?>"
                id="login" value="<?php echo $userData[UserBuilder::LOGIN_REF]; ?>">
    </div>

    <div class="field">
        <label for="mail">Mail address</label>
        <input type="email" name="<?php echo UserBuilder::MAIL_REF; ?>"
                id="mail" value="<?php echo $userData[UserBuilder::MAIL_REF]; ?>">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="<?php echo UserBuilder::PASSWORD_REF; ?>"
                id="password">
    </div>

    <div class="field">
        <input type="submit" value="Save">
    </div>
</form>
