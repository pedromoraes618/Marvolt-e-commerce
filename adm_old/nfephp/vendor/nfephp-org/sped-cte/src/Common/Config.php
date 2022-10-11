<?php

namespace NFePHP\CTe\Common;

/**
 * Class for validation of config
 *
 * @category  NFePHP
 * @package   NFePHP\CTe\Common\Config
 * @copyright NFePHP Copyright (c) 2008-2017
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfe for the canonical source repository
 */

use JsonSchema\Validator as JsonValid;
use JsonSchema\SchemaStorage;
use stdClass;
use NFePHP\CTe\Exception\DocumentsException;

class Config
{
    /**
     * Validate method
     * @param string $content config.json
     * @return boolean
     */
    public static function validate($content)
    {
        if (!is_string($content)) {
            return false;
        }
        $std = json_decode($content);
        if (!is_object($std)) {
            return false;
        }
        self::validInputData($std);
        return true;
    }
    
    /**
     * Validation with JsonVali::class
     * @param stdClass $data
     * @return boolean
     * @throws DocumentsException
     */
    protected static function validInputData(stdClass $data)
    {
        $filejsonschema = __DIR__. "/../../storage/config_json.schema";
        $validator = new JsonValid();
        $validator->check($data, (object)['$ref' => 'file://' . $filejsonschema]);
        if (!$validator->isValid()) {
            $msg = "";
            foreach ($validator->getErrors() as $error) {
                $msg .= sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
            throw DocumentsException::wrongDocument(8, $msg);
        }
        return true;
    }
}
