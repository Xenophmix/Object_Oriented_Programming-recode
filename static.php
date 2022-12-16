<?php

// 靜態 static 的用法
echo Car::$type;

// 原本的寫法
$car = new Car ;
// 呼叫function 依然可以用 
echo $car -> speed();

class Car
{
  public static $type = '裕隆';

  public static function speed(){
    return 60;
  }

}
