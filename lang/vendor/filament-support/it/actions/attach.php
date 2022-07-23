<?php

return [

    'single' => [

        'label' => 'Collega',

        'modal' => [

            'heading' => 'Collega :label',

            'fields' => [

                'record_ids' => [
                    'label' => 'Records',
                ],

            ],

            'actions' => [

                'attach' => [
                    'label' => 'Collega',
                ],

                'attach_another' => [
                    'label' => 'Collega & collega altro',
                ],

            ],

        ],

        'messages' => [
            'attached' => 'Collegato',
        ],

    ],

    'multiple' => [

        'label' => 'Collega',

        'modal' => [

            'heading' => 'Collega :label',

            'actions' => [

                'attach' => [
                    'label' => 'Collega',
                ],

            ],

        ],

        'messages' => [
            'attached' => 'Collegati',
        ],

    ],

];
