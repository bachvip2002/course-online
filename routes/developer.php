<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('clear-cache-all', function () {
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});

Route::get('session-clear', function () {
    session()->flush();
    return "session is cleared";
});

Route::get('clear-cache-route', function () {
    Artisan::call('route:clear');
    return "Cache route is cleared";
});

Route::get('clear-cache-config', function () {
    Artisan::call('config:clear');
    return "Cache config is cleared";
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return "Storage is linked";
});

Route::get('migrate-refresh/{path?}', function ($path = null) {
    if ($path != null) {
        Artisan::call('migrate:refresh', ['path' => $path]);
    }
    Artisan::call('migrate:refresh');
    return "run migrate refresh success";
});

Route::get('migrate-reset', function () {
    Artisan::call('migrate:reset');
    return 'success';
});

Route::get('migrate', function () {
    Artisan::call('migrate');
    return 'success';
});

Route::get('db-seed', function () {
    Artisan::call('db:seed');
    return 'success';
});

Route::get('create-model/{model}', function ($model) {
    Artisan::call("make:model $model --migration");
    return 'success';
});

Route::get('route-list', function () {
    $routeCollection = Route::getRoutes();
    echo "<table style='width:100%'>";
    echo "<tr>";
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" . $value->uri() . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
});

Route::get('php-info', function () {
    return phpinfo();
});

Route::get('composer-update', function () {
    shell_exec('composer update');
    return phpinfo();
});

Route::get('test', function () {
    $a = Cache::get('name');
    return 'success';
});

Route::get('log-php', function () {
    $logFilePath = 'C:\my-softwares\laragon\tmp\php_errors.log';
    $logContent = file_get_contents($logFilePath);
    echo '<pre>' . htmlspecialchars($logContent) . '</pre>';
});

Route::get('menu-command-line', function () {
    return view('command.menu');
});

Route::get('auto-notepad', function () {
    $shell = new COM('WScript.Shell');

    $exec = $shell->Run('notepad.exe', 1, false);

    if ($exec == 0) {
        echo 'Notepad đã được mở thành công.<br>';
        sleep(2);
        $shell->SendKeys("Hello, this is a test text.");

        $shell->SendKeys("%fa"); // Alt + F, chọn Save As
        sleep(1); // Đợi cho hộp thoại Save As xuất hiện
        $shell->SendKeys("example.txt");
        sleep(1); // Đợi cho hộp thoại Save As hoàn thành
        $shell->SendKeys("~"); // Enter, để lưu tệp tin
        echo 'Văn bản đã được ghi vào Notepad và lưu thành công.';
    } else {
        echo 'Có lỗi khi mở Notepad.';
    }
});

Route::get('info-opermon', function () {
    // // Tạo đối tượng COM để tương tác với PerfMon
    // $perfmon = new COM('WbemScripting.SWbemLocator', null, CP_UTF8);

    // // Kết nối đến WMI (Windows Management Instrumentation)
    // $wmi = $perfmon->ConnectServer('.', 'root\\cimv2');

    // // Truy vấn lấy thông tin về CPU Usage
    // $queryCPU = "SELECT * FROM Win32_PerfFormattedData_PerfOS_Processor WHERE Name='_Total'";
    // $cpuData = $wmi->ExecQuery($queryCPU);

    // // Truy vấn lấy thông tin về Memory Usage
    // $queryMemory = "SELECT * FROM Win32_PerfFormattedData_PerfOS_Memory";
    // $memoryData = $wmi->ExecQuery($queryMemory);

    // // Truy vấn lấy thông tin về Disk Usage
    // $queryDisk = "SELECT * FROM Win32_PerfFormattedData_PerfDisk_PhysicalDisk WHERE Name='_Total'";
    // $diskData = $wmi->ExecQuery($queryDisk);

    // // In thông tin về CPU Usage
    // echo "CPU Usage:\n";
    // foreach ($cpuData as $cpu) {
    //     echo '  Percent Processor Time: ' . $cpu->PercentProcessorTime . '%' . PHP_EOL;
    // }

    // // In thông tin về Memory Usage
    // echo "\nMemory Usage:\n";
    // foreach ($memoryData as $memory) {
    //     echo '  Available Bytes: ' . $memory->AvailableBytes . ' bytes' . PHP_EOL;
    // }

    // // In thông tin về Disk Usage
    // echo "\nDisk Usage:\n";
    // foreach ($diskData as $disk) {
    //     echo '  Percent Disk Time: ' . $disk->PercentDiskTime . '%' . PHP_EOL;
    // }

    $computerName = 'localhost'; // Tên máy tính hoặc địa chỉ IP của máy tính cần giám sát
    $namespace = 'root\\cimv2'; // Namespace chứa các lớp WMI

    try {
        // Kết nối đến WMI
        $wmi = new COM("winmgmts://$computerName/$namespace");

        // Truy vấn thông tin về bộ nhớ RAM
        $memoryQuery = "SELECT TotalVisibleMemorySize, FreePhysicalMemory FROM Win32_OperatingSystem";
        $memoryData = $wmi->ExecQuery($memoryQuery);

        foreach ($memoryData as $memory) {
            echo 'Total Memory: ' . $memory->TotalVisibleMemorySize . ' KB' . PHP_EOL . '<br>';
            echo 'Free Memory: ' . $memory->FreePhysicalMemory . ' KB' . PHP_EOL . '<br>';
        }

        // Truy vấn danh sách quy trình
        $processQuery = "SELECT ProcessId, Name FROM Win32_Process";
        $processData = $wmi->ExecQuery($processQuery);

        echo 'Running Processes:' . PHP_EOL . '<br>';
        foreach ($processData as $process) {
            echo $process->Name . ' (PID: ' . $process->ProcessId . ')' . PHP_EOL . '<br>';
        }
    } catch (Exception $e) {
        echo 'Lỗi: ' . $e->getMessage();
    }
});
