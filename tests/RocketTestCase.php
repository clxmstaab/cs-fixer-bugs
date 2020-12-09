<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Util\GlobalState;

abstract class RocketTestCase extends TestCase
{
    protected function prepareTemplate(Text_Template $template)
    {
        // we want our tests to share everything but constants.
        // this prevents us from constant-already defined errors.
        $constants = '';
        $globals = GlobalState::getGlobalsAsString();
        $includedFiles = GlobalState::getIncludedFilesAsString();

        $template->setVar([
            'constants' => $constants,
            'globals' => $globals,
            'included_files' => $includedFiles,
        ], true);
    }

    /**
     * builds a temp path for the given filename, which will not conflict with other test methods files.
     *
     * @param string $file
     */
    protected function tempDir($file = '')
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $caller = $trace[1];
        $testName = $caller['function'];

        $tempPath = APP_TMP_DIR.'/'.static::class.'/'.$testName;
        mkdir($tempPath, 0777, true);

        return $tempPath.'/'.$file;
    }
}
