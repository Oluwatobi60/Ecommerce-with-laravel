// Cart Management
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Flash Sale Timer
let flashSaleEndTime;

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    
    // Initialize flash sale timer
    initFlashSaleTimer();
    
    // If on cart page, render cart items
    if (document.querySelector('.cart-items')) {
        renderCartItems();
    }
    
    // Add to cart buttons
    const addToCartButtons = document.querySelectorAll('.btn-add-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', handleAddToCart);
    });
    
    // Search functionality
    const searchButton = document.querySelector('.search-bar button');
    const searchInput = document.querySelector('.search-bar input');
    
    if (searchButton && searchInput) {
        searchButton.addEventListener('click', handleSearch);
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                handleSearch();
            }
        });
    }
});

// Add to Cart Handler
function handleAddToCart(e) {
    const productCard = e.target.closest('.product-card');
    const product = {
        id: productCard.dataset.productId || Date.now(),
        title: productCard.querySelector('.product-title').textContent,
        price: parseFloat(productCard.querySelector('.price-current').textContent.replace('$', '')),
        image: productCard.querySelector('.product-image').src,
        quantity: 1
    };
    
    addToCart(product);
    showNotification('Product added to cart!');
}

// Add Product to Cart
function addToCart(product) {
    const existingProduct = cart.find(item => item.id == product.id);
    
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push(product);
    }
    
    saveCart();
    updateCartCount();
}

// Remove from Cart
function removeFromCart(productId) {
    cart = cart.filter(item => item.id != productId);
    saveCart();
    updateCartCount();
    renderCartItems();
    showNotification('Product removed from cart');
}

// Update Quantity
function updateQuantity(productId, quantity) {
    const product = cart.find(item => item.id == productId);
    
    if (product) {
        if (quantity <= 0) {
            removeFromCart(productId);
        } else {
            product.quantity = quantity;
            saveCart();
            renderCartItems();
        }
    }
}

// Save Cart to LocalStorage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Update Cart Count Badge
function updateCartCount() {
    const cartBadge = document.querySelector('.cart-count');
    if (cartBadge) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartBadge.textContent = totalItems;
        cartBadge.style.display = totalItems > 0 ? 'block' : 'none';
    }
}

// Render Cart Items on Cart Page
function renderCartItems() {
    const cartItemsContainer = document.querySelector('.cart-items');
    const cartSummary = document.querySelector('.cart-summary');
    
    if (!cartItemsContainer) return;
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h2>Your cart is empty</h2>
                <p>Add some products to your cart and they will appear here.</p>
                <a href="index.html" class="btn btn-primary">Continue Shopping</a>
            </div>
        `;
        if (cartSummary) {
            cartSummary.style.display = 'none';
        }
        return;
    }
    
    if (cartSummary) {
        cartSummary.style.display = 'block';
    }
    
    let cartHTML = '';
    let subtotal = 0;
    
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        cartHTML += `
            <div class="cart-item" data-product-id="${item.id}">
                <img src="${item.image}" alt="${item.title}" class="cart-item-image">
                <div class="cart-item-details">
                    <h3 class="cart-item-title">${item.title}</h3>
                    <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                    <div class="quantity-control">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                        <input type="number" class="quantity-input" value="${item.quantity}" 
                               onchange="updateQuantity(${item.id}, parseInt(this.value))" min="1">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                </div>
                <button class="cart-item-remove" onclick="removeFromCart(${item.id})">×</button>
            </div>
        `;
    });
    
    cartItemsContainer.innerHTML = cartHTML;
    
    // Update Summary
    const shipping = subtotal > 100 ? 0 : 10;
    const tax = subtotal * 0.08;
    const total = subtotal + shipping + tax;
    
    document.querySelector('.subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.querySelector('.shipping').textContent = shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`;
    document.querySelector('.tax').textContent = `$${tax.toFixed(2)}`;
    document.querySelector('.total').textContent = `$${total.toFixed(2)}`;
}

// Search Handler
function handleSearch() {
    const searchInput = document.querySelector('.search-bar input');
    const searchTerm = searchInput.value.trim().toLowerCase();
    
    if (searchTerm) {
        // In a real application, this would filter products or redirect to search results
        console.log('Searching for:', searchTerm);
        showNotification(`Searching for "${searchTerm}"...`);
        
        // Filter products on page if they exist
        const productCards = document.querySelectorAll('.product-card');
        if (productCards.length > 0) {
            productCards.forEach(card => {
                const title = card.querySelector('.product-title').textContent.toLowerCase();
                const category = card.querySelector('.product-category').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || category.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    }
}

// Notification System
function showNotification(message, type = 'success') {
    // Remove existing notification
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: ${type === 'success' ? '#10b981' : '#ef4444'};
        color: white;
        padding: 15px 25px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 10000;
        animation: slideIn 0.3s ease-out;
    `;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Checkout Handler
function handleCheckout() {
    if (cart.length === 0) {
        showNotification('Your cart is empty', 'error');
        return;
    }
    window.location.href = 'checkout.html';
}

// Form Validation for Checkout
function validateCheckoutForm(form) {
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.style.borderColor = '#ef4444';
            isValid = false;
        } else {
            field.style.borderColor = '#e5e7eb';
        }
    });
    
    return isValid;
}

// Place Order
function placeOrder(e) {
    e.preventDefault();
    
    const form = e.target;
    if (!validateCheckoutForm(form)) {
        showNotification('Please fill in all required fields', 'error');
        return;
    }
    
    // In a real application, this would send data to a server
    showNotification('Order placed successfully!');
    
    // Clear cart
    cart = [];
    saveCart();
    updateCartCount();
    
    // Redirect to confirmation page (or show confirmation)
    setTimeout(() => {
        alert('Thank you for your order! Order confirmation sent to your email.');
        window.location.href = 'index.html';
    }, 1500);
}

// Wishlist functionality (basic implementation)
let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

function toggleWishlist(productId) {
    const index = wishlist.indexOf(productId);
    
    if (index > -1) {
        wishlist.splice(index, 1);
        showNotification('Removed from wishlist');
    } else {
        wishlist.push(productId);
        showNotification('Added to wishlist');
    }
    
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
    updateWishlistUI();
}

function updateWishlistUI() {
    const wishlistButtons = document.querySelectorAll('.btn-wishlist');
    wishlistButtons.forEach(button => {
        const productId = button.closest('.product-card').dataset.productId;
        if (wishlist.includes(productId)) {
            button.style.backgroundColor = '#ef4444';
            button.style.color = 'white';
        } else {
            button.style.backgroundColor = '#f9fafb';
            button.style.color = '#1f2937';
        }
    });
}

// Product Image Gallery (for product detail page)
function changeMainImage(thumbnail) {
    const mainImage = document.querySelector('.main-product-image');
    if (mainImage) {
        mainImage.src = thumbnail.src;
    }
}

// Quantity selector for product detail page
function initializeProductQuantity() {
    const quantityInput = document.querySelector('.product-quantity-input');
    const minusBtn = document.querySelector('.quantity-minus');
    const plusBtn = document.querySelector('.quantity-plus');
    
    if (minusBtn && plusBtn && quantityInput) {
        minusBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        plusBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    }
}

// Mobile menu toggle
function toggleMobileMenu() {
    const nav = document.querySelector('nav ul');
    if (nav) {
        nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
    }
}

// Initialize product quantity controls if on product detail page
if (document.querySelector('.product-quantity-input')) {
    initializeProductQuantity();
}

// Flash Sale Timer Functions
function initFlashSaleTimer() {
    // Check if flash sale timer elements exist on the page
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    
    if (!hoursEl || !minutesEl || !secondsEl) {
        return; // Timer elements not on this page
    }
    
    // Get stored end time or create new one
    const storedEndTime = localStorage.getItem('flashSaleEndTime');
    
    if (storedEndTime && new Date(storedEndTime) > new Date()) {
        flashSaleEndTime = new Date(storedEndTime);
    } else {
        // Set flash sale to end in 6 hours from now
        flashSaleEndTime = new Date();
        flashSaleEndTime.setHours(flashSaleEndTime.getHours() + 6);
        localStorage.setItem('flashSaleEndTime', flashSaleEndTime.toISOString());
    }
    
    // Update timer immediately
    updateFlashSaleTimer();
    
    // Update timer every second
    setInterval(updateFlashSaleTimer, 1000);
}

function updateFlashSaleTimer() {
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    
    if (!hoursEl || !minutesEl || !secondsEl) {
        return;
    }
    
    const now = new Date();
    const timeLeft = flashSaleEndTime - now;
    
    if (timeLeft <= 0) {
        // Flash sale ended, reset for next sale
        flashSaleEndTime = new Date();
        flashSaleEndTime.setHours(flashSaleEndTime.getHours() + 6);
        localStorage.setItem('flashSaleEndTime', flashSaleEndTime.toISOString());
        
        hoursEl.textContent = '06';
        minutesEl.textContent = '00';
        secondsEl.textContent = '00';
        
        showNotification('Flash Sale has ended! New sale starting now!', 'success');
        return;
    }
    
    // Calculate hours, minutes, seconds
    const hours = Math.floor(timeLeft / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
    
    // Update display with leading zeros
    hoursEl.textContent = String(hours).padStart(2, '0');
    minutesEl.textContent = String(minutes).padStart(2, '0');
    secondsEl.textContent = String(seconds).padStart(2, '0');
    
    // Add urgency animation when less than 1 hour left
    if (hours === 0 && minutes < 60) {
        hoursEl.style.color = '#ff6b6b';
        minutesEl.style.color = '#ff6b6b';
        secondsEl.style.color = '#ff6b6b';
    } else {
        hoursEl.style.color = 'white';
        minutesEl.style.color = 'white';
        secondsEl.style.color = 'white';
    }
}
