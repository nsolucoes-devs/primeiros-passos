<?php
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $mobile = 1;
    } else {
        $mobile = 0;
    }
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <br><br>
            <?php if($mobile == 0){ ?>
                <iframe style="width: 100%; height: 585px; padding-top: 5px;" src="<?php echo $pedido['boleto']?>" title="description"></iframe>
            <?php } else { ?>
                <iframe style="width: 100%; height: 600px;" src="<?php echo $pedido['boleto']?>" title="description"></iframe>
            <?php } ?>
        </div>
    </body>
</html>