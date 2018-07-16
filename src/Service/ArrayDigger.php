<?php
/**
 *  Copyright 2018 Secalith
 *
 *  Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 *      1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 *      2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 *      3. Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
 *
 *      THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 *      INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 *      IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
 *      OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA,
 *      OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 *      OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

namespace Secalith\ArrayDigger\Service;

class ArrayDigger
{

    /**
     * @var null|string
     */
    protected $delimiter;

    const DEFAULT_DELIMITER = '.';

    /**
     * ArrayDigger constructor.
     * @param null|string $delimiter
     */
    public function __construct($delimiter = null)
    {
        $this->setDelimiter($delimiter);
    }

    /**
     * @param array $resource_data
     * @param $path
     * @param null $delimiter
     * @return array|mixed|null
     */
    public function extractData(array $resource_data, $path, $delimiter = null) {

        $delimiter=($delimiter)?$delimiter:($this->getDelimiter())?$this->getDelimiter():self::DEFAULT_DELIMITER;

        $path_exploded = explode($delimiter,$path);
        if ( ! empty($path_exploded)) {
            $copy = $resource_data;
            foreach($copy as $key=>$value) {
                if(isset($copy[$key])) {
                    $copy = $copy[$key];
                } else {
                    return null;
                }
            }

            return $copy;
        } else {
            return null;
        }
    }

    /**
     * @return null|string
     */
    public function getDelimiter()
    {
        return ($this->delimiter)?$this->delimiter:self::DEFAULT_DELIMITER;
    }

    /**
     * @param null|string $delimiter
     * @return $this
     */
    public function setDelimiter($delimiter=null)
    {
        $this->delimiter = ($delimiter)?$delimiter:self::DEFAULT_DELIMITER;

        return $this;
    }

}