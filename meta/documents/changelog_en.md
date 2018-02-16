# Release Notes for Elastic Export Google Shopping

## v1.2.3 (2018-02-16)

### Changed
- Updated plugin short description.

## 1.2.2 (2017-12-22)

### Fixed
- An issue was fixed which caused the image URL's not to be generated based on the client.

## 1.2.1 (2017-12-06)

### Changed
- Logs for the export will now be saved as batches of 100.

## 1.2.0 (2017-11-28)

### Added
- Added the new field **additional_image_link** for up to 10 additional images.

## 1.1.7 (2017-11-21)

### Changed
- The performance of reading processes regarding properties has been improved.

## 1.1.6 (2017-10-27)

### Fixed
- An issue was fixed which caused the connection to Elasticsearch to break.

## v1.1.5 (2017-10-18)

### Fixed
- An issue was fixed which caused the properties of the type int and float to not be exported correctly.

## v1.1.4 (2017-10-04)

### Fixed
- An issue was fixed which caused some manufacturer to not be exported.

## v1.1.3 (2017-09-26)

### Fixed
- Shipping costs will now be exported including the currency.

## v1.1.2 (2017-09-18)

### Changed
- The user guide was updated.

## v1.1.1 (2017-07-21)

### Fixed
- An issue was fixed which caused the price to have no currency.

## v1.1.0 (2017-06-07)

### Added
- The feed was extended by the field "availabity_date", which allows the specification of a release date.

## v1.0.16 (2017-06-06)

### Changed
- The plugin Elastic Export is now required to use the plugin format GoogleShopping.

## v1.0.15 (2017-05-30)

### Fixed
- An issue was fixed which caused the properties not to be exported if the property name was not set in german.

### Changed
- Values for the columns "gender", "age_group", "size_system", "size_type" and "energy_efficiency_class" will be no longer
 removed, if they are not conform to the values given by Google Shopping.
 This will simplify finding and correcting missing or wrong values.

## v1.0.14 (2017-05-19)

### Fixed
- An issue was fixed which caused the properties not to be exported in the selected language. 

## v1.0.13 (2017-05-18)

### Fixed
- An issue was fixed which caused elastic search to ignore the set referrers for the barcodes. 

## v1.0.12 (2017-05-12)

### Fixed
- An issue was fixed which prevented the calculation of the base price in specific cases.
- An issue was fixed which caused the export format to export texts in the wrong language.

## v1.0.11 (2017-05-05)

### Fixed
- An issue was fixed which caused errors while loading the export format.

## v1.0.10 (2017-05-02)

### Changed
- Outsourced the stock filter logic to the Elastic Export plugin.

## v1.0.9 (2017-04-18)

### Fixed
- An issue was fixed which caused the plugin to fail at the build productive.

## v1.0.8 (2017-04-05)

### Fixed
- The optional property for "item description" will now be correctly evaluated.

## v1.0.7 (2017-04-05)

### Changed
- This plugin works now with elastic search only.
- The performance has been improved.

## v1.0.6 (2017-04-03)

### Fixed
- The API condition will now be correctly shown.

## v1.0.5 (2017-03-31)

### Changed
- The logic was adjusted to improve the stability.

### Fixed
- The item availability will now be correctly shown.

## v1.0.4 (2017-03-28)

### Fixed
- The reading process of the properties will not throw an error anymore.

## v1.0.3 (2017-03-22)

### Fixed
- We now use a different value to get the image URLs for plugins working with elastic search.

## v1.0.2 (2017-03-13)

### Added
- Added marketplace name.

### Changed
- Updated plugin icons.

## v1.0.1 (2017-03-01)

# Changed
- From now on a SKU will be generated for each exported variation.
- Adjustment for the ResultField, so the imageMutator does not affect the image outcome anymore if the referrer "ALL" is set.

## v1.0.0 (2017-02-20)
 
### Added
- Added initial plugin files.
