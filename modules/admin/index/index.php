<?php

final class bmAdminIndexPage extends bmHTMLPage
{
	/*FF::AC::CGIPROPERTIES::{*/


	/*FF::AC::CGIPROPERTIES::}*/


	public function __construct($application, $parameters = array())
	{
		parent::__construct($application, $parameters);

		$this->addScript('ff/jquery');
		$this->addScript('admin/index/index');
		$this->addCSS('admin/global');
		$this->addCSS('admin/index/index');
	}

	function generate()
	{
		$result = parent::generate();

		eval('$this->content = "' . $this->application->getTemplate('admin/index/container') . '";');
		eval('$result = "' . $this->application->getTemplate('admin/index/index') . '";');

		return $result;
	}
}

?>
