<?php
/**
 *引入
 */
include 'db.php';
$dbArr = include 'config.php';

$db = new Db();

$table1 = $db->getTables($dbArr['db1']);
echo $dbArr['db1']['database'].'数据库表总数是'.count($table1['db']).'</br>';

$table2 = $db->getTables($dbArr['db2']);
echo $dbArr['db2']['database'].'数据库表总数是'.count($table2['db']).'</br>';

$arr_diff_table = $db->getDiffArray($table1['db'],$table2['db']);
echo $dbArr['db1']['database'].'和'.$dbArr['db2']['database'].'有'.count($arr_diff_table).'个不同。</br>';
//print_r($table2);

$commonTable = $db->getCommonArray($table1['db'],$table2['db']);

/**
 * 打印格式化
 * @param $arr
 *
 */
function pt($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}?>
<link rel="stylesheet" href="http://apps.bdimg.com/libs/typo.css/2.0/typo.css" type="text/css" media="all" />
<style>
    body{
        padding: 20px;;
    }
</style>
<table border="1">
    <tbody><tr>
        <th width="25%">id</th>
        <th width="75%">相同的表有</th>
    </tr>
    <?php foreach($commonTable as $key=>$value){ ?>
        <tr>
            <td><?=$key+1 ?></td>
            <td><?=$value ?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
<hr>
<table border="1"">
    <tbody><tr>
        <th width="25%">id</th>
        <th width="75%">不同的表</th>
    </tr>
    <?php foreach($arr_diff_table as $key=>$value){ ?>
    <tr>
        <td><?=$key+1 ?></td>
        <td><?=$value ?></td>
    </tr>
    <?php }?>
    </tbody>
</table>
<hr>
<table border="1">
    <tbody><tr>
        <th width="25%">id</th>
        <th width="25%">表名</th>
        <th width="50%">不同的字段</th>

    </tr>
        <?php foreach($commonTable as $key=>$value){ ?>
        <tr>
            <td><?=$key+1 ?></td>
            <td><?=$value ?></td>
            <td>
                <?php
                    $table1Row = $db->getTableRow($dbArr['db1'],$value);
                    $table2Row = $db->getTableRow($dbArr['db2'],$value);
                    if(isset($table1Row['field']) && isset($table2Row['field'])){
                        $tableDiffRow = $db->getDiffArray($table1Row['field'],$table2Row['field']);
                        echo isset($tableDiffRow)?serialize($tableDiffRow):'error';
                    }else{
                        echo '这个需要自己手动对比！';
                    }
                ?>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>