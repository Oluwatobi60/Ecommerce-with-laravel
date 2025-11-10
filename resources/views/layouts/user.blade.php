<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHub - Your Online Store</title>
    <link rel="stylesheet" href="{{ asset('home_asset/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
     @livewireStyles
     <style>
        /* Ensure dropdown works properly */
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.show {
            display: block;
        }
        /* Hover effect for dropdown */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
        .dropdown-menu {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-top">
            <div class="container">
                <div>📞 Call us: +1 (555) 123-4567</div>
                <div>Free shipping on orders over $100!</div>
            </div>
        </div>
        
        <div class="header-main">
            <div class="container">
                <a href="index.html" class="logo">🛍️ ShopHub</a>

                <!-- Search Component -->
                 <div class="search-bar d-none d-md-block">
                    @livewire('ProductSearchComponent')
                </div>

                <div class="header-icons">
                    <button class="icon-btn">
                        👤
                    </button>
                    <button class="icon-btn">
                        ❤️
                        <span class="badge">0</span>
                    </button>
                    <!--cart link-->
                   @livewire('CartComponent')
                </div>
            </div>
        </div>
        
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#deals">
                                <i class="fas fa-box me-1"></i>Products
                            </a>
                        </li>
                        <li class="nav-item dropdown" onmouseover="this.querySelector('.dropdown-menu').classList.add('show')" onmouseout="this.querySelector('.dropdown-menu').classList.remove('show')">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="this.nextElementSibling.classList.toggle('show'); return false;">
                                <i class="fas fa-list me-1"></i>Categories
                            </a>
                            @php
                                $categories = App\Models\Category::all();
                            @endphp
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('home') }}#categories">
                                        <i class="fas fa-th me-2 text-primary"></i>
                                        <strong>All Categories</strong>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('productby.category', $category->category_name) }}">
                                            <i class="fas fa-{{ getCategoryIcon($category->category_name) }} me-2 text-muted"></i>
                                            {{ $category->category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#deals">
                                <i class="fas fa-tags me-1"></i>Deals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">
                                <i class="fas fa-envelope me-1"></i>Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to ShopHub</h1>
            <p>Discover amazing products at unbeatable prices</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="products.html" class="btn btn-primary">Shop Now</a>
                <a href="#categories" class="btn btn-secondary">Browse Categories</a>
            </div>
        </div>
    </section>

  

 

    <!-- Main Content -->
    <main>
        @yield('home')

         @livewire('FlashSellCountdownComponent')
    </main>



    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>🛍️ ShopHub</h3>
                    <p>Your trusted online shopping destination for quality products at amazing prices.</p>
                    <div class="social-links">
                        <a href="#" class="social-icon">f</a>
                        <a href="#" class="social-icon">t</a>
                        <a href="#" class="social-icon">i</a>
                        <a href="#" class="social-icon">y</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="cart.html">Shopping Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Shipping Info</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul>
                        <li>📧 support@shophub.com</li>
                        <li>📞 +1 (555) 123-4567</li>
                        <li>📍 123 Shop Street, NY 10001</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 ShopHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

<!-- Global Cart Handler -->
@livewire('GlobalCartButton')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@livewireScripts
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('home_asset/js/main.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Flash Sale Timer Script -->
    <script>
        // Flash Sale Countdown Timer
        function updateFlashSaleTimer() {
            // Set the date we're counting down to (24 hours from now)
            const countDownDate = new Date().getTime() + (24 * 60 * 60 * 1000);
            
            // Update the count down every 1 second
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                // Display the result in the elements
                document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
                document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
                document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
                document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
                
                // If the count down is finished, restart it
                if (distance < 0) {
                    clearInterval(timer);
                    updateFlashSaleTimer(); // Restart the timer
                }
            }, 1000);
        }
        
        // Start the timer when page loads
        document.addEventListener('DOMContentLoaded', updateFlashSaleTimer);
    </script>
    
    <!-- Initialize Bootstrap Dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
    
    <script>
        // Livewire Toast Notification Listener
        document.addEventListener('livewire:init', ()=>{
            window.Livewire.on('notify', ({title = 'Notification', type='info'}) => {
                console.log('Livewire Notify received', title, type);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: type,
                    title: title,
                    showConfirmButton:false,
                    timer: 2500,
                    timerProgressBar: true,
                })
            })
        })
    </script>
    
</body>
</html>
