<?php

namespace complex;

final class Complex
{

    private $realPart = 0.0;
    private $imaginaryPart = 0.0;
    private $suffixI;

    public function __construct(float $realPart, float $imaginaryPart, string $suffixI = 'i')
    {
        $this->imaginaryPart = $imaginaryPart;
        $this->realPart = $realPart;
        $this->suffixI = $suffixI;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public static function validateComplex($complex): Complex
    {
        if (is_scalar($complex) || is_array($complex)) {
            $complex = new Complex($complex);
        } elseif (!is_object($complex)) {
            throw new \Exception('Неккоректное комплексное число');
        }

        return $complex;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        $str = '0.0 + 0.0i';
        if($this->realPart != 0.0){
            $str = $this->realPart;
        }
        if($this->imaginaryPart != 0.0){
            $str .= ($this->imaginaryPart < 0)?
                    $this->imaginaryPart:
                    '+'.$this->imaginaryPart;
        }
        if($this->suffixI != 'i'){
            $str .= $this->suffixI;
        }else
            $str .= $this->suffixI;

        return $str;
    }



    public function toJson()
    {
        return json_encode(
            [
                'realPart' => $this->realPart,
                'imaginaryPart' => $this->imaginaryPart,
                'suffixI' => $this->suffixI,
            ]
        );
    }
}