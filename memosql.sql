create table verse (
   num int not null auto_increment,
   name  char(10) not null,
   content text not null,
   regist_day char(20),
   primary key(num)
);
