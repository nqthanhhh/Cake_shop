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

// </script>
// <!-- Removed modal script since modals are no longer needed -->
// <script id="cartScript">
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
    // Initialize cart UI
    updateCartUI();

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
});
// Xử lý thêm vào giỏ hàng
document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", async function () {
        try {
            // Kiểm tra đăng nhập trước khi gửi request
            const isLoggedIn =
                document.body.classList.contains("user-logged-in");
            if (!isLoggedIn) {
                window.location.href = "/login";
                return;
            }

            const response = await fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    product_id: this.dataset.productId,
                }),
            });

            const data = await response.json();
            if (data.status === "success") {
                document.querySelector(".cart-badge").textContent =
                    data.cartCount;
                hienThiThongBao("Thêm vào giỏ hàng thành công", true);
            } else {
                hienThiThongBao(data.message || "Có lỗi xảy ra", false);
            }
        } catch (error) {
            console.error("Lỗi:", error);
            hienThiThongBao("Có lỗi xảy ra khi thêm vào giỏ hàng", false);
        }
    });
});

// Hàm hiển thị thông báo
function hienThiThongBao(message, thanhCong = false) {
    // Xóa thông báo cũ nếu có
    const oldNotification = document.querySelector(".notification-toast");
    if (oldNotification) {
        oldNotification.remove();
    }

    const thongBao = document.createElement("div");
    thongBao.className = `notification-toast fixed top-4 right-4 p-4 rounded-lg shadow-lg ${
        thanhCong ? "bg-green-500" : "bg-red-500"
    } text-white transform transition-all duration-300 z-50`;
    thongBao.textContent = message;

    document.body.appendChild(thongBao);

    // Animation hiển thị
    setTimeout(() => thongBao.classList.add("opacity-0"), 2500);
    setTimeout(() => thongBao.remove(), 3000);
}
// Cập nhật số lượng trong giỏ hàng
document.querySelectorAll(".update-quantity").forEach((button) => {
    button.addEventListener("click", async function () {
        const cartId = this.dataset.cartId;
        const quantity =
            this.closest(".quantity-wrapper").querySelector("input").value;

        try {
            const response = await fetch("/cart/update", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    quantity: quantity,
                }),
            });

            const data = await response.json();
            document.querySelector(".cart-badge").textContent = data.cartCount;
            // Cập nhật tổng tiền
            updateCartTotal();
        } catch (error) {
            alert("Có lỗi xảy ra khi cập nhật giỏ hàng");
        }
    });
});

// Xóa sản phẩm khỏi giỏ hàng
document.querySelectorAll(".remove-from-cart").forEach((button) => {
    button.addEventListener("click", async function () {
        if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
            const cartId = this.dataset.cartId;
            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                });

                const data = await response.json();
                document.querySelector(".cart-badge").textContent =
                    data.cartCount;
                // Xóa phần tử khỏi DOM
                this.closest(".cart-item").remove();
                // Cập nhật tổng tiền
                updateCartTotal();
            } catch (error) {
                alert("Có lỗi xảy ra khi xóa sản phẩm");
            }
        }
    });
});
// Hiện ẩn mật khẩu
document.addEventListener("DOMContentLoaded", function () {
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
