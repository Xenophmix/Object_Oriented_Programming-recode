<?php

class DB{

  protected $table;
  protected $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
  protected $pdo;

  public function __construct($table)
  {
    $this -> pdo = new PDO($this -> dsn , 'root','');
    $this -> table = $table;

  }

public function all(...$arg){
  $sql = "select * from $this->table";

  if (isset($args[0])) {
    if (is_array($args[0])) {
      //是陣列 ['acc'=>'mack','pw'=>'1234'];
      //是陣列 ['product'=>'PC','price'=>'10000'];

      foreach ($args[0] as $key => $value) {
        $tmp[] = "`$key`='$value'";
      }

      $sql = $sql . " WHERE " . join(" && ", $tmp);
    } else {
      //是字串
      $sql = $sql . $args[0];
    }
  }

  if (isset($args[1])) {
    $sql = $sql . $args[1];
  }

  echo $sql;
  return $this -> pdo 
               -> query($sql) 
               -> fetchAll(PDO::FETCH_ASSOC);

}


function find($id)
{

  $sql = "select * from `$this->table` ";
  if (is_array($id)) {
    foreach ($id as $key => $value) {
      $tmp[] = "`$key`='$value'";
    }

    $sql = $sql . " WHERE " . join(" && ", $tmp);
  } else {

    $sql = $sql . " WHERE `id`='$id'";
  }

  return $this -> pdo
               ->query($sql)
               ->fetch(PDO::FETCH_ASSOC);
}

function update($col, ...$args)
{
  $sql = "UPDATE $this->table SET ";

  if (is_array($col)) {
    foreach ($col as $key => $value) {
      $tmp[] = "`$key`='$value'";
    }

    $sql = $sql . join(",", $tmp);
  } else {
    echo "錯誤，請提供以陣列形式的資料";
  }

  if (isset($args[0])) {

    if (isset($args[0])) {
      if (is_array($args[0])) {
        $tmp = [];
        foreach ($args[0] as $key => $value) {
          $tmp[] = "`$key`='$value'";
        }

        $sql = $sql . " WHERE " . join(" && ", $tmp);
      } else {
        //是字串
        $sql = $sql . " WHERE `id`='{$args[0]}'";
      }
    }
  }


  // echo $sql;
  return $this -> pdo
               ->exec($sql);
}

function insert($cols)
{

  $keys = array_keys($cols);
  //dd(join("','",$cols));

  $sql = "insert into $this->table (`" . join("`,`", $keys) . "`) values ('" . join("','", $cols) . "')";

  // echo $sql;
  return $this -> pdo
               ->exec($sql);
}

function del($id)
{
  global $pdo;
  $sql = "delete from `$this->table` ";

  if (is_array($id)) {
    foreach ($id as $key => $value) {
      $tmp[] = "`$key`='$value'";
    }

    $sql = $sql . " where " . join(" && ", $tmp);
  } else {

    $sql = $sql . " where `id`='$id'";
  }

  // echo $sql;
  return $this -> pdo
               ->exec($sql);
}
}

$db = new DB('students');
$data = $db -> all();

foreach ($data as $row) {
  echo "<br>";
  echo $row['id'] . " " . $row['school_num'] . " " . $row['name'] . " " . $row['birthday'] . " " . $row['uni_id'] . " ";
  // print_r($row);
}


$Someone = $db -> find(30);
echo $Someone['name'];





