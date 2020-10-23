<?php

return [
    'nation' => [
        'class_name' => 'filter-form_selects_elem country',
        'class_childs' => 'filter-form_selects_elem_option',
        'values' => [
            0           => 'Нация',
            'japan'     => 'Япония',
            'usa'       => 'Сша',
            'ussr'      => 'СССР',
            'germany'   => 'Германия',
            'europe'    => 'Европа',
            'italy'     => 'Италия',
            'uk'        => 'Великобритания',
            'france'    => 'Франция',
            'pan_asia'  => 'Пан-Азия',
            'events'    => 'Содружество',
        ]
    ],
    'level' => [
        'class_name' => 'filter-form_selects_elem',
        'class_childs' => 'filter-form_selects_elem_option',
        'values' => [
            0  => 'Уровень',
            1  => 'I',
            2  => 'II',
            3  => 'III',
            4  => 'IV',
            5  => 'V',
            6  => 'VI',
            7  => 'VII',
            8  => 'VIII',
            9  => 'IX',
            10 => 'X',
            ]
    ],
    'type'  => [
        'class_name' => 'filter-form_selects_elem type',
        'class_childs' => 'filter-form_selects_elem_option',
        'values' => [
            0             => 'Класс',
            'Destroyer'   => 'Эсминцы',
            'Cruiser'     => 'Крейсеры',
            'Battleship'  => 'Линкоры',
            'AirCarrier'  => 'Авианосцы',
        ]
    ]
];