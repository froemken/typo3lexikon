<?php
namespace StefanFroemken\Typo3lexikon\Frontend\DataProcessing;

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
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class HeaderProcessor implements DataProcessorInterface
{
    /**
     * Process content object data
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array $contentObjectConfiguration The configuration of Content Object
     * @param array $processorConfiguration The configuration of this processor
     * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ) {
        if (empty($this->getTypoScriptFrontendController()->register['currentIndexForHeader'])) {
            $this->getTypoScriptFrontendController()->register['currentIndexForHeader'] = 1;
        }
        // don't create header numbers for first element
        if ($cObj->parentRecordNumber !== 1) {
            if (!empty($processedData['data']['header'])) {
                $currentIndex = $this->getTypoScriptFrontendController()->register['currentIndexForHeader'];
                $processedData['data']['header'] = $currentIndex . '. ' . $processedData['data']['header'];
                $this->getTypoScriptFrontendController()->register['currentIndexForHeader'] += 1;
            }
        }
        return $processedData;
    }

    /**
     * get TypoScriptFrontendController
     *
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController()
    {
        return $GLOBALS['TSFE'];
    }
}
