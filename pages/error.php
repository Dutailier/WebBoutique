<?php
$title = ERROR_TITLE;
?>

<?php ob_start(); ?>

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<h1><?php echo ERROR_404; ?></h1>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

