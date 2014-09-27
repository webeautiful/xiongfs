-- 创建存储过程
-- http://dev.mysql.com/doc/refman/5.1/zh/stored-procedures.html
--
-- 调用存储过程
-- call food_insert_batch(1000000);
--
-- 删除存储过程
-- drop procedure food_insert_batch
--
-- ------------------------------------------------------------
DELIMITER $$
CREATE  PROCEDURE `food_insert_batch`(IN number int(11))
BEGIN
  declare i int(11);
  set i = 1;
  set @str = 'yxrsszysltdsgbjd';
  set @chstr='鱼香肉丝鱼香鸡丝香辣土豆丝宫爆鸡叮';
  WHILE i <= number DO
	 set @len = ceil(1+rand()*10);
	 if mod(i,2000)=1 then
	 set @sqltext = concat("(37,",i,",'60.00','",concat(substring(@chstr,@len,4),i),"','",concat(substring(@str,@len,4),i),"')");
	 else
	 set @sqltext = concat("(34,",i,",'60.00','",concat(substring(@chstr,@len,4),i),"','",concat(substring(@str,@len,4),i),"')");
	 end if;
	 set @sqltext=concat('insert into dining_food (merchant_id,food_num,price,name,first_letter) values',@sqltext);
	 prepare stmt from @sqltext;
	 execute stmt;
	 DEALLOCATE PREPARE stmt;
	 set @sqltext='';
	 set i=i+1;
  END WHILE;
END$$
DELIMITER ;




DELIMITER $$
CREATE PROCEDURE `order_insert_batch`(IN number int(11))
BEGIN
  declare i int(11);
  set i = 1;
  WHILE i <= number DO
	 set @len = ceil(1+rand()*10);
	 if mod(i, 2000) =1 then
	 set @sqltext = concat("('34.00','03','0.98','40.00', '*",concat(i,DATE_FORMAT(NOW(),'%Y%m%d%H%i%s')),"','02345",i,"',2,34,1,1,'",now(),"','",now(),"','weixiaohua',1)");
	else
	 set @sqltext = concat("('40.00','02','0.90','40.00', '*",concat(i,DATE_FORMAT(NOW(),'%Y%m%d%H%i%s')),"','0456",i,"',2,37,1,1,'",now(),"','",now(),"','weixiaohua001',1)");
	end if;
	 set @sqltext=concat('insert into dining_order (discount_price,window,discount_point,order_price,order_num,card_num,card_type,merchant_id,is_destory,is_print,add_time,print_time,opeation,is_rebates) values',@sqltext);
	 prepare stmt from @sqltext;
	 execute stmt;
	 DEALLOCATE PREPARE stmt;
	 set @sqltext='';
	 set i=i+1;
  END WHILE;
END$$
DELIMITER ;





DELIMITER $$
CREATE PROCEDURE `order_food_insert_batch`(IN number int(11))
BEGIN
  declare i int(11);
  set i = 1;
  set @chstr='鱼香肉丝鱼香鸡丝香辣土豆丝宫爆鸡叮';
  WHILE i <= number DO
	 set @len = ceil(1+rand()*10);
	 set @sqltext = concat("('34.00','20.00','",concat(substring(@chstr,@len,4),i),"',",i,",",i,",",@len,",1,'",now(),"','20.00','0.98','15.00',1)");
	 set @sqltext=concat('insert into dining_order_food (discount_price, discount_total_price, food_name,count, food_num, order_id, is_destory, add_time, total_price, discount_point,price, is_print) values',@sqltext);
	 prepare stmt from @sqltext;
	 execute stmt;
	 DEALLOCATE PREPARE stmt;
	 set @sqltext='';
	 set i=i+1;
  END WHILE;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `card_insert_batch`(IN number int(11))
BEGIN
  declare i int(11);
  set i = 1;
  set @chstr='123456789QWERTYUIOPLKJHGFDSAZXCVBNM';
  set @cardNum = '0123456789';
  WHILE i <= number DO
	 set @len = ceil(1+rand()*10);
	 if mod(i, 2000)=1 then
	 set @sqltext = concat("('",concat(substring(@cardNum,@len,6),i),"','",concat(substring(@chstr,@len,32),i),"','30.00',2,2,'15.00',2,'",now(),"','",now(),"','",now(),"',0)");
	 else
	 set @sqltext = concat("('",concat(substring(@cardNum,@len,6),i),"','",concat(substring(@chstr,@len,32),i),"','50.00',2,2,'15.00',1,'",now(),"','",now(),"','",now(),"','120')");
	 end if;
	 set @sqltext=concat('insert into dining_card (card_num,card_physical,card_price,is_lock,state,deposit,type,last_price_time,make_time,isuse_time,yun_no) values',@sqltext);
	 prepare stmt from @sqltext;
	 execute stmt;
	 DEALLOCATE PREPARE stmt;
	 set @sqltext='';
	 set i=i+1;
  END WHILE;
END$$
DELIMITER ;





