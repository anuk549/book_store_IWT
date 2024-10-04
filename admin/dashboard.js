document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll("nav ul li a");
  const contentDiv = document.getElementById("content");

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const tab = e.target.getAttribute("href").split("=")[1]; // Extract tab from URL
      loadTab(tab);
    });
  });

  function loadTab(tab) {
    fetch(`tabs/${tab}.php`) // Correct path to load tabs
      .then((response) => response.text())
      .then((data) => {
        contentDiv.innerHTML = data;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  // Load the default tab
  loadTab("categories");
});

// Function to open the modal
function openModal() {
    var modal = document.getElementById('addCategoryModal');
    modal.style.display = "block"; // Show the modal
}

// Function to close the modal
function closeModal() {
    var modal = document.getElementById('addCategoryModal');
    modal.style.display = "none"; // Hide the modal
}

// Function to show image preview when the user selects an image
function showImagePreview() {
    var input = document.getElementById('categoryImage');
    var imagePreviewContainer = document.getElementById('imagePreviewContainer');
    var imagePreview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            imagePreviewContainer.style.display = "block"; // Show the image preview
            imagePreview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]); // Read the selected file
    }
}

// Function to load category data into the modal when the "Edit" button is clicked
function editCategory(button) {
    var modal = document.getElementById('addCategoryModal');
    var categoryId = button.getAttribute('data-id');
    var categoryName = button.getAttribute('data-name');
    var categoryImage = button.getAttribute('data-img');

    // Set modal title and form action
    document.getElementById('modalTitle').textContent = 'Edit Category';
    document.getElementById('categoryForm').action = '../category-proccess/update-category.php'; // Change to update action

    // Set hidden input for the category ID
    document.getElementById('categoryId').value = categoryId;

    // Set current category name and image
    document.getElementById('categoryName').value = categoryName;

    // Set the image preview
    var imagePreviewContainer = document.getElementById('imagePreviewContainer');
    var imagePreview = document.getElementById('imagePreview');
    
    // Check if a valid image path exists and display it
    if (categoryImage && categoryImage.trim() !== "") {
        imagePreviewContainer.style.display = "block"; // Show the image preview container
        imagePreview.src = '../img/category-img/' + categoryImage; // Load current image
    } else {
        imagePreviewContainer.style.display = "none"; // Hide if no image exists
    }

    // Show the modal
    openModal();
}

// Function to handle category deletion
function deleteCategory(button) {
    var categoryId = button.getAttribute('data-id'); // Get category ID from the button

    // Confirm the deletion
    if (confirm("Are you sure you want to delete this category?")) {
        // Create the AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../category-proccess/delete-category.php", true); // Set the URL of the PHP script that will handle the deletion
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Send category ID to the server
        xhr.send("categoryId=" + categoryId);

        // When the request is complete
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parse response
                var response = JSON.parse(xhr.responseText);
                
                if (response.success) {
                    // If deletion was successful, remove the category from the UI
                    alert("Category deleted successfully.");
                    button.closest(".category-item").remove(); // Remove the category from the list
                } else {
                    alert("Failed to delete the category. Please try again.");
                }
            } else {
                alert("An error occurred. Please try again.");
            }
        };
    }
}

