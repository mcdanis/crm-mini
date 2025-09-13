<?php
namespace App\Core;

class Controller {
    
    /**
     * Memuat file view dari folder app/Views
     * 
     * @param string $view Nama file view (tanpa ekstensi .php)
     * @param array $data Array data yang akan diteruskan ke view
     * @return void
     */
    protected function view($view, $data = []) {
        // Extract data array menjadi variabel individual
        extract($data);
        
        // Path ke file view
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        
        // Cek apakah file view ada
        if (!file_exists($viewFile)) {
            throw new \Exception("View file tidak ditemukan: {$viewFile}");
        }
        
        // Include file view
        include $viewFile;
    }
    
    /**
     * Redirect ke URL tertentu
     * 
     * @param string $url URL tujuan
     * @return void
     */
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}
