<?php

/**
 * Copyright (c) 2009, "The Blind Mice Studio"
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * - Redistributions of source code must retain the above copyright
 *   notice, this list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright
 *   notice, this list of conditions and the following disclaimer in the
 *   documentation and/or other materials provided with the distribution.
 * - Neither the name of the "The Blind Mice Studio" nor the
 *   names of its contributors may be used to endorse or promote products
 *   derived from this software without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY "The Blind Mice Studio" ''AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL "The Blind Mice Studio" BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

/**
 * Class bmUser
 *
 * @property int $identifier
 *  default = 0
 * @property int $deleted
 *  default = 0
 * @property string $email
 *  default = null
 * @property string $password
 *  default = null
 * @property int $type
 *  default = null
 *
 */
final class bmUser extends bmDataObject
{
	public function __construct($application, $parameters = array())
	{
		/*FF::AC::MAPPING::{*/

      $this->objectName = 'user';
      $this->map = array_merge($this->map, array(
				'email' => array(
					'fieldName' => 'email',
					'dataType' => BM_VT_STRING,
					'defaultValue' => '0'
				),
				'password' => array(
					'fieldName' => 'password',
					'dataType' => BM_VT_PASSWORD,
					'defaultValue' => '0'
				),
				'type' => array(
					'fieldName' => 'type',
					'dataType' => BM_VT_INTEGER,
					'defaultValue' => 0
				)
      ));

      /*FF::AC::MAPPING::}*/

		parent::__construct($application, $parameters);
	}

	public function __get($propertyName)
	{
		$this->checkDirty();

		switch ($propertyName)
		{
			/*FF::AC::TOP::GETTER::{*/
        
 
        /*FF::AC::TOP::GETTER::}*/
			default:
				return parent::__get($propertyName);
				break;
		}
	}

	/*FF::AC::TOP::REFERENCE_FUNCTIONS::{*/
    

    /*FF::AC::TOP::REFERENCE_FUNCTIONS::}*/
}

?>