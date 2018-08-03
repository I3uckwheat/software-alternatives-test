<?php
namespace Email\V1\Rpc\Email;

class EmailControllerFactory
{
    public function __invoke($controllers)
    {
        return new EmailController();
    }
}
