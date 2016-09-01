<?php
namespace StefanFroemken\Typo3lexikon\Ajax;

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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use StefanFroemken\Typo3lexikon\Console\AnswerQuestions;
use StefanFroemken\Typo3lexikon\Console\ExecuteCommands;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class Console
 *
 * @package StefanFroemken\Typo3lexikon\Ajax
 */
class Console
{
    /**
     * communicate with jquery-console
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function processRequest(ServerRequestInterface $request, ResponseInterface $response)
    {
        $post = $request->getParsedBody();
        $line = '';
        if (is_array($post) && !empty($post['line'])) {
            $line = trim($post['line']);
        }
        if (empty($line)) {
            $content = 'What should I do with an empty line?';
        } elseif ($line === 'help') {
            $content = LocalizationUtility::translate('help', 'typo3lexikon');
        } else {
            $content = $this->analyzeInput($line);
        }
        $response->getBody()->write($content);
        return $response;
    }

    /**
     * Check, what kind of input we have
     *
     * @param string $input
     * @return string
     */
    protected function analyzeInput($input)
    {
        if (preg_match('~^[0-9+\-*/(). ]{3,}$~', $input)) {
            $output = 'Result: ' . MathUtility::calculateWithParentheses($input);
        } elseif (strpos($input, '?')) {
            // it's a question
            /** @var AnswerQuestions $answerQuestions */
            $answerQuestions = GeneralUtility::makeInstance(AnswerQuestions::class);
            $output = $answerQuestions->getAnswer($input);
        } elseif (StringUtility::beginsWith($input, 'search')) {
            // it's a search request
            $output = $this->searchForPages(str_replace('search', '', $input));
        } elseif (StringUtility::beginsWith($input, 'open')) {
            // try to load the page with given UID
            $output = $this->getUrlForPage(str_replace('open', '', $input));
        } else {
            // maybe it's an command
            /** @var ExecuteCommands $executeCommands */
            $executeCommands = GeneralUtility::makeInstance(ExecuteCommands::class);
            $output = $executeCommands->executeCommand($input);
        }
        if (empty($output)) {
            $output = 'I don\'t understand you. Try something else or do you have missed a leading questionmark?';
        }
        return $output;
    }

    /**
     * search for a page
     *
     * @param string $input
     * @return string
     */
    protected function searchForPages($input)
    {
        $likeForBodytext = array();
        $searchWords = GeneralUtility::trimExplode(' ', $input, true);
        foreach ($searchWords as $searchWord) {
            $searchWord = htmlspecialchars(strip_tags(trim($searchWord)));
            $searchWord = '%' . $this->getDatabaseConnection()->escapeStrForLike($searchWord, 'tt_content') . '%';
            $likeForBodytext[] = 'tt_content.bodytext LIKE ' .
                $this->getDatabaseConnection()->fullQuoteStr(
                    $searchWord,
                    'tt_content'
                );
        }
        $pages = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'pages.uid as page_uid, title, header',
            'pages, tt_content',
            'tt_content.pid = pages.uid
            AND ' . implode(' AND ', $likeForBodytext) . '
            AND tt_content.hidden = 0
            AND tt_content.deleted = 0
            AND (tt_content.fe_group = \'\' OR tt_content.fe_group = 0)
            AND pages.hidden = 0
            AND pages.deleted = 0
            AND (pages.fe_group = \'\' OR pages.fe_group = 0)',
            'pages.uid',
            'pages.title',
            '0, 10'
        );
        if (!$pages) {
            $pages = array();
        }
        $output = array();
        foreach ($pages as $page) {
            $output[] = sprintf(
                'ID: %d - Title: %s - Header: %s',
                $page['page_uid'],
                $page['title'],
                $page['header']
            );
        }
        if (empty($output)) {
            $output[] = 'Sorry, I haven\'t found any records which match your searchwords.';
        }
        return implode("\n", $output);
    }

    /**
     * get URL for page UID
     *
     * @param string $input
     * @return string
     */
    protected function getUrlForPage($input)
    {
        $input = (int)trim($input);
        $page = $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            'uid',
            'pages',
            'uid = ' . $input
        );
        if (empty($page)) {
            $output = 'Sorry, I don\'t know this page';
        } else {
            $output = 'http://www.typo3lexikon.de/index.php?id=' . (int)$page['uid'];
        }
        return $output;
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
