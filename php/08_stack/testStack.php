<?php

namespace Algo_08;
use Algo_06\SingleLinkedListNode;
// 自动加载类
require_once "../vendor/autoload.php";
/**
 * 链式栈
 */
class StackOnLinkedList{
  public $head;

  public $length;

  public function __construct(){
    $this->head = new SingleLinkedListNode;
    $this->length = 0;
  }

  /**
   * 出栈
   */
  public function pop(){
    if(is_null($this->head->next)) return false;
    $this->head->next = $this->head->next->next;
    $this->length --;
    return true;
  }

  /**
   * 入栈
   */
  
  public function push($data){
    return $this->pushData($data);
  }

  /**
   * 入栈 data
   */
  public function pushData($data){
    $node = new SingleLinkedListNode($data);
    return $this->pushNode($node);
  }

  /**
   * 入栈 $node
   */
  public function pushNode($node){
    if(is_null($node)) return false;
    $node->next = $this->head->next;
    $this->head->next = $node;
    $this->length ++;
    return $node;
  }

  /**
   * 获取栈顶元素
   */
  public function top(){
    if(is_null($this->head->next)) return false;
    return $this->head->next;
  }
}

/**
 * 顺序栈
 */
class arrayStack{
  // 数组
  private $array;
  // 元素个数
  private $count;
  // 大小
  private $n;

  public function __construct($n=0){
    $this->n = $n;
    $this->count = 0;
    $this->array = [];
  }

  /**
   * 入栈 
   */
  public function push($data){
    if($this->count == $this->n) $this->multiCreate();
    $this->array[$this->count] = $data;
    $this->count++;
  }

  /**
   * 出栈 
   */
  public function pop(){
    if($this->count == 0) return false;
    array_pop($this->array);
    $this->count --;
    return true;
  }

  /**
   * 扩充栈 
   */
  public function multiCreate(){
    $newArray = array();
    $i = 0;
    $count = $this->count;
    while ($count > 0) {
      $newArray[$i] = $this->array[$i];
      $i++;
      $count --;
    }
    $this->array = $newArray;
    $this->count = $this->count;
    $this->n = $this->count * 2;
    return true;
  }
}
/**
 * 测试数组栈
 */
$testArrayStack = new arrayStack(5);
$testArrayStack->push(1);
$testArrayStack->push(2);
$testArrayStack->push(3);
$testArrayStack->push(4);
$testArrayStack->push(5);
$testArrayStack->push(6);
var_dump($testArrayStack);
$testArrayStack->pop();
var_dump($testArrayStack);

/**
 * 测试链表栈
 */
