<?php

namespace Jirafe\Bundle\MailChimpBundle\Connection;

use Jirafe\Bundle\MailChimpBundle\Request;
use Jirafe\Bundle\MailChimpBundle\Response;

/**
 * Interface that must be implemented by the connection classes
 */
interface ConnectionInterface
{
    /**
     * Executes the given request
     *
     * @param  Request $request
     *
     * @return Response
     */
    function execute(Request $request);
}
