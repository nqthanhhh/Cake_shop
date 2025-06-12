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
});
// </script>
