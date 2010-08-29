--TEST--
sem_acquire with blocking and sem_release() on multiple semaphore instanzes 

--SKIPIF--
<?php 
    if (!extension_loaded('sysvsem')) print 'skip sysvsem extension not available';
    if (!extension_loaded('sysvmsg')) print 'skip sysvsem extension not available';
    if (!extension_loaded('pcntl')) print 'skip sysvsem extension not available';
?>
--FILE--
<?php

$sem = sem_get(123);
$queue = msg_get_queue(1);
$pid = pcntl_fork();
if ($pid == -1) {
    die('could not fork');
} else if ($pid) {
    // we are the parent
    sem_acquire($sem);
    msg_send($queue, 3, 'ping');
    sleep(1);
    sem_release($sem);
pcntl_wait($status); //Protect against Zombie children
} else {
    // we are the child
    msg_receive($queue, 0, $msgtype, 200, $message);
    sem_acquire($sem);
}
?>
--EXPECT--
--CREDITS--
Daniel Fahlke, flyingmana@googlemail.com
PHP Testfest Berlin 2010
