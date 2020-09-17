drop database if exists xuejidb;  -- 如果存在则删除数据库xuejidb
create database xuejidb;          -- 创建数据库xuejidb
use xuejidb;                      -- 使用xuejidb作为当前数据库
DROP TABLE if exists student ;	 -- 如果存在则删除数据表student 
CREATE TABLE student(   -- 创建数据表user
	number		VARCHAR(15)	PRIMARY KEY ,
	name		VARCHAR(10)	NOT NULL ,
	sex		VARCHAR(2)	not null DEFAULT '男',
	school		VARCHAR(10)	not null ,
	major		VARCHAR(10)	NOT NULL ,
	class 	 	VARCHAR(10)	NOT NULL
) ;

-- 在数据表student中插入记录
INSERT INTO user_infor VALUES ('201505010101','王飞哥','男','经贸学院','国际商务','国商151') ;
INSERT INTO student VALUES ('201504020102','李康','女','轮机工程学院','轮机工程','轮机151') ;
INSERT INTO student VALUES ('201515030103','张明','男','信息与通信工程学院','软件技术','软件151') ;
INSERT INTO student VALUES ('201516010104','张想','男','外语学院','商务英语','商务151') ;

-- 删除数据表student中name='张明'的记录
-- DELETE FROM student WHERE name='张明' ;

-- 更新数据表student中number='201515030103'的记录的name值
-- UPDATE studentSET name='叮当'WHERE number='201515030103' ;

-- 查询数据表中的所有记录
-- SELECT * FROM student;

-- 查询出表中student 里面包含李的记录
-- SELECT * FROM student WHERE name LIKE '%李%';