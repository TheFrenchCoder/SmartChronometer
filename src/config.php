<?php

return (object) array(
    'role' => [
        'all' => ['Admin', 'Start', 'Finish', 'Judge', 'Debug'],
        'allowTo' => [
            'start'  => ['Admin', 'Start' ],
            'judge'  => ['Admin', 'Judge' ],
            'finish' => ['Admin', 'Finish'],
            'admin'  => ['Admin']          ,

            'debug' => ['Admin', 'Debug']
        ]
    ],
    'role' => [
        'displayPenaltyChoice' => 'text',

        'judge_gates' => [
            '_syntax' => ' "user_id" => ["gate_number_allowed", "another"]',
            '1' => [1, 2, 3]
        ],
    ],
    'races' => [
        '_synthax' => '{number}',
        'current_race' => 1,

        '_comment' => 'List all races',
        '_warning' => 'MUST HAVE A TABLE IN DB WITH PREFIX_NAME',
        '_syntax_programmedRaces' => [
            'race_{integer_or_string}' => [
                'type' => '{string} (slalom/sprint)',
                'order' => '{integer}'
            ]
        ],
    ]
);