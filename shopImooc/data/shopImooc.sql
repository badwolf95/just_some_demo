create DATABASE IF NOT EXISTS shopImooc;
USE shopImooc;
-- 管理员表
DROP TABLE IF EXISTS imooc_admin;
CREATE TABLE imooc_admin(
id tinyint unsigned auto_increment key,
username varchar(20) not null unique,
password char(30) not null,
email varchar(50) not null
);

-- 商品分类表
DROP TABLE IF EXISTS imooc_cate;
CREATE TABLE imooc_cate(
id smallint unsigned auto_increment key,
cName varchar(50) unique
);

-- 商品表
DROP TABLE IF EXISTS imooc_pro;
CREATE TABLE imooc_pro(
id int unsigned auto_increment key,
pName varchar(50) not null unique,
pSn varchar(50) not null,
pNum int unsigned default 1,
iPrice decimal(10,2) not null,
mPrice decimal(10,2) not null,
pDesc text,
pImg varchar(50) not null,
pubTime int unsigned not null,
isShow tinyint(1) default 1,
isHot tinyint(1) default 0,
cId smallint unsigned not null
);

-- 用户表
DROP TABLE IF EXISTS imooc_user;
CREATE TABLE imooc_user(
id int unsigned auto_increment key,
username varchar(20) not null unique,
password char(32) not null,
sex enum("��","Ů","����") not null default "����",
face varchar(50) not null,
regTime int unsigned not null
);

-- 相册表
DROP TABLE IF EXISTS imooc_album;
CREATE TABLE imooc_album(
id int unsigned auto_increment key,
pid int unsigned not null,
albumPath varchar(50) not null
);







