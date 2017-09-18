<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 26/06/17
 * Time: 13:45
 */

namespace AppBundle\Services;


class MonkeyTie
{
    public function big5Result()
    {

        $url = 'http://37.187.181.30/candidat/big5/response';
       return $json = json_decode(file_get_contents($url), true);


    }

}