<?php
/**
 * Imager X configuration for responsive image transforms.
 */

return [
    'transformer' => 'craft',
    'imagerSystemPath' => '@webroot/imager/',
    'imagerUrl' => '/imager/',
    'jpegQuality' => 82,
    'pngCompressionLevel' => 6,
    'webpQuality' => 80,
    'useCwebp' => false,
    'interlace' => true,
    'allowUpscale' => false,
    'removeMetadata' => true,
    'cacheDuration' => 31536000,

    // Named transforms
    'namedTransforms' => [
        'heroImage' => [
            ['width' => 1920],
            ['width' => 1200],
            ['width' => 768],
            ['width' => 480],
        ],
        'bookCover' => [
            ['width' => 600, 'height' => 900, 'mode' => 'crop'],
            ['width' => 400, 'height' => 600, 'mode' => 'crop'],
            ['width' => 280, 'height' => 420, 'mode' => 'crop'],
        ],
        'authorPhoto' => [
            ['width' => 480, 'height' => 600, 'mode' => 'crop'],
            ['width' => 360, 'height' => 450, 'mode' => 'crop'],
            ['width' => 240, 'height' => 300, 'mode' => 'crop'],
        ],
        'authorTeaser' => [
            ['width' => 400, 'height' => 500, 'mode' => 'crop'],
            ['width' => 280, 'height' => 350, 'mode' => 'crop'],
        ],
    ],
];
