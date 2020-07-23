<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Test\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Client;
use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;
use ChristophSchaeffer\Dhl\BusinessShipping\Test\AbstractUnitTest;
use ChristophSchaeffer\Dhl\BusinessShipping\Utility\StatusMapper;

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
                [Status\CityNotKnownToZipCode::class, Status\RoutingCodeNotPossible::class],
                [],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\RoutingCodeNotPossible('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                       Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [Status\CityNotKnownToZipCode::class],
                [],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [Status\CityNotKnownToZipCode::class, Status\RoutingCodeNotPossible::class],
                [(new Status\EmptyStreetName('test', Client::LANGUAGE_LOCALE_GERMAN_DE))],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new Status\EmptyStreetName('test', Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\RoutingCodeNotPossible('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                       Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [Status\CityNotKnownToZipCode::class],
                [(new Status\EmptyStreetName('test', Client::LANGUAGE_LOCALE_GERMAN_DE))],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new Status\EmptyStreetName('test', Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                Status\CityNotKnownToZipCode::class,
                [],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                Status\CityNotKnownToZipCode::class,
                [(new Status\EmptyStreetName('test', Client::LANGUAGE_LOCALE_GERMAN_DE))],
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    (new Status\EmptyStreetName('test', Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                [(new Status\UnknownError('status message', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                [],
                '',
                [(new Status\UnknownError('', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                [],
                NULL,
                [(new Status\UnknownError(NULL, Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                [(new Status\EmptyCity('test', Client::LANGUAGE_LOCALE_GERMAN_DE))],
                'status message',
                [
                    (new Status\EmptyCity('test', Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\UnknownError('status message', Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [(new Status\EmptyCity('test', Client::LANGUAGE_LOCALE_GERMAN_DE))],
                '',
                [
                    (new Status\EmptyCity('test', Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\UnknownError('', Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                [(new Status\EmptyCity('test', Client::LANGUAGE_LOCALE_GERMAN_DE))],
                NULL,
                [
                    (new Status\EmptyCity('test', Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\UnknownError(NULL, Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                Status\WeakValidationError::class
            ],
            [
                'ok',
                Status\Success::class
            ],
            [
                'Der Webservice wurde ohne Fehler ausgeführt.',
                Status\Success::class
            ],
            [
                'Bitte geben Sie Name 1 an.',
                Status\EmptyName1::class
            ],
            [
                'Die Sendung ist nicht leitcodierbar.',
                Status\RoutingCodeNotPossible::class
            ],
            [
                'Der Ort ist zu dieser PLZ nicht bekannt.',
                Status\CityNotKnownToZipCode::class
            ],
            [
                'Die Postleitzahl konnte nicht gefunden werden.',
                Status\ZipCodeNotFound::class
            ],
            [
                'Die angegebene Straße kann nicht gefunden werden.',
                Status\StreetNotFound::class
            ],
            [
                'Die angegebene Hausnummer kann nicht gefunden werden.',
                Status\StreetNumberNotFound::class
            ],
            [
                'Unbekannt',
                NULL
            ],
            [
                'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                Status\InvalidZipCode::class
            ],
            [
                'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999 oder 99999-9999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                Status\InvalidZipCode::class
            ],
            [
                'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie eine britisches Format: AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA oder AA99 9AA. Es ist dennoch möglich, einen Versandschein zu drucken.',
                Status\InvalidZipCode::class
            ],
            [
                'Bitte geben Sie eine gültige Postleitzahl ein. Das Format ist 99999. Das Postleitzahlensystem von Südkorea wurde am 1.8.2015 umgestellt. Falls Ihnen noch eine Postleitzahl im alten Format vorliegt (999-999), kontaktieren Sie bitte den Empfänger für die neue Postleitzahl. Es ist dennoch möglich, einen Versandschein zu drucken.',
                Status\InvalidZipCode::class
            ],
            [
                'Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                [
                    Status\CityNotKnownToZipCode::class,
                    Status\RoutingCodeNotPossible::class
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
                    (new Status\WeakValidationError('Weak validation error occured.',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                    (new Status\StreetNumberNotFound('Die angegebene Hausnummer kann nicht gefunden werden.',
                                                     Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\WeakValidationError('Weak validation error occured.',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\Success('Der Webservice wurde ohne Fehler ausgeführt.',
                                        Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\StreetNotFound('Die angegebene Straße kann nicht gefunden werden.',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                    (new Status\ServiceTemporaryNotAvailable('Service temporary not available',
                                                             Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => NULL],
                [
                    (new Status\ServiceTemporaryNotAvailable(NULL,
                                                             Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => 'Der service steht temporär nicht zur verfügung.', 'statusText' => 'test'],
                [
                    (new Status\ServiceTemporaryNotAvailable('Der service steht temporär nicht zur verfügung.',
                                                             Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => 'Der service steht temporär nicht zur verfügung.', 'statusText' => NULL],
                [
                    (new Status\ServiceTemporaryNotAvailable('Der service steht temporär nicht zur verfügung.',
                                                             Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => 'Weak validation error occured.'],
                [
                    (new Status\ServiceTemporaryNotAvailable('Weak validation error occured.',
                                                             Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusCode' => 500, 'statusMessage' => NULL, 'statusText' => 'tester'],
                [
                    (new Status\ServiceTemporaryNotAvailable('tester',
                                                             Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                [(new Status\RequestProcessingFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 11, 'statusMessage' => 'test'],
                [(new Status\NotWellformedXML('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 12, 'statusMessage' => 'test'],
                [(new Status\XMLSchemaViolation('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 13, 'statusMessage' => 'test'],
                [(new Status\WrongServiceCall('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 14, 'statusMessage' => 'test'],
                [(new Status\RequestProcessingFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 14))]
            ],
            [
                (object)['statusCode' => 15, 'statusMessage' => 'test'],
                [(new Status\RequestProcessingFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 15))]
            ],
            [
                (object)['statusCode' => 17, 'statusMessage' => 'test'],
                [(new Status\RequestProcessingFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 17))]
            ],
            [
                (object)['statusCode' => 19, 'statusMessage' => 'test'],
                [(new Status\RequestProcessingFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 19))]
            ],
            [
                (object)['statusCode' => 20, 'statusMessage' => 'test'],
                [(new Status\QoSFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 21, 'statusMessage' => 'test'],
                [(new Status\SystemOverload('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 100, 'statusMessage' => 'test'],
                [(new Status\GeneralFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 101, 'statusMessage' => 'test'],
                [(new Status\GeneralFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 101))]
            ],
            [
                (object)['statusCode' => 102, 'statusMessage' => 'test'],
                [(new Status\GeneralFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 102))]
            ],
            [
                (object)['statusCode' => 105, 'statusMessage' => 'test'],
                [(new Status\GeneralFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 105))]
            ],
            [
                (object)['statusCode' => 109, 'statusMessage' => 'test'],
                [(new Status\GeneralFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE, 109))]
            ],
            [
                (object)['statusCode' => 110, 'statusMessage' => 'test'],
                [(new Status\AuthorizationFailure('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusCode' => 111, 'statusMessage' => 'test'],
                [(new Status\AuthentificationFailed('test', Client::LANGUAGE_LOCALE_GERMAN_DE))]
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
                    (new Status\WeakValidationError('Weak validation error occured.',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => NULL, 'statusText' => 'Hard validation error occured.'],
                [
                    (new Status\HardValidationError('Hard validation error occured.',
                                                    Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => NULL, 'statusText' => 'ok'],
                [(new Status\Success('ok', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => 'ok'],
                [
                    (new Status\Success('Der Webservice wurde ohne Fehler ausgeführt.',
                                        Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Der Webservice wurde ohne Fehler ausgeführt.', 'statusText' => NULL],
                [
                    (new Status\Success('Der Webservice wurde ohne Fehler ausgeführt.',
                                        Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Bitte geben Sie Name 1 an.'],
                [
                    (new Status\EmptyName1('Bitte geben Sie Name 1 an.',
                                           Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die Sendung ist nicht leitcodierbar.'],
                [
                    (new Status\RoutingCodeNotPossible('Die Sendung ist nicht leitcodierbar.',
                                                       Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Der Ort ist zu dieser PLZ nicht bekannt.'],
                [
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt.',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die Postleitzahl konnte nicht gefunden werden.'],
                [
                    (new Status\ZipCodeNotFound('Die Postleitzahl konnte nicht gefunden werden.',
                                                Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die angegebene Straße kann nicht gefunden werden.'],
                [
                    (new Status\StreetNotFound('Die angegebene Straße kann nicht gefunden werden.',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Die angegebene Hausnummer kann nicht gefunden werden.'],
                [
                    (new Status\StreetNumberNotFound('Die angegebene Hausnummer kann nicht gefunden werden.',
                                                     Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Unbekannt'],
                [(new Status\UnknownError('Unbekannt', Client::LANGUAGE_LOCALE_GERMAN_DE))]
            ],
            [
                (object)['statusMessage' => 'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new Status\InvalidZipCode('Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999 oder 99999-9999. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new Status\InvalidZipCode('Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie das Format 99999 oder 99999-9999. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie eine britisches Format: AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA oder AA99 9AA. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new Status\InvalidZipCode('Es handelt sich um eine ungültige Postleitzahl. Bitte verwenden Sie eine britisches Format: AA9A 9AA, A9A 9AA, A9 9AA, A99 9AA, AA9 9AA oder AA99 9AA. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ],
            [
                (object)['statusMessage' => 'Bitte geben Sie eine gültige Postleitzahl ein. Das Format ist 99999. Das Postleitzahlensystem von Südkorea wurde am 1.8.2015 umgestellt. Falls Ihnen noch eine Postleitzahl im alten Format vorliegt (999-999), kontaktieren Sie bitte den Empfänger für die neue Postleitzahl. Es ist dennoch möglich, einen Versandschein zu drucken.'],
                [
                    (new Status\InvalidZipCode('Bitte geben Sie eine gültige Postleitzahl ein. Das Format ist 99999. Das Postleitzahlensystem von Südkorea wurde am 1.8.2015 umgestellt. Falls Ihnen noch eine Postleitzahl im alten Format vorliegt (999-999), kontaktieren Sie bitte den Empfänger für die neue Postleitzahl. Es ist dennoch möglich, einen Versandschein zu drucken.',
                                               Client::LANGUAGE_LOCALE_GERMAN_DE))
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
                    (new Status\CityNotKnownToZipCode('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                      Client::LANGUAGE_LOCALE_GERMAN_DE)),
                    (new Status\RoutingCodeNotPossible('Der Ort ist zu dieser PLZ nicht bekannt die Sendung ist nicht leitcodierbar',
                                                       Client::LANGUAGE_LOCALE_GERMAN_DE))
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function providerStatusObjectsWithMapData() {
        $data = [];
        foreach (StatusMapper::MESSAGE_MAP as $message => $class):
            $expectedStatusObjects = [];

            if(is_array($class)):
                $classes = $class;
                foreach ($classes as $subClass):
                    $subClass                = '\\' . str_replace('\\\\', '\\', $subClass);
                    $expectedStatusObjects[] = new $subClass($message, Client::LANGUAGE_LOCALE_GERMAN_DE);
                endforeach;
            else:
                $class                   = '\\' . str_replace('\\\\', '\\', $class);
                $expectedStatusObjects[] = new $class($message, Client::LANGUAGE_LOCALE_GERMAN_DE);
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
            (new StatusMapper()),
            'addMultipleStatusClasses',
            [$statusClasses, $statusObjects, $statusMessage, Client::LANGUAGE_LOCALE_GERMAN_DE]
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
            (new StatusMapper()),
            'addSingleStatusClass',
            [$statusClass, $statusObjects, $statusMessage, Client::LANGUAGE_LOCALE_GERMAN_DE]
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
            (new StatusMapper()),
            'addUnknownErrorStatus',
            [$statusObjects, $statusMessage, Client::LANGUAGE_LOCALE_GERMAN_DE]
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
            (new StatusMapper()),
            'getStatusObjectsByCode',
            [$statusResponse, Client::LANGUAGE_LOCALE_GERMAN_DE]
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
            (new StatusMapper()),
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
            (new StatusMapper()),
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
            (new StatusMapper()),
            'ensureStatusMessagePropertyExists',
            [$statusResponse]
        );

        $this->assertEquals((object)['statusMessage' => NULL], $statusResponseAfter);
    }

    /**
     * @param string                  $statusMessage
     * @param Status\AbstractStatus[] $expectedStatusClass
     *
     * @dataProvider providerGetStatusClassByMessage
     *
     * @throws \ReflectionException
     */
    public function testGetStatusClassByMessage($statusMessage, $expectedStatusClass) {
        $statusClass = $this->runProtectedMethod(
            (new StatusMapper()),
            'getStatusClassByMessage',
            [$statusMessage]
        );

        $this->assertEquals($expectedStatusClass, $statusClass);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerStatusObjectsWithMapData
     */
    public function testGetStatusObjectsWithMapData($statusResponse, $expectedStatusObjects) {
        $statusObjects = StatusMapper::getStatusObjects($statusResponse, Client::LANGUAGE_LOCALE_GERMAN_DE);

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerMultipleStatusResponsesToStatusObjects
     * @dataProvider providerSingleStatusResponseToStatusObject
     * @dataProvider providerSingleStatusResponseToStatusObjects
     */
    public function testGetStatusObjectsWithValidData($statusResponse, $expectedStatusObjects) {
        $statusObjects = StatusMapper::getStatusObjects($statusResponse, Client::LANGUAGE_LOCALE_GERMAN_DE);

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @throws \ReflectionException
     */
    public function testHasMultipleStatusClasses() {
        $statusClasses            = [];
        $hasMultipleStatusClasses = $this->runProtectedMethod(
            (new StatusMapper()),
            'hasMultipleStatusClasses',
            [$statusClasses]
        );

        $this->assertTrue($hasMultipleStatusClasses);

        $statusClasses            = ['test'];
        $hasMultipleStatusClasses = $this->runProtectedMethod(
            (new StatusMapper()),
            'hasMultipleStatusClasses',
            [$statusClasses]
        );

        $this->assertTrue($hasMultipleStatusClasses);

        $statusClasses            = 'test';
        $hasMultipleStatusClasses = $this->runProtectedMethod(
            (new StatusMapper()),
            'hasMultipleStatusClasses',
            [$statusClasses]
        );

        $this->assertFalse($hasMultipleStatusClasses);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerMultipleStatusResponsesToStatusObjects
     *
     * @throws \ReflectionException
     */
    public function testMapMultipleStatusMessagesToStatusObjects($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new StatusMapper()),
            'mapMultipleStatusMessagesToStatusObjects',
            [$statusResponse, Client::LANGUAGE_LOCALE_GERMAN_DE]
        );

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerSingleStatusResponseToStatusObject
     *
     * @throws \ReflectionException
     */
    public function testMapStatusMessageToStatusObjects($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new StatusMapper()),
            'mapStatusMessageToStatusObjects',
            [
                $statusResponse->statusMessage,
                $statusResponse,
                Client::LANGUAGE_LOCALE_GERMAN_DE
            ]
        );

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(Status\AbstractStatus::class, $statusObject);
        endforeach;

        $this->assertEquals($expectedStatusObjects, $statusObjects);
    }

    /**
     * @param object|object[]         $statusResponse
     * @param Status\AbstractStatus[] $expectedStatusObjects
     *
     * @dataProvider providerStatusObjectsWithMapData
     * @throws \ReflectionException
     */
    public function testMapStatusMessageToStatusObjectsWithMapData($statusResponse, $expectedStatusObjects) {
        $statusObjects = $this->runProtectedMethod(
            (new StatusMapper()),
            'mapStatusMessageToStatusObjects',
            [
                $statusResponse->statusMessage,
                $statusResponse,
                Client::LANGUAGE_LOCALE_GERMAN_DE
            ]
        );

        foreach ($statusObjects as $statusObject):
            $this->assertInstanceOf(Status\AbstractStatus::class, $statusObject);
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
            (new StatusMapper()),
            'sanitizeStatusMessage',
            [$statusMessage]
        );

        $this->assertEquals($expectedSanitizedStatusMessage, $sanitizedStatusMessage);
    }

}

?>