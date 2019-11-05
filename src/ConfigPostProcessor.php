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
        'zf-apigility' => 'apigility',
    ];

    /** @var Replacements */
    private $replacements;

    /** @var callable[] */
    private $rulesets;

    public function __construct()
    {
        $this->replacements = new Replacements();

        // Define the rulesets for replacements.
        // Each rulest receives the value being rewritten, and the key, if any.
        // It then returns either null (no match), or a callable (match).
        // A returned callable is then used to perform the replacement.
        $this->rulesets     = [
            // Exact values
            function ($value) {
                return is_string($value) && isset($this->exactReplacements[$value])
                    ? [$this, 'replaceExactValue']
                    : null;
            },

            // Aliases
            function ($value, $key) {
                return $key === 'aliases' && is_array($value)
                    ? [$this, 'replaceDependencyAliases']
                    : null;
            },

            // Array values
            function ($value, $key) {
                return null !== $key && is_array($value)
                    ? [$this, '__invoke']
                    : null;
            },
        ];
    }

    /**
     * @return array
     */
    public function __invoke(array $config)
    {
        $rewritten = [];

        foreach ($config as $key => $value) {
            $newKey   = is_string($key) ? $this->replace($key) : $key;
            $newValue = $this->replace($value, $newKey);

            // Key does not already exist and/or is not an array value
            if (! array_key_exists($newKey, $rewritten) || ! is_array($rewritten[$newKey])) {
                // Do not overwrite existing values with null values
                $rewritten[$newKey] = array_key_exists($newKey, $rewritten) && null === $newValue
                    ? $rewritten[$newKey]
                    : $newValue;
                continue;
            }

            // New value is null; nothing to do.
            if (null === $newValue) {
                continue;
            }

            // Key already exists as an array value, but $value is not an array
            if (! is_array($newValue)) {
                $rewritten[$newKey][] = $newValue;
                continue;
            }

            // Key already exists as an array value, and $value is also an array
            $rewritten[$newKey] = static::merge($rewritten[$newKey], $newValue);
        }

        return $rewritten;
    }

    /**
     * Perform substitutions as needed on an individual value.
     *
     * The $key is provided to allow fine-grained selection of rewrite rules.
     *
     * @param mixed $value
     * @param null|int|string $key
     * @return mixed
     */
    private function replace($value, $key = null)
    {
        $rewriteRule = $this->replacementRuleMatch($value, $key);
        return $rewriteRule($value);
    }

    /**
     * Merge two arrays together.
     *
     * If an integer key exists in both arrays, the value from the second array
     * will be appended to the first array. If both values are arrays, they are
     * merged together, else the value of the second array overwrites the one
     * of the first array.
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

            if (null === $value && array_key_exists($key, $a)) {
                // Leave as-is if value from $b is null
                continue;
            }

            if (is_int($key)) {
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
     * @param mixed $value
     * @param null|int|string $key
     * @return callable Callable to invoke with value
     */
    private function replacementRuleMatch($value, $key = null)
    {
        foreach ($this->rulesets as $ruleset) {
            $result = $ruleset($value, $key);
            if (is_callable($result)) {
                return $result;
            }
        }
        return [$this, 'fallbackReplacement'];
    }

    /**
     * Replace a value using the translation table, if the value is a string.
     *
     * @param mixed $value
     * @return mixed
     */
    private function fallbackReplacement($value)
    {
        return is_string($value)
            ? $this->replacements->replace($value)
            : $value;
    }

    /**
     * Replace a value matched exactly.
     *
     * @param mixed $value
     * @return mixed
     */
    private function replaceExactValue($value)
    {
        return $this->exactReplacements[$value];
    }

    /**
     * Rewrite dependency aliases array
     *
     * In this case, we want to keep the alias as-is, but rewrite the target.
     *
     * @param array $value
     * @return array
     */
    private function replaceDependencyAliases(array $aliases)
    {
        foreach ($aliases as $alias => $target) {
            $aliases[$alias] = $this->replacements->replace($target);
        }
        return $aliases;
    }
}
