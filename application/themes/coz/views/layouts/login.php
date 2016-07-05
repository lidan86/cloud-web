<!DOCTYPE html>
<html lang="en">
<?php echo $template['partials']['header']; ?>
    
    <body class="bg-black">

        <div class="form-box" id="<?php echo $this->router->method; ?> direction: <?php echo t('direction'); ?>">
            <?php echo $template['body']; ?>

        </div>
        <?php echo $template['partials']['javascript']; ?>
       

    </body>

</html>

