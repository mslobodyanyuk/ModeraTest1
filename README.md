A task:
=====================

We need to make a web application that implements the following functionality:
Stores category tree. Each category has a name. A category may have a parent category (or it may not be — then the category is considered the top). The number of categories of nesting categories is not limited.
Ability to upload a file with data about the category tree (file format will be provided below). After downloading the file, the current category tree is cleared and replaced with the contents from the file.
Displays the category tree as a list. Initially, only the top categories are shown; when you click on any category, a list of its subcategories opens.

The format of the file with data about categories: json file in which an array of data about categories is stored. Category data is an associative array with 3 fields:

* id - category identifier (number greater than 0);
* name - the name of the category;
* parent_id is the identifier of the parent category (or 0 for the upper category).

###Example json file:

```php
[{“Id”: 1, “name”: “Top category”, “parent_id”: 0}, {“id”: 2, “name”: “Subcategory”, “parent_id”: 1}]
```

Actions on deployment of the project:
====================
1. `git clone << project path >>`

2. `сomposer install`

3. configure domain settings `hosts` file, `httpd.conf`.

4. make a new database - modera_test for example ( utf8_general_ci encoding )

5. database settings in `config/Database.php` file

```php
        $databaseParameters = [
                    'host' => "localhost",
                    'name' => "root",
                    'password' => "",
                    'database' => "modera_test",
                ];
```

* The database dump is located in the `public` folder.


Useful links:
====================
* json_decode

<https://php.ru/manual/function.json-decode.html>

* javaScript, jQuery library version 

<http://www.programmersforum.ru/showthread.php?t=165221>

<https://stackoverflow.com/questions/441412/is-there-a-link-to-the-latest-jquery-library-on-google-apis>

* sorting multidimensional arrays by a specific field

<https://php.ru/forum/threads/sortirovka-mnogomernyx-massivov-po-opredelennomu-polju.9062/>

* for correct generation of `INSERT INTO` sql-query

<https://ruseller.com/lessons.php?id=1769>

<https://www.internet-technologies.ru/articles/obrezanie-strok-s-pomoschyu-funkciy-php.html>

<http://php.net/manual/ru/function.mb-strimwidth.php>

<http://www.php.su/functions/?substr>
