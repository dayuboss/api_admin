
create table `admin_app`(
  `id` int(11) unsigned not null  auto_increment,
  `app_id` varchar(50) not null default '' comment '应用id',
  `app_secret` varchar(50) not null default '' comment '应用密钥',
  `app_name` varchar(50) not null default '' comment '应用名称',
  `app_status` tinyint(2) not null default 1 comment '可用状态:1表示开启',
  `app_info` tinytext  comment '应用说明',
  `app_api` text default null comment '当前应用允许请求的全部api接口',
  `api_group` varchar(128) not null default 'default' comment '当前应用所属的应用组唯一标识',
  `api_create_time` int(11) not null default  0,
  `app_api_show` text default  null comment '前台样式要显示的数据格式,json/xml',
  primary key (`id`),
  unique key `app_id`(`app_id`)
)engine = innodb default charset =utf8 comment '应用信息表';