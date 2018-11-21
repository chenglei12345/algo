<?php
namespace Algo_09;

use Algo_06\SingleLinkedListNode;

require_once "../vendor/autoload.php";
/**
 * 数组实现的队列
 */
class ArrayQueue{
  // 头下标
  private $first;
  // 尾下标
  private $end;
  // 列表
  private $array;
  // 长度
  private $length;
  // 声明的长度
  private $n;
  public function __construct($n=0){
    $this->array = [];
    $this->length = 0;
    $this->n = $n;
    $this->first = 0;
    $this->end = 0;
  }

  /**
   * 入队列
   */
  public function enqueue($data){
    if($this->length >= $this->n) $this->multiCreate();
    $this->array[$this->end] = $data;
    $this->end ++;
    $this->length ++;
    return true;
  } 

  /**
   * 出队列
   */
  public function dequeue(){
    if($this->length == 0) return false;
    unset($this->array[$this->first]);
    $this->first ++;
    $this->length --;
    return true;
  }
  /**
   * 扩增队列
   */
  public function multiCreate(){
    $newArray = array();
    $i = 0;
    $first = $this->first;
    $length = $this->length;
    while ($length > 0) {
      $newArray[$i] = $this->array[$first];
      $i ++;
      $first ++;
      $length --;
    }
    $this->array = $newArray; 
    $this->n *= 2;
    return true;
  }
}

/**
 * 链式队列
 */
class linkQueue{
  // 头指针
  private $head;
  // 尾指针
  private $tail;
  private $length;

  public function __construct(){
    $this->head = new SingleLinkedListNode();
    $this->tail = $this->head;
    $this->length = 0;
  }

  /**
   * 入队列
   */
  public function enqueue($data){
    $node = new SingleLinkedListNode($data);
    $this->tail->next = $node;
    // 尾指针后移
    $this->tail = $this->tail->next;
    $this->length ++;
    return true;
  }

  /**
   * 出队列
   */
  public function dequeue(){
    $this->head->next = $this->head->next->next;
    // 头指针后移动
    $this->head = $this->head->next;
    $thia->length --;
    return true;
  }
}


/**
 * 测试数组队列
 */

$testArrayQueue = new ArrayQueue(5);
$testArrayQueue->enqueue(1);
$testArrayQueue->enqueue(2);
$testArrayQueue->enqueue(3);
$testArrayQueue->enqueue(4);
$testArrayQueue->enqueue(5);
$testArrayQueue->enqueue(6);

// var_dump($testArrayQueue);

/**
 * 测试 链式队列
 */

$testLinkQueue = new linkQueue;
$testLinkQueue->enqueue(1);
$testLinkQueue->enqueue(2);
$testLinkQueue->enqueue(3);
var_dump($testLinkQueue);