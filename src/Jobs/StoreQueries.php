<?php

namespace Vistik\Apm\Jobs;

use Vistik\Apm\Query;
use Vistik\Apm\Request\RequestContext;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class StoreQueries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var RequestContext
     */
    private $requestContext;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RequestContext $requestContext)
    {
        $this->requestContext = $requestContext;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $queries = $this->requestContext->getQueries();

        foreach ($queries as $query) {
            Query::create([
                'sql'        => $query['query'],
                'time_ms'    => $query['time_ms'],
                'connection' => $query['connection'],
                'request_id' => $this->requestContext->getId(),
            ]);
        }
    }
}
