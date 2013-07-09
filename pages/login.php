<?php
$title = LOGIN_TITLE;
?>

<?php ob_start(); ?>

<link type="text/css" rel="stylesheet" href="css/logIn.css"/>

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<div id="background">
    <div id="logIn">
        <form id="frmLogIn" method="post" onsubmit="return false;">
            <p>
                <label class="inline" for="username"><?php echo LOGIN_LBL_USERNAME; ?></label>
                <input id="username" name="username" type="text"/>
            </p>

            <p>
                <label class="inline" for="password"><?php echo LOGIN_LBL_PASSWORD; ?></label>
                <input id="password" name="password" type="password"/>
            </p>

            <p>
                <input id='btnLogIn' type="submit" value="<?php echo LOGIN_BTN_LOGIN; ?>"/>
            </p>
        </form>
    </div>
</div>

<script src="js/logIn.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

