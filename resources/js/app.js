// public/js/app.js

// Global Variables
window.App = {
    csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
    baseUrl: window.location.origin,
    cartCount: 0,
    user: null
};

// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Laravel E-Commerce App Loaded');
    
    // Initialize components
    initCart();
    initModals();
    initForms();
    initNavigation();
    
    // Update cart count if exists
    updateCartCount();
});

// Initialize Cart Functions
function initCart() {
    // Load cart from localStorage
    const savedCart = localStorage.getItem('ecommerce_cart');
    if (savedCart) {
        window.App.cart = JSON.parse(savedCart);
        window.App.cartCount = window.App.cart.items?.length || 0;
    }
}

// Update Cart Count in Navbar
function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = window.App.cartCount;
        
        // Show/hide badge
        if (window.App.cartCount > 0) {
            cartCountElement.style.display = 'inline';
        } else {
            cartCountElement.style.display = 'none';
        }
    }
}

// Initialize Modal Functions
function initModals() {
    // Toggle Password Visibility in Login Modal
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = document.getElementById('loginPassword');
            if (passwordInput) {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            }
        });
    }
    
    // Quick Amount Buttons in Topup Modal
    document.querySelectorAll('.amount-btn').forEach(button => {
        button.addEventListener('click', function() {
            const amount = this.getAttribute('data-amount');
            const amountInput = document.getElementById('topup-amount');
            if (amountInput) {
                amountInput.value = amount;
            }
        });
    });
}

// Initialize Form Validation
function initForms() {
    // Form validation for login
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const email = this.querySelector('[name="email"]').value;
            const password = this.querySelector('[name="password"]').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Harap lengkapi semua field!');
            }
        });
    }
    
    // Form validation for register
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = this.querySelector('[name="password"]').value;
            const confirmPassword = this.querySelector('[name="password_confirmation"]').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password tidak cocok!');
            }
        });
    }
}

// Initialize Navigation
function initNavigation() {
    // Active link highlighting
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
}

// Add to Cart Function
function addToCart(productId, productName, price, quantity = 1) {
    if (!window.App.cart) {
        window.App.cart = { items: [] };
    }
    
    // Check if product already in cart
    const existingItem = window.App.cart.items.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        window.App.cart.items.push({
            id: productId,
            name: productName,
            price: price,
            quantity: quantity
        });
    }
    
    // Update cart count
    window.App.cartCount = window.App.cart.items.length;
    
    // Save to localStorage
    localStorage.setItem('ecommerce_cart', JSON.stringify(window.App.cart));
    
    // Update UI
    updateCartCount();
    
    // Show notification
    showNotification('Produk ditambahkan ke keranjang!', 'success');
    
    return window.App.cart;
}

// Remove from Cart Function
function removeFromCart(productId) {
    if (window.App.cart && window.App.cart.items) {
        window.App.cart.items = window.App.cart.items.filter(item => item.id !== productId);
        window.App.cartCount = window.App.cart.items.length;
        
        // Save to localStorage
        localStorage.setItem('ecommerce_cart', JSON.stringify(window.App.cart));
        
        // Update UI
        updateCartCount();
        
        // Show notification
        showNotification('Produk dihapus dari keranjang!', 'warning');
    }
}

// Show Notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
}

// Format Currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Make functions available globally
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.showNotification = showNotification;
window.formatCurrency = formatCurrency;