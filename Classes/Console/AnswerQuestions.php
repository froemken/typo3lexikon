<?php
namespace StefanFroemken\Typo3lexikon\Console;

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
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class AnswerQuestions
{
    /**
     * This represents a list of the must important words for a question
     * As more words match as better the answer
     *
     * @var array
     */
    protected $importantWordsOfQuestions = [
        array('help'),
        array('how', 'you'),
        array('how', 'old', 'you'),
        array('come', 'from', 'you'),
        array('name', 'your'),
        array('boss'),
        array('boss', 'your'),
        array('work', 'working', 'you'),
        array('typo'),
        array('typo3'),
        array('typo3', 'think', 'you'),
        array('typo3', 'download'),
        array('typo3', 'install', 'composer'),
        array('typo3', 'packages', 'repository', 'composer'),
        array('templavoila'),
        array('documentation', 'tsref'),
        array('documentation', 'tsref', 'page'),
        array('documentation', 'tsref', 'config'),
        array('documentation', 'tsref', 'stdwrap'),
        array('documentation', 'tsref', 'typolink'),
        array('documentation', 'tsref', 'tsconfig'),
        array('documentation', 'tsref', 'pagetsconfig'),
        array('documentation', 'tsref', 'usertsconfig'),
        array('joomla', 'think', 'you'),
        array('wordpress', 'think', 'you'),
        array('mambo', 'think', 'you'),
        array('plone', 'think', 'you'),
        array('opencms', 'think', 'you'),
        array('papaya', 'think', 'you'),
        array('drupal', 'think', 'you'),
        array('django', 'think', 'you'),
        array('married', 'you'),
        array('wife', 'name'),
        array('hair', 'color', 'you'),
        array('eye', 'eyes', 'color', 'you'),
        array('hobby', 'hobbies', 'you', 'your'),
        array('old', 'petra', 'wife'),
        array('why'),
        array('weather'),
        array('where', 'am', 'i'),
        array('who', 'am', 'i'),
    ];

    /**
     * check, if we can answer the question directly
     *
     * @param string $question
     * @return string
     */
    public function getAnswer($question)
    {
        $bestMatchingQuestion = array(
            'sameWords' => array(),
            'questionKey' => null
        );
        $wordsOfOriginalQuestion = GeneralUtility::trimExplode(
            ' ',
            $this->cleanUpQuestion($question),
            true
        );
        foreach ($this->importantWordsOfQuestions as $questionKey => $importantWordsOfQuestion) {
            $sameWords = array_intersect($importantWordsOfQuestion, $wordsOfOriginalQuestion);
            if (count($sameWords) > count($bestMatchingQuestion['sameWords'])) {
                $bestMatchingQuestion = array(
                    'sameWords' => $sameWords,
                    'questionKey' => $questionKey
                );
            }
        }
        if (empty($bestMatchingQuestion['sameWords'])) {
            $output = 'Sorry. I haven\'t found a matching question. Try something else';
            /** @var MailMessage $mailMessage */
            $mailMessage = GeneralUtility::makeInstance(MailMessage::class);
            $mailMessage->addFrom('info@typo3lexikon.de', 'Stefan Froemken');
            $mailMessage->addTo('froemken@gmail.com', 'Stefan Froemken');
            $mailMessage->setSubject('New question from jquery-console');
            $mailMessage->setBody('New question: ' . $question);
            $mailMessage->send();
        } else {
            $output = LocalizationUtility::translate(
                implode('_', $this->importantWordsOfQuestions[$bestMatchingQuestion['questionKey']]),
                'typo3lexikon'
            );
        }
        return $output;
    }

    /**
     * CleanUp question
     *
     * @param string $question
     * @return string
     */
    protected function cleanUpQuestion($question)
    {
        $question = strtolower($question);

        // extract first question
        $position = strpos($question, '?');
        if ($position !== false) {
            $question = substr($question, 0, $position);
        }
        return $question;
    }
}
