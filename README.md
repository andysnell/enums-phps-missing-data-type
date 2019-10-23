# Enums: PHP's Missing Data Type

**Latest Slide Deck:** https://slides.com/andysnell/php-world-enums

PHP may not have a native data type for an enumerated type (“enum”), like other 
programming languages, but there are userland solutions we can leverage to get 
access to this powerful data type. We’ll see how representing things like 
statuses with enums provides immutability, improved readability, and type 
safety — preventing the kind of errors that happen with “magic strings” and 
class constants. In this session, we’ll be making our own immutable enums from 
scratch in order to explore the concept, but we’ll also introduce two libraries 
for use in your production code. We’ll also demystify the imposing-sounding 
“finite state machine” by using using immutable enum objects to regulate the 
transitions between statuses.

## Additional Resources

### Interesting Userland Package Implementations of Enum Objects

* [myclabs/php-enum: PHP Enum implementation inspired from SplEnum](https://github.com/myclabs/php-enum)
* [spatie/enum: Strongly typed enums in PHP supporting autocompletion and refactoring](https://github.com/spatie/enum)
* [BenSampo/laravel-enum: Simple, extensible and powerful enumeration implementation for Laravel.](https://github.com/BenSampo/laravel-enum)
* [dbalabka/php-enumeration: Implementation of enumeration classes in PHP](https://github.com/dbalabka/php-enumeration)

### PHP RFCs and Internals Discussions

* [PHP RFC: Enumerated Types](https://wiki.php.net/rfc/enum)
* [Request for Comments: Enum](https://wiki.php.net/rfc/enum?rev=1365505707)
* [Request for Comments: Enum (Previous Version)](https://wiki.php.net/rfc/enum?rev=1302087566)
* https://externals.io/message/52834
* https://externals.io/message/57928
* https://externals.io/message/88293

### Other Resources

* [Martin Fowler - Value Object](https://martinfowler.com/bliki/ValueObject.html)