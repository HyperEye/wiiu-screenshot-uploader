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

/**
wiiuDir

The output directory. The screenshots are saved into game subdirectories here.
*/
$wiiuDir = '/var/www/wiiu/';

/**
matchWidth

Boolean value. When enabled the smaller of the two images
is resized to match the width of the larger image. Aspect ratio is
maintained. Disable to append without resizing and add a border.
*/
$matchWidth = false;

/**
mergedBGColor

If matchWidth is disabled the smaller of the two images
will include a border on the sides. This setting modifies the border color.
*/
$mergedBGColor = 'black';

/**
resizeFilter

The filter to use when resizing an image.
Possible values can be found here:
http://php.net/manual/en/imagick.constants.php#imagick.constants.filters
*/
$resizeFilter = Imagick::FILTER_LANCZOS;

/**
displayResult

Boolean value. When enabled the user will be redirected to
the uploaded image. For this to work wiiuDir must be accessible to the web
server. If this setting is disabled the user will be informed of success or
failure.
*/
$displayResult = true;

?>
