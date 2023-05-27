<!DOCTYPE html>
<html data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="navbar bg-base-100 shadow-xl">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl">
                Ludo King
            </a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1 z-40">
                <li tabindex="0">
                    <a href="./index.php">
                        Master
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                        </svg>
                    </a>
                    <ul class="p-2 bg-base-100 z-100">
                        <li><a href="./customer.php">Customer</a></li>
                        <li><a href="./game.php">Game</a></li>
                    </ul>
                </li>
                <li><a href="./report.php">Report</a></li>
                <li><a href="./ledger.php">Ledger</a></li>
                <li><a href="./daybook.php">Day Book</a></li>
                <li><a href="./exit.php">Exit</a></li>
            </ul>
        </div>
    </div>