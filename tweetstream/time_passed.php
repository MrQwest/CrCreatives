<?php
function time_passed($t1, $t2)
{
   if($t1 > $t2)
   {
      $time1 = $t2;
      $time2 = $t1;
   }
   else
   {
      $time1 = $t1;
      $time2 = $t2;
   }
   $diff = array(
      'years' => 0,
      'months' => 0,
      'weeks' => 0,
      'days' => 0,
      'hours' => 0,
      'minutes' => 0,
      'seconds' =>0
   );
   $units = array('years','months','weeks','days','hours','minutes','seconds');
   foreach($units as $unit)
   {
      while(true)
      {
         $next = strtotime("+1 $unit", $time1);
         if($next < $time2)
         {
            $time1 = $next;
            $diff[$unit]++;
         }
         else
         {
            break;
         }
      }
   }
   return($diff);
}
?>