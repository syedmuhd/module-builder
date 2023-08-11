<?php

/**
 * Test that a command can create a model from the model.php.stub file
 */

it('can create a request file', function () {
    $this->artisan('builder:request', ['name' => 'Test', 'action' => 'Get'])->assertExitCode(0);
    expect(app_path('Http/Requests/Test/TestGetRequest.php'))->toBeFile();
})->group('unit')->skip();

afterEach(function () {
    // Clean up generated files
    unlink(app_path('Http/Requests/Test/TestGetRequest.php'));

    // Clean up generated directory
    rmdir(app_path('Http/Requests/Test'));
    rmdir(app_path('Http/Requests'));
});
