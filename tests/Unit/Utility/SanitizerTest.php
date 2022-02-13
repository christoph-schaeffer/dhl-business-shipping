<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Test\Unit\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\Sanitizer;

/**
 * Class SanitizerTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Unit\Utility
 */
class SanitizerTest extends AbstractUnitTest
{

    /**
     * @return array[]
     */
    public function providerNonObjectInputs()
    {
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
    public function providerConvertBooleanToIntegerArrayRecursiveWithValidData()
    {
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
                    55 => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56 => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                [
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55 => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56 => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

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
                            'prop1' => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE
                        ]
                    ], 'true' => TRUE, 'false' => FALSE
                ],
                [
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1' => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => 1, 'false' => 0
                        ]
                    ], 'true' => 1, 'false' => 0
                ]
            ]

        ];
    }

    /**
     * @return array
     */
    public function providerConvertFloatToStringArrayRecursiveWithValidData()
    {
        return [
            [
                ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => 1.25, '10' => 1, '11' => 0, '12' => 0.555555, '13' => -0.5, '14' => -99999, '15' => 0.0001,
                    '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001'],
                ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => '1.25', '10' => 1, '11' => 0, '12' => '0.555555', '13' => '-0.5', '14' => -99999, '15' => '0.0001',
                    '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
            ],
            [

                [
                    ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => 1.25, '10' => 1, '11' => 0, '12' => 0.555555, '13' => -0.5, '14' => -99999, '15' => 0.0001,
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ],
                [
                    ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => '1.25', '10' => 1, '11' => 0, '12' => '0.555555', '13' => '-0.5', '14' => -99999, '15' => '0.0001',
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ]
            ],
            [

                [
                    (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => 1.25, '10' => 1, '11' => 0, '12' => 0.555555, '13' => -0.5, '14' => -99999, '15' => 0.0001,
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ],
                [
                    (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => '1.25', '10' => 1, '11' => 0, '12' => '0.555555', '13' => '-0.5', '14' => -99999, '15' => '0.0001',
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerConvertFloatToStringObjectRecursiveWithValidData()
    {
        return [
            [
                (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => 1.25, '10' => 1, '11' => 0, '12' => 0.555555, '13' => -0.5, '14' => -99999, '15' => 0.0001,
                    '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001'],
                (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    '9' => '1.25', '10' => 1, '11' => 0, '12' => '0.555555', '13' => '-0.5', '14' => -99999, '15' => '0.0001',
                    '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
            ],
            [

                (object)[
                    (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => 1.25, '10' => 1, '11' => 0, '12' => 0.555555, '13' => -0.5, '14' => -99999, '15' => 0.0001,
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ],
                (object)[
                    (object)['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => '1.25', '10' => 1, '11' => 0, '12' => '0.555555', '13' => '-0.5', '14' => -99999, '15' => '0.0001',
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ]
            ],
            [

                (object)[
                    ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => 1.25, '10' => 1, '11' => 0, '12' => 0.555555, '13' => -0.5, '14' => -99999, '15' => 0.0001,
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ],
                (object)[
                    ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                        '9' => '1.25', '10' => 1, '11' => 0, '12' => '0.555555', '13' => '-0.5', '14' => -99999, '15' => '0.0001',
                        '16' => '1.25', '17' => '1', '18' => '0', '19' => '0.555555', '20' => '-0.5', '21' => '-99999', '22' => '0.0001']
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerSanitizeArrayRecursiveWithValidData()
    {
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
                    55 => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56 => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                [
                    '1' => ['2' => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE],
                    '2' => 'test', '4' => ' ', '5' => 0, '6' => 1, '7' => FALSE, '8' => TRUE,
                    'test' => [22 => 'test', '4' => ' '],
                    56 => ['4' => 0],
                    58 => ['4' => ['4' => ['4' => 1]]]
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
                            'prop1' => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
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
    public function providerConvertBooleanToIntegerObjectRecursiveWithValidData()
    {
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
                    55 => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56 => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

                ],
                (object)[
                    '1' => ['1' => NULL, '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1],
                    '2' => 'test', '3' => '', '4' => ' ', '5' => 0, '6' => 1, '7' => 0, '8' => 1,
                    '9' => NULL, 'test' => ['a' => NULL, 22 => 'test', 23 => '', '4' => ' '],
                    55 => ['a' => NULL, 22 => '', 23 => '', '4' => NULL],
                    56 => ['a' => NULL, 22 => '', 23 => '', '4' => 0],
                    57 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => NULL]]],
                    58 => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => ['a' => NULL, 22 => '', 23 => '', '4' => 1]]]

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
                            'prop1' => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
                                ['', 'asdf' => 1], 'prop4' => 'tester', 'true' => TRUE, 'false' => FALSE
                        ]
                    ], 'true' => TRUE, 'false' => FALSE
                ],
                (object)[
                    'tester1' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester'],
                        'prop6' => (object)[
                            'prop1' => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
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
    public function providerSanitizeObjectRecursiveWithValidData()
    {
        return [
            [
                (object)[
                    'a' => NULL, 'b' => 'test', 'c' => '', 'd' => ' ', 'e' => 0, 'f' => 1, 'g' => FALSE, 'h' =>
                        TRUE
                ],
                (object)['b' => 'test', 'd' => ' ', 'e' => 0, 'f' => 1, 'g' => FALSE, 'h' => TRUE]
            ],
            [
                (object)[
                    'a' => ['a' => NULL, 'b' => 'test', 'c' => '', 'd' => ' ', 'e' => 0, 'f' => 1, 'g' => FALSE, 'h' => TRUE],
                    'b' => 'test', 'c' => '', 'd' => ' ', 'e' => 0, 'f' => 1, 'g' => FALSE, 'h' => TRUE,
                    'i' => NULL, 'test' => ['a' => NULL, 'aa' => 'test', 'bb' => '', 'd' => ' '],
                    'ee' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => NULL],
                    'ff' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => 0],
                    'gg' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => NULL]]],
                    'hh' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => ['a' => NULL, 'aa' => '', 'bb' => '', 'd' => 1]]]

                ],
                (object)[
                    'a' => ['b' => 'test', 'd' => ' ', 'e' => 0, 'f' => 1, 'g' => FALSE, 'h' => TRUE],
                    'b' => 'test', 'd' => ' ', 'e' => 0, 'f' => 1, 'g' => FALSE, 'h' => TRUE,
                    'test' => ['aa' => 'test', 'd' => ' '],
                    'ff' => ['d' => 0],
                    'hh' => ['d' => ['d' => ['d' => 1]]]
                ]
            ],
            [
                (object)['a' => NULL],
                NULL
            ],
            [
                (object)['a' => (object)['prop1' => NULL, 'prop2' => (object)[NULL, 'prop' => NULL]]],
                NULL,
            ],
            [
                (object)['a' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester']],
                (object)['a' => (object)['prop1' => 0, 'prop4' => 'tester']]
            ],
            [
                (object)[
                    'a' => (object)[
                        'prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester',
                        'prop5' => (object)['prop1' => 0, 'prop2' => NULL, 'prop3' => '', 'prop4' => 'tester']
                    ]
                ],
                (object)[
                    'a' => (object)[
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
                            'prop1' => 0, 'prop2' => [NULL, NULL], 'prop3' => '', 'prop5' =>
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
    public function providerUnsetKeyIfEmptyWithValidData()
    {
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
    public function providerFloatToString()
    {
        return [
            [1, "1", 0],
            [2, "2", 0],
            [100, "100", 0],
            [9, "9", 0],
            [256, "256", 0],
            [1024, "1024", 0],
            [99999999999, "99999999999", 0],
            [0, "0", 0],
            [0.1, "0.1", 1],
            [0.2, "0.2", 1],
            [0.4, "0.4", 1],
            [0.5, "0.5", 1],
            [0.6, "0.6", 1],
            [0.8, "0.8", 1],
            [0.9, "0.9", 1],
            [1.1, "1.1", 1],
            [1.2, "1.2", 1],
            [1.4, "1.4", 1],
            [1.5, "1.5", 1],
            [1.6, "1.6", 1],
            [1.8, "1.8", 1],
            [1.9, "1.9", 1],
            [0.15, "0.15", 2],
            [0.25, "0.25", 2],
            [0.45, "0.45", 2],
            [0.55, "0.55", 2],
            [0.65, "0.65", 2],
            [0.85, "0.85", 2],
            [0.95, "0.95", 2],
            [1.15, "1.15", 2],
            [1.25, "1.25", 2],
            [1.45, "1.45", 2],
            [1.55, "1.55", 2],
            [1.65, "1.65", 2],
            [1.85, "1.85", 2],
            [1.95, "1.95", 2],
            [0.19, "0.19", 2],
            [0.29, "0.29", 2],
            [0.49, "0.49", 2],
            [0.59, "0.59", 2],
            [0.69, "0.69", 2],
            [0.89, "0.89", 2],
            [0.99, "0.99", 2],
            [1.19, "1.19", 2],
            [1.29, "1.29", 2],
            [1.49, "1.49", 2],
            [1.59, "1.59", 2],
            [1.69, "1.69", 2],
            [1.89, "1.89", 2],
            [1.99, "1.99", 2],
            [19.99, "19.99", 2],
            [20.99, "20.99", 2],
            [20.01, "20.01", 2],
            [20.09, "20.09", 2],
            [20.05, "20.05", 2],
            [0.01, "0.01", 2],
            [0.02, "0.02", 2],
            [0.04, "0.04", 2],
            [0.05, "0.05", 2],
            [0.06, "0.06", 2],
            [0.08, "0.08", 2],
            [0.09, "0.09", 2],
            [1.01, "1.01", 2],
            [1.02, "1.02", 2],
            [1.04, "1.04", 2],
            [1.05, "1.05", 2],
            [1.06, "1.06", 2],
            [1.08, "1.08", 2],
            [1.09, "1.09", 2],
            [0.001, "0.001", 3],
            [0.002, "0.002", 3],
            [0.004, "0.004", 3],
            [0.005, "0.005", 3],
            [0.006, "0.006", 3],
            [0.008, "0.008", 3],
            [0.009, "0.009", 3],
            [1.001, "1.001", 3],
            [1.002, "1.002", 3],
            [1.004, "1.004", 3],
            [1.005, "1.005", 3],
            [1.006, "1.006", 3],
            [1.008, "1.008", 3],
            [1.009, "1.009", 3],
            [1.0010, "1.001", 3],
            [1.00100, "1.001", 3],
            [1.001000, "1.001", 3],
            [1.0010000, "1.001", 3],
            [1.00100000, "1.001", 3],
            [1.00000000, "1", 0],
            [1.9999999999, "1.9999999999", 10],
            [1.99999999, "1.99999999", 8],
            [1.9999999, "1.9999999", 7],
            [1.999999, "1.999999", 6],
            [1.0000000001, "1.0000000001", 10],
            [1.00000001, "1.00000001", 8],
            [1.0000001, "1.0000001", 7],
            [1.000001, "1.000001", 6],
            [1.00001, "1.00001", 5],
            [1.0001, "1.0001", 4],
            [1.0, "1", 0],
            [-1, "-1", 0],
            [-2, "-2", 0],
            [-100, "-100", 0],
            [-9, "-9", 0],
            [-256, "-256", 0],
            [-1024, "-1024", 0],
            [-99999999999, "-99999999999", 0],
            [-0, "0", 0],
            [-0.1, "-0.1", 1],
            [-0.2, "-0.2", 1],
            [-0.4, "-0.4", 1],
            [-0.5, "-0.5", 1],
            [-0.6, "-0.6", 1],
            [-0.8, "-0.8", 1],
            [-0.9, "-0.9", 1],
            [-1.1, "-1.1", 1],
            [-1.2, "-1.2", 1],
            [-1.4, "-1.4", 1],
            [-1.5, "-1.5", 1],
            [-1.6, "-1.6", 1],
            [-1.8, "-1.8", 1],
            [-1.9, "-1.9", 1],
            [-0.15, "-0.15", 2],
            [-0.25, "-0.25", 2],
            [-0.45, "-0.45", 2],
            [-0.55, "-0.55", 2],
            [-0.65, "-0.65", 2],
            [-0.85, "-0.85", 2],
            [-0.95, "-0.95", 2],
            [-1.15, "-1.15", 2],
            [-1.25, "-1.25", 2],
            [-1.45, "-1.45", 2],
            [-1.55, "-1.55", 2],
            [-1.65, "-1.65", 2],
            [-1.85, "-1.85", 2],
            [-1.95, "-1.95", 2],
            [-0.19, "-0.19", 2],
            [-0.29, "-0.29", 2],
            [-0.49, "-0.49", 2],
            [-0.59, "-0.59", 2],
            [-0.69, "-0.69", 2],
            [-0.89, "-0.89", 2],
            [-0.99, "-0.99", 2],
            [-1.19, "-1.19", 2],
            [-1.29, "-1.29", 2],
            [-1.49, "-1.49", 2],
            [-1.59, "-1.59", 2],
            [-1.69, "-1.69", 2],
            [-1.89, "-1.89", 2],
            [-1.99, "-1.99", 2],
            [-19.99, "-19.99", 2],
            [-20.99, "-20.99", 2],
            [-20.01, "-20.01", 2],
            [-20.09, "-20.09", 2],
            [-20.05, "-20.05", 2],
            [-0.01, "-0.01", 2],
            [-0.02, "-0.02", 2],
            [-0.04, "-0.04", 2],
            [-0.05, "-0.05", 2],
            [-0.06, "-0.06", 2],
            [-0.08, "-0.08", 2],
            [-0.09, "-0.09", 2],
            [-1.01, "-1.01", 2],
            [-1.02, "-1.02", 2],
            [-1.04, "-1.04", 2],
            [-1.05, "-1.05", 2],
            [-1.06, "-1.06", 2],
            [-1.08, "-1.08", 2],
            [-1.09, "-1.09", 2],
            [-0.001, "-0.001", 3],
            [-0.002, "-0.002", 3],
            [-0.004, "-0.004", 3],
            [-0.005, "-0.005", 3],
            [-0.006, "-0.006", 3],
            [-0.008, "-0.008", 3],
            [-0.009, "-0.009", 3],
            [-1.001, "-1.001", 3],
            [-1.002, "-1.002", 3],
            [-1.004, "-1.004", 3],
            [-1.005, "-1.005", 3],
            [-1.006, "-1.006", 3],
            [-1.008, "-1.008", 3],
            [-1.009, "-1.009", 3],
            [-1.0010, "-1.001", 3],
            [-1.00100, "-1.001", 3],
            [-1.001000, "-1.001", 3],
            [-1.0010000, "-1.001", 3],
            [-1.00100000, "-1.001", 3],
            [-1.00000000, "-1", 0],
            [-1.9999999999, "-1.9999999999", 10],
            [-1.99999999, "-1.99999999", 8],
            [-1.9999999, "-1.9999999", 7],
            [-1.999999, "-1.999999", 6],
            [-1.0000000001, "-1.0000000001", 10],
            [-1.00000001, "-1.00000001", 8],
            [-1.0000001, "-1.0000001", 7],
            [-1.000001, "-1.000001", 6],
            [-1.00001, "-1.00001", 5],
            [-1.0001, "-1.0001", 4],
        ];
    }


    /**
     * @return array[]
     */
    public function providerUnsetPropertyIfEmptyWithValidData()
    {
        return [
            [
                (object)[
                    'property' => 'value', 'emptyProperty' => NULL, 'emptyProperty2' => '', 'notEmpty' => ' ', 'notEmpty2' => '0',
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
     * @param array $arrayToSanitize
     * @param array $expectedSanitizedArray
     *
     * @dataProvider providerSanitizeArrayRecursiveWithValidData
     */
    public function testSanitizeArrayRecursiveWithValidData($arrayToSanitize, $expectedSanitizedArray)
    {
        Sanitizer::sanitizeArrayRecursive($arrayToSanitize);
        $sanitizedArray = $arrayToSanitize;

        if ($sanitizedArray !== NULL)
            $this->assertTrue(is_array($sanitizedArray));

        $this->assertEquals($expectedSanitizedArray, $sanitizedArray);
    }

    /**
     * @param array $arrayToConvert
     * @param array $expectedConvertedArray
     *
     * @dataProvider providerConvertBooleanToIntegerArrayRecursiveWithValidData
     */
    public function testConvertBooleanToIntegerArrayRecursiveWithValidData($arrayToConvert, $expectedConvertedArray)
    {
        Sanitizer::convertBooleanToIntegerArrayRecursive($arrayToConvert);
        $convertedArray = $arrayToConvert;

        if ($convertedArray !== NULL)
            $this->assertTrue(is_array($convertedArray));

        $this->assertEquals($expectedConvertedArray, $convertedArray);
    }

    /**
     * @param array $arrayToConvert
     * @param array $expectedConvertedArray
     *
     * @dataProvider providerConvertFloatToStringArrayRecursiveWithValidData
     */
    public function testConvertFloatToStringArrayRecursiveWithValidData($arrayToConvert, $expectedConvertedArray)
    {
        Sanitizer::convertFloatToStringArrayRecursive($arrayToConvert);
        $convertedArray = $arrayToConvert;

        if ($convertedArray !== NULL)
            $this->assertTrue(is_array($convertedArray));

        $this->assertEquals($expectedConvertedArray, $convertedArray);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonObjectInputs
     */
    public function testSanitizeObjectRecursiveWithInvalidData($invalidInput)
    {
        $invalidInputBefore = $invalidInput;
        Sanitizer::sanitizeObjectRecursive($invalidInput);
        $invalidInputAfter = $invalidInput;

        $this->assertFalse(is_object($invalidInputBefore));
        $this->assertFalse(is_object($invalidInputAfter));
        $this->assertEquals($invalidInputBefore, $invalidInputAfter);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonObjectInputs
     */
    public function testConvertBooleanToIntegerObjectRecursiveWithValidDataWithInvalidData($invalidInput)
    {
        $invalidInputBefore = $invalidInput;
        Sanitizer::convertBooleanToIntegerObjectRecursive($invalidInput);
        $invalidInputAfter = $invalidInput;

        $this->assertFalse(is_object($invalidInputBefore));
        $this->assertFalse(is_object($invalidInputAfter));
        $this->assertEquals($invalidInputBefore, $invalidInputAfter);
    }

    /**
     * @param mixed $invalidInput
     *
     * @dataProvider providerNonObjectInputs
     */
    public function testConvertFloatToStringObjectRecursiveWithValidDataWithInvalidData($invalidInput)
    {
        $invalidInputBefore = $invalidInput;
        Sanitizer::convertFloatToStringObjectRecursive($invalidInput);
        $invalidInputAfter = $invalidInput;

        $this->assertFalse(is_object($invalidInputBefore));
        $this->assertFalse(is_object($invalidInputAfter));
        $this->assertEquals($invalidInputBefore, $invalidInputAfter);
    }

    /**
     * @param object $objectToSanitize
     * @param object $expectedSanitizedObject
     *
     * @dataProvider providerSanitizeObjectRecursiveWithValidData
     */
    public function testSanitizeObjectRecursiveWithValidData($objectToSanitize, $expectedSanitizedObject)
    {
        Sanitizer::sanitizeObjectRecursive($objectToSanitize);
        $sanitizedObject = $objectToSanitize;

        if ($sanitizedObject !== NULL)
            $this->assertTrue(is_object($sanitizedObject));

        $this->assertEquals($expectedSanitizedObject, $sanitizedObject);
    }

    /**
     * @param object $objectToConvert
     * @param object $expectedConvertedObject
     *
     * @dataProvider providerConvertBooleanToIntegerObjectRecursiveWithValidData
     */
    public function testConvertBooleanToIntegerObjectRecursiveWithValidData($objectToConvert,
                                                                            $expectedConvertedObject)
    {
        Sanitizer::convertBooleanToIntegerObjectRecursive($objectToConvert);
        $convertedObject = $objectToConvert;

        if ($convertedObject !== NULL)
            $this->assertTrue(is_object($convertedObject));

        $this->assertEquals($expectedConvertedObject, $convertedObject);
    }

    /**
     * @param object $objectToConvert
     * @param object $expectedConvertedObject
     *
     * @dataProvider providerConvertFloatToStringObjectRecursiveWithValidData
     */
    public function testConvertFloatToStringObjectRecursiveWithValidData($objectToConvert,
                                                                         $expectedConvertedObject)
    {
        Sanitizer::convertFloatToStringObjectRecursive($objectToConvert);
        $convertedObject = $objectToConvert;

        if ($convertedObject !== NULL)
            $this->assertTrue(is_object($convertedObject));

        $this->assertEquals($expectedConvertedObject, $convertedObject);
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
    public function testUnsetKeyIfEmptyWithValidData($array, $value, $key, $expectedUnsetArray)
    {
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
    public function testUnsetPropertyIfEmptyWithInvalidData($invalidInput)
    {
        $invalidInputBefore = $invalidInput;
        $this->runProtectedMethod((new Sanitizer()), 'unsetPropertyIfEmpty', [$invalidInput, 'val', 'prop']);
        $invalidInputAfter = $invalidInput;

        $this->assertFalse(is_object($invalidInputBefore));
        $this->assertFalse(is_object($invalidInputAfter));
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
    public function testUnsetPropertyIfEmptyWithValidData($object, $value, $property, $expectedUnsetObject)
    {
        $unsetObject = $this->runProtectedMethod((new Sanitizer()), 'unsetPropertyIfEmpty', [
            $object, $value,
            $property
        ]);

        $this->assertEquals($expectedUnsetObject, $unsetObject);
    }

    /**
     * @param float $float
     * @param string $expectedFloatString
     *
     * @dataProvider providerFloatToString
     *
     * @throws \ReflectionException
     */
    public function testFloatToString($float, $expectedFloatString)
    {
        $actualFloatToString = $this->runProtectedMethod((new Sanitizer()), 'floatToString', [
            $float
        ]);

        $this->assertEquals($expectedFloatString, $actualFloatToString);
    }

    /**
     * @param float $float
     * @param string $_ // not used but in provider
     * @param int $expectedDecimalCount
     *
     * @dataProvider providerFloatToString
     *
     * @throws \ReflectionException
     */
    public function testGetDecimalDigitCountOfloat($float, $_, $expectedDecimalCount)
    {
        $actualDecimalCount = $this->runProtectedMethod((new Sanitizer()), 'getDecimalDigitCountOfloat', [
            $float
        ]);

        $this->assertEquals($expectedDecimalCount, $actualDecimalCount);
    }
}

?>
