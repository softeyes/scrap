<?php

// logs errors made by objects ie exceptions
function log_exception(Exception $e) // for php < 7.0
// function log_exception(Throwable $e) // for php => 7.0
{
    $message = "Line {$e->getLine()} in " . basename($e->getFile()) . ", {$e->getMessage()}  (" . get_class($e) . ")";
    append_message($message);
    exit();
}

// logs basic errors by turning them into Exception objects
function log_error($num, $str, $file, $line, $context = null)
{
    log_exception(new ErrorException($str, 0, $num, $file, $line));
}

// helper function for debugging
function logger($message)
{
    $debug_arr = debug_backtrace();
    $prepend = 'line ' . $debug_arr[0]['line'] . ' ('. basename($debug_arr[0]['file']) .') ' . print_r($message, true) . PHP_EOL;
    append_message($prepend);
}

// checks for something that caused the script to shutdown
function check_for_fatal()
{
    $error = error_get_last();
    if ($error["type"] == E_ERROR) {
        log_error($error["type"], $error["message"], $error["file"], $error["line"]);
    }
}

// adds any messages to the end of backend/common/notices.log
function append_message($message)
{
    $fileContents = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/backend/common/notices.log");
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/backend/common/notices.log", $fileContents.$message);
}

// sets all the global php values to make debugging work
register_shutdown_function("check_for_fatal");
set_error_handler("log_error");
set_exception_handler("log_exception");
ini_set("display_errors", "on");
error_reporting(E_ALL);