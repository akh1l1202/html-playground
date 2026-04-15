# 🛠 Setup & Troubleshooting

## 📦 The `vendor/` Directory
The `vendor/` directory is **not committed** to the repository because it is generated automatically.

To install dependencies and generate it, run:

    composer install

---

## ❌ Resolving Errors (Class Not Found)

If the test suite shows errors instead of **OK**, follow the steps below.

---

### 1️⃣ Configure the Namespace

Open the `composer.json` file in the project root.  
Ensure it tells Composer where to find the `App` namespace.

    {
        "autoload": {
            "psr-4": {
                "App\\": "includes/"
            }
        },
        "require-dev": {
            "phpunit/phpunit": "^11.5"
        }
    }

---

### 2️⃣ Rebuild the Autoload Map

Whenever you add a new namespace or class file, regenerate Composer’s autoload map:

    composer dump-autoload

---

### 3️⃣ Rerun the Test Suite

Verify that the issue is resolved by running:

    ./vendor/bin/phpunit tests

---

## 💡 Why This Happens

This project uses **PSR-4 Autoloading**, which allows PHP classes to be loaded automatically without using `require_once`.

Composer maps the `App\` namespace to the `includes/` directory.  
If `composer dump-autoload` is not run after changes, PHPUnit cannot locate the class files, resulting in a **"Class not found"** error.
