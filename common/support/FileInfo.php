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
            //�ļ�����1024�ֽ�ʱɾ�������´������ļ���
            if(filesize($this->file)>1024)
            {
                echo "<script>alert('File is more than 1024 bytes and will be deleted soon������')</script>";
                if(unlink($this->file))
                {
                    echo "<script>alert('File has been deleted and system will create a same file but empty soon������')</script>";
                    touch($this->file) or die("Couldn't create ".$this->file);
                }

            }
            //��ȡ�ļ�������ݣ�������д��ʱ�����ǣ�
            $con = file_get_contents($this->file);
            $fo = fopen($this->file,"w") or die("Couldn't open $this->file,sorry!");
            if($fo)
            {
                //��ͬ�ļ�֮ǰ������һ��д�룺
                fwrite($fo,$con."<br>It's just a test by Adam Li on ".date("D d M Y H:i:s",time())) or die("$file isn't writable,sorry!");
                fclose($fo);
            }
        }
        else//����ļ������ڣ�ֱ�Ӵ�����д�����ݣ�
        {
            $this->createfile();
            $this->modifilefile();
        }
        //�����ǻ�ȡ�ļ����ԣ�
        //��ȡ�ļ���С:
        echo "<p>�ļ�".$this->file."��СΪ��<font color=red>".filesize($this->file)." bytes;</font></p>";
        //����Ƿ����ļ���
        echo "<p>$this->file is ".(is_file($this->file)?"":"not ")."a file</p>";
        //����Ƿ���Ŀ¼��
        echo "<p>$this->file is ".(is_dir($this->file)?"":"not ")."a directory</p>";
        //����ļ��Ƿ�ɶ�:
        echo "<p>$this->file is ".(is_readable($this->file)?"":"not ")."readable</p>";
        //����ļ��Ƿ��д��
        echo "<p>$this->file is ".(is_writable($this->file)?"":"not ")."writable</p>";
        //����ļ��Ƿ��ִ�У�
        echo "<p>$this->file is ".(is_executable($this->file)?"":"not ")."executable</p>";
        //ȡ���ļ����ϴη���ʱ��
        echo "<p>$this->file was accessed on ".date("D d M Y H:i:s",fileatime($this->file))."</p>";
        //ȡ���ļ��޸�ʱ��
        echo "<p>$this->file was modified on ".date("D d M Y H:i:s",filemtime($this->file))."</p>";
        //ȡ���ļ��� inode �޸�ʱ��
        echo "<p>$this->file was changed on ".date("D d M Y H:i:s",filectime($this->file))."</p>";
        //��ʾ��ʱ�ļ�����������ݣ�
        echo "<p>�ļ���������ǣ�<font color=red>".file_get_contents($this->file)."</font></p>";
    }
}