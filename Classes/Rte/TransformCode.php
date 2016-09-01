<?php
namespace StefanFroemken\Typo3lexikon\Rte;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class TransformCode
{
    /**
     * @var \TYPO3\CMS\Core\Html\RteHtmlParser
     */
    public $pObj;

    /**
     * @var string
     */
    public $transformationKey = '';

    /**
     * @param string $value
     * @param \TYPO3\CMS\Core\Html\RteHtmlParser $rteHtmlParser
     * @return string
     */
    public function transform_db($value, \TYPO3\CMS\Core\Html\RteHtmlParser $rteHtmlParser)
    {
        // do not transform anything if either pre or code is not present
        if (strpos($value, '<code') === false && strpos($value, '<pre') === false) {
            return $value;
        }
        $value = $this->combineMultipleCodeTags($value);
        $matches = array();
        if (preg_match_all('~<pre><code class="language-[a-z]+">(.*?)</code></pre>~s', $value, $matches)) {
            // I only need the sub-patterns
            unset($matches[0]);
            foreach ($matches as $match) {
                $sub = $this->cleanUpCodeTags($match[0]);
                $value = str_replace($match[0], $sub, $value);
            }
        }
        return $value;
    }

    /**
     * @param string $value
     * @param \TYPO3\CMS\Core\Html\RteHtmlParser $rteHtmlParser
     * @return string
     */
    public function transform_rte($value, \TYPO3\CMS\Core\Html\RteHtmlParser $rteHtmlParser)
    {
        return $value;
    }

    /**
     * combine multiple pre and or code-tags into one
     *
     * @param string $value
     * @return string
     */
    protected function combineMultipleCodeTags($value)
    {
        $search = array("</pre>\n<pre>", "</pre> <pre>", "</pre><pre>");
        $replace = array("\n", "\n", "\n");
        return str_replace($search, $replace, $value);
    }

    /**
     * convert whitespaces to &nbsp;
     * convert new-lines to <br />
     *
     * @param string $value
     * @return string
     */
    protected function cleanUpCodeTags($value)
    {
        $search = array('<p>', '</p>', ' ', "\n", '<br&nbsp;/>');
        $replace = array('', '', '&nbsp;', '<br />', '<br />');
        return str_replace($search, $replace, $value);
    }
}
