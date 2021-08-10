<?php

return [
    'hosts' => [
        // elasticsearch의 host를 환경에 맞게 지정
        env('ELASTICSEARCH_HOST', '127.0.0.1:9200'),
    ]
];
