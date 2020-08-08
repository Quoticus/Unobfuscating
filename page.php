<?php
  $text_block = file_get_contents('textfile.txt');

  drawBlock('Unfiltered Text', $text_block);
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

  drawBlock('Filtered Unique Keys', arrayString($array));

  foreach ($substrmatches as $key => $value) {
    foreach ($value as $innerValue) {
      unset($array[array_search($innerValue, $array)]);
      array_unshift($array, $innerValue);
    }
  }
  drawBlock('Resorted Array', arrayString($array));
  
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

  drawBlock('Added Assoc Keys to Array', arrayString($assocArray));

  foreach ($assocArray as $key => $value) {
    $text_block = str_replace($value, $key, $text_block);
  } 

  drawBlock('Filtered Text', $text_block);

  function drawBlock ($title, $text) {
    echo '<h3>'.$title.'</h3>';
    echo '<textarea class="box" cols="170" rows="60" readonly>'.$text.'</textarea><br/>';
  }

  function arrayString ($array) {
    $arraystring = '';
    foreach ($array as $key => $value) {
      $arraystring .= $key . ': ' . $value . "\r\n";
    }
    
    return $arraystring;
  }

?>
