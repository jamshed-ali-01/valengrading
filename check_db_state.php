<?php

use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$servicesExists = Schema::hasTable('services');
$serviceLevelsHasSubmissionType = Schema::hasColumn('service_levels', 'submission_type_id');
$serviceLevelsHasServiceId = Schema::hasColumn('service_levels', 'service_id');

echo "Services Table Exists: " . ($servicesExists ? 'YES' : 'NO') . "\n";
echo "submission_type_id Exists: " . ($serviceLevelsHasSubmissionType ? 'YES' : 'NO') . "\n";
echo "service_id Exists: " . ($serviceLevelsHasServiceId ? 'YES' : 'NO') . "\n";
