create database congresoonline default character set utf8 collate utf8_unicode_ci;
create user admin@localhost identified with mysql_native_password by 'congreso-BD-2020';
grant all on congresoonline.* to admin@localhost;
flush privileges;