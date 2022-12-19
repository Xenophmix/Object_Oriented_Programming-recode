<?php
class DB
{
  protected $table;
  protected $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
  protected $pdo;

  public function __construct($table)
  {
    $this->pdo = new PDO($this->dsn, 'root', '');
    $this->table = $table;
  }


  public function all(...$args)
  {
    $sql = "SELECT * FROM $this->table ";

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
    return $this->pdo
      ->query($sql)
      ->fetchAll(PDO::FETCH_ASSOC);
  }


  function find($id)
  {
    $sql = "SELECT * FROM `$this->table` ";

    if (is_array($id)) {
      foreach ($id as $key => $value) {
        $tmp[] = "`$key`='$value'";
      }

      $sql = $sql . " WHERE " . join(" && ", $tmp);
    } else {

      $sql = $sql . " WHERE `id`='$id'";
    }
    //echo $sql;
    $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $data = new stdClass;
    echo "<pre>";

    print_r($row);
    echo "</pre>";
    echo is_array($row);

    // 以下轉變成Object

    foreach ($row as $col => $value) {
      $data->{$col} = $value;
    }
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    echo is_object($data);

    return $data;
  }

  function del($id)
  {
    $sql = "delete FROM `$this->table` ";
    print_r($id);
    if (is_array($id)) {
      foreach ($id as $key => $value) {
        $tmp[] = "`$key`='$value'";
      }

      $sql = $sql . " WHERE " . join(" && ", $tmp);
    } else {

      $sql = $sql . " WHERE `id`='$id'";
    }

    // echo $sql;
    return $this->pdo->exec($sql);
  }

  function save($array)
  {
    if (isset($array['id'])) {
      // 更新update
      $tmp = $this->arrayToSqlArray($array);
      // print_r($tmp);
      // dd($tmp);
      $id = $array['id'];
      unset($array['id']);
      $sql = "update $this->table set ";
      $sql .= join(",", $tmp);
      $sql .= " WHERE `id` = $id ";
      echo $sql;
    } else {
      // 新增insert
      $cols = array_keys($array);

      $sql = "insert into $this->table (`" . join("`,`", $cols) . "`) 
                                       values ('" . join("','", $array) . "')";

      // echo $sql;
      return $this->pdo
        ->exec($sql);
    }
  }

  function count(...$arg)
  {
    $sql = $this->mathSql('count', '*', $arg);
    echo $sql;
    return $this->pdo->query($sql)->fetchColumn();
  }

  function sum($col, ...$arg)
  {
    $sql = $this->mathSql('sum', $col, $arg);

    echo $sql;
    return $this->pdo->query($sql)->fetchColumn();
  }
  function max($col, ...$arg)
  {
    $sql = $this->mathSql('max', $col, $arg);

    echo $sql;
    return $this->pdo->query($sql)->fetchColumn();
  }

  function min($col, ...$arg)
  {
    $sql = $this->mathSql('min', $col, $arg);;

    echo $sql;
    return $this->pdo->query($sql)->fetchColumn();
  }

  function avg($col, ...$arg)
  {
    $sql = $this->mathSql('avg', $col, $arg);

    echo $sql;
    return $this->pdo->query($sql)->fetchColumn();
  }

  private function mathSql($math, $col, ...$arg)
  {
    if (isset($arg[0][0])) {
      $tmp = $this->arrayToSqlArray($arg[0][0]);
      $sql = "SELECT $math($col) FROM $this->table WHERE ";
      $sql .= join(" && ", $tmp);
    } else {

      $sql = "SELECT $math($col) FROM $this->table ";
    }

    return $sql;
  }

  private function arrayToSqlArray($array)
  {
    foreach ($array as $key => $value) {
      $tmp[] = "`$key` = '$value' ";
    }
    return $tmp;
  }
}

function dd($array)
{
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}

//萬用sql函式
function q($sql)
{
  $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
  $pdo = new PDO($dsn, 'root', '');
  //echo $sql;
  return $pdo->query($sql)->fetchAll();
}

//header函式
function to($location)
{
  header("location:$location");
}
