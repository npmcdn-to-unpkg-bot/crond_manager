#!/bin/bash
LOG_TIME=`date "+%Y-%m-%d %H:%M:%S"`  #取出当前的时间值，赋值给变量LOG_TIME
echo "脚本开始时间："$LOG_TIME    # 打印一下该变量的值

/bin/sleep 5  # 暂停10秒

LOG_TIME=`date "+%Y-%m-%d %H:%M:%S"`
echo "脚本结束时间："$LOG_TIME # 再打印一下该变量的值
