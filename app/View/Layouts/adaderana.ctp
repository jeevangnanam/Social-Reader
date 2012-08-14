<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_for_layout; ?> &raquo; <?php echo Configure::read('Site.title'); ?></title>
        <?php
        echo $this->Layout->meta();
        echo $this->Layout->feed();
        echo $this->Html->css(array(
            'reset',
            '960',
            'theme',
            '/appproperties/adaderana/css/custom',
            '/js/facebox/src/facebox'
        ));
        echo $this->Layout->js();
        echo $this->Html->script(array(
            'jquery/jquery.min',
            'jquery/jquery.hoverIntent.minified',
            'jquery/superfish',
            'jquery/supersubs',
            'theme',
            'custom',
            'facebox/src/facebox'
        ));
        echo $this->Blocks->get('css');
        echo $this->Blocks->get('script');
        ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header" class="container_16">
                <div class="grid_16">
                    <div id="applogo" style="float:left;margin-right:10px;"><img src="<?php echo $appLogo; ?>"  style=""/></div>
                    <div style="padding-top: 30px;"><h3 class="site-title"><?php echo Configure::read('Site.title'); ?></h1>
                            <span class="site-tagline"><?php echo Configure::read('Site.tagline'); ?></span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

            <div id="nav">
                <div class="container_16">
                   
                    <div id="menu-3" class="menu">
                        <ul class="sf-menu sf-js-enabled">
                            <?php foreach($menu as $menuProp){ ?>
                            <li><a href="feed/<?php echo $menuProp['FeedId']; ?>/" class="mainMenuLink" rel="<?php echo $menuProp['FeedId']; ?>" ><?php echo $menuProp['FeedName']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="main" class="container_16">
                <div id="content" class="grid_11">
                    <?php
                    echo $this->Layout->sessionFlash();
                    echo $content_for_layout;
                    ?>
                </div>

                <div id="sidebar" class="grid_5">
                   <?php echo $this->element('global_social_status'); ?>
                    <?php //echo $this->Layout->blocks('right'); ?>
                </div>

                <!--friend and like list-->
                <div id="sidebar" class="grid_5">
                   <?php echo $this->element('appusers'); ?>
                    <?php //echo $this->Layout->blocks('right'); ?>
                </div>
                
                 <!--Recent share list-->
                <div id="sidebar" class="grid_5">
                   <?php echo $this->element('recentshares'); ?>
                    <?php //echo $this->Layout->blocks('right'); ?>
                </div>
                
                <div class="clear"></div>
                
            </div>

            <div id="footer">
                <div class="container_16">
                    <div class="grid_8 left">
			&nbsp;
                    </div>
                    <div class="grid_8 right">
                       &nbsp;
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <?php
                    echo $this->Blocks->get('scriptBottom');
                    echo $this->Js->writeBuffer();
                    echo $this->element('sql_dump');
        ?>
        <div id="fb-root"></div>
    <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '<?php echo $appId; ?>', // App ID
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
    };

    // Load the SDK Asynchronously
    (function(d){
      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
  </script>
    </body>
</html>