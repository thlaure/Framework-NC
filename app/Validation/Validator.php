<?php

namespace App\Validation;

class Validator
{
    private array $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray) {
            if (array_key_exists($name, $this->data)) {
                $nbRules = count($rulesArray);
                for ($i = 0; $i < $nbRules; ++$i) {
                    switch ($rulesArray[$i]) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rulesArray[$i], 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rulesArray[$i]);
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return $this->getErrors();
    }

    private function required(string $name, string $value)
    {
        $value = trim($value);
        if (!isset($value) || $value === null || empty($value)) {
            $this->errors[$name][] = "{$name} est requis";
        }
    }

    private function min(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];
        if (strlen($value) < $limit) {
            $this->errors[$name][] = "{$name} doit comprendre un minimum de {$limit} caractères";
        }
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }
}