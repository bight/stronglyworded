<?php
    use \Michelf\Markdown;
    use \Michelf\SmartyPants;
?>

<!doctype html>
<html lang="en-CA">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser.<br />
            Please <a href="http://browsehappy.com/">upgrade</a> to improve your experience and security.</p>
        <![endif]-->

        <?php
        require_once __DIR__ . '/vendor/autoload.php';
        require 'config.php';

        if (isset($_POST['address'])) {
            if (!empty($_POST['address'])
                && isset($_POST['city'])
                && !empty($_POST['city'])
                && isset($_POST['province_state'])
                && !empty($_POST['province_state'])
                && isset($_POST['postalcode_zipcode'])
                && !empty($_POST['postalcode_zipcode'])
                && isset($_POST['name'])
                && !empty($_POST['name'])
                && isset($_POST['letter'])
                && !empty($_POST['letter'])) {
                $letter = sprintf(
                    '<div class="letter">
                        <div class="sender">%s<br />%s</div>
                        <div class="date">%s</div>
                        <div class="recipient">%s%s%s</div>
                        <div class="salutation">%s</div>
                        <div class="body">%s</div>
                        <div class="signature">%s</div>
                        <div class="name">%s</div>
                    </div>',
                    $_POST['name'],
                    $_POST['address'] . '<br />'
                        . $_POST['city'] . ', ' . $_POST['province_state'] . ' ' . $_POST['postalcode_zipcode'],
                    date('F j, Y'),
                    (isset($recipient['name'])) ? '<p class="name">' . $recipient['name'] . '<br />' : '<p>',
                    (isset($recipient['organization'])) ? $recipient['organization'] . '</p>' : '</p>',
                    '<p class="address">' . $recipient['address'] . '<br />'
                        . $recipient['city'] . ', ' . $recipient['province_state'] . ' '
                        . $recipient['postalcode_zipcode'] . '</p>',
                    $salutation,
                    Markdown::defaultTransform($_POST['letter']),
                    $signature,
                    $_POST['name']
                );
                $mpdf = new mPDF();
                $mpdf->WriteHTML(file_get_contents(__DIR__ . '/css/print.css'), 1);
                $mpdf->WriteHTML($letter, 2);
                $mpdf->Output($filename, 'D');
            } else {
                printf(
                    '<p class="error">%s</p>',
                    'You didn&rsquo;t fill out something you were supposed to fill out. Please try again.'
                );
            }
        }
        ?>
        <div class="intro"><?= SmartyPants::defaultTransform(Markdown::defaultTransform($intro))?></div>
        <form class="content" action="" method="post">
        <p class="align-right"><input type="text" name="address" placeholder="Street Address" /></p>
        <p class="align-right"><input type="text" name="city" placeholder="City" /></p>
        <p class="align-right"><input type="text" name="province_state" placeholder="Province/State" /></p>
        <p class="align-right"><input type="text" name="postalcode_zipcode" placeholder="Postal Code/Zip Code" /></p>
        <p class="align-right"><?= date('F j, Y'); ?></p>
        <?php printf(
            '<p class="recipient">%s%s<br />%s<br />%s, %s %s</p>',
            (isset($recipient['name'])) ? $recipient['name'] . '<br />' : '',
            $recipient['organization'] . '<br />',
            $recipient['address'],
            $recipient['city'],
            $recipient['province_state'],
            $recipient['postalcode_zipcode']
        );
        printf(
            '<p class="salutation">%s</p>',
            $salutation
        );
        printf(
            '<textarea class="letter" name="letter" rows="20" readonly>%s</textarea>',
            SmartyPants::defaultTransform($body)
        );
        printf(
            '<p class="signoff">%s</p>',
            $signoff
        );
        ?>
        <p><input type="text" name="name" placeholder="Your Name" /></p>
        <input type="submit" name="generate" value="Generate Letter" />
        <form>

        <?php if ($analytics) { ?>
        <!-- Google Analytics -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','<?= $analytics; ?>','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
        <?php } ?>
    </body>
</html>
