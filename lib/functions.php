<?php
function addCode($matches) {
  return '<span class="code-'.$matches[1].'">'.$matches[2].'</span>';
}

function processColors($text) {
  $result = htmlspecialchars(preg_replace('/\xA7/', '&', $text));
  $result = preg_replace_callback('/&amp;([k-o])(.*?)(?=&amp;[0-9a-fk-or])/', "addCode", $result);
  $result = preg_replace_callback('/&amp;([k-o])(.*)$/', "addCode", $result);
  $result = preg_replace_callback('/&amp;([0-9a-f])(.*?)(?=&amp;[0-9a-fr])/', "addCode", $result);
  $result = preg_replace_callback('/(?:&amp;([0-9a-f]))(.*)$/', "addCode", $result);
  $result = preg_replace('/&amp;r/', '', $result);
  return $result;
}