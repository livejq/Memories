drop database if exists xuejidb;  -- ���������ɾ�����ݿ�xuejidb
create database xuejidb;          -- �������ݿ�xuejidb
use xuejidb;                      -- ʹ��xuejidb��Ϊ��ǰ���ݿ�
DROP TABLE if exists student ;	 -- ���������ɾ�����ݱ�student 
CREATE TABLE student(   -- �������ݱ�user
	number		VARCHAR(15)	PRIMARY KEY ,
	name		VARCHAR(10)	NOT NULL ,
	sex		VARCHAR(2)	not null DEFAULT '��',
	school		VARCHAR(10)	not null ,
	major		VARCHAR(10)	NOT NULL ,
	class 	 	VARCHAR(10)	NOT NULL
) ;

-- �����ݱ�student�в����¼
INSERT INTO user_infor VALUES ('201505010101','���ɸ�','��','��óѧԺ','��������','����151') ;
INSERT INTO student VALUES ('201504020102','�','Ů','�ֻ�����ѧԺ','�ֻ�����','�ֻ�151') ;
INSERT INTO student VALUES ('201515030103','����','��','��Ϣ��ͨ�Ź���ѧԺ','�������','���151') ;
INSERT INTO student VALUES ('201516010104','����','��','����ѧԺ','����Ӣ��','����151') ;

-- ɾ�����ݱ�student��name='����'�ļ�¼
-- DELETE FROM student WHERE name='����' ;

-- �������ݱ�student��number='201515030103'�ļ�¼��nameֵ
-- UPDATE studentSET name='����'WHERE number='201515030103' ;

-- ��ѯ���ݱ��е����м�¼
-- SELECT * FROM student;

-- ��ѯ������student ���������ļ�¼
-- SELECT * FROM student WHERE name LIKE '%��%';