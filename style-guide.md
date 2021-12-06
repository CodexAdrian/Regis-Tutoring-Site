# Style Guide
## Files
File names should be all lowercase, words should be separated with dashes

Good:
```
index.php
styles.css
api/get-classes.php
```
Bad:
```
Index.php
newStyles.css
api/get-Classes.php
```
## Keywords
Keywords across all languages should be lowercase

PHP
```PHP
$bool = false; //good
$bool = FALSE; //bad
```
MySQL
```mySQL
select * from table where id = 4; ##good

SELECT * FROM table WHERE id = 4; ##bad
```
# PHP

## Skeleton

### Pure PHP
PHP code should be formatted in the following way:

an opening tag on a new line, by itself,with an empty line following it. Code should be ended with an empty line, a comment marking End of File or EOF and a trailing empty line. There should not be a closing tag

```PHP
<?php

$int 1 = 0; //code

//EOF
 
```

### Embedded PHP


```PHP
<?php

$int = 1; //code

?>
```

## Short Echo Tags

Inside an HTML block, PHP code may be required in order to print a variable or use it in HTML tags.

```PHP
<h1><?php echo $variable; ?></h1>
```

While this is okay, wherever possible, `<?=` should be used over `<?php echo`

```PHP
<h1><?= $variable; ?></h1>
```

It is always preferential to use `<a><?= $name ?></a>` over echoing html code like so

```PHP
<?php

$name = "This is a name";

echo "<a>$name</a>";

//EOF
 
```

## Variables
Variables should all use camelCase, except in the case of constant or static variables, which should use all UPPER_CASE.

Good:
```PHP
define('MESSAGE_OF_THE_DAY', 'Hello world!');
define('RED', 'this is the color red');

$int = 1;
$numerousInts = [1, 2, 3];
```
Bad:
```PHP
define('MESSAGEOFTHEDAY', 'Hello world!');
// Static variable name does not have words separated by commas

define('MessageOfTheDay', 'Hello World!');
// Static variable name is not entirely capitalized

$INT = 3;
// Non-static variable is all capitalized

$new-int = 3;
// Naming does not follow camelCase conventions
```