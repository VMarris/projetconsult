<?php

    // get the HTML
    ob_start();
    include(dirname(__FILE__).'../aprint.php');
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/../admin/lib/php/html2pdf-4.5.1/vendor/autoload.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('rendez_vous.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }


