<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    
    <script> 
        goog.require( 'altumo.core.Altumo' );
    </script>
    
    <script>

            var alt = new altumo.core.Altumo({
                routes: <?php echo \sfAltumoPlugin\Routing\RouteExporter::getRoutesAsKeyValuePairJson( '/^api\\_.+$/', array( 'export_to_javascript' => true ) ); ?>
            });
            
    </script>
    
    <script>goog.require( 'app.main' );</script>
  </head>
  <body>
    <?php echo $sf_content ?>
  </body>
</html>
