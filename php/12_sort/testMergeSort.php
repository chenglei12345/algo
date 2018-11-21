<?php
/**
 * 归并排序
 * 先把数组从中间分成两份
 * 对前后两部分分别排序
 * 再将排序好的部分合并在一起
 */

function mergeSort(&$arr,$p,$r){
  // 递归终止条件
  if($p >= $r){
    // 当前归并到只有一个元素了 此时 p = 0 ,r = 0,直接返回这个元素即可,return 要是一个数组
    return [$arr[$r]];
  }

  // 找中间元素
  $q = (int)(($p+$r)/2);
  $left = mergeSort($arr,$p,$q);
  $right = mergeSort($arr,$q+1,$r);

  return merge($left,$right);
}

function merge(array $left,array $right){
  // 合并排序
  $tmp = [];
  $i = 0;
  $j = 0;
  $llength = count($left);
  $rlength = count($right);
  while ($i < $llength && $j < $rlength) {
    // 归并排序时稳定的排序
    if($left[$i] <= $right[$j]){
      $tmp[] = $left[$i];
      $i++;
    }else{
      $tmp[] = $right[$j];
      $j++;
    }
  }

  //考虑两边剩余情况，只可能有一边（大的那边）有剩余，将剩余部分放在tmp的末尾
  $start = $i;
  $end = $llength;
  $copyArr = $left;
  if($j < $rlength){
    // 左边空 剩余右边
    $start = $j;
    $end = $rlength;
    $copyArr = $right;
  }
  for (; $start < $end; $start++) { 
    $tmp[] = $copyArr[$start];
  }

  return $tmp;
}


$arr = [11, 8, 3, 9, 7, 1];
$length = count($arr);
$p = 0;
$r = $length - 1;
$result = mergeSort($arr, $p, $r);

var_dump($result);die;

