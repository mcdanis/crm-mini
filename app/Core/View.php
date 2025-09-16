<?php
namespace App\Core;

class View {
    public static function render(string $view, array $data = []) {
        $viewPath = __DIR__ . '/../Views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View {$view} tidak ditemukan.");
        }

        // Ekstrak variabel untuk digunakan di view
        extract($data);

        require $viewPath;
    }
}
