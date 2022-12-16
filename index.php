<?php


class Animal
{
  // 先放值進去 當預設值 
  protected $type = 'animal';
  protected $name = 'John';
  protected $hair_color = 'brown';

  public function __construct($type, $name, $hair_color)
  {
    $this->type = $type;
    $this->name = $name;
    $this->hair_color = $hair_color;
    //建構式內容
  }

  public function getType()
  {
    echo "<br>";
    return "{$this->type}";

    //公開行為內容
  }

  public function getName()
  {
    echo "<br>";
    return "{$this->name}";
    //公開行為內容
  }

  public function getColor()
  {
    echo "<br>";
    return "{$this->hair_color}";
    //公開行為內容
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
    echo "<br>";

    //私有行為內容
  }
}

$dog = new Animal('dog', '小汪', "白色");
$cat = new Animal('cat', '小咪', "虎斑");
$dog->run();
$cat->run();

echo "種類是".$dog->getType();
echo "種類是".$cat->getType();
echo "名字是".$dog->getName();
echo "名字是".$cat->getName();
echo "毛色是".$dog->getColor();
echo "毛色是".$cat->getColor();