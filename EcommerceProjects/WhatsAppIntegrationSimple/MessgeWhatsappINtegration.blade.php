# **Laravel + WhatsApp Order Integration**

**Objective:**
Create a free Laravel project where users can order products (like shared hosting) and send the order details to the
admin via WhatsApp manually. This is semi-automated and free.

---

## **Step 1: Install Laravel**

Run the following command to create a new Laravel project:

```bash
composer create-project laravel/laravel laravel-whatsapp-order
cd laravel-whatsapp-order
php artisan serve
```

The project will be accessible at `http://127.0.0.1:8000`.

---

## **Step 2: Create Product Model**

Generate a Product model with migration:

```bash
php artisan make:model Product -m
```

Edit the migration file `database/migrations/xxxx_create_products_table.php`:

```php
Schema::create('products', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->text('description');
$table->decimal('price', 8, 2);
$table->timestamps();
});
```

Run the migration:

```bash
php artisan migrate
```

---

## **Step 3: Seed Sample Products**

In `database/seeders/DatabaseSeeder.php`, add:

```php
use App\Models\Product;

Product::create([
'name' => 'Shared Hosting Basic',
'description' => '1GB Storage, 10GB Bandwidth',
'price' => 5.99
]);

Product::create([
'name' => 'Shared Hosting Premium',
'description' => '10GB Storage, 100GB Bandwidth',
'price' => 15.99
]);
```

Run the seeder:

```bash
php artisan db:seed
```

---

## **Step 4: Create Controller & Routes**

Generate controller:

```bash
php artisan make:controller ProductController
```

Add routes in `routes/web.php`:

```php
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/order/{product}', [ProductController::class, 'order']);
```

In `app/Http/Controllers/ProductController.php`:

```php
use App\Models\Product;

class ProductController extends Controller
{
public function index() {
$products = Product::all();
return view('products.index', compact('products'));
}

public function order(Product $product) {
// Admin WhatsApp number
$adminNumber = '9779812345678'; // Replace with your number

// Pre-filled message
$message = "Hello, I want to order: " . $product->name . "\nDescription: " . $product->description . "\nPrice: $" .
$product->price;

// WhatsApp URL
$url = "https://wa.me/$adminNumber?text=" . urlencode($message);

// Redirect user to WhatsApp chat
return redirect($url);
}
}
```

---

## **Step 5: Create Blade View**

Create `resources/views/products/index.blade.php`:

```html
<!DOCTYPE html>
<html>

<head>
    <title>Products</title>
</head>

<body>
    <h1>Products</h1>
    <ul>
        @foreach($products as $product)
        <li>
            <h3>{{ $product->name }} - ${{ $product->price }}</h3>
            <p>{{ $product->description }}</p>
            <a href="{{ url('/order/'.$product->id) }}">Order via WhatsApp</a>
        </li>
        @endforeach
    </ul>
</body>

</html>
```

---

## **Step 6: Test the Project**

1. Run the Laravel server:

```bash
php artisan serve
```

2. Open the browser at `http://127.0.0.1:8000/`.
3. Click **Order via WhatsApp** on any product.
4. WhatsApp (Web or Mobile) will open with a **pre-filled message** ready to send to the admin.

---

## **Step 7: Notes & Tips**

* **Free & Semi-Automatic:** Uses WhatsApp link (`wa.me`) – no paid API needed.
* **Custom Messages:** You can add user inputs like name, email, or quantity to the message before redirecting.
* **Shared Hosting/Other Products:** You can expand the `products` table to include categories or multiple options.
* **Deployment:** Can be hosted on any free/shared hosting that supports Laravel (like 000webhost, InfinityFree, or your
local XAMPP).