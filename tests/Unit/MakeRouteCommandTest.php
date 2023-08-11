<?php

/**
 * Test that a command can create a model from the model.php.stub file
 */

it('can create a route file', function () {
    $this->artisan('builder:route', ['name' => 'Test'])->assertExitCode(0);
    expect(base_path('routes/api/test.php'))->toBeFile();
})->group('unit')->skip();

afterEach(function () {
    // Clean up generated files
    unlink(base_path('routes/api/test.php'));

    // Clean up generated directory
    rmdir(base_path('routes/api'));
});
