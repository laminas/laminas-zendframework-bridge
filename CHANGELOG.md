# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 0.2.4 - TBD

### Added

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
