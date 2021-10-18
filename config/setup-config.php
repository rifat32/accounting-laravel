<?php

return [
    "roles_permission" => [
        "admin" => [],
        "parchase officer" => [],
        "stock manager" => [],
        "accounts manager" => [],
        "wing manager" => []
    ],
    "roles" => [
        "admin",
        "parchase officer",
        "stock manager",
        "accounts manager",
        "wing manager"
    ],
    "permissions" => [
        // parchase
        "create requisition",
        "approve requisition",
        "cancel requisition",
        "create purchase",
        "purchase return",
        // inventory
        "check stock",
        "fixed asset stock",
        "category wise stock",
        "create stockout request",
        "approve stockout request",
        "deney stockout request",
        "add stockout",
        // account management
        "add credit voucher",
        "voucher approval",
        "add invoice",
        "add revenue",
        "approve revenue",
        "add debit voucher",
        "approve voucher",
        "add payment",
        "approve payment",
        // Fund Transfer
        "apply for fund request",
        "approve fund request",
        "cancel fund request",
        "add fund",
        "transfer fund",
        "add debit voucher",
        "approve voucher",
        "add payment",
        "approve payment",


    ],

];
