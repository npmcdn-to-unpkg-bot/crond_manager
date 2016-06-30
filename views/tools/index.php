<?php
/**
 * Created by lizt
 * Date: 2016/5/31
 * Time: 15:19
 */
use app\assets\AssetTools;
use app\assets\AssetBootstrap;

AssetTools::register($this);
AssetBootstrap::register($this);

echo 'test';
?>

<script>
    System.import('app').catch(function(err){ console.error(err); });
</script>
<my-app>Loading...</my-app>