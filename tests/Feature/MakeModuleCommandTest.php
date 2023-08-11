<?php

it('can create a module files', function () {
    $this->artisan('builder:module', ['name' => 'Test'])->assertExitCode(0);
    expect(app_path('Http/Controllers/Test/TestController.php'))->toBeFile();
    expect(app_path('Models/Test/Test.php'))->toBeFile();
    expect(app_path('Repositories/Test/TestRepository.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestGetRequest.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestCreateRequest.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestUpdateRequest.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestDeleteRequest.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestDeleteManyRequest.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestRestoreRequest.php'))->toBeFile();
    expect(app_path('Http/Requests/Test/TestRestoreManyRequest.php'))->toBeFile();
    expect(base_path('routes/api/test.php'))->toBeFile();
    expect(app_path('Services/Test/TestService.php'))->toBeFile();
})->group('feature');

afterEach(function () {
    unlink(app_path('Http/Controllers/Test/TestController.php'));
    unlink(app_path('Models/Test/Test.php'));
    unlink(app_path('Repositories/Test/TestRepository.php'));
    unlink(app_path('Http/Requests/Test/TestGetRequest.php'));
    unlink(app_path('Http/Requests/Test/TestCreateRequest.php'));
    unlink(app_path('Http/Requests/Test/TestUpdateRequest.php'));
    unlink(app_path('Http/Requests/Test/TestDeleteRequest.php'));
    unlink(app_path('Http/Requests/Test/TestDeleteManyRequest.php'));
    unlink(app_path('Http/Requests/Test/TestRestoreRequest.php'));
    unlink(app_path('Http/Requests/Test/TestRestoreManyRequest.php'));
    unlink(base_path('routes/api/test.php'));
    unlink(app_path('Services/Test/TestService.php'));

    rmdir(app_path('Http/Controllers/Test'));
    rmdir(app_path('Models/Test'));
    rmdir(app_path('Repositories/Test'));
    rmdir(app_path('Repositories'));
    rmdir(app_path('Http/Requests/Test'));
    rmdir(app_path('Http/Requests'));
    rmdir(app_path('Services/Test'));
    rmdir(app_path('Services'));
    rmdir(base_path('routes/api'));
});
