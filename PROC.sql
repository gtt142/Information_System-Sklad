CREATE PROCEDURE RES_UPDATE ()
BEGIN
	DECLARE pr_id, pr_cost, pr_count INTEGER;
	DECLARE done INTEGER DEFAULT 0;
	DECLARE C1 CURSOR FOR
		SELECT p_id, cost, count FROM reserve
		WHERE res_date = (SELECT MAX(res_date) FROM reserve);
	DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done=1;
	OPEN C1;
	REPEAT
		IF(done = 0) THEN
			FETCH C1 INTO pr_id, pr_cost, pr_count;
			INSERT INTO `reserve` (`res_id`, `p_id`, `cost`, `count`, `res_date`) VALUES (NULL, pr_id, pr_cost, pr_count, CURDATE());
		END IF;
	UNTIL(done=1) END REPEAT;
	CLOSE C1;
END