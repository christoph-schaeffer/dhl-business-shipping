<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\MultiClient;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\ShippingStatusMapper;

/**
 * Class StatusMapperTest
 * @package ChristophSchaeffer\Dhl\BusinessShipment\Test\Utility
 */
class StatusMapperTest extends AbstractUnitTest {

    /**
     * @return array
     */
    public function providerAddMultipleStatusClasses() {
        return [
            [
                [\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class, \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible::class],
                [],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                       MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class],
                [],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class, \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible::class],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyStreetName('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyStreetName('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                       MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyStreetName('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyStreetName('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerAddSingleStatusClass() {
        return [
            [
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class,
                [],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class,
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyStreetName('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyStreetName('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerAddUnknownErrorStatus() {
        return [
            [
                [],
                'status message',
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError('status message', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                [],
                '',
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError('', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                [],
                NULL,
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError(NULL, MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyCity('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
                'status message',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyCity('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError('status message', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyCity('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
                '',
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyCity('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError('', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyCity('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))],
                NULL,
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyCity('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError(NULL, MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerContainsZipKeyword() {
        return [
            ['postleitzahl', TRUE],
            [' postleitzahl', TRUE],
            ['postleitzahl ', TRUE],
            [' postleitzahl ', TRUE],
            ['1postleitzahl1', TRUE],
            ['1postleitzahl', TRUE],
            ['postleitzahl123', TRUE],
            ['123postleitzahl123', TRUE],
            ['plz', TRUE],
            [' plz', TRUE],
            ['plz ', TRUE],
            [' plz ', TRUE],
            ['1plz1', TRUE],
            ['1plz', TRUE],
            ['plz123', TRUE],
            ['123plz123', TRUE],
            ['123', FALSE],
            ['test', FALSE],
            ['TRUE', FALSE],
            ['FALSE', FALSE],
            ['NULL', FALSE],
            ['', FALSE],
            [' ', FALSE],
            ['post', FALSE],
            ['0', FALSE],
            ['1', FALSE]
        ];
    }

    /**
     * @return array[]
     */
    public function providerGetStatusClassByMessage() {
        return [
            [
                'Weak validation error occured.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\WeakValidationError::class
            ],
            [
                'ok',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success::class
            ],
            [
                'Der Webservice wurde ohne Fehler ausgeführt.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success::class
            ],
            [
                'Bitte geben Sie Name 1 an.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyName1::class
            ],
            [
                'Die Sendung ist nicht leitcodierbar.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible::class
            ],
            [
                'Der Ort ist zu dieser PLZ nicht bekannt.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class
            ],
            [
                'Die Postleitzahl konnte nicht gefunden werden.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ZipCodeNotFound::class
            ],
            [
                'Die angegebene Straße kann nicht gefunden werden.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\StreetNotFound::class
            ],
            [
                'Die angegebene Hausnummer kann nicht gefunden werden.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\StreetNumberNotFound::class
            ],
            [
                'Unbekannt',
                NULL
            ],
            [
                'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode::class
            ],
            [
                'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999 oder 99999-9999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode::class
            ],
            [
                'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie eine britisches Format: AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA oder AA99 9AA. Es ist dennoch möglich, einen Versandschein zu drucken.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode::class
            ],
            [
                'Bitte geben Sie eine gültige Postleitzahl ein. Das Format ist 99999. Das Postleitzahlensystem von Südkorea wurde am 1.8.2015 umgestellt. Falls Ihnen noch eine Postleitzahl im alten Format vorliegt (999-999), kontaktieren Sie bitte den Empfänger für die neue Postleitzahl. Es ist dennoch möglich, einen Versandschein zu drucken.',
                \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode::class
            ],
            [
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode::class,
                    \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible::class
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerMultipleStatusResponsesToStatusObjects() {
        return [
            [
                (object)[
                    'statusMessage' => [
                        'Weak validation error occured.'
                    ]
                ],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\WeakValidationError('Weak validation error occured.',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => []],
                []
            ],
            [
                (object)[
                    'statusMessage' => [
                        'Die angegebene Hausnummer kann nicht gefunden werden.',
                        'Weak validation error occured.',
                        'Der Webservice wurde ohne Fehler ausgeführt.',
                        'Der Webservice wurde ohne Fehler ausgeführt.',
                        'Die angegebene Straße kann nicht gefunden werden.',
                        'Weak validation error occured.'
                    ]
                ],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\StreetNumberNotFound('Die angegebene Hausnummer kann nicht gefunden werden.',
                                                     MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\WeakValidationError('Weak validation error occured.',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('Der Webservice wurde ohne Fehler ausgeführt.',
                                        MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\StreetNotFound('Die angegebene Straße kann nicht gefunden werden.',
                                               MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerSanitizeStatusMessage() {
        return [
            [
                'Weak validation error occured.',
                'weakvalidationerroroccured'
            ],
            [
                'äöüß., ' . PHP_EOL,
                ''
            ],
            [
                ' A ',
                'a'
            ],
            [
                'A ',
                'a'
            ],
            [
                ' A',
                'a'
            ],
            [
                ' abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ 1234567890 -_',
                'abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz1234567890_'
            ],
            [
                ' 1äödFüA',
                '1dfa'
            ],
            [
                ' ',
                ''
            ],
            [
                '',
                ''
            ],
            [
                '1',
                '1'
            ],
            [
                '0',
                '0'
            ],
            [
                'äüöß., -"\'\\/:;' . PHP_EOL . '0' . 'äüöß., -"\'\\/:;' . PHP_EOL,
                '0'
            ],
            [
                'NULL',
                'null'
            ],
            [
                'true',
                'true'
            ],
            [
                'false',
                'false'
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerGetStatusObjectsByCode() {
        return [
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => 'Service temporary not available'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ServiceTemporaryNotAvailable('Service temporary not available',
                                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => NULL],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ServiceTemporaryNotAvailable(NULL,
                                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => 'Der service steht temporär nicht zur verfügung.', 'statusText' => 'test'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ServiceTemporaryNotAvailable('Der service steht temporär nicht zur verfügung.',
                                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => 'Der service steht temporär nicht zur verfügung.', 'statusText' => NULL],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ServiceTemporaryNotAvailable('Der service steht temporär nicht zur verfügung.',
                                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => 'Weak validation error occured.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ServiceTemporaryNotAvailable('Weak validation error occured.',
                                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => 'tester'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ServiceTemporaryNotAvailable('tester',
                                                             MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 9999999, 'statusMessage' => NULL, 'statusText' => NULL],
                NULL
            ],
            [
                (object)['statusMessage' => NULL, 'statusText' => NULL],
                NULL
            ],
            [
                (object)['statusCode' => 10, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RequestProcessingFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 11, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\NotWellformedXML('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 12, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\XMLSchemaViolation('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 13, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\WrongServiceCall('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 14, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RequestProcessingFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 14))]
            ],
            [
                (object)['statusCode' => 15, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RequestProcessingFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 15))]
            ],
            [
                (object)['statusCode' => 17, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RequestProcessingFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 17))]
            ],
            [
                (object)['statusCode' => 19, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RequestProcessingFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 19))]
            ],
            [
                (object)['statusCode' => 20, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\QoSFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 21, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\SystemOverload('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 100, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\GeneralFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 101, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\GeneralFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 101))]
            ],
            [
                (object)['statusCode' => 102, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\GeneralFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 102))]
            ],
            [
                (object)['statusCode' => 105, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\GeneralFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 105))]
            ],
            [
                (object)['statusCode' => 109, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\GeneralFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE, 109))]
            ],
            [
                (object)['statusCode' => 110, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AuthorizationFailure('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 111, 'statusMessage' => 'test'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AuthentificationFailed('test', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ]
        ];

    }

    /**
     * @return array[]
     */
    public function providerSingleStatusResponseToStatusObject() {
        return [
            [
                (object)['statusMessage' => NULL, 'statusText' => 'Weak validation error occured.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\WeakValidationError('Weak validation error occured.',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => NULL, 'statusText' => 'Hard validation error occured.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\HardValidationError('Hard validation error occured.',
                                                    MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => NULL, 'statusText' => 'ok'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('ok', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => 'ok'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('Der Webservice wurde ohne Fehler ausgeführt.',
                                        MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => NULL],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\Success('Der Webservice wurde ohne Fehler ausgeführt.',
                                        MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Bitte geben Sie Name 1 an.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\EmptyName1('Bitte geben Sie Name 1 an.',
                                           MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die Sendung ist nicht leitcodierbar.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible('Die Sendung ist nicht leitcodierbar.',
                                                       MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Der Ort ist zu dieser PLZ nicht bekannt.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt.',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die Postleitzahl konnte nicht gefunden werden.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\ZipCodeNotFound('Die Postleitzahl konnte nicht gefunden werden.',
                                                MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die angegebene Straße kann nicht gefunden werden.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\StreetNotFound('Die angegebene Straße kann nicht gefunden werden.',
                                               MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die angegebene Hausnummer kann nicht gefunden werden.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\StreetNumberNotFound('Die angegebene Hausnummer kann nicht gefunden werden.',
                                                     MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Unbekannt'],
                [(new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\UnknownError('Unbekannt', MultiClient::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusMessage' => 'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode('Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999 oder 99999-9999. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode('Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999 oder 99999-9999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie eine britisches Format: AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA oder AA99 9AA. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode('Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie eine britisches Format: AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA oder AA99 9AA. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Bitte geben Sie eine gültige Postleitzahl ein. Das Format ist 99999. Das Postleitzahlensystem von Südkorea wurde am 1.8.2015 umgestellt. Falls Ihnen noch eine Postleitzahl im alten Format vorliegt (999-999), kontaktieren Sie bitte den Empfänger für die neue Postleitzahl. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\InvalidZipCode('Bitte geben Sie eine gültige Postleitzahl ein. Das Format ist 99999. Das Postleitzahlensystem von Südkorea wurde am 1.8.2015 umgestellt. Falls Ihnen noch eine Postleitzahl im alten Format vorliegt (999-999), kontaktieren Sie bitte den Empfänger für die neue Postleitzahl. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerSingleStatusResponseToStatusObjects() {
        return [
            [
                (object)['statusMessage' => 'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar'],
                [
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      MultiClient::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\RoutingCodeNotPossible('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                       MultiClient::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerStatusObjectsWithMapData() {
        $data = [];
        foreach (ShippingStatusMapper::MESSAGE_MAP as $message => $class):
            $expectedStatusObjects = [];

            if(is_array($class)):
                $classes = $class;
                foreach ($classes as $subClass):
                    $subClass                = '\\' . str_replace('\\\\', '\\', $subClass);
                    $expectedStatusObjects[] = new $subClass($message, MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
                endforeach;
            else:
                $class                   = '\\' . str_replace('\\\\', '\\', $class);
                $expectedStatusObjects[] = new $class($message, MultiClient::LANGUAGE_LOCALE_GERMAN_DE);
            endif;

            $data[] = [(object)['statusMessage' => $message], $expectedStatusObjects];
        endforeach;

        return $data;
    }

    /**
     * @param $statusClasses
     * @param $statusObjects
     * @param $statusMessage
     * @param $expectedStatusObjects
     *
     * @dataProvider providerAddMultipleStatusClasses
     *
     * @throws \ReflectionException
     */
    public function testAddMultipleStatusClasses($statusClasses, $statusObjects, $statusMessage,
                                                 $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'addMultipleStatusClasses',
            [$statusClasses, $statusObjects, $statusMessage, MultiClient::LANGUAGE_LOCALE_GERMAN_DE]
        );

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param $statusClass
     * @param $statusObjects
     * @param $statusMessage
     * @param $expectedStatusObjects
     *
     * @dataProvider providerAddSingleStatusClass
     *
     * @throws \ReflectionException
     */
    public function testAddSingleStatusClass($statusClass, $statusObjects, $statusMessage,
                                             $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'addSingleStatusClass',
            [$statusClass, $statusObjects, $statusMessage, MultiClient::LANGUAGE_LOCALE_GERMAN_DE]
        );

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object[] $statusObjects
     * @param string   $statusMessage
     * @param object[] $expectedStatusObjects
     *
     * @dataProvider providerAddUnknownErrorStatus
     *
     * @throws \ReflectionException
     */
    public function testAddUnknownErrorStatus($statusObjects, $statusMessage, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'addUnknownErrorStatus',
            [$statusObjects, $statusMessage, MultiClient::LANGUAGE_LOCALE_GERMAN_DE]
        );

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object   $statusResponse
     * @param object[] $expectedStatusObjects
     *
     * @dataProvider providerGetStatusObjectsByCode
     *
     * @throws \ReflectionException
     */
    public function testGetStatusObjectsByCode($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'getStatusObjectsByCode',
            [$statusResponse, MultiClient::LANGUAGE_LOCALE_GERMAN_DE]
        );

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param string $statusMessage
     * @param string $expectedContainsZipKeyword
     *
     * @dataProvider providerContainsZipKeyword
     *
     * @throws \ReflectionException
     */
    public function testContainsZipKeyword($statusMessage, $expectedContainsZipKeyword) {
        $containsZipKeyword = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'containsZipKeyword',
            [$statusMessage]
        );

        $this->assertEquals($expectedContainsZipKeyword, $containsZipKeyword);
    }

    /**
     * @throws \ReflectionException
     */
    public function testEnsureStatusMessagePropertyExistsWith() {
        $statusResponse      = (object)['statusMessage' => NULL];
        $statusResponseAfter = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'ensureStatusMessagePropertyExists',
            [$statusResponse]
        );

        $this->assertEquals((object)['statusMessage' => NULL], $statusResponseAfter);
    }

    /**
     * @throws \ReflectionException
     */
    public function testEnsureStatusMessagePropertyExistsWithout() {
        $statusResponse      = (object)[];
        $statusResponseAfter = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'ensureStatusMessagePropertyExists',
            [$statusResponse]
        );

        $this->assertEquals((object)['statusMessage' => NULL], $statusResponseAfter);
    }

    /**
     * @param string                  $statusMessage
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $expectedStatusClass
     *
     * @dataProvider providerGetStatusClassByMessage
     *
     * @throws \ReflectionException
     */
    public function testGetStatusClassByMessage($statusMessage, $expectedStatusClass) {
        $statusClass = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'getStatusClassByMessage',
            [$statusMessage]
        );

        $this->assertEquals($expectedStatusClass, $statusClass);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerStatusObjectsWithMapData
     */
    public function testGetStatusObjectsWithMapData($statusResponse, $expectedStatusObjects) {
        $statusObjects = ShippingStatusMapper::getStatusObjects($statusResponse, MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerMultipleStatusResponsesToStatusObjects
     * @dataProvider providerSingleStatusResponseToStatusObject
     * @dataProvider providerSingleStatusResponseToStatusObjects
     */
    public function testGetStatusObjectsWithValidData($statusResponse, $expectedStatusObjects) {
        $statusObjects = ShippingStatusMapper::getStatusObjects($statusResponse, MultiClient::LANGUAGE_LOCALE_GERMAN_DE);

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @throws \ReflectionException
     */
    public function testHasMultipleStatusClasses() {
        $statusClasses            = [];
        $hasMultipleStatusClasses = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'hasMultipleStatusClasses',
            [$statusClasses]
        );

        $this->assertTrue($hasMultipleStatusClasses);

        $statusClasses            = ['test'];
        $hasMultipleStatusClasses = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'hasMultipleStatusClasses',
            [$statusClasses]
        );

        $this->assertTrue($hasMultipleStatusClasses);

        $statusClasses            = 'test';
        $hasMultipleStatusClasses = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'hasMultipleStatusClasses',
            [$statusClasses]
        );

        $this->assertFalse($hasMultipleStatusClasses);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerMultipleStatusResponsesToStatusObjects
     *
     * @throws \ReflectionException
     */
    public function testMapMultipleStatusMessagesToStatusObjects($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'mapMultipleStatusMessagesToStatusObjects',
            [$statusResponse, MultiClient::LANGUAGE_LOCALE_GERMAN_DE]
        );

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerSingleStatusResponseToStatusObject
     *
     * @throws \ReflectionException
     */
    public function testMapStatusMessageToStatusObjects($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'mapStatusMessageToStatusObjects',
            [
                $statusResponse->statusMessage,
                $statusResponse,
                MultiClient::LANGUAGE_LOCALE_GERMAN_DE
            ]
        );

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param \ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerStatusObjectsWithMapData
     * @throws \ReflectionException
     */
    public function testMapStatusMessageToStatusObjectsWithMapData($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'mapStatusMessageToStatusObjects',
            [
                $statusResponse->statusMessage,
                $statusResponse,
                MultiClient::LANGUAGE_LOCALE_GERMAN_DE
            ]
        );

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(\ChristophSchaeffer\Dhl\BusinessShipping\Response\Shipping\Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param string $statusMessage
     * @param string $expectedSanitizedStatusMessage
     *
     * @dataProvider providerSanitizeStatusMessage
     *
     * @throws \ReflectionException
     */
    public function testSanitizeStatusMessage($statusMessage, $expectedSanitizedStatusMessage) {
        $sanitizedStatusMessage = $this->runProtectedMethod(
            (new ShippingStatusMapper()),
            'sanitizeStatusMessage',
            [$statusMessage]
        );

        $this->assertEquals($expectedSanitizedStatusMessage, $sanitizedStatusMessage);
    }

}

?>