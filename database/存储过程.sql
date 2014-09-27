//会员信息表存储过程

DELIMITER $$
CREATE  PROCEDURE `member_info`(IN number int(11))
BEGIN
  declare i int(11);
  set i = 1;
  WHILE i <= number DO
	 set @sqltext=concat('insert into member_info (real_name,photo_mob,gender,birthday,address,im_qq,email,wechat,sina,marriage,income,job,idcard_type,idcard,education,sales_amount,member_grade,card_num,integral,integral_endtime,add_time,sale_account,sales_return,last_sale_time,last_sale_type,platfrom_type,region_id,city_id) values',concat("('小白','15175100159',1,'1989-03-22','北京市海淀区','598596630','598596630@qq.com','wechat_1','sina_1',1,4,5,1,'130105198903220314',1,40000.00,2,'000285',40000,'2018-08-30','2014-08-21 12:00:00',1,0,'2014-08-21 12:00:00',13,1,2,8)"));
	 prepare stmt from @sqltext;
	 execute stmt;
	 DEALLOCATE PREPARE stmt;
	 set @sqltext='';
	 set i=i+1;
  END WHILE;
END$$
DELIMITER ;



//会员支付方式表存储过程
DELIMITER $$
CREATE  PROCEDURE `member_info_replenish`(IN number int(11))
BEGIN
  declare i int(11);
  set i = 1;
  WHILE i <= number DO
	 insert into member_info_replenish (payment_type,payment_account,payment_time,sale_type,sale_platfrom,consume_pact_id,merchant_id,consume_client_id,lj_kid,is_return,member_id) values(1,4000.00,'2014-08-32 12:00:00','床垫',1,'120130001',512,1,'K16000001',1,i);
	 set i=i+1;
  END WHILE;
END$$
DELIMITER ;