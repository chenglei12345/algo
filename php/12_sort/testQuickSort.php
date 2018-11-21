<?php
/**
 * 测试快速排序
 * p到r之间的一组数据，选择p到r之间的任意一个数据作为pivot（分区点，一般情况选择最后一个元素）
 * 遍历p到r之间的数据，小于pivot的放左边，大于的放右边，pivot放在中间（中间点记为q）
 * 这一步骤后p到r分成3块，p到q < q < q+1到r
 * 分区继续递推，直到区间为1
 */

function quickSort(array &$arr){
  $n = count($arr);
  $l = 0;
  // 排序
  quickSortInternally($arr,$l,$n-1);
}

function quickSortInternally(array &$arr,$l,$r){
  if($l >= $r){
    return;
  }
  // 寻找中间点
  $q = partition($arr, $l, $r);
  quickSortInternally($arr, $l, $q-1);
  quickSortInternally($arr, $q+1, $r);
}

/**
 * 寻找分区点
 * 数组分为已排序区，和未排序区，每次从未排序区拿一个元素和分区点的元素比较
 * 如果该元素比分区点的元素小，交换这个元素和未排序区当前的位置
 */
function partition(array &$arr,$l,$r){
  // 设置最后数组最后一个为分区点
  $pivot = $arr[$r];
  // 已排序区移动标记
  $i = $l;
  // 未排序区移动标记
  $j = $l;

  while ($j<$r) {
    if($arr[$j] < $pivot){
      list($arr[$i],$arr[$j]) = [$arr[$j],$arr[$i]];
      // 已排序标记移动
      $i++;
    }
    $j++;
  }
  // 最后将 分区点元素 放在中间位置
  list($arr[$i],$arr[$r]) = [$arr[$r],$arr[$i]];

  return $i;
}

function getN(array $arr,$number){
  $n = count($arr);
  $l = 0;
  // 找第n个元素
  return quickSortN($arr,$l,$n-1,$number);
}
/**
 * 寻找数组的第n大的元素
 */

function quickSortN(array &$arr,$l,$r,$number){
  if($number <= $l || $number > $r+1){
    echo '已超出范围';
    return;
  }
  // 寻找中间点(注意是下标)
  $q = partition($arr, $l, $r);
  if($q + 1 < $number){
    $bigN = quickSortN($arr, $q+1, $r , $number);
  }else if($q + 1 == $number){
    $bigN = $arr[$q];
  }else{
    $bigN = quickSortN($arr, $l, $q-1 , $number);
  }
  if($bigN) return $bigN;
}

// 测试快速排序
$arr = [5, -1, 9, 3, 7, 8, 3, -2, 9];
quickSort($arr);
var_dump($arr);

// 测试找第 K 大元素
$arr = [6,2,1,4,7,5];
$getN = getN($arr,2);
var_dump($getN);

