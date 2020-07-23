<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\Sanitizer;

/**
 * Class SanitizerTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Utility
 */
class SanitizerTest extends AbstractUnitTest {

    /**
     * @return array[]
     */
    public function providerNonArrayInputs() {
        return [
            [NULL],
            [1],
            [22],
            [0],
            [-23],
            [TRUE],
            [FALSE],
            ['STRING'],
            ['22'],
            ['11'],
            ['Object'],
            ['object'],
            ['array'],
            ['Array'],
            [(object)['prop' => 'value']]
        ];
    }

    /**
     * @return array[]
     */
    public function providerNonObjectInputs() {
        return [
            [NULL],
            [1],
            [22],
            [0],
            [-23],
            [TRUE],
            [FALSE],
            ['STRING'],
            ['22'],
            ['11'],
            ['Object'],
            ['object'],
            ['array'],
            ['Array'],
            [['prop' => 'value']]
        ];
    }

    /**
     * @return array
     */
    public function providerConvertBooleanToIntegerArrayRecursiveWithValidData() {
        return [
            [
                ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1],
            ],
            [
                [
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55  => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56  => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                [
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55  => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56  => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ]
            ],
            [
                [55 => NULL],
                [55 => NULL]
            ],
            [
                [55 => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL, 'true' => TRUE, 'false' => FALSE]]],
                [55 => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL, 'true' => 1, 'false' => 0]]],
            ],
            [
                [55 => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE]],
                [55 => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => 1, 'false' => 0]]
            ],
            [
                [
                    55 => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE,
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE]
                    ]
                ],
                [
                    55 => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => 1, 'false' => 0,
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => 1, 'false' => 0]
                    ]
                ]
            ],
            [
                [
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1'                        => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE
                        ]
                    ], 'true' => TRUE, 'false' => FALSE
                ],
                [
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1'                        => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => 1, 'false' => 0
                        ]
                    ], 'true' => 1, 'false' => 0
                ]
            ]

        ];
    }

    /**
     * @return array[]
     */
    public function providerSanitizeArrayRecursiveWithValidData() {
        return [
            [
                ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                ['2' => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE]
            ],
            [
                [
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55  => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56  => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                [
                    '1'    => ['2' => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2'    => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    'test' => [22 => 'test', '4' => ' '],
                    56     => ['4' => 0],
                    58     => ['4' => ['4' => ['4' => 1]]]
                ]
            ],
            [
                [55 => NULL],
                NULL
            ],
            [
                [55 => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL]]],
                NULL,
            ],
            [
                [55 => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester']],
                [55 => (object)['prop1' => 0, 'prop4' => 'tester']]
            ],
            [
                [
                    55 => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester']
                    ]
                ],
                [
                    55 => (object)[
                        'prop1' => 0, 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop4' => 'tester']
                    ]
                ]
            ],
            [
                [
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1'                        => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester'
                        ]
                    ]
                ],
                [
                    'tester1' => (object)[
                        'prop1' => 0, 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop4' => 'tester'],
                        'prop6' => (object)['prop1' => 0, 'prop5' => ['asdf' => 1], 'prop4' => 'tester']
                    ]

                ]
            ]

        ];
    }

    /**
     * @return array
     */
    public function providerConvertBooleanToIntegerObjectRecursiveWithValidData() {
        return [
            [
                (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1]
            ],
            [
                (object)[
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55  => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56  => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                (object)[
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55  => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56  => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ]
            ],
            [
                (object)[55 => NULL],
                (object)[55 => NULL],
            ],
            [
                (object)[55 => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL, 'true' => TRUE, 'false' => FALSE]]],
                (object)[55 => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL, 'true' => 1, 'false' => 0]]]
            ],
            [
                (object)[55 => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE]],
                (object)[55 => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => 1, 'false' => 0]]
            ],
            [
                (object)[
                    55 => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE]
                    ]
                ],
                (object)[
                    55 => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester', 'true' => 1, 'false' => 0]
                    ]
                ]
            ],
            [
                (object)[
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1'                        => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE
                        ]
                    ], 'true' => TRUE, 'false' => FALSE
                ],
                (object)[
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1'                        => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => 1, 'false' => 0
                        ]
                    ], 'true' => 1, 'false' => 0
                ]
            ]

        ];

    }

    /**
     * @return array[]
     */
    public function providerSanitizeObjectRecursiveWithValidData() {
        return [
            [
                (object)[
                    '1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' =>
                        TRUE
                ],
                (object)['2' => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE]
            ],
            [
                (object)[
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55  => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56  => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58  => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                (object)[
                    '1'    => ['2' => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2'    => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    'test' => [22 => 'test', '4' => ' '],
                    56     => ['4' => 0],
                    58     => ['4' => ['4' => ['4' => 1]]]
                ]
            ],
            [
                (object)[55 => NULL],
                NULL
            ],
            [
                (object)[55 => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL]]],
                NULL,
            ],
            [
                (object)[55 => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester']],
                (object)[55 => (object)['prop1' => 0, 'prop4' => 'tester']]
            ],
            [
                (object)[
                    55 => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester']
                    ]
                ],
                (object)[
                    55 => (object)[
                        'prop1' => 0, 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop4' => 'tester']
                    ]
                ]
            ],
            [
                (object)[
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1'                        => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester'
                        ]
                    ]
                ],
                (object)[
                    'tester1' => (object)[
                        'prop1' => 0, 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop4' => 'tester'],
                        'prop6' => (object)['prop1' => 0, 'prop5' => ['asdf' => 1], 'prop4' => 'tester']
                    ]

                ]
            ]

        ];
    }

    /**
     * @return array[]
     */
    public function providerUnsetKeyIfEmptyWithValidData() {
        return [
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], NULL, 'emptyKey',
                ['key' => 'value', 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], '', 'emptyKey2',
                ['key' => 'value', 'emptyKey' => NULL, 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], NULL, 'notEmpty',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 'value', 'key',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], ' ', 'notEmpty',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], '0', 'notEmpty2',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 0, 'notEmpty3',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 22, 'notEmpty4',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], -22, 'notEmpty5',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 'newValue', 'key',
                ['key' => 'newValue', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 'newValue', 'notEmpty',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => 'newValue', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 3, 'notEmpty3',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 3, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], '22', 'notEmpty4',
                ['key' => 'value', 'emptyKey' => NULL, 'emptyKey2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => '22', 'notEmpty5' => -22]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerUnsetPropertyIfEmptyWithValidData() {
        return [
            [
                (object)[
                    'property'  => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0',
                    'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22
                ], NULL, 'emptyProperty',
                (object)['property' => 'value', 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], '', 'emptyProperty2',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], NULL, 'notEmpty',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 'value', 'property',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], ' ', 'notEmpty',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], '0', 'notEmpty2',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 0, 'notEmpty3',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 22, 'notEmpty4',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], -22, 'notEmpty5',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 'newValue', 'property',
                (object)['property' => 'newValue', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 'newValue', 'notEmpty',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => 'newValue', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], 3, 'notEmpty3',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 3, 'notEmpty4' => 22, 'notEmpty5' => -22]
            ],
            [
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => 22, 'notEmpty5' => -22], '22', 'notEmpty4',
                (object)['property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0', 'notEmpty3' => 0, 'notEmpty4' => '22', 'notEmpty5' => -22]
            ]
        ];
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonArrayInputs
     */
    public function testSanitizeArrayRecursiveWithInvalidData($invalidInput) {
        try {
            Sanitizer::sanitizeArrayRecursive($invalidInput);

            $this->assertIsArray($invalidInput, 'Invalid data type has been inserted, but no type error has ' .
                                              'been thrown. sanitizeArrayRecursive should only allow arrays as input.');
        } catch (\TypeError $e) {
            $this->addToAssertionCount(1);
        }
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonArrayInputs
     */
    public function testConvertBooleanToIntegerArrayRecursiveWithInvalidData($invalidInput) {
        try {
            Sanitizer::convertBooleanToIntegerArrayRecursive($invalidInput);

            $this->assertIsArray($invalidInput, 'Invalid data type has been inserted, but no type error has ' .
                                              'been thrown. convertBooleanToIntegerArrayRecursive should only allow arrays as input.');
        } catch (\TypeError $e) {
            $this->addToAssertionCount(1);
        }
    }

    /**
     * @param array $arrayToSanitize
     * @param array $expectedSanitizedArray
     *
     * @dataProvider providerSanitizeArrayRecursiveWithValidData
     */
    public function testSanitizeArrayRecursiveWithValidData($arrayToSanitize, $expectedSanitizedArray) {
        Sanitizer::sanitizeArrayRecursive($arrayToSanitize);
        $sanitizedArray = $arrayToSanitize;

        if($sanitizedArray !== NULL)
            $this->assertIsArray($sanitizedArray);

        $this->assertEquals($expectedSanitizedArray, $sanitizedArray);
    }

    /**
     * @param array $arrayToConvert
     * @param array $expectedConvertedArray
     *
     * @dataProvider providerConvertBooleanToIntegerArrayRecursiveWithValidData
     */
    public function testConvertBooleanToIntegerArrayRecursiveWithValidData($arrayToConvert, $expectedConvertedArray) {
        Sanitizer::convertBooleanToIntegerArrayRecursive($arrayToConvert);
        $convertedArray = $arrayToConvert;

        if($convertedArray !== NULL)
            $this->assertIsArray($convertedArray);

        $this->assertEquals($expectedConvertedArray, $convertedArray);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonObjectInputs
     */
    public function testSanitizeObjectRecursiveWithInvalidData($invalidInput) {
        $invalidInputBefore = $invalidInput;
        Sanitizer::sanitizeObjectRecursive($invalidInput);
        $invalidInputAfter = $invalidInput;

        $this->assertIsNotObject($invalidInputBefore);
        $this->assertIsNotObject($invalidInputAfter);
        $this->assertEquals($invalidInputBefore, $invalidInputAfter);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonObjectInputs
     */
    public function testConvertBooleanToIntegerObjectRecursiveWithValidDataWithInvalidData($invalidInput) {
        $invalidInputBefore = $invalidInput;
        Sanitizer::convertBooleanToIntegerObjectRecursive($invalidInput);
        $invalidInputAfter = $invalidInput;

        $this->assertIsNotObject($invalidInputBefore);
        $this->assertIsNotObject($invalidInputAfter);
        $this->assertEquals($invalidInputBefore, $invalidInputAfter);
    }

    /**
     * @param object $objectToSanitize
     * @param object $expectedSanitizedObject
     *
     * @dataProvider providerSanitizeObjectRecursiveWithValidData
     */
    public function testSanitizeObjectRecursiveWithValidData($objectToSanitize, $expectedSanitizedObject) {
        Sanitizer::sanitizeObjectRecursive($objectToSanitize);
        $sanitizedObject = $objectToSanitize;

        if($sanitizedObject !== NULL)
            $this->assertIsObject($sanitizedObject);

        $this->assertEquals($expectedSanitizedObject, $sanitizedObject);
    }

    /**
     * @param object $objectToConvert
     * @param object $expectedConvertedObject
     *
     * @dataProvider providerConvertBooleanToIntegerObjectRecursiveWithValidData
     */
    public function testConvertBooleanToIntegerObjectRecursiveWithValidData($objectToConvert,
                                                                            $expectedConvertedObject) {
        Sanitizer::convertBooleanToIntegerObjectRecursive($objectToConvert);
        $convertedObject = $objectToConvert;

        if($convertedObject !== NULL)
            $this->assertIsObject($convertedObject);

        $this->assertEquals($expectedConvertedObject, $convertedObject);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonArrayInputs
     *
     * @throws \ReflectionException
     */
    public function testUnsetKeyIfEmptyWithInvalidData($invalidInput) {
        try {
            $this->runProtectedMethod((new Sanitizer()), 'unsetKeyIfEmpty', [$invalidInput, 'value', 'key']);

            $this->assertIsArray($invalidInput, 'Invalid data type has been inserted, but no type error has ' .
                                              'been thrown. unsetKeyIfEmpty should only allow arrays as input.');
        } catch (\TypeError $e) {
            $this->addToAssertionCount(1);
        }
    }

    /**
     * @param $array
     * @param $value
     * @param $key
     * @param $expectedUnsetArray
     *
     * @dataProvider providerUnsetKeyIfEmptyWithValidData
     *
     * @throws \ReflectionException
     */
    public function testUnsetKeyIfEmptyWithValidData($array, $value, $key, $expectedUnsetArray) {
        $unsetArray = $this->runProtectedMethod((new Sanitizer()), 'unsetKeyIfEmpty', [$array, $value, $key]);

        $this->assertEquals($expectedUnsetArray, $unsetArray);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonObjectInputs
     *
     * @throws \ReflectionException
     */
    public function testUnsetPropertyIfEmptyWithInvalidData($invalidInput) {
        $invalidInputBefore = $invalidInput;
        $this->runProtectedMethod((new Sanitizer()), 'unsetPropertyIfEmpty', [$invalidInput, 'val', 'prop']);
        $invalidInputAfter = $invalidInput;

        $this->assertIsNotObject($invalidInputBefore);
        $this->assertIsNotObject($invalidInputAfter);
        $this->assertEquals($invalidInputBefore, $invalidInputAfter);
    }

    /**
     * @param $object
     * @param $value
     * @param $property
     * @param $expectedUnsetObject
     *
     * @dataProvider providerUnsetPropertyIfEmptyWithValidData
     *
     * @throws \ReflectionException
     */
    public function testUnsetPropertyIfEmptyWithValidData($object, $value, $property, $expectedUnsetObject) {
        $unsetObject = $this->runProtectedMethod((new Sanitizer()), 'unsetPropertyIfEmpty', [
            $object, $value,
            $property
        ]);

        $this->assertEquals($expectedUnsetObject, $unsetObject);
    }
}

?>