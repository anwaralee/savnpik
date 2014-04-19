<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title_for_layout; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css"-->
        <?php echo $this->Html->css('normalize.min'); ?>
        <?php echo $this->Html->css('main'); ?>
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' rel='stylesheet' type='text/css'>

        <!--script src="js/vendor/modernizr-2.6.2.min.js"></script-->
        <?php echo $this->Html->script('vendor/modernizr-2.6.2.min'); ?>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <!-- Header Element -->
        <?php echo $this->element('header', array('cache' => false)); ?>

        <div id="content" class="mid-content clearfix">
            <?php echo $this->Session->flash('good'); ?>
            <?php echo $this->Session->flash('bad'); ?>
            <!-- Main Content goes here -->
            <?php echo $content_for_layout; ?>

            <!--Right Sidebar Element -->
            <!--?php echo $this->element('right-sidebar', array('cache' => false)); ?-->

        </div> 
        
        <!--Footer Element -->
        <?php echo $this->element('footer', array('cache' => false)); ?>
                                               


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <!--<?php $pluvendor=$this->Html->script('pluvendor/jquery-1.10.1.min'); ?>
        <script>window.jQuery || document.write(<?php echo $pluvendor;?></script>-->

        <!--script src="js/plugins.js"></script-->
        <?php echo $this->Html->script('plugins'); ?>
        <!--script src="js/main.js"></script-->
         <?php echo $this->Html->script('main'); ?>
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
