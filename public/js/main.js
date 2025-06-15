// <script id="mobileMenuScript">
document.addEventListener("DOMContentLoaded", function () {
    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const mobileMenu = document.getElementById("mobileMenu");
    mobileMenuBtn.addEventListener("click", function () {
        if (mobileMenu.classList.contains("hidden")) {
            mobileMenu.classList.remove("hidden");
        } else {
            mobileMenu.classList.add("hidden");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const cartBtn = document.getElementById("cartBtn");
    const cartSidebar = document.getElementById("cartSidebar");
    const closeCartBtn = document.getElementById("closeCartBtn");
    const continueShopping = document.getElementById("continueShopping");
    const cartItems = document.getElementById("cartItems");
    const emptyCart = document.getElementById("emptyCart");
    const cartTotal = document.getElementById("cartTotal");
    const cartBadge = document.querySelector(".cart-badge");
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    let cart = [];
    function updateCartUI() {
        if (cart.length === 0) {
            emptyCart.classList.remove("hidden");
            cartTotal.textContent = "0đ";
            cartBadge.textContent = "0";
        } else {
            emptyCart.classList.add("hidden");
            // Clear current items
            const cartItemElements = cartItems.querySelectorAll(".cart-item");
            cartItemElements.forEach((item) => {
                if (!item.classList.contains("empty-cart")) {
                    item.remove();
                }
            });
            // Add items to cart
            let total = 0;
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                const cartItemElement = document.createElement("div");
                cartItemElement.className =
                    "cart-item flex items-center gap-4 py-4 border-b border-gray-200";
                cartItemElement.innerHTML = `
                <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden">
                    <img src="${item.image}" alt="${
                    item.name
                }" class="w-full h-full object-cover object-top">
                </div>
                <div class="flex-1">
                    <h4 class="font-medium">${item.name}</h4>
                    <div class="text-primary font-bold">${item.price.toLocaleString()}đ</div>
                    <div class="flex items-center mt-2">
                        <button class="decrease-quantity w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full" data-index="${index}">
                            <i class="ri-subtract-line"></i>
                        </button>
                        <span class="mx-2">${item.quantity}</span>
                        <button class="increase-quantity w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full" data-index="${index}">
                            <i class="ri-add-line"></i>
                        </button>
                    </div>
                </div>
                <button class="remove-item text-gray-400 hover:text-red-500" data-index="${index}">
                    <i class="ri-delete-bin-line"></i>
                </button>
            `;
                cartItems.appendChild(cartItemElement);
            });
            // Update total and badge
            cartTotal.textContent = `${total.toLocaleString()}đ`;
            cartBadge.textContent = cart.reduce(
                (sum, item) => sum + item.quantity,
                0
            );
            // Add event listeners to cart item buttons
            document
                .querySelectorAll(".decrease-quantity")
                .forEach((button) => {
                    button.addEventListener("click", function () {
                        const index = parseInt(this.dataset.index);
                        if (cart[index].quantity > 1) {
                            cart[index].quantity--;
                            updateCartUI();
                        }
                    });
                });
            document
                .querySelectorAll(".increase-quantity")
                .forEach((button) => {
                    button.addEventListener("click", function () {
                        const index = parseInt(this.dataset.index);
                        cart[index].quantity++;
                        updateCartUI();
                    });
                });
            document.querySelectorAll(".remove-item").forEach((button) => {
                button.addEventListener("click", function () {
                    const index = parseInt(this.dataset.index);
                    cart.splice(index, 1);
                    updateCartUI();
                });
            });
        }
    }

    function openCart() {
        cartSidebar.classList.remove("translate-x-full");
        document.body.style.overflow = "hidden";
    }
    function closeCart() {
        cartSidebar.classList.add("translate-x-full");
        document.body.style.overflow = "";
    }
    cartBtn.addEventListener("click", openCart);
    closeCartBtn.addEventListener("click", closeCart);
    continueShopping.addEventListener("click", closeCart);
    // Add to cart functionality

    // Initialize cart UI
    updateCartUI();
    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productCard = this.closest(".product-card");
            const name = productCard.querySelector("h3").textContent;
            const priceText =
                productCard.querySelector(".text-primary").textContent;
            const price = parseInt(priceText.replace(/\D/g, ""));
            const image = productCard.querySelector("img").src;
            // Check if product already in cart
            const existingItemIndex = cart.findIndex(
                (item) => item.name === name
            );
            if (existingItemIndex !== -1) {
                cart[existingItemIndex].quantity++;
            } else {
                cart.push({
                    name,
                    price,
                    image,
                    quantity: 1,
                });
            }
            updateCartUI();
            openCart();
        });
    });

    const form = document.querySelector("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("password_confirmation");
    const termsCheckbox = document.querySelector('input[name="terms"]');
    const submitButton = document.querySelector('button[type="submit"]');

    function showAlert(message, isSuccess = false) {
        const modal = document.createElement("div");
        modal.className =
            "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50";
        modal.innerHTML = `
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm mx-4">
                <div class="text-center">
                    <i class="${
                        isSuccess
                            ? "ri-checkbox-circle-line text-green-500"
                            : "ri-error-warning-line text-primary"
                    } text-5xl mb-4"></i>
                    <p class="text-gray-800 mb-6">${message}</p>
                    <button onclick="${
                        isSuccess
                            ? 'window.location.href="/login"'
                            : "this.closest('.fixed').remove()"
                    }"
                            class="${
                                isSuccess ? "bg-green-500" : "bg-primary"
                            } text-white px-6 py-2 rounded-button hover:bg-opacity-90 transition-colors">
                        ${isSuccess ? "Đến trang đăng nhập" : "Đóng"}
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    function validateForm() {
        if (!termsCheckbox.checked) {
            showAlert(
                "Vui lòng đồng ý với điều khoản sử dụng và chính sách bảo mật"
            );
            return false;
        }

        if (password.value !== confirmPassword.value) {
            showAlert("Mật khẩu không khớp");
            return false;
        }

        return true;
    }

    // Kiểm tra mật khẩu realtime
    confirmPassword.addEventListener("input", function () {
        if (password.value !== confirmPassword.value) {
            this.setCustomValidity("Mật khẩu không khớp");
            confirmPassword.style.borderColor = "#ff6b6b";
        } else {
            this.setCustomValidity("");
            confirmPassword.style.borderColor = "#10b981";
        }
    });

    // Kiểm tra checkbox điều khoản
    termsCheckbox.addEventListener("change", function () {
        if (!this.checked) {
            showAlert(
                "Vui lòng đồng ý với điều khoản sử dụng và chính sách bảo mật"
            );
        }
    });

    // Xử lý submit form
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if (validateForm()) {
            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'input[name="_token"]'
                    ).value,
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        showAlert("Đăng ký tài khoản thành công!", true);
                    } else {
                        showAlert(data.message || "Có lỗi xảy ra khi đăng ký");
                    }
                })
                .catch((error) => {
                    showAlert("Có lỗi xảy ra khi đăng ký");
                });
        }
    });
    function setupPasswordToggle(toggleId, passwordId, iconId) {
        const toggleButton = document.getElementById(toggleId);
        const passwordInput = document.getElementById(passwordId);
        const passwordIcon = document.getElementById(iconId);
        toggleButton.addEventListener("click", function () {
            const type =
                passwordInput.getAttribute("type") === "password"
                    ? "text"
                    : "password";
            passwordInput.setAttribute("type", type);
            if (type === "password") {
                passwordIcon.classList.remove("ri-eye-off-line");
                passwordIcon.classList.add("ri-eye-line");
            } else {
                passwordIcon.classList.remove("ri-eye-line");
                passwordIcon.classList.add("ri-eye-off-line");
            }
        });
    }
    setupPasswordToggle(
        "toggleRegisterPassword",
        "password",
        "registerPasswordIcon"
    );
    setupPasswordToggle(
        "toggleConfirmPassword",
        "password_confirmation",
        "confirmPasswordIcon"
    );
});

// Cart functionality
document.addEventListener("DOMContentLoaded", function () {
    // Add CSRF token to all AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        window.csrfToken = csrfToken.getAttribute("content");
    }

    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const productId = this.getAttribute("data-product-id");
            const productName = this.getAttribute("data-product-name");
            const productPrice = this.getAttribute("data-product-price");
            const productImage = this.getAttribute("data-product-image");

            // Disable button temporarily
            this.disabled = true;
            this.innerHTML = "Đang thêm...";

            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.csrfToken,
                },
                body: JSON.stringify({
                    product_id: productId,
                    product_name: productName,
                    product_price: productPrice,
                    product_image: productImage,
                    quantity: 1,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Show success message
                        showNotification(data.message, "success");

                        // Update cart count in header if exists
                        updateCartCount(data.cart_count);
                    } else {
                        showNotification(
                            "Có lỗi xảy ra. Vui lòng thử lại!",
                            "error"
                        );
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showNotification(
                        "Có lỗi xảy ra. Vui lòng thử lại......!",
                        "error"
                    );
                })
                .finally(() => {
                    // Re-enable button
                    this.disabled = false;
                    this.innerHTML = "Thêm vào giỏ";
                });
        });
    });
    function updateCartCount() {
        fetch("/cart/count")
            .then((response) => response.json())
            .then((data) => {
                const cartCountElements =
                    document.querySelectorAll(".cart-count");
                cartCountElements.forEach((element) => {
                    element.textContent = data.count;
                });
            })
            .catch((error) =>
                console.error("Error fetching cart count:", error)
            );
    }
    updateCartCount();
});

// Show notification function
function showNotification(message, type = "success") {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll(".notification");
    existingNotifications.forEach((notification) => notification.remove());

    // Create notification
    const notification = document.createElement("div");
    notification.className = `notification fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === "success" ? "bg-green-500 text-white" : "bg-red-500 text-white"
    }`;
    notification.textContent = message;

    // Add to DOM
    document.body.appendChild(notification);

    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// // Update cart count in header
// function updateCartCount(count) {
//     const cartCountElements = document.querySelectorAll(".cart-count");
//     cartCountElements.forEach((element) => {
//         element.textContent = count;
//     });
// }
