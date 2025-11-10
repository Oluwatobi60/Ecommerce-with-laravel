<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHub - Your Online Store</title>
    <link rel="stylesheet" href="{{ asset('home_asset/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                
                <div class="search-bar">
                    <input type="text" placeholder="Search for products...">
                    <button>Search</button>
                </div>
                
                <div class="header-icons">
                    <button class="icon-btn">
                        👤
                    </button>
                    <button class="icon-btn">
                        ❤️
                        <span class="badge">0</span>
                    </button>
                    <a href="cart.html" class="icon-btn">
                        🛒
                        <span class="badge cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
        
        <nav>
            <div class="container">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="#categories">Categories</a></li>
                    <li><a href="#deals">Deals</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
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

  

    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <h2 class="section-title">Shop by Category</h2>
            <div class="category-grid">
                <div class="category-card">
                    <div class="category-icon">👕</div>
                    <h3>Fashion</h3>
                    <p>Trendy Clothes</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">💻</div>
                    <h3>Electronics</h3>
                    <p>Latest Tech</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🏠</div>
                    <h3>Home & Living</h3>
                    <p>Decor & More</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">📚</div>
                    <h3>Books</h3>
                    <p>Reading Materials</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">⚽</div>
                    <h3>Sports</h3>
                    <p>Fitness & Gear</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🎨</div>
                    <h3>Art & Craft</h3>
                    <p>Creative Supplies</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main>
        {{ $slot }}


        <!-- flash sale section -->
<section class="flash-sale bg-gradient py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <!-- Flash Sale Text -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="text-white">
                    <h2 class="display-5 fw-bold mb-3">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Flash Sale
                    </h2>
                    <p class="lead mb-0">Don't miss out on our limited-time offers!</p>
                    <small class="text-light opacity-75">Hurry up! Limited stock available</small>
                </div>
            </div>
            
            <!-- Timer -->
            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex justify-content-center justify-content-md-start">
                    <div class="row g-2 text-center" id="flash-sale-timer">
                        <!-- Days -->
                        <div class="col-3">
                            <div class="bg-white rounded-3 p-3 shadow-sm">
                                <div class="timer-value display-6 fw-bold text-primary" id="days">00</div>
                                <small class="text-muted fw-semibold">DAYS</small>
                            </div>
                        </div>
                        
                        <!-- Hours -->
                        <div class="col-3">
                            <div class="bg-white rounded-3 p-3 shadow-sm">
                                <div class="timer-value display-6 fw-bold text-primary" id="hours">00</div>
                                <small class="text-muted fw-semibold">HOURS</small>
                            </div>
                        </div>
                        
                        <!-- Minutes -->
                        <div class="col-3">
                            <div class="bg-white rounded-3 p-3 shadow-sm">
                                <div class="timer-value display-6 fw-bold text-primary" id="minutes">00</div>
                                <small class="text-muted fw-semibold">MINS</small>
                            </div>
                        </div>
                        
                        <!-- Seconds -->
                        <div class="col-3">
                            <div class="bg-white rounded-3 p-3 shadow-sm">
                                <div class="timer-value display-6 fw-bold text-danger" id="seconds">00</div>
                                <small class="text-muted fw-semibold">SECS</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="col-lg-3 text-center text-lg-end">
                <a href="#products" class="btn btn-warning btn-lg px-4 py-3 fw-bold shadow-lg">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Shop Now
                </a>
                <div class="mt-2">
                    <small class="text-light opacity-75">
                        <i class="fas fa-fire text-warning me-1"></i>
                        Hot Deals Inside!
                    </small>
                </div>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="bg-white bg-opacity-25 rounded-pill p-1">
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" 
                             role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2 px-2">
                        <small class="text-white opacity-75">
                            <i class="fas fa-clock me-1"></i>Sale Progress
                        </small>
                        <small class="text-white opacity-75">75% Complete</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

    <script src="{{ asset('home_asset/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
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
</body>
</html>
