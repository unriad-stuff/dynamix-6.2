<?PHP
/* Copyright 2005-2016, Lime Technology
 * Copyright 2012-2016, Bergware International.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */
?>
<?
$docroot = $_SERVER['DOCUMENT_ROOT'];
$file = $_POST['file'];
switch ($_POST['cmd']) {
case 'save':
  $source = $_POST['source'];
  if (pathinfo($source, PATHINFO_EXTENSION) == 'txt') {
    exec("zip -qlj $docroot/$file $source");
  } else {
    $tmp = "/var/tmp/".basename($source).".txt";
    copy($source, $tmp);
    exec("zip -qlj $docroot/$file $tmp");
    @unlink($tmp);
  }
  echo "/$file";
  break;
case 'delete':
  @unlink("$docroot/$file");
  break;
case 'diag':
  exec("$docroot/webGui/scripts/diagnostics {$_POST['anonymize']} $docroot/$file");
  echo "/$file";
  break;
}
?>
