<?php

class bmSaveReferences extends bmCustomRemoteProcedure
{
	/*FF::AC::CGIPROPERTIES::{*/
	/*FF::AC::CGIPROPERTIES::}*/

	private $referenceNames = array();


	public function __construct($application, $parameters = array())
	{
		parent::__construct($application, $parameters);

		if ($this->application->user->type < 100)
		{
			echo 'Недостаточно прав доступа';
			exit;
		}

		$this->referenceNames = $this->application->cgi->getGPC('referenceName', array());
	}

	public function execute()
	{
		foreach ($this->referenceNames as $referenceMapId => $referenceName)
		{
			set_time_limit(0);
			if ($referenceMapId != 0 || $referenceName != '')
			{
				$referenceName = trim($referenceName);

				$pattern = '/^[a-zA-Z][a-zA-Z0-9_]+$/';
				if (preg_match($pattern, $referenceName))
				{
					$migration = new bmMigration($this->application->dataLink);
					$referenceMap = new bmReferenceMap($this->application, array('identifier' => $referenceMapId), $migration);
					$referenceMap->beginUpdate();

					if ($referenceMap->type != 1)
					{
						$referenceMap->name = $referenceName;
					}

					$referenceMap->endUpdate();
					$referenceMap->save();
					$migration->generationMigration();
				}
				else
				{
					echo 'Ошибка: имя связи может состоять из строчных и прописных латинских букв и цифр и должно начинаться с буквы';
				}
			}
		}



		parent::execute();
	}
}

?>
