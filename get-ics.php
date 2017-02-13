<?php


require('source.php');

//ICS FILE

function dateToCal($timestamp) {
    return date('Ymd\THis\Z', $timestamp);
}

function escapeString($string) {
    return preg_replace('/([\,;])/','\\\$1', $string);
}


$filename='edt-L3-G'.$group.$subgroup.'.ics';

header('Content-type: text/calendar');
header('Content-Disposition: inline; filename='.$filename);

echo "BEGIN:VCALENDAR";
echo "\nVERSION:2.0";
echo "\nPRODID:-//hacksw/handcal//NONSGML v1.0//EN";

foreach ($fullCal as $key => $event) {
    echo "\nBEGIN:VEVENT";
    echo "\nUID:".dateToCal(time())."-".uniqid()."@clementbosc.fr";
    echo "\nDTSTAMP:".dateToCal(time());
    echo "\nDTSTART:".dateToCal(strtotime($event['horaires']['begin'].' Europe/Paris'));
    echo "\nDTEND:".dateToCal(strtotime($event['horaires']['end'].' Europe/Paris'));
    echo "\nLOCATION:".escapeString($event['salle']);
    echo "\nDESCRIPTION:".escapeString($event['notes']);
    echo "\nSUMMARY:".escapeString($event['type'].' - '.$event['matiere']);
    echo "\nEND:VEVENT";
}
echo "\nEND:VCALENDAR";

exit();
