<?php

// 靜態 static 的用法
echo CarTeacher::$type;

// 原本的寫法
$car = new CarTeacher ;
// 呼叫function 依然可以用 
echo $car -> speed();

class CarTeacher
{
  public static $type = '裕隆';

  public static function speed(){
    return 60;
  }

}
