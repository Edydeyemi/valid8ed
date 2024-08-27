# valid8ed
A simple-to-use, lightweight PHP Validation Class

Each method requires at least two parameters-
1. The name of the form field
2. The value to be validated

All validation methods can be chained together i.e. $v->setField('product_category', $product_cat_id)->required()->isNumeric()->notGreaterThan(10);
Errors are contained in the $error property.

## Installation

### With Composer

````shell
composer require Edydeyemi/valid8ed
````

//1. Create a new instance of the Class
````shell
$v = new ValidateForm(); //Create a new instance of the class
````

//2. Set a field as required
````shell
$v->setField('product_name', $_POST["product_name"])->required();
````

//3. Check for or output any errors in the validation object
````shell
print_r($v->errors);
````
