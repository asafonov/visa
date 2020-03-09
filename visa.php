<?php

function check_date($date) {
  $dates = require('dates.php');
  $end_date = strtotime("90 days", $date);
  $start_date = strtotime("-90 days", $date);

  $number_of_days = 90;

  for ($i = count($dates) - 1; $i > -1; --$i) {
    $from_date = strtotime($dates[$i][0]);
    $to_date = strtotime($dates[$i][1]);

    if ($to_date > $start_date) {
      $period_start_date = max($start_date, $from_date);
      $days_abroad = ($to_date - $period_start_date) / 24 / 3600 + 1;
      echo "Substructing days abroad: $days_abroad (" . date('Y-m-d', $period_start_date) . " - {$dates[$i][1]})\n";
      $number_of_days -= $days_abroad;
      $start_date = strtotime("-{$days_abroad}days", $start_date);
    } else {
      break;
    }
  }

  return $number_of_days;
}

$date = count($argv) > 1 ? strtotime($argv[1]) : strToTime(date('Y-m-d', time()));
echo "Requested date: " . date("Y-m-d", $date) . "\n";
$days_left = check_date($date);
echo "Days left: $days_left\n";
