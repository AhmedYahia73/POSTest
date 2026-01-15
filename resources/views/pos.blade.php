

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام نقاط البيع - POS</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 20px 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .branch-info h3 {
            font-size: 16px;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .branch-info p {
            font-size: 14px;
            opacity: 0.7;
        }

        .main-container {
            display: flex;
            height: calc(100vh - 80px);
        }

        .left-panel {
            flex: 0 0 65%;
            background: white;
            padding: 30px;
            overflow-y: auto;
            border-left: 1px solid #e0e6ed;
        }

        .right-panel {
            flex: 0 0 35%;
            background: #ffffff;
            padding: 30px;
            display: flex;
            flex-direction: column;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            position: relative;
            margin-bottom: 25px;
        }

        .search-box input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s;
            background: #f8fafc;
        }

        .search-box input:focus {
            outline: none;
            border-color: #1e3c72;
            background: white;
            box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 20px;
        }

        .section-title {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .category-card {
            background: white;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            padding: 20px 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .category-card:hover {
            border-color: #1e3c72;
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.15);
            transform: translateY(-3px);
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card.active {
            border-color: #1e3c72;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.3);
        }

        .category-card.active h4 {
            color: white;
        }

        .category-card img {
            width: 70px;
            height: 70px;
            margin-bottom: 12px;
            object-fit: cover;
            border-radius: 10px;
        }

        .category-card h4 {
            color: #334155;
            font-size: 15px;
            font-weight: 600;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: #1e3c72;
            box-shadow: 0 10px 30px rgba(30, 60, 114, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 140px;
            border-radius: 10px;
            margin-bottom: 12px;
            object-fit: cover;
        }

        .product-card h5 {
            color: #1e293b;
            font-size: 15px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .product-card .price {
            color: #1e3c72;
            font-weight: 700;
            font-size: 18px;
        }

        .cart-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            text-align: center;
        }

        .cart-header h2 {
            font-size: 20px;
            font-weight: 600;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-left: 5px;
        }

        .cart-item {
            background: #f8fafc;
            border: 1px solid #e0e6ed;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
        }

        .cart-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .cart-item img {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-info h5 {
            color: #1e293b;
            margin-bottom: 6px;
            font-size: 15px;
        }

        .cart-item-price {
            color: #1e3c72;
            font-weight: 700;
            font-size: 16px;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 5px;
            border-radius: 8px;
            border: 1px solid #e0e6ed;
        }

        .cart-item-controls button {
            width: 32px;
            height: 32px;
            border: none;
            background: #1e3c72;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-item-controls button:hover {
            background: #2a5298;
            transform: scale(1.1);
        }

        .cart-item-controls span {
            font-weight: 700;
            min-width: 35px;
            text-align: center;
            color: #1e293b;
        }

        .cart-footer {
            background: #f8fafc;
            padding: 25px;
            border-radius: 12px;
            border: 2px solid #e0e6ed;
        }

        .subtotal-row, .tax-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #64748b;
            font-size: 15px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            margin-top: 10px;
            border-top: 2px dashed #cbd5e1;
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
        }

        .total-amount {
            color: #1e3c72;
        }

        .checkout-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.3);
        }

        .empty-cart {
            text-align: center;
            color: #94a3b8;
            padding: 60px 20px;
        }

        .empty-cart-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                height: auto;
            }
            
            .left-panel, .right-panel {
                flex: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h1>🛒 نظام نقاط البيع - POS System</h1>
        </div>
        <div class="branch-info">
            <h3>📍 فرع المعادي</h3>
            <p>القاهرة - مصر الجديدة</p>
        </div>
    </div>

    <div class="main-container">
        <!-- Left Panel: Categories & Products -->
        <div class="left-panel">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="ابحث عن منتج...">
                <span class="search-icon">🔍</span>
            </div>

            <h3 class="section-title">التصنيفات</h3>
            <div class="categories" id="categoriesContainer"></div>

            <h3 class="section-title">المنتجات</h3>
            <div class="products-grid" id="productsGrid"></div>
        </div>

        <!-- Right Panel: Cart -->
        <div class="right-panel">
            <div class="cart-header">
                <h2>🛍️ سلة المشتريات</h2>
            </div>

            <div class="cart-items" id="cartItems">
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h3>السلة فارغة</h3>
                    <p>ابدأ بإضافة منتجات من القائمة</p>
                </div>
            </div>

            <div class="cart-footer">
                <div class="subtotal-row">
                    <span>المجموع الفرعي:</span>
                    <span id="subtotal">0.00 ج.م</span>
                </div>
                <div class="tax-row">
                    <span>الضريبة (14%):</span>
                    <span id="tax">0.00 ج.م</span>
                </div>
                <div class="total-row">
                    <span>الإجمالي النهائي:</span>
                    <span class="total-amount" id="totalAmount">0.00 ج.م</span>
                </div>
                <button class="checkout-btn" onclick="checkout()">💳 إتمام عملية الدفع</button>
            </div>
        </div>
    </div>

    <script>
        // Real Data with Real Images
 const categories = @json($categories);
const products = @json($products);

        let cart = [];
        let selectedCategory = null;

        // Initialize
        $(document).ready(function() {
            renderCategories();
            renderProducts();
            
            $('#searchInput').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                filterProducts(searchTerm);
            });
        });

        // Render Categories
        function renderCategories() {
            const container = $('#categoriesContainer');
            container.empty();
            
            categories.forEach(category => {
                const card = $(`
                    <div class="category-card" data-id="${category.id}">
                        <img src="/storage/${category.image}" alt="${category.name}">
                        <h4>${category.name}</h4>
                    </div>
                `);
                
                card.on('click', function() {
                    if (selectedCategory === category.id) {
                        selectedCategory = null;
                        $('.category-card').removeClass('active');
                    } else {
                        $('.category-card').removeClass('active');
                        $(this).addClass('active');
                        selectedCategory = category.id;
                    }
                    renderProducts();
                });
                
                container.append(card);
            });
        }

        // Render Products
        function renderProducts() {
            const grid = $('#productsGrid');
            grid.empty();
            
            let filteredProducts = products;
            if (selectedCategory) {
                filteredProducts = products.filter(p => p.category_id === selectedCategory);
            }
            
            filteredProducts.forEach(product => {
                const card = $(`
                    <div class="product-card">
                        <img src="/storage/${product.image}" alt="${product.name}">
                        <h5>${product.name}</h5>
                        <div class="price">${product.price} ج.م</div>
                    </div>
                `);
                
                card.on('click', function() {
                    addToCart(product);
                });
                
                grid.append(card);
            });
        }

        // Filter Products
        function filterProducts(searchTerm) {
            const grid = $('#productsGrid');
            grid.empty();
            
            let filteredProducts = products.filter(p => 
                p.name.toLowerCase().includes(searchTerm)
            );
            
            if (selectedCategory) {
                filteredProducts = filteredProducts.filter(p => p.category_id === selectedCategory);
            }
            
            filteredProducts.forEach(product => {
                const card = $(`
                    <div class="product-card">
                        <img src="${product.image}" alt="${product.name}">
                        <h5>${product.name}</h5>
                        <div class="price">${product.price} ج.م</div>
                    </div>
                `);
                
                card.on('click', function() {
                    addToCart(product);
                });
                
                grid.append(card);
            });
        }

        // Add to Cart
        function addToCart(product) {
            const existingItem = cart.find(item => item.id === product.id);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    ...product,
                    quantity: 1
                });
            }
            
            renderCart();
        }

        // Render Cart
        function renderCart() {
            const container = $('#cartItems');
            container.empty();
            
            if (cart.length === 0) {
                container.html(`
                    <div class="empty-cart">
                        <div class="empty-cart-icon">🛒</div>
                        <h3>السلة فارغة</h3>
                        <p>ابدأ بإضافة منتجات من القائمة</p>
                    </div>
                `);
                updateTotal();
                return;
            }
            
            cart.forEach(item => {
                const itemDiv = $(`
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="cart-item-info">
                            <h5>${item.name}</h5>
                            <div class="cart-item-price">${(item.price * item.quantity).toFixed(2)} ج.م</div>
                        </div>
                        <div class="cart-item-controls">
                            <button onclick="decreaseQuantity(${item.id})">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="increaseQuantity(${item.id})">+</button>
                        </div>
                    </div>
                `);
                
                container.append(itemDiv);
            });
            
            updateTotal();
        }

        // Increase Quantity
        function increaseQuantity(productId) {
            const item = cart.find(i => i.id === productId);
            if (item) {
                item.quantity++;
                renderCart();
            }
        }

        // Decrease Quantity
        function decreaseQuantity(productId) {
            const item = cart.find(i => i.id === productId);
            if (item) {
                item.quantity--;
                if (item.quantity === 0) {
                    cart = cart.filter(i => i.id !== productId);
                }
                renderCart();
            }
        }

        // Update Total
        function updateTotal() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.14;
            const total = subtotal + tax;
            
            $('#subtotal').text(`${subtotal.toFixed(2)} ج.م`);
            $('#tax').text(`${tax.toFixed(2)} ج.م`);
            $('#totalAmount').text(`${total.toFixed(2)} ج.م`);
        }

        // Checkout
        function checkout() {
            if (cart.length === 0) {
                            alert('⚠️ السلة فارغة! الرجاء إضافة منتجات أولاً');
            return;
        }

        // هنا يمكنك إضافة منطق إتمام الدفع الحقيقي لاحقاً
        // مثل: إرسال الطلب للـ backend، طباعة فاتورة، فتح بوابة دفع...

        let receipt = "╔════════════════════════════════════╗\n";
        receipt += "║         فاتورة الطلب               ║\n";
        receipt += "╟────────────────────────────────────╢\n";

        cart.forEach(item => {
            const totalItem = (item.price * item.quantity).toFixed(2);
            receipt += `║ ${item.name.padEnd(24)} ${item.quantity}x ${totalItem} ج.م ║\n`;
        });

        receipt += "╟────────────────────────────────────╢\n";

        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.14;
        const total = subtotal + tax;

        receipt += `║ المجموع الفرعي:          ${subtotal.toFixed(2)} ج.م ║\n`;
        receipt += `║ الضريبة (14%):            ${tax.toFixed(2)} ج.م ║\n`;
        receipt += "╟────────────────────────────────────╢\n";
        receipt += `║ الإجمالي النهائي:        ${total.toFixed(2)} ج.م ║\n`;
        receipt += "╚════════════════════════════════════╝\n\n";
        receipt += "شكراً لتسوقكم معنا! 🌟\n";
        receipt += `تاريخ: ${new Date().toLocaleString('ar-EG')}\n`;

        alert(receipt);

        // إعادة تعيين السلة بعد الدفع
        cart = [];
        renderCart();

        // يمكنك هنا إضافة أي إجراءات إضافية مثل:
        // - إرسال الطلب للسيرفر
        // - طباعة الفاتورة
        // - عرض شاشة شكر/نجاح
    }

    // إضافة إمكانية الضغط على Enter في البحث
    $('#searchInput').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            $(this).blur();
        }
    });

    // تحسين بسيط: إظهار عدد المنتجات في السلة على أيقونة السلة (اختياري)
    function updateCartBadge() {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        // يمكنك إضافة عنصر badge في header إذا أردت لاحقاً
        console.log(`عدد المنتجات في السلة: ${totalItems}`);
    }

    // تعديل الدوال التي تغير السلة لتحديث البادج (اختياري)
    const originalAddToCart = addToCart;
    addToCart = function(product) {
        originalAddToCart(product);
        updateCartBadge();
    };

    const originalIncrease = increaseQuantity;
    increaseQuantity = function(id) {
        originalIncrease(id);
        updateCartBadge();
    };

    const originalDecrease = decreaseQuantity;
    decreaseQuantity = function(id) {
        originalDecrease(id);
        updateCartBadge();
    };

    // بدء التحميل الأولي للبادج (يكون صفر في البداية)
    updateCartBadge();

    </script>
</body>
</html>