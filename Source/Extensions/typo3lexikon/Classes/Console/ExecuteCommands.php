<?php

/*
 * This file is part of the package stefanfroemken/typo3lexikon.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

/**
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ExecuteCommands
{
    /**
     * check for command and try to execute it
     *
     * @param string $command
     *
     * @return string
     */
    public function executeCommand($command)
    {
        $output = '';
        $command = $this->cleanUpCommand($command);
        if (StringUtility::beginsWith($command, 'convert')) {
            $output = $this->convert(trim(str_replace('convert', '', $command)));
        } elseif (StringUtility::beginsWith($command, 'show')) {
            $output = $this->show(trim(str_replace('show', '', $command)));
        } elseif ($command === 'delete all cookies') {
            $this->deleteAllCookies();
            $output = 'All cookies for this page are now deleted';
        } elseif (StringUtility::beginsWith($command, 'ping')) {
            exec(
                sprintf(
                    'ping -c 1 -W 5 %s',
                    escapeshellarg(trim(str_replace('ping', '', $command)))
                ),
                $res,
                $returnValue
            );
            $output = $returnValue === 0 ? 'Host is reachable' : 'Host can\'t be reached';
        }
        return $output;
    }

    /**
     * convert value
     *
     * @param string $command
     * @return string
     */
    protected function convert($command)
    {
        $lowerCasedCommand = strtolower($command);
        if (StringUtility::beginsWith($lowerCasedCommand, 'md5')) {
            $output = md5(trim(str_ireplace('md5', '', $command)));
        } elseif (StringUtility::beginsWith($lowerCasedCommand, 'crc32')) {
            $checkSum = crc32(trim(str_ireplace('crc32', '', $command)));
            $output = sprintf("%u\n", $checkSum);
        } elseif (StringUtility::beginsWith($lowerCasedCommand, 'sha1')) {
            $output = sha1(trim(str_ireplace('sha1', '', $command)));
        } elseif (StringUtility::beginsWith($lowerCasedCommand, 'password_hash')) {
            $output = password_hash(trim(str_ireplace('password_hash', '', $command)), PASSWORD_DEFAULT);
        } else {
            $output = 'Sorry, I don\'t know this kind of converter';
        }
        return $output;
    }

    /**
     * show something
     *
     * @param string $command
     * @return string
     */
    protected function show($command)
    {
        $output = '';
        $lowerCasedCommand = strtolower($command);
        if ($lowerCasedCommand === 'environment' || $lowerCasedCommand === 'env') {
            $output = DebugUtility::viewArray(GeneralUtility::getIndpEnv('_ARRAY'));
        } elseif ($lowerCasedCommand === 'server') {
            $output = DebugUtility::viewArray($_SERVER);
        } elseif ($lowerCasedCommand === 'my ip') {
            $output = $_SERVER['REMOTE_ADDR'];
        } elseif ($lowerCasedCommand === 'post') {
            $output = DebugUtility::viewArray($_POST);
        } elseif ($lowerCasedCommand === 'get') {
            $output = DebugUtility::viewArray($_GET);
        } elseif ($lowerCasedCommand === 'request') {
            $output = DebugUtility::viewArray($_REQUEST);
        } elseif ($lowerCasedCommand === 'cookie' || $lowerCasedCommand === 'cookies') {
            $output = DebugUtility::viewArray($_COOKIE);
        } elseif ($lowerCasedCommand === 'timestamp') {
            $output = time();
        } elseif ($lowerCasedCommand === 'date') {
            $output = date('d.m.Y');
        } elseif ($lowerCasedCommand === 'time') {
            $output = date('H:i:s');
        } elseif ($lowerCasedCommand === 'datetime') {
            $output = date('d.m.Y H:i:s');
        }
        $output = str_replace('<pre>', '', $output);
        $output = str_replace('</pre>', '', $output);
        return $output;
    }

    /**
     * delete all cookies set by this page
     */
    protected function deleteAllCookies()
    {
        if (isset($_COOKIE)) {
            foreach ($_COOKIE as $cookieName => $value) {
                setcookie($cookieName, '', time() - 1000);
                setcookie($cookieName, '', time() - 1000, '/');
            }
        }
    }

    /**
     * CleanUp command
     *
     * @param string $command
     *
     * @return string
     */
    protected function cleanUpCommand($command)
    {
        $command = trim($command);
        return $command;
    }
}
