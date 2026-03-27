<?php
/* START: Manual PSR-4 Autoloader Section */

spl_autoload_register(function ($class) {
    // Prefix for our application namespace
    $prefix = 'App\\';
    
    // Base directory for the namespace prefix
    $base_dir = __DIR__ . '/';

    // Does the class use the prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace namespace separators with directory separators, append .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/* END: Manual PSR-4 Autoloader Section */
?>
