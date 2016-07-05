<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Modules::run('pref/_site_name').' | '.$template['title'] ?></title>
    <meta name="title" content="iCore" />
    <meta name="description" content="Information Corespondence" />
    <meta name="author" content="Reko Srowako - +6285717745555" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo img_url(); ?>_assets/favicon.ico" type="image/vnd.microsoft.icon" />
    <!-- This is the traditional favicon.
     - size: 16x16 or 32x32
     - transparency is OK -->
    <link rel="apple-touch-icon" href="<?php echo img_url(); ?>apple-touch-icon.png" />
    <!-- The is the icon for iOS's Web Clip and other things.
     - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for retina display (IMHO, just go ahead and use the biggest one)
     - To prevent iOS from applying its styles to the icon name it thusly: apple-touch-icon-precomposed.png
     - Transparency is not recommended (iOS will put a black BG behind the icon) -->
    <!-- Core CSS files files -->
    <?php echo css('stylesheets'); ?>
    <!-- Custom Module CSS files -->
    <?php echo module_css(); ?>
    <!-- End CSS files -->
    <!-- Core JS files -->
    <?php // echo js('plugins/jquery/jquery.min'); ?>
    <?php echo js('jquery-1.11.1.min'); ?>
    <?php echo js('plugins/bootstrap/bootstrap.min'); ?>
    <?php echo js('actions'); ?>
    <!-- Custom Module JS files -->
    <?php echo module_js(); ?>
    <!-- HMVC CSS & JS files -->
    <?php echo (isset($template['metadata']) ? $template['metadata']:''); ?>
    <!-- End JS files -->    
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 </head>