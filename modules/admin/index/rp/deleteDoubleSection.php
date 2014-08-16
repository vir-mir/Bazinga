<?php
/**
 * This file was automatically generated by Дмитрий Носов at 20:07:43, 2013-12-25.
 */



class bmDeleteDoubleSection extends bmCustomRemoteProcedure
{
  /*FF::AC::CGIPROPERTIES::{*/
	
	
	/*FF::AC::CGIPROPERTIES::}*/
  
  
  public function __construct($application, $parameters = array())
  {
    parent::__construct($application, $parameters);

    /**
     * @warn Uncomment these lines below if you want to restrict acces for this procedure.
     */

    if ($this->application->user->type < 100)
    {
      echo 'Недостаточно прав доступа';
      exit;
    }
    /**
     * @warn Procedure properties, see bmCustomRemoteProcedure class.
     */

/*
    $this->type = BM_RP_TYPE_ ... (choose proper type) // procedure type
    $this->output = new stdClass();                    // for JSON procedures
    $this->returnTo = '/';                             // for redirect after execution
*/


    // ... YOUR CODE HERE ...

  }

  public function execute()
  {
	  foreach($this->application->data->getDoubleSection() as $section){

		  $tempSectionUrl = str_replace("-1", "", $section->prettyUrl);

		  $tempSectionId = $this->application->data->getSectionByPrettyUrl($tempSectionUrl);
		  if (!empty($tempSectionId) && $tempSectionId[0]->moderated != 1){

			$tempSection = new bmSection($this->application, array('identifier' => $tempSectionId[0]->identifier));
		  
		  	echo $section->prettyUrl. ' ' . $section->identifier . ' | ';
		  	echo $tempSectionUrl . ' '. $tempSectionId[0]->identifier . '<br />'; 

			if($section->moderated == 1){

				$section->prettyUrl = $tempSectionUrl;
				$tempSection->prettyUrl = $tempSectionUrl . '--delete';
			}
		  } else {
			//$section->prettyUrl = $tempSectionUrl;	
		  }
	  }	  
  }
}

?>