<?php 

/**
 * 冒泡排序
 * @param array $array [<等待排序的数组>]
 *
 * 最外层 循环 count($array) 次
 * 每一次 里面循环 count($array) - $i - 1,因为每一次里面 都会少循环一次，每次会找出一个最大的往后放
 */

function bubbo(&$array){
  $length = count($array);
  // 检测冒泡了几次
  $t = 0;
  for ($i=0; $i < $length; $i++) { 
    $flag = false;
    $t++;
    for ($j = 0; $j < $length-$i-1; $j++) { 
      if($array[$j] > $array[$j+1]){
        // 交换位置
        $tmp = $array[$j];
        $array[$j] = $array[$j+1];
        $array[$j+1] = $tmp;
        $flag = true;
      }
    }
    if(!$flag){
      echo $t;
      break;
    }
  }
}

/**
 * 插入排序
 * 将数组中的数据分为两个区间，已排序区区间和未排序区间
 * 初始已排序区间只有一个元素，数组的第一个元素（注意是头到尾，还是尾到头）
 * 从未排序区间取数据，在已排序区间找合适的位置插入
 * 重复直到未排序区间元素为空，算法结束
 * 
 */

function insert(&$array){
  $length = count($array);
  if($length <= 1) return;
  for ($i=0; $i < $length; $i++) { 
    $data = $array[$i];
    $j = $i - 1;
    for (; $j >= 0 ; $j--) { 
      if ($array[$j] > $data) {
        // 移动数据
        $array[$j+1] = $array[$j];  
      } else {                       
        break;
      }
    }
    // 插入数据
    $array[$j+1] = $data;
  }
}

/**
 * 选择排序
 * 将数组中的数据分为两个区间，已排序区间和未排序区间
 * 初始已排序空间为空
 * 从未排序区间选择最小的放在已排序空间的末尾
 */
function select(&$array){
  $length = count($array);
  if($length <=1 ) return;
  for ($i=0; $i < $length; $i++) { 
    $flag = false;
    $j = $length - $i - 1;
    $least = $i;
    for (; $j > $i ; $j--) { 
      if($array[$least] < $array[$j]){
        continue;
      }else{
        $flag = true;
        $least = $j;
      }
    }
    if(!$flag){
      break;
    }else{
      // 交换
      $temp = $array[$i];
      $array[$i] = $array[$least];
      $array[$least] = $temp;
    }
  }
}




/**
 * 引用传递
 */
$lists = [3,5,4,1,2,6];
select($lists);
var_dump($lists);die;
