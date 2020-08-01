# Epic Games Store Roadmap — Version History / Changelog Parser

> Presents a collected Epic Games Store Version History on a single page

## General info

Written for practice. A simple Trello JSON file parser in PHP for showing the Epic Games Store Release Notes / Changelog on a single page. Uses Trello REST API and updates automatically.

## Version History

* 2019-09-02:
  * First release (used "actions" instead of "cards")
* 2019-09-03:
  * Added time of entry
* 2019-09-04:
  * Improved readability, no duplicates. Reading "cards" instead of "actions". Added links to the Trello cards.
* 2019-09-05:
  * Deleted unneeded "Patch Notes" texts, whitespaces, time of day. Date moved to the same line as Version name to save space. Fixed dates for cards, now the date of card creation on Trello is showed. Refactored code, added comments, formatted files. Mouse hover over date shows also detailed time of day and Timezone (UTC +0).
  * Added favicon, description, source link, changed titles.
* 2020-08-01:
  * Support for Trello REST API using public key (the changelog now updates automatically).

## Technologies

* HTML5/CSS
* PHP
* Trello REST API
* JSON

## Contact

Written by [ReznoRMichael](https://github.com/ReznoRMichael)
