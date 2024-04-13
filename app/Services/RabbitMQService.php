<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private $connection;
    private $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(env('MQ_HOST'), env('MQ_PORT'), env('MQ_USER'), env('MQ_PASS'), env('MQ_VHOST'));
        $this->channel = $this->connection->channel();
        $this->channel->exchange_declare('test_exchange', 'direct', false, false, false);
        $this->channel->queue_declare('test_queue', false, false, false, false);
        $this->channel->queue_bind('test_queue', 'test_exchange', 'test_key');
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, 'test_exchange', 'test_key');
        echo " [x] Sent $message to test_exchange / test_queue.\n";
    }

    /**
     * @throws \ErrorException
     */
    public function consume()
    {
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };
        $this->channel->basic_consume('test_queue', '', false, true, false, false, $callback);
        echo 'Waiting for new message on test_queue', " \n";
//        while ($this->channel->basic_consume()) {
//            $this->channel->wait();
//        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
