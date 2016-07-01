<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 20:13
 */

namespace app\common\support;


class Fileinfo
{
    public $file;
    function __construct($f)
    {
        $this->file = $f;
    }
    function createfile()
    {
        touch($this->file) or die("Couldn't create $this->file,sorry!");
    }
    function modifilefile()
    {
        $fo = fopen($file,"w") or die("Couldn't open $this->file,sorry!");
        if($fo)
        {
            fwrite($fo,"It's just a test by Adam Li on ".date("D d M Y H:i:s",time())) or die("$this->file isn't writable,sorry!");
            fclose($fo);
        }
    }
    function getfileinfo()
    {
        if(file_exists($this->file))
        {
            //文件大于1024字节时删除并重新创建空文件：
            if(filesize($this->file)>1024)
            {
                echo "<script>alert('File is more than 1024 bytes and will be deleted soon···')</script>";
                if(unlink($this->file))
                {
                    echo "<script>alert('File has been deleted and system will create a same file but empty soon···')</script>";
                    touch($this->file) or die("Couldn't create ".$this->file);
                }

            }
            //获取文件里的内容，避免再写入时被覆盖：
            $con = file_get_contents($this->file);
            $fo = fopen($this->file,"w") or die("Couldn't open $this->file,sorry!");
            if($fo)
            {
                //连同文件之前的内容一起写入：
                fwrite($fo,$con."<br>It's just a test by Adam Li on ".date("D d M Y H:i:s",time())) or die("$file isn't writable,sorry!");
                fclose($fo);
            }
        }
        else//如果文件不存在，直接创建，写入内容：
        {
            $this->createfile();
            $this->modifilefile();
        }
        //以下是获取文件属性：
        //获取文件大小:
        echo "<p>文件".$this->file."大小为：<font color=red>".filesize($this->file)." bytes;</font></p>";
        //检查是否是文件：
        echo "<p>$this->file is ".(is_file($this->file)?"":"not ")."a file</p>";
        //检查是否是目录：
        echo "<p>$this->file is ".(is_dir($this->file)?"":"not ")."a directory</p>";
        //检查文件是否可读:
        echo "<p>$this->file is ".(is_readable($this->file)?"":"not ")."readable</p>";
        //检查文件是否可写：
        echo "<p>$this->file is ".(is_writable($this->file)?"":"not ")."writable</p>";
        //检查文件是否可执行：
        echo "<p>$this->file is ".(is_executable($this->file)?"":"not ")."executable</p>";
        //取得文件的上次访问时间
        echo "<p>$this->file was accessed on ".date("D d M Y H:i:s",fileatime($this->file))."</p>";
        //取得文件修改时间
        echo "<p>$this->file was modified on ".date("D d M Y H:i:s",filemtime($this->file))."</p>";
        //取得文件的 inode 修改时间
        echo "<p>$this->file was changed on ".date("D d M Y H:i:s",filectime($this->file))."</p>";
        //显示此时文件里的所有内容：
        echo "<p>文件里的内容是：<font color=red>".file_get_contents($this->file)."</font></p>";
    }
}