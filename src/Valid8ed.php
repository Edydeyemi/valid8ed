<?php
declare(strict_types=1);

namespace Edydeyemi;

class Valid8ed
{

    public ?string $errors = null;
    private string $field;
    private string $value;
    public array $bucket = [];

    public function storeValues(): void
    {
        $this->bucket[] = [$this->field => $this->value];
    }

    /**
     * dumpValue
     *
     * @return array
     */
    public function dumpValue(): array
    {
        return $this->bucket;
    }

    /**
     * setField
     *
     * @param string $field Name of form field
     * @param string|int $value Value of form field
     * @return object
     */
    public function setField(string $field, string|int $value): object
    {
        $this->field = trim(strtolower($field));
        $this->value = trim($value);
        return $this;
    }

    /**
     * STRING VALIDATION
     *
     * Validates if the value is empty.
     *
     * @return $this Instance of the class for method chaining
     */
    public function required(): self
    {
        // If the value is empty, store the error message
        if (empty($this->value)) {
            $this->errors = $this->field . "_error";
        }

        // Store the value in the bucket
        $this->storeValues();

        // Return the instance of the class for method chaining
        return $this;
    }


    /**
     * Email Validation
     *
     * Validates if the value is a valid email address.
     *
     * @return $this Instance of the class for method chaining
     */
    public function isEmail()
    {

        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }
    
    /**
     * URL Validation
     *
     * Validates if the value is a valid URL.
     *
     * @return $this Instance of the class for method chaining
     */

    public function isUrl()
    {

        if (!filter_var($this->value, FILTER_VALIDATE_URL)) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function inArray(array $array): self
    {
        if (array_key_exists($this->value, array_flip($array))) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function equals($control)
    {
        if ($this->value !== $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    /**
     * NUMERIC VALIDATION
     */
    public function min(int|float $control)
    {
        if ($this->value < $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function max(int|float $control)
    {
        if ($this->value > $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function isNumeric()
    {
        if (!is_numeric($this->value)) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function isFloat()
    {
        if (!is_float($this->value)) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    /**
     * DATE VALIDATION
     */
    public function isDate($format = 'Y-m-d')
    {
        $date = \DateTime::createFromFormat($format, $this->value);
        if (!$date) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    function isToday($format = 'Y-m-d')
    {
        $today = \DateTime::createFromFormat($format, date($format, time()));
        $date = \DateTime::createFromFormat($format, $this->value);

        if ($date != $today) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function beforeToday($format = 'Y-m-d')
    {
        $today = \DateTime::createFromFormat($format, date($format, time()));
        $date = \DateTime::createFromFormat($format, $this->value);

        if ($date >= $today) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function afterToday($format = 'Y-m-d')
    {
        $today = \DateTime::createFromFormat($format, date($format, time()));
        $date = \DateTime::createFromFormat($format, $this->value);

        if ($date <= $today) {

            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function beforeTomorrow($format = 'Y-m-d')
    {
        $today = \DateTime::createFromFormat($format, date($format, time()));
        $date = \DateTime::createFromFormat($format, $this->value);

        if ($date > $today) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function afterYesterday($format = 'Y-m-d')
    {
        $today = \DateTime::createFromFormat($format, date($format, time()));
        $date = \DateTime::createFromFormat($format, $this->value);

        if ($date < $today) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function dateNotBefore($control)
    {
        $this->value = strtotime($this->value);
        $control = strtotime($control);
        if ($this->value < $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function dateNotAfter($control)
    {

        $this->value = strtotime($this->value);
        $control = strtotime($control);
        if ($this->value > $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }


    /**
     * GENERIC VALIDATION
     */
    public function NotGreaterThan($control)
    {

        if ($this->value > $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }

    public function NotLesserThan($control)
    {
        if ($this->value < $control) {
            $this->errors = $this->field . "_error";
        }
        $this->storeValues();
        return $this;
    }
}

