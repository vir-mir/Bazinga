<?php

/**
 * Переименование поля `name` в `name` у объекта `post`
 * Переименование поля `url` в `url` у объекта `post`
 * Переименование поля `order` в `order` у объекта `post`
 * Переименование поля `active` в `active` у объекта `post`
 * Переименование поля `text` в `text` у объекта `post`
 * Переименование поля `text2` в `text2` у объекта `post`
 *
 * Date: 16.08.2014
 * Time: 22:38:07
 */
class bm1408228687_af extends bmIMigrate
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
					update
						dataObjectField dof
						inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
						inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
					set
						dof.propertyName = 'name',
						dof.fieldName = 'name',
						dof.dataType = 1,
						dof.localName = 'name',
						dof.defaultValue = '',
						dof.type = 0
					where
						dof.fieldName = 'name'
						and dom.name = 'post'
					");
		$this->execute("
					update
						dataObjectField dof
						inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
						inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
					set
						dof.propertyName = 'url',
						dof.fieldName = 'url',
						dof.dataType = 1,
						dof.localName = 'url',
						dof.defaultValue = '',
						dof.type = 0
					where
						dof.fieldName = 'url'
						and dom.name = 'post'
					");
		$this->execute("
					update
						dataObjectField dof
						inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
						inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
					set
						dof.propertyName = 'order',
						dof.fieldName = 'order',
						dof.dataType = 2,
						dof.localName = 'order',
						dof.defaultValue = 0,
						dof.type = 0
					where
						dof.fieldName = 'order'
						and dom.name = 'post'
					");
		$this->execute("
					update
						dataObjectField dof
						inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
						inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
					set
						dof.propertyName = 'active',
						dof.fieldName = 'active',
						dof.dataType = 2,
						dof.localName = 'active',
						dof.defaultValue = 1,
						dof.type = 0
					where
						dof.fieldName = 'active'
						and dom.name = 'post'
					");
		$this->execute("
					update
						dataObjectField dof
						inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
						inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
					set
						dof.propertyName = 'text',
						dof.fieldName = 'text',
						dof.dataType = 9,
						dof.localName = 'text',
						dof.defaultValue = '',
						dof.type = 0
					where
						dof.fieldName = 'text'
						and dom.name = 'post'
					");
		$this->execute("
					update
						dataObjectField dof
						inner join link_dataObjectMap_dataObjectField ldd on ldd.dataObjectFieldId = dof.id
						inner join dataObjectMap dom on dom.id = ldd.dataObjectMapId
					set
						dof.propertyName = 'text2',
						dof.fieldName = 'text2',
						dof.dataType = 9,
						dof.localName = 'text2',
						dof.defaultValue = '',
						dof.type = 0
					where
						dof.fieldName = 'text2'
						and dom.name = 'post'
					");
		$this->execute("ALTER TABLE
                  `post`CHANGE `name` `name`  VARCHAR(255) NOT NULL DEFAULT '', CHANGE `url` `url`  VARCHAR(255) NOT NULL DEFAULT '', CHANGE `order` `order`  INT(10) NOT NULL DEFAULT '0', CHANGE `active` `active`  INT(10) NOT NULL DEFAULT '1', CHANGE `text` `text`  LONGTEXT NOT NULL DEFAULT '', CHANGE `text2` `text2`  LONGTEXT NOT NULL DEFAULT '';");

		return true;
	}

}