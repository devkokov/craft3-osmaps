# OS Maps Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 1.0.0 - 2019-12-04
### Added
- Initial release

## 1.0.1 - 2019-12-04
### Fixed
- Fixed error "InvalidArgumentException: The file or directory to be published does not exist" caused by Craft unable to find the resources folder of our AssetBundle

## 1.1.0 - 2020-01-21
### Changed
- Changed attribution to Burnthebook Ltd.
- Changed namespaces to Burnthebook\OSMaps
- Moved repository to https://github.com/Burnthebook/craft3-osmaps
- Moved composer package to burnthebook/craft3-osmaps

## 1.2.0 - 2021-04-19
### Changed
- Updated the API URL
- Removed jenssegers/proxy
- Updated Composer to version 2

## 1.2.1 - 2021-04-19
### Changed
- sourcepath in assetbundles/OSMaps/OSMapsAsset wasn't changed correctly 

## 1.2.2 - 2021-04-19
### Changed
- added laminas/laminas-diactoros as dependency

## 1.2.3 - 2021-06-15
### Changed
- namespaces now comply with PSR4 autoloading standards 

## 1.2.4 - 2021-06-15
### Changed
- namespaces correctly named in OSMaps.php 

## 1.2.5 - 2021-06-16
### Changed
- services in composer.json should be lowercase 

## 2.0.0 - 2023-05-25
- Craft 4 - initial compatibility