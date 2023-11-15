<?php
// create an anchor link for view files
function get_link($url, $text_content = null, $options = [])
{
  $url = trim($url);
  $url = htmlspecialchars($url);

  $link = '<a href="' . ROOT_URL . $url . '">';

  if (isset($text_content)) {
    $text_content = htmlspecialchars($text_content);
    $link .= $text_content;
  } else {
    $link .= 'link';
  }

  $link .= '</a>';

  echo $link;

  return;
}
