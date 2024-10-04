<?php
include("../../category-proccess/fetch-categories.php");
?>

<div class="all-categories">
    <div class="d1">
        <h2>All Categories</h2>
        <button id="addNewCategory" onclick="openModal();">+ Add New Category</button>
    </div>

    <div class="categories-list">
        <?php
        foreach ($categories as $category) {
            ?>
            <div class="category-item">
                <img src="<?php echo htmlspecialchars($category['category_img']); ?>"
                    alt="<?php echo htmlspecialchars($category['category_name']); ?>">
                <span><?php echo htmlspecialchars($category['category_name']); ?></span>
                <button class="edit" data-id="<?php echo $category['category_id']; ?>"
                    data-name="<?php echo htmlspecialchars($category['category_name']); ?>"
                    data-img="<?php echo htmlspecialchars($category['category_img']); ?>" onclick="editCategory(this);"><img
                        src="../img/edit.png" alt="edit"></button>
                <button class="delete" data-id="<?php echo $category['category_id']; ?>" onclick="deleteCategory(this);">
                    <img src="../img/delete.png" alt="delete">
                </button>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="modal"> <!-- Modal initially hidden -->
    <div class="modal-content">
        <span class="close" onclick="closeModal();">&times;</span>
        <h2 id="modalTitle">Add New Category</h2>
        <form id="categoryForm" action="../category-proccess/insert-category.php" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" id="categoryId" name="categoryId">
            <!-- Hidden input to store the category ID for editing -->

            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" id="categoryName" name="categoryName" required>
            </div>
            <div class="form-group">
                <label for="categoryImage">Category Image</label>
                <input type="file" id="categoryImage" name="categoryImage" accept="image/*"
                    onchange="showImagePreview();">
            </div>
            <!-- Image preview container -->
            <div id="imagePreviewContainer" style="display: none;">
                <img id="imagePreview" src="" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
            </div>
            <button type="submit" name="submitCategory">Save Changes</button>
        </form>
    </div>
</div>