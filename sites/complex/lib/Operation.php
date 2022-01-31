<?php

namespace complex;

class Operation
{
    /**
     * @param mixed ...$complexValue
     * @return Complex
     * @throws \Exception
     */
    public static function add(...$complexValues) : Complex
    {
        if(count($complexValues) < 2)
            throw new \Exception('Необходимо как минимум 2 аргумента');

        $startComplexValue = array_shift($complexValues);
        $result = clone Complex::validateComplex($startComplexValue);

        foreach ($complexValues as $complexValue){

            $complexValue = Complex::validateComplex($complexValue);

            if($complexValue->suffixI !== $result->suffixI)
                throw new \Exception('Суффикс отсутствует');


            $real = $result->realPart + $complexValue->realPart;
            $imaginary = $result->imaginaryPart + $complexValue->imaginaryPart;

            $result = new Complex(
                $real,
                $imaginary,
                $result->suffixI
            );
        }
        return $result;
    }

    public static function sub(...$complexValues) : Complex
    {
        if(count($complexValues) < 2)
            throw new \Exception('Необходимо как минимум 2 аргумента');

        $startComplexValue = array_shift($complexValues);
        $result = clone Complex::validateComplex($startComplexValue);

        foreach ($complexValues as $complexValue){

            $complexValue = Complex::validateComplex($complexValue);

            if($complexValue->suffixI !== $result->suffixI)
                throw new \Exception('Суффикс отсутствует');


            $real = $result->realPart - $complexValue->realPart;
            $imaginary = $result->imaginaryPart - $complexValue->imaginaryPart;

            $result = new Complex(
                $real,
                $imaginary,
                $result->suffixI
            );
        }
        return $result;
    }

    public static function div(...$complexValues) : Complex
    {
        if(count($complexValues) < 2)
            throw new \Exception('Необходимо как минимум 2 аргумента');

        $startComplexValue = array_shift($complexValues);
        $result = clone Complex::validateComplex($startComplexValue);

        foreach ($complexValues as $complexValue){

            $complexValue = Complex::validateComplex($complexValue);

            if($complexValue->suffixI !== $result->suffixI)
                throw new \Exception('Суффикс отсутствует');

            if($complexValue->realPart == 0.0 || $complexValue->realPart == 0.0)
                throw new \Exception('Делить на ноль нельзя');

            //Перемножение многочленов и приведение общего знаменателя по фсу

            $numerator1 = $result->realPart * $complexValue->realPart +
                $result->imaginaryPart * $complexValue->imaginaryPart;

            $numerator2 = $result->imaginaryPart * $complexValue->realPart -
                $result->realPart * $complexValue->imaginaryPart;

            $denominator = ($complexValue->realPart * $complexValue->realPart) +
                ($complexValue->imaginaryPart * $complexValue->imaginaryPart);


            $real = $numerator1 / $denominator;
            $imaginary = $numerator2 / $denominator;


            $result = new Complex(
                $real,
                $imaginary,
                $result->suffixI
            );
        }
        return $result;
    }

    public static function mul(...$complexValues) : Complex
    {
        if(count($complexValues) < 2)
            throw new \Exception('Необходимо как минимум 2 аргумента');

        $startComplexValue = array_shift($complexValues);
        $result = clone Complex::validateComplex($startComplexValue);

        foreach ($complexValues as $complexValue){

            $complexValue = Complex::validateComplex($complexValue);

            if($complexValue->suffixI !== $result->suffixI)
                throw new \Exception('Суффикс отсутствует');

            //Перемножение многочленов
            $real = $result->realPart * $complexValue->realPart -
                $result->imaginaryPart * $complexValue->imaginaryPart;
            $imaginary = $result->realPart * $complexValue->imaginaryPart +
                $result->imaginaryPart * $complexValue->realPart ;


            $result = new Complex(
                $real,
                $imaginary,
                $result->suffixI
            );
        }
        return $result;
    }
}