<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05/12/2016
 * Time: 17:33
 */

namespace st\UserBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class stUserBundle extends Bundle
{
 public function getParent()
 {
     return 'FOSUserBundle';
 }
}

