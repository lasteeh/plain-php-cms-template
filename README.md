# Creating a Simple MVC App with PHP

This guide provides basic and simple steps to create a simple MVC (Model-View-Controller) app using PHP. The examples below will help you understand the process.

## Step 0: Setting Up the App Directory

- Define the root directory path of the project using `__DIR__`.
- Define the path/URL of the index page relative to the root directory using `str_replace('/index.php', '', $_SERVER['PHP_SELF'])`.
- Define the root URL using `$_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . INDEX_PATH`.
- Make a custom server request URI if the app is not in the root directory of the server using `$_SERVER['REQUEST_URI']`.

## Step 1: Creating a Funnel to the App

- Create an index page (`index.php`) to funnel every request to it.
- Create a `.htaccess` file for funneling rules and filter every URL request towards the index page.

## Step 2: Creating Routes for Request URI Matching

- Create `routes.php` and define the URL, HTTP method, and controller/action pair for each route. For example: `'url' => ['GET' => ['controller' => 'controller@action']],`.

## Step 3: Creating Controllers

- Create controllers to serve requests based on the URL to control the app. For example, if the URI is '/login', then create `session_controller.php`.
- Each controller file (e.g., `session_controller.php`) should contain a class (e.g., `SessionController`) and CRUD action functions such as `new()` and `create()`.

## Step 4: Creating Views

- Create view pages for the controllers to serve. For example, you can render views like this: `render('views/sessions/index.php')`.
