<?php require('config.php') ?>

<html>
    <head>
        <title>Withing Data Api</title>
    </head>
    <body>
        <?php echo '<p>Withing - Data Api</p>'; ?>
            <p>
                <a href="http://account.withings.com/oauth2_user/authorize2?response_type=code&client_id=fabe9d002edc6ef59cf9d277031614ed16d6c5f26bac664af4109ee95e3848ad&state=a_random_value&scope=user.info,user.metrics,user.activity&redirect_uri=<?= urlencode('http://localhost/www/data.php') ?>&mode=demo">Retrieve the data</a>
            </p>
    </body>
</html>