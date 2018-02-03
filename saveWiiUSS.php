<?php
/*
 * MIT License
 *
 * Copyright (c) 2018 Michael J. Wood
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

require('config.php');

echo '<pre>';

/* This is a critical test. Without it someone could upload and execute code on the server.
   Good server configuration is still important. If someone uploads code in a file with an
   image mime type and extension the server should not attempt to execute it. For the best
   peace of mind make this page use https and protect it with credentials. */
function fileIsImage($filename, $ext)
{
    // Verify mime type
    $fileinfo = new finfo(FILEINFO_MIME_TYPE);
    $file = $fileinfo->file($filename);
    $allowed_types = array('image/jpeg', 'image/png');
    if(!in_array($file, $allowed_types)) {
        return false;
    }

    // Verify extension
    $allowed_exts = array('jpeg', 'jpg', 'png');
    if(!in_array($ext, $allowed_exts)) {
        return false;
    }

    return true;
}

function prepGameDir($gamedir)
{
    if(!file_exists($gamedir)) {
        if(!mkdir($gamedir, 0775)) {
            return false;
        }
        chmod($gamedir, 0775);
    }
    return true;
}

function mergeImages($topimg, $bottomimg, $outfile)
{
    require('config.php');
    if($topimg === '' || $bottomimg === '' || $outfile === '') {
        echo "Bad parameter passed to mergeImages()\n";
        return false;
    }

    if($matchWidth) {
        list($topwidth) = getimagesize($topimg);
        list($bottomwidth) = getimagesize($bottomimg);
        $width = max($bottomwidth, $topwidth);
    }

    $convert = new Imagick();
    $convert->setBackgroundColor(new ImagickPixel($mergedBGColor));
    $convert->setGravity(imagick::GRAVITY_CENTER);

    if(!$convert->readImage($topimg)) {
        echo "Failed to read top image\n";
        return false;
    }
    
    if($matchWidth) {
        $convert->resizeImage($width, 0, $resizeFilter, 0);
    }

    if(!$convert->readImage($bottomimg)) {
        echo "Failed to read bottom image\n";
        return false;
    }

    if($matchWidth) {
        $convert->resizeImage($width, 0, $resizeFilter, 0);
    }

    $convert->resetIterator();
    $convert = $convert->appendImages(true);
    return $convert->writeImage($outfile);
}

if($_POST['game'] !== '') {
    $game = $_POST['game'];
} elseif($_POST['gameSelect'] !== '') {
    $game = $_POST['gameSelect'];
}

$uploaddir = $wiiuDir . $game . "/";
$topsrcfile = $_FILES['topimg']['tmp_name'];
$topext = strtolower(pathinfo($_FILES['topimg']['name'], PATHINFO_EXTENSION));
$bottomsrcfile = $_FILES['bottomimg']['tmp_name'];
$bottomext = strtolower(pathinfo($_FILES['bottomimg']['name'], PATHINFO_EXTENSION));

if($_POST['filerename'] !== '') {
    $uploadfile = $uploaddir . $_POST['filerename'] . '.' . $topext;
} else {
    $uploadfile = $uploaddir . basename($_FILES['topimg']['name']);
}

if($topsrcfile === '') {
    die('Failure. Top image is required.');
}

// Verify that this is an image file
if(!fileIsImage($topsrcfile, $topext) || ($bottomsrcfile !== '' && !fileIsImage($bottomsrcfile, $bottomext))) {
    die('Failure. Attempted to upload invalid file type.');
}

// If the game directory doesn't exist create it
if(!prepGameDir($uploaddir)) {
    die('Failure. Could not create game directory.');
}

// Don't overwrite existing files
if(file_exists($uploadfile)) {
    die('Failure. File exists.');
} else {
    if($bottomsrcfile !== '') {
        if(!class_exists('Imagick')) {
            die('Failure. Images cannot be combined. Please install the ImageMagick php package.');
        }
        if(!mergeImages($topsrcfile, $bottomsrcfile, $uploadfile)) {
            die('Failure. Could not merge images.');
        }
    } else {
        if (!move_uploaded_file($topsrcfile, $uploadfile)) {
            die('Failure. Could not write to destination');
        }
    }
    chmod($uploadfile, 0660);

    if($displayResult) {
        header('Location: '.str_replace(' ','%20',$uploadfile));
    }
    else {
        echo "Success.";
        exit();
    }
}
?>
