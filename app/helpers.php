<?php

function handleActiveMenuItem($type)
{
    $map = [
        "tickets.create" => [
            "tickets.create",
            "tickets.store.success"
        ],
        "tickets.list" => [
            "tickets.list",
            "tickets.view"
        ]
    ];

    if (!isset($map[$type]))
        return false;

    $currentRouteName = \Route::currentRouteName();

    if (in_array($currentRouteName, $map[$type])) {
        return "active";
    }

    return false;

}

function currentConnection(): \App\Models\ConnectionMapping
{
    return session()->get("connection");
}
