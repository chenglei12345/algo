<?php 
namespace Algo_06;

/**
 * 定义链表节点
 */
class SingleNode{
  public $data;
  public $next;

  public function __construct($data = null){
    // 定义节点数据
    $this->data = $data;
    // 定义节点下一个指针
    $this->next = null;
  }
}

/**
 * 定义单链表
 */
class SingleLinkedList{
  // 头节点
  public $head;
  // 长度
  private $length;

  public function __construct($head = null){
    // 链表初始化 设置一个头节点 一个初始长度
    $this->head = is_null($head)?new SingleNode():$head;
    $this->length = 0;
  }

  // 获取链表长度
  public function getLength(){
    return $this->length;
  }

  // 插入数据 采用头插法 插入新数据
  // 头插发：每次都插入到哨兵节点后
  public function insert($data){
    return $this->insertAfterOrigin($this->head,$data);
  }

  // 尾插法：每次都插入到链表的尾部
  public function insertAfterEnd($data){
    // 找到尾部节点
    $lastNode = $this->getLastNode();
    return $this->insertAfterOrigin($lastNode,$data);
  }

  // 删除节点
  public function delete($node){
    if($node == null) return false;
    // 要删除一个节点步骤
    // 1找到这个节点的前置节点 
    $preNode = $this->getPreNode($node);
    // 2改变前置节点的next指向
    $preNode->next = $node->next;
    // 3unset去掉的节点
    unset($node);

    $this->length --;
    return true;
  }

  // 输出单链表 当data的数据为可输出类型
  public function printList(){
    // 至少有一个节点
    if(is_null($this->head->next)) return false;
    $nowNode = $this->head;
    $i = 0;
    // 按顺序循环遍历节点
    while (!is_null($nowNode->next) && $i < $this->getLength()) {
      $i++;
      echo $nowNode->next->data.'->';
      $nowNode = $nowNode->next;
    }
    echo 'NULL' . PHP_EOL;
    return true;
  }

  // 根据值获取对应的节点
  public function getNodeByData($data){
    if(empty($data)) return false;
    $i = 0;
    $nowNode = $this->head;
    while ($i < $this->getLength() && $nowNode->data != $data) {
      $i ++;
      $nowNode = $nowNode->next;
    }
    return $nowNode->data == $data ? $nowNode : false;
  }

  // 获取节点的前置节点（如果是哨兵节点 返回哨兵节点）
  public function getPreNode(SingleNode $node){
    if($node == null) return false;
    // 初始 头节点
    $head = $this->head;
    // 初始 前置节点
    $preNode = $this->head;
    // 循环 从头节点开始下后循环比较
    // 比较两个节点是否完全一致 使用 全等于 ===
    while ($head !== $node && $head != null) {
      $preNode = $head;
      $head = $head->next;
    }
    return $preNode;
  }

  // 通过索引获取节点
  public function getIndexNode(int $index){
    if($index > $this->getLength()) return false;
    $now = $this->head;
    for($i=1;$i<=$this->getLength();$i++){
      $now = $now->next;
      if($i == $index) break;
    }
    return $now;
  }

 
  // 在某个节点后插入新的节点 (直接插入数据)
  public function insertAfterOrigin($origin,$data){
    if(is_null($origin)) return false;
    $newNode = new SingleNode($data);
    $newNode->next = $origin->next;
    $origin->next = $newNode;
    $this->length ++ ;
    return true;
  }

  // 在某个节点前插入新的节点（很少使用）
  public function insertBeforeOrigin($origin,$data){
    if(is_null($origin)) return false;
    $preNode = $this->getPreNode($origin);
    $newNode = new SingleNode($data);
    $newNode->next = $origin;
    $preNode->next = $newNode;
    $this->length ++;
    return true;
  }

  // 在某个节点后插入新的节点
  public function inserNodeAfterOrigin($origin,$node){
    if(is_null($origin) || is_null($node)) return false;
    $originNext = $origin->next;
    $origin->next = $node;
    $node->next = $originNext;
    $this->length ++;
    return true;
  }

  // 获取尾部节点
  public function getLastNode(){
    if($this->getLength() == 0) return false;
    $i = 0;
    $nowNode = $this->head;
    while ($i < $this->getLength() && !is_null($nowNode->next)) {
      $nowNode = $nowNode->next;
    }
    return $nowNode;
  }

  /**
   * 获取中间节点
   */
  public function getMiddleNode(){
    // 至少要有两个节点
    if(is_null($this->head) || is_null($this->head->next)) return false;
    $fNode = $this->head->next;
    $sNode = $this->head->next;
    $return['isSingle'] = true;
    while (!is_null($sNode->next->next)) {
      $fNode = $fNode->next;
      $sNode = $sNode->next->next;
    }
    // 判断当前链表长度是基数还是偶数
    if(!is_null($sNode->next)){
      // 长度为偶数
      $return['isSingle'] = false;
    }
    $return['middleNode'] = $fNode;
    return $return;
  }

  /**
   * LRU算法（least recently used）
   * 1. 如果此数据之前已经被缓存在链表中了，我们遍历得到这个数据对应的结点，并将其从原来的位置删除，然后再插入到链表的头部。
   * 2. 如果此数据没有在缓存链表中，又可以分为两种情况：
   *    * 如果此时缓存未满，则将此结点直接插入到链表的头部；
   *    * 如果此时缓存已满，则链表尾结点删除，将新的数据结点插入链表的头部。
   */
  public function lru($data,$length = 3){
    if($this->getLength() == 0){
      $this->insert(new SingleNode($data));
    }
    $nowNode = $this->getNodeByData($data);
    if($nowNode){
      // 在链表中
      $this->delete($nowNode);
    }else{
      // 缓存满 删除尾节点
      if($this->getLength() >= $length) $this->delete($this->getLastNode());
    }
    // 将此节点插入到链表的头部
    $newNode = new SingleNode($data);
    return $this->inserNodeAfterOrigin($this->head,$newNode);
  }

  /**
   * 检测外部字符串是否是回文字符串
   */
  public function checkPalindrome(){
    $middleDetail = $this->getMiddleNode();
    if(!$middleDetail) return false;
    $middleNode = $middleDetail['middleNode'];
    // 判断是基数长度还是偶数长度 确认左边开始节点
    $leftNode = $middleDetail['isSingle'] == true ? $this->getPreNode($middleNode) : $middleNode;
    $rightNode = $middleNode->next;
    // 比较中间节点 左边 右边 是否一致
    while (!is_null($rightNode->next) && !is_null($leftNode->data)) {
      if($leftNode->data != $rightNode->data) return false;
      $leftNode = $this->getPreNode($leftNode);
      $rightNode = $rightNode->next;
    }
    // 右边没到底 左边没到头
    if(!is_null($rightNode->next) || $this->head->next !== $leftNode ) return false;
    return true;
  }

  /**
   * reverse 单链表反转
   *
   * preNode 变化
   * 1->null
   * 2->1->null
   * 3->2->1->null
   * 4->3->2->1->null
   * head->4->3->2->1->null
   * 
   */                   
  public function reverse(){
    if(is_null($this) || is_null($this->head) || is_null($this->head->next)) return false;
    // 反转后的链表
    $preNode = null;
    // 当前的链表
    $curNode = $this->head->next;
    // 记录剩下的链表 
    $remainNode = null;

    $this->head->next = null;

    while (!is_null($curNode)) {
      $remainNode = $curNode->next;
      // 取出当前链表的第一 node
      $curNode->next = $preNode;
      // 拼接反转后的链表
      $preNode = $curNode;
      $curNode = $remainNode;
    }
    // 拼接头节点
    $this->head->next = $preNode;

    print_r($this);
  }

  /**
   * checkCircle 链表中环的检测
   */
  public function checkCircle(){
    if(is_null($this) || is_null($this->head) || is_null($this->head->next)) return false;
    $fast = $this->head->next;
    $slow = $this->head->next;
    while (!is_null($fast) && !is_null($slow)) {
      $fast = $fast->next->next;
      $slow = $slow->next;
      if($fast === $solow){
        return true;
      }
    }
    return false;
  }

  /**
   * mergerSortedList 两个有序的链表合并
   * $listA 1-2-4-5-7
   * $listB 3-4-5-6-7-8
   *
   * $newRootRode 新的合并和的链表 指针每次向后移一个
   */
  public function mergerSortedList(SingleLinkedList $listA,SingleLinkedList $listB){
    if(is_null($listA)) return $listB;
    if(is_null($listB)) return $listA;
    $newList = new SingleLinkedList;
    $flistA = $listA->head->next;
    $flistB = $listB->head->next;
    $newHead = $newList->head;
    $newRootNode = $newHead;
    while (!is_null($flistA->next) && !is_null($flistB->next)) {
      if($flistA->data <= $flistB->data){
        $newRootNode->next = $flistA;
        $flistA = $flistA->next;
      }else{
        $newRootNode->next = $flistB;
        $flistB = $flistB->next;
      }
      // 指针每次向后移一个
      $newRootNode = $newRootNode->next;
    }
    // 如果第一个链表未处理完，拼接到新链表后面
    if ($pListA != null) {
      $newRootNode->next = $pListA;
    }
    // 如果第二个链表未处理完，拼接到新链表后面
    if ($pListB != null) {
      $newRootNode->next = $pListB;
    }
    return $newList;
  }

  /**
   * deleteLastKth 删除链表倒数第n个结点
   * 典型的利用双指针法解题。
   * 首先让指针first指向头节点，然后让其向后移动n步，接着让指针sec指向头结点，并和first一起向后移动。
   * 当first的next指针为NULL时，sec即指向了要删除节点的前一个节点，接着让second指向的next指针指向要删除节点的下一个节点即可。
   * 注意如果要删除的节点是首节点，那么first向后移动结束时会为NULL，这样加一个判断其是否为NULL的条件，若为NULL则返回头结点的next指针。
   */
  
  public function deleteLastKth($index){
    if(is_null($this) || is_null($this->head) || is_null($this->head->next)) return false;
    $first  = $this->head;
    $second  = $this->head;
    $i = 0;

    while ($i < $index) {
      $first = $first->next;
      $i++;
    }

    while (!is_null($first->next)) {
      $first = $first->next;
      $second = $second->next;
    }
    
    $second->next = $second->next->next;

    $this->length --;
    return true;
  } 
}



/**
 * 测试用例
 */

// 头节点插入
$newLinkedList = new SingleLinkedList();
$newLinkedList->insert(1);
$newLinkedList->insert(2);
$newLinkedList->insert(3);
print_r($newLinkedList);

// 通过索引获取节点
// print_r($newLinkedList->getIndexNode(2));

// 删除
// var_dump($newLinkedList->delete($newLinkedList->head->next));
// print_r($newLinkedList);

// 输出链表
// var_dump($newLinkedList->printList());

// 前置插入
// $newLinkedList->insertBeforeOrigin($newLinkedList->head->next->next,'cc');
// print_r($newLinkedList);

// 后置插入（节点）
// $newLinkedList->inserNodeAfterOrigin($newLinkedList->head->next->next,new SingleNode('aa'));
// print_r($newLinkedList);

// 获取尾部节点
// print_r($newLinkedList->getLastNode());

// 测试LRU
// $lruList = new SingleLinkedList();
// $lruList->lru(1,3);
// $lruList->lru(2,3);
// $lruList->lru(3,3);
// $lruList->lru(2,3);
// $lruList->lru(4,3);
// var_dump($lruList);

// 检测回文字符串
// $data = '1,2,1,2';
// $data = explode(',', $data);
// $newLinkedList = new SingleLinkedList();
// $i = 0;
// while ($i < count($data)) {
//   $newLinkedList->insert($data[$i]);
//   $i++;
// }
// var_dump($newLinkedList->checkPalindrome());


// 测试单链表反转
// $newLinkedList->reverse();

// 测试单链表是否有环
// $data = [1, 2, 3, 4, 5, 6, 7, 8];
// $node0 = new SingleNode($data[0]);
// $node1 = new SingleNode($data[1]);
// $node2 = new SingleNode($data[2]);
// $node3 = new SingleNode($data[3]);
// $node4 = new SingleNode($data[4]);
// $node5 = new SingleNode($data[5]);
// $node6 = new SingleNode($data[6]);
// $node7 = new SingleNode($data[7]);

// $circle = new SingleLinkedList;
// $circle->inserNodeAfterOrigin($circle->head, $node0);
// $circle->inserNodeAfterOrigin($node0, $node1);
// $circle->inserNodeAfterOrigin($node1, $node2);
// $circle->inserNodeAfterOrigin($node2, $node3);
// $circle->inserNodeAfterOrigin($node3, $node4);
// $circle->inserNodeAfterOrigin($node4, $node5);
// $circle->inserNodeAfterOrigin($node5, $node6);
// $circle->inserNodeAfterOrigin($node6, $node7);

// $node7->next = $node4;
// var_dump($circle->checkCircle());

// 测试删除倒数第n个节点
$newLinkedList->deleteLastKth(4);
var_dump($newLinkedList);die;
