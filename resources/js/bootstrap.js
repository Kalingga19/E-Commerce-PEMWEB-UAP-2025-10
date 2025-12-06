// public/js/bootstrap.js

// Custom Bootstrap initializations
(function() {
    'use strict';
    
    // Enable Bootstrap tooltips everywhere
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Enable Bootstrap popovers everywhere
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
    // Initialize all carousels
    var carousels = document.querySelectorAll('.carousel');
    carousels.forEach(function(carousel) {
        new bootstrap.Carousel(carousel, {
            interval: 5000,
            wrap: true
        });
    });
    
    // Handle dropdowns on hover (optional)
    var dropdowns = document.querySelectorAll('.dropdown-hover');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('mouseenter', function() {
            var bsDropdown = bootstrap.Dropdown.getInstance(this) || new bootstrap.Dropdown(this);
            bsDropdown.show();
        });
        
        dropdown.addEventListener('mouseleave', function() {
            var bsDropdown = bootstrap.Dropdown.getInstance(this);
            if (bsDropdown) {
                bsDropdown.hide();
            }
        });
    });
    
})();