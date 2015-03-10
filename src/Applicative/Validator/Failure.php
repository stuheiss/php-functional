<?php
namespace Applicative\Validator;

use Applicative\ApplicativeInterface;
use Common\CreateTrait;
use Functor\MapTrait;

class Failure implements ApplicativeInterface
{
    use CreateTrait;
    use MapTrait;

    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function ap(ApplicativeInterface $applicative)
    {
        if ($applicative instanceof Failure) {
            return $applicative->map(function($v) {
                return array_merge($this->value, $v);
            });
        } else {
            return $this;
        }
    }
}