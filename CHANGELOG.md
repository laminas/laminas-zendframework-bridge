# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 0.3.4 - TBD

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.3.3 - 2019-11-06

### Added

- [#22](https://github.com/laminas/laminas-zendframework-bridge/pull/22) adds configuration post-processing features, exposed both as a laminas-config-aggregator post processor (for use with Expressive applications) and as a laminas-modulemanager `EVENT_MERGE_CONFIG` listener (for use with MVC applications). When registered, it will post-process the configuration, replacing known Zend Framework-specific strings with their Laminas replacements. A ruleset is provided that ensures dependency configuration is rewritten in a safe manner, routing configuration is skipped, and certain top-level configuration keys are matched exactly (instead of potentially as substrings or word stems). A later release of laminas-migration will auto-register these tools in applications when possible.

### Changed

- [#22](https://github.com/laminas/laminas-zendframework-bridge/pull/22) removes support for PHP versions prior to PHP 5.6. We have decided to only support supported PHP versions, whether that support is via php.net or commercial. The lowest supported PHP version we have found is 5.6. Users wishing to migrate to Laminas must at least update to PHP 5.6 before doing so.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.3.2 - 2019-10-30

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- [#21](https://github.com/laminas/laminas-zendframework-bridge/pull/21) removes rewriting of the Amazon library, as it is not moving to Laminas.

- [#21](https://github.com/laminas/laminas-zendframework-bridge/pull/21) removes rewriting of the GCM and APNS libraries, as they are not moving to Laminas.

### Fixed

- [#21](https://github.com/laminas/laminas-zendframework-bridge/pull/21) fixes how the recaptcha and twitter library package and namespaces are rewritten.

## 0.3.1 - 2019-04-25

### Added

- [#20](https://github.com/laminas/laminas-zendframework-bridge/pull/20) provides an additional autoloader that is _prepended_ to the autoloader
  stack. This new autoloader will create class aliases for interfaces, classes,
  and traits referenced in type hints and class declarations, ensuring PHP is
  able to resolve them correctly during class_alias operations.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.3.0 - 2019-04-12

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- [#16](https://github.com/laminas/laminas-zendframework-bridge/pull/16) removes the `RewriteRules::classRewrite()` method, as it is no longer
  needed due to internal refactoring.

### Fixed

- [#16](https://github.com/laminas/laminas-zendframework-bridge/pull/16) fixes how the rewrite rules detect the word `Zend` in subnamespaces and
  class names to be both more robust and simpler.

## 0.2.5 - 2019-04-11

### Added

- [#12](https://github.com/laminas/laminas-zendframework-bridge/pull/12) adds functionality for ensuring we alias namespaces and classes that
  include the word `Zend` in them; e.g., `Zend\Expressive\ZendView\ZendViewRendererFactory`
  will now alias to `Expressive\LaminasView\LaminasViewRendererFactory`.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.2.4 - 2019-04-11

### Added

- [#11](https://github.com/laminas/laminas-zendframework-bridge/pull/11) adds maps for the Expressive router adapter packages.

- [#10](https://github.com/laminas/laminas-zendframework-bridge/pull/10) adds a map for the Psr7Bridge package, as it used `Zend` within a subnamespace.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.2.3 - 2019-04-10

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#9](https://github.com/laminas/laminas-zendframework-bridge/pull/9) fixes the mapping for the Problem Details package.

## 0.2.2 - 2019-04-10

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Added a check that the discovered alias exists as a class, interface, or trait
  before attempting to call `class_alias()`.

## 0.2.1 - 2019-04-10

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#8](https://github.com/laminas/laminas-zendframework-bridge/pull/8) fixes mappings for each of zend-expressive-authentication-zendauthentication,
  zend-expressive-zendrouter, and zend-expressive-zendviewrenderer.

## 0.2.0 - 2019-04-01

### Added

- Nothing.

### Changed

- [#4](https://github.com/laminas/laminas-zendframework-bridge/pull/4) rewrites the autoloader to be class-based, via the class
  `Laminas\ZendFrameworkBridge\Autoloader`. Additionally, the new approach
  provides a performance boost by using a balanced tree algorithm, ensuring
  matches occur faster.

### Deprecated

- Nothing.

### Removed

- [#4](https://github.com/laminas/laminas-zendframework-bridge/pull/4) removes function aliasing. Function aliasing will move to the packages that
  provide functions.

### Fixed

- Nothing.

## 0.1.0 - 2019-03-27

### Added

- Adds an autoloader file that registers with `spl_autoload_register` a routine
  for aliasing legacy ZF class/interface/trait names to Laminas Project
  equivalents.

- Adds autoloader files for aliasing legacy ZF package functions to Laminas
  Project equivalents.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
