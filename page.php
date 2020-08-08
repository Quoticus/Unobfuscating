<?php
  $text_block = file_get_contents('textfile.txt');
  echo 'Unfiltered Text';
  echo '<br/>';
  echo '<textarea class="box" cols="170" rows="60" readonly>'.$text_block.'</textarea>';
  preg_match_all("/(_0x[a-zA-Z0-9]*)/", $text_block, $matches);
  $array = [];
  foreach($matches as $value) {
    $array = array_merge($array, $value);
  }
  $array = array_unique($array);
  

  $substrmatches = [];
  foreach ($array as $key => $value){
    $count = 0;
    foreach ($array as $innerKey => $innerValue) {
      if ($innerKey != $key && strpos($innerValue, $value) !== FALSE) {
        $count++;
        if ($key < $innerKey) {
          $substrmatches[$value][] = $innerValue;
        }
      }
    }
  }

  echo '<br/>Filtered Unique Keys<br/>';
  echo '<textarea class="box" cols="170" rows="60" readonly>'.arrayString($array).'</textarea>';

  foreach ($substrmatches as $key => $value) {
    foreach ($value as $innerValue) {
      unset($array[array_search($innerValue, $array)]);
      array_unshift($array, $innerValue);
    }
  }

  echo '<br/>Resorted Array</br>';
  echo '<textarea class="box" cols="170" rows="60" readonly>'.arrayString($array).'</textarea>';
  
  $assocArray = [];
  $count = 0;
  $specialPlayers = [
    '_0x17c285' => 'BigVar1',
    '_0x17c2' => 'MasterArray',
    '_0x540b' => 'AnonymousFunction',
    '_0x540b0f' => 'ReturnedArray',
    '_0x478919' => 'LocationVariable',
    '_0x14ad6e' => 'CharacterMask',
  ];
  foreach ($array as $key => $value) {
    if (array_key_exists($value, $specialPlayers)) {
      $assocArray[$specialPlayers[$value]] = $value;
    }
    else {
      $assocArray['variableNum'.++$count] = $value;
    }
  }

  echo '<br/>Added Assoc Keys to Array</br>';
  echo '<textarea class="box" cols="170" rows="60" readonly>'.arrayString($assocArray).'</textarea>';

  foreach ($assocArray as $key => $value) {
    $text_block = str_replace($value, $key, $text_block);
  } 

  echo '<br/>Filtered Text</br>';
  echo '<textarea class="box" cols="170" rows="60" readonly>'.$text_block.'</textarea>';

  function arrayString ($array) {
    $arraystring = '';
    foreach ($array as $key => $value) {
      $arraystring .= $key . ': ' . $value . "\r\n";
    }
    
    return $arraystring;
  }

?>
