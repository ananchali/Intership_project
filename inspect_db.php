<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\PaymentMethod;
use App\Models\Order;

$pm = PaymentMethod::find('6aa1996c907f759d9306cb0c');
echo 'PAYMENT METHOD: ' . ($pm?->name ?? 'NOT FOUND') . ' | applicable_to=' . ($pm->applicable_to ?? '-') . PHP_EOL;
echo 'ALL PAYMENT METHODS:' . PHP_EOL;
foreach (PaymentMethod::all() as $p) {
    echo '  ' . $p->_id . ' | ' . $p->name . ' | active=' . ($p->is_active ? 'yes' : 'no') . ' | account=' . ($p->account_number ?? '-') . PHP_EOL;
}

$o = Order::find('6aa19ef6907f759d9306cb10');
echo PHP_EOL . 'ORDER total=' . $o->total_amount . ' currency=' . $o->currency . ' order_number=' . $o->order_number . PHP_EOL;