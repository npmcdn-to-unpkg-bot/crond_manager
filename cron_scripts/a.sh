#!/bin/bash
#下行队列消费
PHP=/webser/php5/bin/php
LIST=/webser/www/qmyxcg_backend/yii
SHELL=/yunke-to-erp/save-cst-opp
for ((i=0;i<=39;i++))
   do
	nohup $PHP $LIST $SHELL --mod=$i  &
   done
