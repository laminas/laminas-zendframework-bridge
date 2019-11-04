<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

class ConfigPostProcessor
{
    /** @var array String keys => string values */
    private $exactReplacements = [
        'zend-expressive' => 'expressive',
    ];

    /** @var string[] */
    private $exactReplacementsLookupTable;

    /** @var Replacements */
    private $replacements;

    public function __construct()
    {
        $this->replacements = new Replacements();
        $this->exactReplacementsLookupTable = array_keys($this->exactReplacements);
    }

    /**
     * @return array
     */
    public function __invoke(array $config)
    {
        $rewritten = [];

        foreach ($config as $key => $value) {
            $newKey = is_string($key) ? $this->replace($key) : $key;

            if (array_key_exists($newKey, $rewritten) && is_array($rewritten[$newKey])) {
                $rewritten[$newKey] = self::merge($rewritten[$newKey], $this->rewriteValue($value, $newKey));
                continue;
            }

            $rewritten[$newKey] = $this->rewriteValue($value, $newKey);
        }

        return $rewritten;
    }

    /**
     * Perform subsitutions as needed on an individual value.
     *
     * The $key is provided to ensure we do not rewrite aliases configuration.
     *
     * @param mixed $value
     * @param string|int $key
     * @return mixed
     */
    private function rewriteValue($value, $key)
    {
        if (is_string($value)) {
            return $this->replace($value);
        }

        if (! is_array($value)) {
            return $value;
        }

        // Array; time to recurse, but only if not aliases.
        return $key === 'aliases' ? $value : $this($value);
    }

    /**
     * Merge two arrays together.
     *
     * If an integer key exists in both arrays and preserveNumericKeys is false, the value
     * from the second array will be appended to the first array. If both values are arrays, they
     * are merged together, else the value of the second array overwrites the one of the first array.
     *
     * Based on zend-stdlib Zend\Stdlib\ArrayUtils::merge
     * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
     *
     * @param  array $a
     * @param  array $b
     * @return array
     */
    public static function merge(array $a, array $b)
    {
        foreach ($b as $key => $value) {
            if (! isset($a[$key]) && ! array_key_exists($key, $a)) {
                $a[$key] = $value;
                continue;
            }

            if (! $preserveNumericKeys && is_int($key)) {
                $a[] = $value;
                continue;
            }
            
            if (is_array($value) && is_array($a[$key])) {
                $a[$key] = static::merge($a[$key], $value);
                continue;
            }

            $a[$key] = $value;
        }

        return $a;
    }

    /**
     * @param string $value
     * @return string
     */
    private function replace($value)
    {
        if (in_array($value, $this->exactReplacementsLookupTable, true)) {
            return $this->exactReplacements[$value];
        }
        return $this->replacements->replace($value);
    }
}
