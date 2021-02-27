<?php

namespace App\Http\Helpers;


use App\Models\ConnectionMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseHelper
{

    public static function getInstance(): DatabaseHelper
    {
        return new self();
    }

    public function initConnections(ConnectionMapping $model)
    {
        session()->put("connection", $model);
        $asaasDatabaseName = "baseet_{$model->asaas_office_id}";
        $maintenanceDatabaseName = $model->maintenance_db_name;
        config([
            "database.connections.asaas" => [
                'driver' => 'mysql',
                'url' => env('AS_DATABASE_URL'),
                'host' => env('AS_DB_HOST'),
                'port' => env('AS_DB_PORT'),
                'database' => $asaasDatabaseName,
                'username' => env('AS_DB_USERNAME'),
                'password' => env('AS_DB_PASSWORD'),
                'unix_socket' => env('AS_DB_SOCKET'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
            ],
            "database.connections.maintenance" => [
                'driver' => 'mysql',
                'url' => env('MA_DATABASE_URL'),
                'host' => env('MA_DB_HOST'),
                'port' => env('MA_DB_PORT'),
                'database' => $maintenanceDatabaseName,
                'username' => env('MA_DB_USERNAME'),
                'password' => env('MA_DB_PASSWORD'),
                'unix_socket' => env('MA_DB_SOCKET'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
            ]
        ]);
        // test connections.
        $this->testConnection("asaas", "tbl_contract");
        $this->testConnection("maintenance", "maintenance_tickets");
    }

    public function testConnection($connectionName, $testCaseTable)
    {
        try {
            if (DB::connection($connectionName)->getDatabaseName()) {
                // tbl_contract is our test case.
                if (!Schema::connection($connectionName)->hasTable($testCaseTable)) {
//                    abort(404);
                }
            }
        } catch (\Exception $exception) {
//            abort(404);
        }

    }

}
