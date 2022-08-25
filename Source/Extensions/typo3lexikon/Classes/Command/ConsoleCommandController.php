<?php

/*
 * This file is part of the package stefanfroemken/typo3lexikon.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace StefanFroemken\Typo3lexikon\Command;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ConsoleCommandController extends CommandController
{
    /**
     * @var \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected $databaseConnection;

    /**
     * initializes this object.
     */
    public function initializeObject()
    {
        $this->databaseConnection = $GLOBALS['TYPO3_DB'];
    }

    /**
     * Installs an extension by key
     *
     * The extension files must be present in one of the
     * recognised extension folder paths in TYPO3.
     *
     * @param string $question
     * @param string $answer
     */
    public function addAnswerCommand($question, $answer)
    {
        $answerId = $this->insertAnswer($answer);

        $words = GeneralUtility::trimExplode(' ', $question);
        $words = array_unique($words);
        // @ToDo: remove exclude words like "the" and "a"
        foreach ($words as $word) {
            $wordId = $this->insertWord($word);
            $this->databaseConnection->exec_INSERTquery(
                'tx_typo3lexikon_answer_word_mm',
                [
                    'uid_local' => $answerId,
                    'uid_foreign' => $wordId
                ]
            );
        }
        $this->outputLine('Answer was added');
    }

    /**
     * Insert answer to database
     *
     * @param string $answer
     *
     * @return int
     */
    protected function insertAnswer($answer)
    {
        $this->databaseConnection->exec_INSERTquery(
            'tx_typo3lexikon_answer',
            [
                'answer' => trim($answer)
            ]
        );
        return (int)$this->databaseConnection->sql_insert_id();
    }

    /**
     * Insert word to database
     *
     * @param string $word
     *
     * @return int
     */
    protected function insertWord($word)
    {
        $row = $this->databaseConnection->exec_SELECTgetSingleRow(
            'uid',
            'tx_typo3lexikon_word',
            'word=' . $this->databaseConnection->fullQuoteStr($word, 'tx_typo3lexikon_word')
        );
        if (empty($row)) {
            $this->databaseConnection->exec_INSERTquery(
                'tx_typo3lexikon_word',
                [
                    'word' => $word
                ]
            );
            return (int)$this->databaseConnection->sql_insert_id();
        }
        return (int)$row['uid'];
    }
}
