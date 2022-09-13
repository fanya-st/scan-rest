<?php
return [
    'default' => 'standard',
    'sanitizers' => [
        'standard' => \Smorken\Sanitizer\Sanitizers\Standard::class,
        'sis' => \Smorken\Sanitizer\Sanitizers\RdsCds::class,
    ],
];
