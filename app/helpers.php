<?php

if (!function_exists('getCategoryIcon')) {
    /**
     * Get Font Awesome icon name based on category name
     *
     * @param string $categoryName
     * @return string
     */
    function getCategoryIcon($categoryName)
    {
        $icons = [
            // Electronics & Technology
            'electronics' => 'laptop',
            'computers' => 'desktop',
            'phones' => 'mobile-alt',
            'mobile' => 'mobile-alt',
            'tablets' => 'tablet-alt',
            'cameras' => 'camera',
            'audio' => 'headphones',
            'gaming' => 'gamepad',
            'accessories' => 'plug',
            
            // Fashion & Apparel
            'fashion' => 'tshirt',
            'clothing' => 'tshirt',
            'shoes' => 'shoe-prints',
            'bags' => 'shopping-bag',
            'watches' => 'clock',
            'jewelry' => 'gem',
            'sunglasses' => 'glasses',
            
            // Home & Living
            'home' => 'home',
            'furniture' => 'couch',
            'kitchen' => 'utensils',
            'decor' => 'paint-brush',
            'garden' => 'leaf',
            'appliances' => 'blender',
            
            // Sports & Outdoors
            'sports' => 'futbol',
            'fitness' => 'dumbbell',
            'outdoor' => 'mountain',
            'camping' => 'campground',
            'cycling' => 'bicycle',
            
            // Books & Media
            'books' => 'book',
            'music' => 'music',
            'movies' => 'film',
            'magazines' => 'newspaper',
            
            // Health & Beauty
            'health' => 'heartbeat',
            'beauty' => 'spa',
            'cosmetics' => 'palette',
            'skincare' => 'hand-sparkles',
            
            // Food & Beverages
            'food' => 'utensils',
            'beverages' => 'wine-glass-alt',
            'groceries' => 'shopping-basket',
            
            // Toys & Kids
            'toys' => 'puzzle-piece',
            'kids' => 'child',
            'baby' => 'baby',
            
            // Automotive
            'automotive' => 'car',
            'parts' => 'cog',
            
            // Office & Stationery
            'office' => 'briefcase',
            'stationery' => 'pen',
            
            // Pet Supplies
            'pets' => 'paw',
            'pet supplies' => 'paw',
        ];
        
        // Convert to lowercase and check for matches
        $categoryLower = strtolower($categoryName);
        
        // Check for exact match
        if (isset($icons[$categoryLower])) {
            return $icons[$categoryLower];
        }
        
        // Check for partial match
        foreach ($icons as $key => $icon) {
            if (str_contains($categoryLower, $key) || str_contains($key, $categoryLower)) {
                return $icon;
            }
        }
        
        // Default icon
        return 'tags';
    }
}
