<?

// Function to convert time 24 hour mode and convert it to integer.
function conv($time){
// get am pm
$ampm=explode(" ",$time);
// get H:M:S
$hms=explode(":",$ampm[0]);

// figure out noon vs midnight, convert to 24 hour time.
if($hms[0]==12 && $ampm[1]=="AM"){
$hms[0]="00";
}
else{
   if($ampm[1]=="PM"){
      if($hms[0]<12){
      $hms[0]=$hms[0]+12;
      }
   }
}
// build the integer
$build=$hms[0].$hms[1].$hms[2];
return $build;
}
?>