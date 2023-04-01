<?php
require '../../vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

$image = Image::make('lis.png');
$image->resize($image->getWidth()-10, $image->getHeight()-10, function (\Intervention\Image\Constraint $constraint) {
    $constraint->aspectRatio();
});

$image->text('Hello Word', 0, 50, function (\Intervention\Image\AbstractFont $font) {
    $font->size(24);
    $font->file('verdana.ttf');
    $font->color('#000000');
    $font->align('right');
    $font->align('bottom');
});

$image->save('test.png');

echo $image->response('png');
