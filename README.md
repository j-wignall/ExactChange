Exact-change Calculator
=======================

Introduction
------------
This is a demonstration program that, when given a monetary amount, will
calculate the minimum number of coins needed to make that amount.

The input accepts GBP Sterling including £2, £1, 50p, 20p, 10p, 5p, 2p and 1p coins.

* Examples of valid inputs include: 432, 213p, £16.23p, £14, £54.04, £23.33333, 001.41p.
* Examples of invalid inputs include : 13x, 13p.02, £p, -30p, -50, twentytwop.

This application is built using the Zend Skeleton Application, which is included in this repository.


Requirements
------------

    * ZfcBase - (latest master)


Main Setup
----------

    1. Download & setup Composer from https://getcomposer.org
    2. Download the ExactChange application into your web root folder.
    3. Run `php composer.phar install` from the project root - this will download and install the required dependencies.


Post installation
-----------------

    1. Navigate your browser to <your-server>/ExactChange/


Notes (TODO's)
-----

   1. Incomplete items includes a View Helper (exactChangeWidget) which can be used from any view script in the application: <?php echo $this->exactChangeWidget(); ?>
   
   2. Time restrictions meant that the following could not be accomplished:
      * Custom HTML5 / CSS / SASS
      * Use JS to prevent the page from reloading e.g. AJAX, SPA.
      * JS form validation
      * Advanced (foolproof) form validation
      * Additional test cases
   
   These items and more will be coming soon!
