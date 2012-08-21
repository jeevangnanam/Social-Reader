<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    	<?php if(isset($icon)): ?>
		<link rel="SHORTCUT ICON" href="<?php echo $icon; ?>"/>
        <?php endif; ?>
        
        <title><?php echo $title; ?></title>
        
        <meta property="fb:app_id" content="<?php echo $appId; ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo $description; ?>" />

       <?php if(isset($image)): ?>
        <meta property="og:image" content="<?php echo $image; ?>" />
        <?php endif; ?>
        
        <meta property="og:url" content="<?php echo $url; ?>" />
        

        <?php
        echo $this->Layout->meta();
        echo $this->Layout->feed();
        echo $this->Html->css(array(
            'reset',
            '960',
            'theme',
            'custom',
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
    <body class="changeBodyBack">
        <div id="fb-root"></div>
        <div id="main" class="container_12 " >
                <div id="content" class="grid_11 ">
                    <?php
                    echo $this->Layout->sessionFlash();
                    echo $content_for_layout;
                    ?>
                </div>

                
                <div class="clear"></div>
                
            </div>


    </body>
 </html>
