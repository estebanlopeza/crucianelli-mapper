<?php 
switch ( $_POST['action'] ) {
    case 'save':
        save_coords($_POST['coords'], $_POST['despiece']);
        break;
    case 'load':
        load_coords($_POST['despiece']);
        break;
    default:
        echo '0';
        die;
}

function save_coords($coords, $despiece){
    $coords = json_decode($coords);

    $csv = 'csv/'.$despiece.'.csv';
    $fp = fopen($csv, 'w');

    foreach ($coords as $coord) {
        fputcsv($fp, [$coord]);
    }
    fclose($fp);
    
    echo  1;
    die;
}

function load_coords($despiece){

    $csv = 'csv/'.$despiece.'.csv';

    if(! file_exists($csv)) die('0');

    $fp = fopen($csv, 'r');
    $arr = [];

    while (($line = fgetcsv($fp)) !== FALSE) {
        $arr[] = $line;
    }
    echo json_encode($arr);
    fclose($fp);
}