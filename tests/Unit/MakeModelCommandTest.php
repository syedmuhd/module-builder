<?php

/**
 * Test that a command can create a model from the model.php.stub file
 */

it('can create a model file', function () {
    $this->artisan('builder:model', ['name' => 'Test'])->assertExitCode(0);
    expect(app_path('Models/Test/Test.php'))->toBeFile();
})->group('unit')->skip();

afterEach(function () {
    // Clean up generated files
    unlink(app_path('Models/Test/Test.php'));

    // Clean up generated directory
    rmdir(app_path('Models/Test'));
});
