<?php

return [

    'fields' => [

        'search_query' => [
            'label' => 'Cerca',
            'placeholder' => 'Cerca',
        ],

    ],

    'pagination' => [

        'label' => 'Navigazione paginazione',

        'overview' => 'Mostrati i risultati da :first a :last di :total',

        'fields' => [

            'records_per_page' => [
                'label' => 'per pagina',
            ],

        ],

        'buttons' => [

            'go_to_page' => [
                'label' => 'Vai a pagina :page',
            ],

            'next' => [
                'label' => 'Successivo',
            ],

            'previous' => [
                'label' => 'Precedente',
            ],

        ],

    ],

    'buttons' => [

        'filter' => [
            'label' => 'Filtra',
        ],

        'open_actions' => [
            'label' => 'Azioni aperte',
        ],

        'toggle_columns' => [
            'label' => 'Alterna colonne',
        ],

    ],

    'actions' => [

        'replicate' => [

            'label' => 'Duplica',

            'messages' => [
                'replicated' => 'Record duplicato',
            ],
        ],

    ],

    'empty' => [
        'heading' => 'Nessun risultato trovato',
    ],

    'filters' => [

        'buttons' => [

            'reset' => [
                'label' => 'Azzera filtri',
            ],

            'close' => [
                'label' => 'Chiudi',
            ],

        ],

        'multi_select' => [
            'placeholder' => 'Tutti',
        ],

        'select' => [
            'placeholder' => 'Tutti',
        ],
    ],

    'selection_indicator' => [
        'selected_count' => '1 record selezionato.|:count records selezionati.',
        'buttons' => [

            'select_all' => [
                'label' => 'Seleziona tutti e :count',
            ],

            'deselect_all' => [
                'label' => 'Deseleziona tutti',
            ],

        ],

    ],

];
