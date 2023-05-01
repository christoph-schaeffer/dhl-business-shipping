<?php

namespace ChristophSchaeffer\Dhl\BusinessShipping\Utility;

use function file_get_contents;
use function file_put_contents;
use function simplexml_load_string;

class PatchXSD
{
    public array $patches = [
        'postnumberEmail',
        'hongkongZipCode'
    ];

    /** Holds xml files in flux */
    public array $files = [];
    /** Holds human-readable name to file-path lookup table */
    public array $names = [];

    /**
     * BCS file is type defintions
     * CIS file is the schema
     */
    public function handle(): void
    {
        $files = glob(__DIR__ . '/../../wsdl/*.xsd');
        foreach ($files as $file) {
            $name = str_contains($file, 'bcs_base.xsd') ? 'types' : 'schema';
            $content = file_get_contents($file);

            $this->files[$name] = simplexml_load_string($content);
            $this->names[$name] = $file;
        }

        foreach ($this->patches as $patch) {
            $this->{$patch}();
        }

        foreach ($this->names as $name => $path) {
            @unlink($path);
            file_put_contents($path, $this->files[$name]->asXML());
        }
    }

    public function postnumberEmail(): void
    {
        // Ensure that the postnumber is not required
        // to allow sending in an email instead
        $elements = $this->files['schema']->xpath('//xs:element[@name="postNumber"][not(contains(@minOccurs, "0"))]');

        foreach ($elements as $element) {
            $element->addAttribute('minOccurs', 0);
        }
    }

    public function hongkongZipCode()
    {
        $elements = $this->files['schema']->xpath('//xs:element[@ref="cis:zip"][not(contains(@minOccurs, "0"))]');

        foreach ($elements as $element) {
            $element->addAttribute('minOccurs', 0);
        }
    }
}

(new PatchXSD())->handle();
