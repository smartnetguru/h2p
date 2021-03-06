<?php
/*
 * H2P - HTML to PDF PHP library
 *
 * Sample file
 *
 * LICENSE: The MIT License (MIT)
 *
 * Copyright (C) 2013 Daniel Garajau Pereira
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this
 * software and associated documentation files (the "Software"), to deal in the Software
 * without restriction, including without limitation the rights to use, copy, modify,
 * merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies
 * or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @package    H2P
 * @author     Daniel Garajau <http://github.com/kriansa>
 * @copyright  2013 Daniel Garajau <http://github.com/kriansa>
 * @license    MIT License
 */

include '../autoloader.php';

use H2P\Converter\PhantomJS;
use H2P\TempFile;
use H2P\Request;
use H2P\Request\Cookie;

$converter = new PhantomJS(array(
    'orientation' => PhantomJS::ORIENTATION_LANDSCAPE,
    'format' => PhantomJS::FORMAT_A4,
    'zoomFactor' => 2,
    'border' => '1cm',
    'header' => array(
        'height' => '1cm',
        'content' => "<h1>{{pageNum}} / {{totalPages}}</h1>",
    ),
    'footer' => array(
        'height' => '1cm',
        'content' => "<h1>{{pageNum}} / {{totalPages}}</h1>",
    ),
));

// Create a full custom request
$request = new Request(
    'http://www.google.com/',
    Request::METHOD_POST,
    array('param' => 'value'), // POST params
    array('X-Header' => 'value'), // Custom headers
    array(
        new Cookie('Cookie', 'value', 'domain'), // Create a basic cookie
    )
);

$destination = new TempFile();
$converter->convert($request, $destination);

// $destination->save('/home/user/Documents/page.pdf');