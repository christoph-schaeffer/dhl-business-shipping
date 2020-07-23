<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Utility;

use ChristophSchaeffer\Dhl\BusinessShipping\Response\Status;

/**
 * Class StatusMapper
 * @package ChristophSchaeffer\Dhl\BusinessShipping\Utility
 *
 * Used to map the return status messages of the dhl api to specific translatable objects. You could check
 * for example if a status extends the HardValidationError or WeakValidationError to output user-friendly error
 * messages or to add custom error handling.
 * If a status message has not been created yet, it will default to the UnknownError object.
 */
class StatusMapper {

    const CODE_MAP = [
        ['from' => 10, 'to' => 10, 'class' => Status\RequestProcessingFailure::class],
        ['from' => 11, 'to' => 11, 'class' => Status\NotWellformedXML::class],
        ['from' => 12, 'to' => 12, 'class' => Status\XMLSchemaViolation::class],
        ['from' => 13, 'to' => 13, 'class' => Status\WrongServiceCall::class],
        ['from' => 14, 'to' => 19, 'class' => Status\RequestProcessingFailure::class],
        ['from' => 20, 'to' => 20, 'class' => Status\QoSFailure::class],
        ['from' => 21, 'to' => 21, 'class' => Status\SystemOverload::class],
        ['from' => 22, 'to' => 29, 'class' => Status\QoSFailure::class],
        ['from' => 100, 'to' => 109, 'class' => Status\GeneralFailure::class],
        ['from' => 110, 'to' => 110, 'class' => Status\AuthorizationFailure::class],
        ['from' => 111, 'to' => 111, 'class' => Status\AuthentificationFailed::class],
        ['from' => 112, 'to' => 112, 'class' => Status\InsufficientRight::class],
        ['from' => 113, 'to' => 119, 'class' => Status\AuthorizationFailure::class],
        ['from' => 120, 'to' => 120, 'class' => Status\IncorrectRequest::class],
        ['from' => 121, 'to' => 121, 'class' => Status\MissingParameter::class],
        ['from' => 122, 'to' => 122, 'class' => Status\InvalidParameter::class],
        ['from' => 123, 'to' => 129, 'class' => Status\IncorrectRequest::class],
        ['from' => 130, 'to' => 179, 'class' => Status\GeneralFailure::class],
        ['from' => 180, 'to' => 180, 'class' => Status\NetworkFailure::class],
        ['from' => 181, 'to' => 181, 'class' => Status\ConnectionFailure::class],
        ['from' => 182, 'to' => 182, 'class' => Status\NetworkIOReadFailure::class],
        ['from' => 183, 'to' => 183, 'class' => Status\NetworkIOWriteFailure::class],
        ['from' => 184, 'to' => 189, 'class' => Status\NetworkFailure::class],
        ['from' => 190, 'to' => 199, 'class' => Status\GeneralFailure::class],
        ['from' => 500, 'to' => 500, 'class' => Status\ServiceTemporaryNotAvailable::class],
        ['from' => 1000, 'to' => 1000, 'class' => Status\GeneralError::class],
        ['from' => 1001, 'to' => 1001, 'class' => Status\AuthenticationFailure::class],
        ['from' => 2010, 'to' => 2010, 'class' => Status\IllegalShipmentState::class]
    ];

    const MESSAGE_MAP = [
        'derwebservicewurdeohnefehlerausgefhrt'                                          => Status\Success::class,
        'ok'                                                                             => Status\Success::class,
        'hardvalidationerroroccured'                                                     => Status\HardValidationError::class,
        'indersendungtratmindestenseinharterfehlerauf'                                   => Status\HardValidationError::class,
        'weakvalidationerroroccured'                                                     => Status\WeakValidationError::class,
        'dereingegebenewertistzulangundwurdegekrzt'                                      => Status\ValueHasBeenShortened::class,
        'derortistzudieserplznichtbekanntdiesendungistnichtleitcodierbar'                => [
            Status\CityNotKnownToZipCode::class,
            Status\RoutingCodeNotPossible::class
        ],
        'dieeingegebeneadresseistnichtleitcodierbar'                                     => Status\RoutingCodeNotPossible::class,
        'ashipmentforprintcannotbefound'                                                 => Status\UnknownShipmentNumber::class,
        'dieangegebenesendungsnummerkonntenichtgefundenwerden'                           => Status\UnknownShipmentNumber::class,
        'unknownshipmentnumber'                                                          => Status\UnknownShipmentNumber::class,
        'diesendungsnummeristinderaktuellennutzergruppenichtbekannt'                     => Status\UnknownShipmentNumber::class,
        'ashipmentforcancelationcannotbefound'                                           => Status\UnknownShipmentNumber::class,
        'dieausgewhlteabrechnungsnummerstehtnichtzurverfgung'                            => Status\AccountNumberNotAvailable::class,
        'dieabrechnungsnummeristfrdiepostleitzahldesempfngersungltig'                    => Status\InvalidAccountNumberForGivenZipCode::class,
        'sieknnenausdemabsenderlandnichtverschicken'                                     => Status\CantSendFromShipperCountry::class,
        'derortistzudieserplznichtbekannt'                                               => Status\CityNotKnownToZipCode::class,
        'derortistzudieserplznichtbekanntdiesendungisttrotzdemleitcodierbarundeswurdeeinversandscheinerzeugt'
                                                                                         => Status\CityNotKnownToZipCode::class,
        'bittewhlensieeindatum'                                                          => Status\EmptyDayOfDelivery::class,
        'bittegebensieeinenortan'                                                        => Status\EmptyCity::class,
        'bittegebensiedenwarenwertan'                                                    => Status\EmptyCustomsValue::class,
        'bittegebensiedieanzahlan'                                                       => Status\EmptyExportAmount::class,
        'bittegebensiediebeschreibungan'                                                 => Status\EmptyExportPositionDescription::class,
        'beimtypsonstigesisteinebeschreibungerforderlich'                                => Status\EmptyExportTypeDescription::class,
        'bittegebensiedieartdersendungan'                                                => Status\EmptyExportType::class,
        'bittegebensiedasgewichtan'                                                      => Status\EmptyExportWeight::class,
        'bittegebensiename1an'                                                           => Status\EmptyName1::class,
        'bittegebensieeinproduktan'                                                      => Status\EmptyProduct::class,
        'bittegebensieeinestraean'                                                       => Status\EmptyStreetName::class,
        'bittegebensieeinehausnummeran'                                                  => Status\EmptyStreetNumber::class,
        'bittegebensieeingewichtan'                                                      => Status\EmptyWeight::class,
        'bittegebensieeinepostleitzahlan'                                                => Status\EmptyZipCode::class,
        'bittegebensieeineganzezahlein'                                                  => Status\NonIntegerGiven::class,
        'dasangegebenegurtmaistzugro'                                                    => Status\GirthToLong::class,
        'dieausgewhlteabrechnungsnummeristnichtgltig'                                    => Status\InvalidAccountNumber::class,
        'bittegebensieeinengltigenbetragan'                                              => Status\InvalidAmount::class,
        'dieverwendetepostnummeristnichtgltigbittegebensieeinegltigepostnummeran'        => Status\InvalidPostNumber::class,
        'bittegebensieeinegltigeemailadresseeinundverwendensiebeidereingabemehrereremailadresseneinkommazurtrennungdieeingabevonumlautenistungltigsolltensieeinegltigeemailadresseeingegebenhabensohatderempfngerdemerhaltvonemailsdurchdhlwidersprochenindiesemfallistesnichtmglichdenserviceauszufhren'
                                                                                         => Status\InvalidEmailAddress::class,
        'bittegebensiefrdieversandbesttigungeineodermehrereemailadressenanverwendensiebeidereingabemehrereremailadresseneinkommazurtrennung'
                                                                                         => Status\InvalidEmailAddress::class,
        'bittegebensieeinegltigeemailadresseeindieeingabevonumlautenistungltigsolltensieeinegltigeemailadresseeingegebenhabensohatderempfngerdemerhaltvonemailsdurchdhlwidersprochen'
                                                                                         => Status\InvalidEmailAddress::class,
        'dieangegebeneartdersendungistnichtgltig'                                        => Status\InvalidExportType::class,
        'bittegebensieeinegltigetelefonnummeran'                                         => Status\InvalidPhoneNumber::class,
        'bittegebensieeingltigessendungsdatuman'                                         => Status\InvalidShipmentDate::class,
        'bittegebensieeingltigesdatuman'                                                 => Status\InvalidDate::class,
        'bitteberprfensieihreangabendasfeldnachnameisteinpflichtfeldundmussbeflltwerden' => Status\EmptySurname::class,
        'bitteberprfensieihreangabendasfeldvornameisteinpflichtfeldundmussbeflltwerden'  => Status\EmptyGivenName::class,
        'bitteberprfensieihreangabeningeburtsdatumundodermindestaltermindestenseinesdieserfeldermussbeflltwerdeneineangabeinbeidenfeldernistebenfallszulssig'
                                                                                         => Status\EmptyDateOfBirthOrMinimumAge::class,
        'daszustelldatummussmindestensheutesein'                                         => Status\DayOfDeliveryInThePast::class,
        'wirdeinederabmessungenangegebenmssenalleangegebenwerden'                        => Status\MissingDimension::class,
        'dieangegebenelngeistzugro'                                                      => Status\LengthToLong::class,
        'dieangegebenehheistzugro'                                                       => Status\HeightToHigh::class,
        'dieangegebenebreiteistzugro'                                                    => Status\WidthToLarge::class,
        'bittegebensieeinennachnahmebetragan'                                            => Status\EmptyCodAmount::class,
        'derangegebenenachnahmebetragzuhoch'                                             => Status\CodAmountToHigh::class,
        'dergewhltetypderalterssichtprfungistnichtgltigmglichewertea16odera18'           => Status\InvalidVisualCheckOfAgeType::class,
        'ihrpasswortistabgelaufen'                                                       => Status\PasswordExpired::class,
        'passwordexpired'                                                                => Status\PasswordExpired::class,
        'dasangegebeneproduktistfrdaslandnichtverfgbar'                                  => Status\ProductNotAvailableForReceiverCountry::class,
        'dasproduktistnichtfrdasabsenderlandverfgbar'                                    => Status\ProductNotAvailableForShipperCountry::class,
        'diebenutzungdesproduktesdhlpakettaggleichistfrdieseempfngeradressenichtmglich'  => Status\SameDayDeliveryNotAvailableForReceiverAddress::class,
        'diesendungistnichtleitcodierbar'                                                => Status\RoutingCodeNotPossible::class,
        'bittewhlensieeinzeitfenster'                                                    => Status\EmptyPreferredTime::class,
        'bittegebensieeinepostnummeran'                                                  => Status\EmptyPostNumber::class,
        'dasgewhltezeitfensteristnichtgltig'                                             => Status\InvalidTimeFrame::class,
        'dieangegebeneibanistnichtgltig'                                                 => Status\InvalidIBAN::class,
        'mindestalterhateinenfalschenwert'                                               => Status\InvalidMinimumAge::class,
        'dasvonihnenausgewhltezustellzeitfensterstehtleiderfrdieseempfngeradressenichtzurverfgung'
                                                                                         => Status\TimeFrameNotAvailableForReceiverAddress::class,
        'dieangegebenestraekannnichtgefundenwerden'                                      => Status\StreetNotFound::class,
        'dieangegebenehausnummerkannnichtgefundenwerden'                                 => Status\StreetNumberNotFound::class,
        'dasangegebeneproduktistnichtbekannt'                                            => Status\UnknownProduct::class,
        'diepackstationsnummeristunsaktuellnichtbekanntbitteberprfensiedienummerunddiepostleitzahleskannineinzelfllenseindasseineneuepackstationnochnichtbekanntistsieknnentrotzdemeineleitcodiertesendungerzeugen'
                                                                                         => Status\UnknownPackstationNumber::class,
        'packstationsnummernliegenzwischen101und999bittesetzensiesichmitdemempfngerinverbindungumeinekorrektenummerzuerfragen'
                                                                                         => Status\InvalidPackstationNumber::class,
        'diefilialnummeristnichtinversendenhinterlegtbitteberprfensiedienummerunddiepostleitzahleskannineinzelfllenseindasseineneuefilialenochnichthinterlegtistsieknnentrotzdemeineleitcodiertesendungerzeugen'
                                                                                         => Status\UnknownPostfilialNumber::class,
        'filialnummernliegenzwischen401und999bittesetzensiesichmitdemempfngerinverbindungumeinekorrektenummerzuerfragen'
                                                                                         => Status\InvalidPostfilialNumber::class,
        'diegewichtsangabeistzuhoch'                                                     => Status\WeightToHigh::class,
        'diegewichtsangabeistkleineralsimcn23formular'                                   => Status\WeightLowerThanCN23Form::class,
        'dassendungsgewichtentsprichtdemgesamtnettogewichtderwarenpositionenbittetragensiehierdasgesamtgewichtdersendungeinschlielichverpackungsundfllmaterialienein'
                                                                                         => Status\ShipmentWeightIsEqualToNetWeight::class,
        'diegewichtsangabeistzugering'                                                   => Status\WeightToLow::class,
        'diepostleitzahlkonntenichtgefundenwerden'                                       => Status\ZipCodeNotFound::class,
        'daszpl2formatwurdeautomatischauf103x199mmgendert'                               => Status\ZPL2LabelFormatAutomaticallyChanged::class,
        'essindkeinesendungenfrdiegewhlteabrechnungsnummerunddentag'                     => Status\NoShipmentsForManifestFound::class,
        'illegalshipmentstate'                                                           => Status\IllegalShipmentState::class
    ];

    /**
     * @param object $statusResponse
     * @param string $languageLocale
     *
     * @return Status\AbstractStatus[]
     */
    public static function getStatusObjects($statusResponse, $languageLocale) {
        $statusObjects = self::getStatusObjectsByCode($statusResponse, $languageLocale);

        if(empty($statusObjects)):
            $statusResponse = self::ensureStatusMessagePropertyExists($statusResponse);

            if(is_array($statusResponse->statusMessage))
                $statusObjects = self::mapMultipleStatusMessagesToStatusObjects($statusResponse, $languageLocale);
            else
                $statusObjects = self::mapStatusMessageToStatusObjects($statusResponse->statusMessage,
                                                                       $statusResponse, $languageLocale);
        endif;

        return $statusObjects;
    }

    /**
     * @param Status\AbstractStatus[] $statusClasses
     * @param Status\AbstractStatus[] $statusObjects
     * @param string                  $statusMessage
     * @param string                  $languageLocale
     *
     * @return Status\AbstractStatus[]
     */
    private static function addMultipleStatusClasses($statusClasses, array $statusObjects, $statusMessage,
                                                     $languageLocale) {
        foreach ($statusClasses as $statusClass)
            $statusObjects[] = new $statusClass($statusMessage, $languageLocale);

        return $statusObjects;
    }

    /**
     * @param Status\AbstractStatus   $statusClass
     * @param Status\AbstractStatus[] $statusObjects
     * @param string                  $statusMessage
     * @param string                  $languageLocale
     *
     * @return Status\AbstractStatus[]
     */
    private static function addSingleStatusClass($statusClass, array $statusObjects, $statusMessage, $languageLocale) {
        $statusObjects[] = new $statusClass($statusMessage, $languageLocale);

        return $statusObjects;
    }

    /**
     * @param Status\AbstractStatus[] $statusObjects
     * @param string                  $statusMessage
     *
     * @return Status\AbstractStatus[]
     */
    private static function addUnknownErrorStatus(array $statusObjects, $statusMessage, $languageLocale) {
        $unknownError    = new Status\UnknownError($statusMessage, $languageLocale);
        $statusObjects[] = $unknownError;

        return $statusObjects;
    }

    /**
     * @param string $sanitizedStatusMessage
     *
     * @return bool
     */
    private static function containsZipKeyword($sanitizedStatusMessage) {
        return strpos($sanitizedStatusMessage, 'postleitzahl') !== FALSE
            || strpos($sanitizedStatusMessage, 'plz') !== FALSE;
    }

    /**
     * @param Object $statusResponse
     *
     * @return Object
     */
    private static function ensureStatusMessagePropertyExists($statusResponse) {
        if(!property_exists($statusResponse, 'statusMessage'))
            $statusResponse->statusMessage = NULL;

        return $statusResponse;
    }

    /**
     * @param object $statusResponse
     * @param string $languageLocale
     *
     * @return NULL|Status\AbstractStatus[]
     */
    private static function getStatusObjectsByCode($statusResponse, $languageLocale) {
        if(!property_exists($statusResponse, 'statusCode'))
            return NULL;

        $statusCode = (int)$statusResponse->statusCode;
        $rawMessage = empty($statusResponse->statusMessage) ? $statusResponse->statusText : $statusResponse->statusMessage;
        foreach (self::CODE_MAP as $codeRange):
            if($codeRange['from'] <= $statusCode && $codeRange['to'] >= $statusCode):
                $statusObject = new $codeRange['class']($rawMessage, $languageLocale, $statusCode);

                return [$statusObject];
            endif;
        endforeach;

        return NULL;
    }

    /**
     * @param string $statusMessage
     *
     * @return Status\AbstractStatus[]|Status\AbstractStatus|null
     */
    private static function getStatusClassByMessage($statusMessage) {
        $sanitizedStatusMessage = self::sanitizeStatusMessage($statusMessage);

        if(key_exists($sanitizedStatusMessage, self::MESSAGE_MAP)):
            $statusClass = self::MESSAGE_MAP[$sanitizedStatusMessage];
        elseif(self::containsZipKeyword($sanitizedStatusMessage)):
            $statusClass = Status\InvalidZipCode::class;
        else:
            $statusClass = NULL;
        endif;

        return $statusClass;
    }

    /**
     * @param Status\AbstractStatus[]|Status\AbstractStatus $statusClasses
     *
     * @return bool
     */
    private static function hasMultipleStatusClasses($statusClasses) {
        return is_array($statusClasses);
    }

    /**
     * @param object $statusResponse
     * @param string $languageLocale
     *
     * @return array
     */
    private static function mapMultipleStatusMessagesToStatusObjects($statusResponse, $languageLocale) {
        $statusObjects                 = [];
        $statusResponse->statusMessage = array_unique($statusResponse->statusMessage);

        foreach ($statusResponse->statusMessage as $statusMessage):
            $statusObjects = array_merge(
                $statusObjects,
                self::mapStatusMessageToStatusObjects($statusMessage, $statusResponse, $languageLocale)
            );
        endforeach;

        return $statusObjects;
    }

    /**
     * @param string $statusMessage
     * @param object $statusResponse
     * @param string $languageLocale
     *
     * @return Status\AbstractStatus[]
     */
    private static function mapStatusMessageToStatusObjects($statusMessage, $statusResponse, $languageLocale) {
        if(empty($statusMessage))
            $statusMessage = $statusResponse->statusText;

        $statusClass = self::getStatusClassByMessage($statusMessage);

        $statusObjects = [];
        if(empty($statusClass)):
            $statusObjects = self::addUnknownErrorStatus($statusObjects, $statusMessage, $languageLocale);
        elseif(self::hasMultipleStatusClasses($statusClass)):
            $statusObjects = self::addMultipleStatusClasses($statusClass, $statusObjects, $statusMessage, $languageLocale);
        else:
            $statusObjects = self::addSingleStatusClass($statusClass, $statusObjects, $statusMessage, $languageLocale);
        endif;

        return $statusObjects;
    }

    /**
     * @param string $statusMessage
     *
     * @return string
     */
    private static function sanitizeStatusMessage($statusMessage) {
        return strtolower(str_replace([
                                          'ä', 'ü', 'ö', 'ß', '.', ',', ' ', '-', '"', '\'', '\\', '/', ':', ';',
                                          PHP_EOL
                                      ], '',
                                      $statusMessage));
    }


}