<?php
/**
 * Created by PhpStorm.
 * User: hxp
 * Date: 16/3/23
 * Time: 上午9:42
 */
function autoload_function($class){
    include($class.php);
}
spl_autoload_register($autoload_function);
?>