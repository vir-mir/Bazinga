<?php

/**
 * Удаление поля `qq` у объекта `user`
 *
 * Date: 16.08.2014
 * Time: 23:16:25
 */
class bm1408230985_af extends bmIMigrate
{

	public function up()
	{
		$messenge = $this->validateObjects([]);
		if ($messenge !== true)
		{
			return $messenge;
		}

		$messenge = $this->validateFields([]);

		if ($messenge !== true)
		{
			return $messenge;
		}

		// $this->execute("insert ignore into ....");
		// $this->execute("update ....");
		$this->execute("
					set @idData = (
						select dof.id from
									dataObjectField dof
									inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
									inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
								where
									dof.fieldName = 'qq'
									and dom.name = 'user'
					)");
		$this->execute("
						delete from
							dataObjectField
						where
							`id` = @idData
						");
		$this->execute("
											DELETE FROM
												`link_dataObjectMap_dataObjectField`
											WHERE
												`dataObjectMapId` = (select id as dataObjectMapId from `dataObjectMap` where name = 'user')
							and `dataObjectFieldId` = @idData
					");
		$this->execute("ALTER TABLE
                  `user`DROP COLUMN `qq`;");

		return true;
	}

}