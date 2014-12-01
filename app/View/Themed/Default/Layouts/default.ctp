<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        
        <title><?php echo $title_for_layout; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css"-->
        <?php echo $this->Html->css('normalize.min',array('fullBase'=>true)); ?>
        <?php echo $this->Html->css('main',array('fullBase'=>true)); ?>
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' rel='stylesheet' type='text/css'>

        <!--script src="js/vendor/modernizr-2.6.2.min.js"></script-->
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
        <?php echo $this->Html->script('jquery-1.10.2.min.js');?>
        <?php echo $this->Html->script('vendor/modernizr-2.6.2.min',array('fullBase'=>true)); ?>
        <script src="<?php echo $this->webroot?>js/jquery-ui-1.10.4.min.js"></script>
        <link href="<?php echo $this->webroot?>css/jquery.ui.css" type="text/css" rel="stylesheet" />
    <script>
    $(function(){
        setTimeout('delay3',4000);
        
    });
    function delay3()
    {
        $('.message').slideUp(1000);
    }
    
    
    </script>
    </head>
    <body>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=643188959085610";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
            <?php
            if($this->request->params['action']!='register') 
            echo $this->element('right-sidebar', array('cache' => false)); 
            ?>

        </div> 
        
        <!--Footer Element -->
        <?php echo $this->element('footer', array('cache' => false)); ?>
                                               


        
        <!--<?php $pluvendor=$this->Html->script('pluvendor/jquery-1.10.1.min'); ?>
        <script>window.jQuery || document.write(<?php echo $pluvendor;?></script>-->

        <!--script src="js/plugins.js"></script-->
        <?php echo $this->Html->script('plugins',array('fullBase'=>true)); ?>
        <!--script src="js/main.js"></script-->
         <?php echo $this->Html->script('main',array('fullBase'=>true)); ?>
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        <?php //echo $this->element('sql_dump'); ?>
        <script type="text/javascript">
      (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client:plusone.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
    </script>
    <div class="dialog-modal"></div>
    </body>
</html>
