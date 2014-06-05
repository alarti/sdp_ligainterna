
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        #add_filter('authenticate', array('sdp_SAMLAuthenticator', 'authenticate'), 10, 2);
        require_once('../../../../wp-load.php');
        require_once('../../../../wp-config.php');

        home_url();
        //$sdp=new sdp_SAMLAuthenticator();
        //$sdp->authenticate();
        //echo wp_login_url(home_url()); 
        //include_once("../class/sdp_SAMLAuthenticator.php");
        //$as = new sdp_SAMLAuthenticator();
        //$as->authenticate('infaar01', 'infaar01');
        //add_filter('authenticate', array('sdp_SAMLAuthenticator', 'authenticate'), 10, 2);
        ?>
    </body>
</html>
