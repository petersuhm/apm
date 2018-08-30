<?php

namespace Vistik\Apm\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RequestContext
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;
    /**
     * @var array
     */
    private $queries = [];
    private $startedAt;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->startedAt = Carbon::now(config('apm.timezone', 'UTC'));
    }

    public function getId(): string
    {
        return $this->id->toString();
    }

    public function getStartedAt(): Carbon
    {
        return $this->startedAt;
    }

    public function addQuery(string $query, float $time, array $bindings, string $connectionName)
    {
        $query = $this->attachBindings($query, $bindings);

        $this->queries[] = [
            'query'      => $query,
            'time_ms'    => $time,
            'bindings'   => $bindings,
            'connection' => $connectionName
        ];
    }

    public function getQueries(): array
    {
        return $this->queries;
    }

    /**
     * @param string $query
     * @param array $bindings
     * @return mixed|string
     */
    protected function attachBindings(string $query, array $bindings)
    {
        if (!config('apm.showBindings', false)) {
            return $query;
        }

        if (count($bindings) == 0) {
            return $query;
        }

        $sql = str_replace(['%', '?'], ['%%', "%s"], $query);

        $cleanedBindings = [];
        foreach ($bindings as $key => $binding) {
            $cleanedBindings[$key] = DB::connection()->getPdo()->quote($binding);
        }

        $full_sql = vsprintf($sql, $cleanedBindings);

        return $full_sql;
    }
}
