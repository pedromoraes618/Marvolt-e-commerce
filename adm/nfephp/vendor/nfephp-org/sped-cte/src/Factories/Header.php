<?php

namespace NFePHP\CTe\Factories;

/**
 * Class responsible for the assembly of SOAPHeader, will no longer exist
 * in version 4.0 of the SEFAZ layout.
 * This class is valid only until 11/2017 after that date becomes OBSOLETE
 * and if it is used it will cause communication failure.
 */

class Header
{
    /**
     * Return header
     * @param string $namespace
     * @param string $cUF
     * @param string $version
     * @return string
     */
    public static function get($namespace, $cUF, $version)
    {
        return "<cteCabecMsg "
            . "xmlns=\"$namespace\">"
            . "<cUF>$cUF</cUF>"
            . "<versaoDados>$version</versaoDados>"
            . "</cteCabecMsg>";
    }
}
