<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING);
	$date=date("Ymdgis");
	if($_REQUEST['p']) {
        $Filename = $_REQUEST['filename'];
        $Filename = $Filename . $date;
        $file =  $_REQUEST['p'];
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Type: application/force-download");
        header('Content-Disposition: attachment; filename=' . "$Filename.pdf");
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        //flush();
        readfile($file);
        unlink($file);
        exit;
    }
?>