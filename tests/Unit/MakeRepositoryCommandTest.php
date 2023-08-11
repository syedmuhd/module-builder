<?php

/**
 * Test that a command can create a model from the model.php.stub file
 */

it('can create a repository file', function () {
    $this->artisan('builder:repository', ['name' => 'Test'])->assertExitCode(0);
    expect(app_path('Repositories/Test/TestRepository.php'))->toBeFile();
})->group('unit')->skip();

afterEach(function () {
    // Clean up generated files
    unlink(app_path('Repositories/Test/TestRepository.php'));

    // Clean up generated directory
    rmdir(app_path('Repositories/Test'));

    // Clean up generated directory
    rmdir(app_path('Repositories'));
});
