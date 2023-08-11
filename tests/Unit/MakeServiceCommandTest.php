<?php

/**
 * Test that a command can create a model from the model.php.stub file
 */

it('can create a service file', function () {
    $this->artisan('builder:service', ['name' => 'Test'])->assertExitCode(0);
    expect(app_path('Services/Test/TestService.php'))->toBeFile();
})->group('unit')->skip();

afterEach(function () {
    // Clean up generated files
    unlink(app_path('Services/Test/TestService.php'));

    // Clean up generated directory
    rmdir(app_path('Services/Test'));
    rmdir(app_path('Services'));
});
