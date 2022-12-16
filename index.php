<?php


class Animal
{
  protected $type;
  protected $name;
  protected $hair_color;

  public function __construct($type, $name, $hair_color)
  {
    $this->type = $type;
    $this->name = $name;
    $this->hair_color = $hair_color;
    //建構式內容
  }

  public function run()
  {
    echo "這隻名叫 {$this->name} 毛色是 {$this->hair_color} 的 {$this->type} 跑走了! ";
    $this->speed();
    //公開行為內容
  }

  private function speed()
  {
    echo "<br>";
    echo "跑超級快!!";
    //私有行為內容
  }
}

$dog = new Animal('dog', 'John', "brown");
$dog->run();