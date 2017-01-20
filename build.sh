#!/bin/bash
DIR=`dirname $(readlink -f $0)`
OUT_DIR='./output/app/wx'
OUT_CONF='./output/conf/wx'
cd ${DIR}

rm -rf ${OUT_DIR}
rm -rf ${OUT_CONF}
mkdir -p ${OUT_DIR}
mkdir -p ${OUT_CONF}
cp -r ./actions ${OUT_DIR}
cp -r ./controllers ${OUT_DIR}
cp -r ./Bootstrap.php ${OUT_DIR}
cp -r ./models ${OUT_DIR}
cp -r ./conf/* ${OUT_CONF}

tar -czvf wx.tar.gz ./output/*
