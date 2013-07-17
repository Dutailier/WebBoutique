<?php
$title = TYPES_TITLE;
?>

<?php ob_start(); ?>

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

