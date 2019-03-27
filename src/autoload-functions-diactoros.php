<?php
/**
 * Provide aliases for zend-diactoros functions.
 *
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright Copyright (c) 2019 Laminas Foundation (https://getlaminas.org)
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Diactoros;

use Laminas\Diactoros\UploadedFile;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\UploadedFileInterface;

use function Laminas\Diactoros\createUploadedFile as laminasCreateUploadedFile;
use function Laminas\Diactoros\marshalHeadersFromSapi as laminasMarshalHeadersFromSapi;
use function Laminas\Diactoros\marshalMethodFromSapi as laminasMarshalMethodFromSapi;
use function Laminas\Diactoros\marshalProtocolVersionFromSapi as laminasMarshalProtocolVersionFromSapi;
use function Laminas\Diactoros\marshalUriFromSapi as laminasMarshalUriFromSapi;
use function Laminas\Diactoros\normalizeServer as laminasNormalizeServer;
use function Laminas\Diactoros\normalizeUploadedFiles as laminasNormalizeUploadedFiles;
use function Laminas\Diactoros\parseCookieHeader as laminasParseCookieHeader;

// Only define functions if one or more known functions do not exist
if (! function_exists(__NAMESPACE__ . '\createUploadedFile')) {
    function createUploadedFile(array $spec) : UploadedFile
    {
        return laminasCreateUploadedFile($spec);
    }
    
    /**
     * @return array<string, mixed>
     */
    function marshalHeadersFromSapi(array $server) : array
    {
        return laminasMarshalHeadersFromSapi($server);
    }
    
    function marshalMethodFromSapi(array $server) : string
    {
        return laminasMarshalMethodFromSapi($server);
    }
    
    function marshalProtocolVersionFromSapi(array $server) : string
    {
        return laminasMarshalProtocolVersionFromSapi($server);
    }
    
    function marshalUriFromSapi(array $server, array $headers) : Uri
    {
        return laminasMarshalUriFromSapi($server, $headers);
    }
    
    function normalizeServer(array $server, callable $apacheRequestHeaderCallback) : array
    {
        return laminasNormalizeServer($server, $apacheRequestHeaderCallback);
    }
    
    /**
     * @return UploadedFileInterface[]
     */
    function normalizeUploadedFiles(array $files) : array
    {
        return laminasNormalizeUploadedFiles($files);
    }
    
    /**
     * @param  string $cookieHeader A string cookie header value
     * @return array<string, mixed> Key/value cookie pairs
     */
    function parseCookieHeader($cookieHeader) : array
    {
        return laminasParseCookieHeader($cookieHeader);
    }
}
