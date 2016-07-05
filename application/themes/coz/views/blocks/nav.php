<?php if(!isset($active)) $active =''; ?>
<?php echo Modules::run('navigation/build', $active); ?>