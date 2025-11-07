<div>
    <label for="category_id" class="form-label fw-bold mb-2">Select A Category For Your Product</label>
    <select class="form-select mb-2" name="category_id" wire:model.live="selectedCategory">
        <option value="">Select A Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
    </select>


     <label for="subcategory_id" class="form-label fw-bold mb-2">Select Sub Category For Your Product</label>
    <select class="form-select mt-3" name="subcategory_id" wire:model="selectedSubcategory">
        <option value="">Select A Subcategory</option>
        @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
        @endforeach
    </select>
</div>
