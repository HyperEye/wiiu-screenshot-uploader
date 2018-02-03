<!--
  MIT License

  Copyright (c) 2018 Michael J. Wood

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
  SOFTWARE.
-->

<!DOCTYPE html>
<html>
<head>
  <title>WiiU Screenshot Upload</title>
</head>

<body>
<form style="border: 1px solid #000; padding: 10px" enctype="multipart/form-data" action="saveWiiUSS.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
Top Image <input name="topimg" type="file"/> <span style="color:ff0000"> *</span>
<br style="margin-bottom:20px;"/>
Bottom Image <input name="bottomimg" type="file"/>
<br style="margin-bottom:20px;"/>
Rename 
<input name="filerename" type="input"/>
<br style="margin-bottom:20px;"/>
<select name="gameSelect">
<option value="">- Select Game -
<?php
require('config.php');
$dirPath = dir($wiiuDir);
$dirArray = array();
while (($file = $dirPath->read()) !== false)
{
    $fullpath = $wiiuDir . '/' . $file;
    if(is_dir($fullpath) && $file !== '.' && $file !== '..') {
        $dirArray[ ] = trim($file);
    }
}
$dirPath->close();
sort($dirArray);
$c = count($dirArray);
for($i = 0; $i < $c; $i++)
{
    echo "<option value=\"" . $dirArray[$i] . "\">" . $dirArray[$i] . "\n";
}
?>
</select>
Other <input name="game" type="input"/>
<br style="margin-bottom:20px;"/>
<input type="submit" value="Go"/>
</form>
</body>
</html>
