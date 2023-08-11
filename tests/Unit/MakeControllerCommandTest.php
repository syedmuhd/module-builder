<?php

/**
 * Test that a command can create a controller from the controller.php.stub file
 */

it('can create a controller file', function () {
    $this->artisan('builder:controller', ['name' => 'Test'])->assertExitCode(0);
    expect(app_path('Http/Controllers/Test/TestController.php'))->toBeFile();
})->group('unit')->skip();

afterEach(function () {
    // Clean up generated files
    unlink(app_path('Http/Controllers/Test/TestController.php'));

    // Delete the directory
    rmdir(app_path('Http/Controllers/Test'));
});
