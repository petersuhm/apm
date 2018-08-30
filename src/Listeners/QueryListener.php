<?php

namespace Vistik\Apm\Listeners;

use Vistik\Apm\Request\RequestContext;
use Illuminate\Database\Events\QueryExecuted;

class QueryListener
{
    /**
     * @var RequestContext
     */
    private $requestContext;

    /**
     * Create the event listener.
     *
     * @param RequestContext $requestContext
     */
    public function __construct(RequestContext $requestContext)
    {
        $this->requestContext = $requestContext;
    }

    /**
     * Handle the event.
     *
     * @param QueryExecuted $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        $this->requestContext->addQuery($event->sql, $event->time, $event->bindings, $event->connectionName);
    }
}
