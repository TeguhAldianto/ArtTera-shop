@extends('layouts.app')
@section('title', 'Exclusive Gallery - ArtTera')

@section('content')

    <section class="gallery-section">
        <div class="gallery-header" style="text-align: center; margin-bottom: 4rem;">
            <h1 class="title">Curated Collection</h1>
            <p style="font-size: 1.6rem; color: var(--light-color); max-width: 600px; margin: 0 auto;">
                Explore our premium selection of digital assets and physical masterpieces.
            </p>
        </div>

        <div class="filter-bar" style="display: flex; justify-content: center; gap: 1.5rem; margin-bottom: 4rem; flex-wrap: wrap;">
            <button class="btn filter-btn active" data-filter="all" style="background: var(--black); color: var(--white);">All Items</button>
            <button class="btn filter-btn" data-filter="digital" style="background: var(--white); color: var(--black); border: 1px solid #ddd;">Digital Art</button>
            <button class="btn filter-btn" data-filter="sculpture" style="background: var(--white); color: var(--black); border: 1px solid #ddd;">Sculptures</button>
            <button class="btn filter-btn" data-filter="painting" style="background: var(--white); color: var(--black); border: 1px solid #ddd;">Paintings</button>
        </div>

        <div class="box-container" id="gallery-grid">
            @foreach ($all_products as $product)
                <form action="{{ route('cart.add', $product->id) }}" method="post" class="product-card" data-category="{{ Str::lower($product->category) }}">
                    @csrf

                    <div class="badge">{{ $product->category }}</div>

                    <div class="image-wrapper">
                        <img src="{{ asset('uploaded_img/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" width="400" height="400">
                        <div class="overlay-actions">
                            <a href="{{ route('products.show', $product->id) }}" class="action-btn" aria-label="View {{ $product->name }} details"><i class="fas fa-eye"></i></a>
                            <button type="submit" name="add_to_cart" class="action-btn" aria-label="Add {{ $product->name }} to cart"><i class="fas fa-shopping-cart"></i></button>
                        </div>
                    </div>

                    <div class="card-content">
                        <h3 class="name">{{ $product->name }}</h3>
                        <div class="price-row">
                            <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <input type="number" name="qty" class="qty-input" min="1" max="99" value="1" inputmode="numeric">
                        </div>
                    </div>
                </form>
            @endforeach
        </div>

        @if ($all_products->isEmpty())
            <div class="empty-state" style="text-align: center; padding: 5rem;">
                <i class="fas fa-box-open" style="font-size: 5rem; color: #ddd;"></i>
                <p style="font-size: 2rem; color: var(--light-color); margin-top: 1rem;">No masterpiece found.</p>
            </div>
        @endif
    </section>

@endsection

@push('styles')
<style>
    /* Gallery Section Enhancements */
    .gallery-section {
        padding: 4rem 2rem;
    }
    
    .gallery-header h1.title {
        font-size: 4rem;
        color: var(--black);
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    
    .gallery-header h1.title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--yellow);
    }
    
    /* Filter Bar Enhancements */
    .filter-bar {
        margin-bottom: 4rem;
    }
    
    .filter-btn {
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-size: 1.4rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .filter-btn:hover:not(.active) {
        border-color: var(--yellow);
        color: var(--yellow);
    }
    
    .filter-btn.active {
        background: var(--black) !important;
        color: var(--white) !important;
        border-color: var(--black);
    }
    
    .filter-btn[data-filter="digital"].active,
    .filter-btn[data-filter="sculpture"].active,
    .filter-btn[data-filter="painting"].active {
        background: var(--yellow) !important;
        border-color: var(--yellow) !important;
    }
    
    /* Product Grid - Masonry-like with CSS Grid */
    #gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 3rem;
        transition: all 0.3s ease;
    }
    
    /* Product Card Enhancements */
    .product-card {
        background: var(--white);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        position: relative;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        opacity: 1;
        transform: scale(1);
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }
    
    .product-card.hidden {
        opacity: 0;
        transform: scale(0.8);
        pointer-events: none;
        position: absolute;
        height: 0;
        margin: 0;
        padding: 0;
    }
    
    .product-card .badge {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        background: var(--black);
        color: var(--white);
        padding: 0.5rem 1.2rem;
        font-size: 1.1rem;
        border-radius: 20px;
        z-index: 2;
        font-weight: 500;
        text-transform: capitalize;
    }
    
    .product-card .badge.digital { background: #6366f1; }
    .product-card .badge.sculpture { background: #8b5cf6; }
    .product-card .badge.painting { background: #ec4899; }
    
    .image-wrapper {
        position: relative;
        overflow: hidden;
        height: 30rem;
        background: #f5f5f5;
    }
    
    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .product-card:hover .image-wrapper img {
        transform: scale(1.1);
    }
    
    .overlay-actions {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding: 1.5rem;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        transform: translateY(100%);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .product-card:hover .overlay-actions {
        transform: translateY(0);
    }
    
    .action-btn {
        background: var(--white);
        color: var(--black);
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        border: none;
    }
    
    .action-btn:hover {
        background: var(--yellow);
        color: var(--white);
        transform: scale(1.1);
    }
    
    .action-btn:focus-visible {
        outline: 3px solid var(--yellow);
        outline-offset: 2px;
    }
    
    .card-content {
        padding: 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .product-card .name {
        font-size: 1.8rem;
        margin: 0 0 1rem;
        color: var(--black);
        font-weight: 600;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    
    .price {
        font-size: 2rem;
        color: var(--black);
        font-weight: 700;
    }
    
    .qty-input {
        width: 70px;
        padding: 0.8rem;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        text-align: center;
        font-size: 1.4rem;
        font-family: inherit;
        transition: border-color 0.2s ease;
    }
    
    .qty-input:focus {
        outline: none;
        border-color: var(--yellow);
    }
    
    /* Empty State Enhancement */
    .empty-state {
        grid-column: 1 / -1;
    }
    
    .empty-state i {
        font-size: 6rem;
        color: var(--light-color);
        margin-bottom: 2rem;
        opacity: 0.5;
    }
    
    .empty-state p {
        font-size: 1.8rem;
        color: var(--light-color);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 1024px) {
        #gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }
    }
    
    @media (max-width: 768px) {
        .gallery-header h1.title {
            font-size: 3rem;
        }
        
        .filter-bar {
            gap: 1rem;
        }
        
        .filter-btn {
            padding: 0.8rem 1.5rem;
            font-size: 1.2rem;
        }
        
        #gallery-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .image-wrapper {
            height: 25rem;
        }
    }
    
    @media (max-width: 480px) {
        .overlay-actions {
            transform: translateY(0);
            background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        }
    }
    
    /* Animation for filtering */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .product-card:not(.hidden) {
        animation: fadeInUp 0.5s ease forwards;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gallery Filter Functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-card');
        const galleryGrid = document.getElementById('gallery-grid');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                
                // Filter products with animation
                productCards.forEach((card, index) => {
                    const category = card.dataset.category;
                    
                    if (filter === 'all' || category === filter) {
                        // Show card
                        card.style.position = 'relative';
                        card.style.height = 'auto';
                        card.style.margin = '';
                        card.style.padding = '';
                        card.style.pointerEvents = 'auto';
                        
                        // Trigger reflow for animation
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        card.offsetHeight; // Force reflow
                        
                        card.classList.remove('hidden');
                        requestAnimationFrame(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        });
                    } else {
                        // Hide card
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        
                        setTimeout(() => {
                            if (!card.classList.contains('hidden')) {
                                card.classList.add('hidden');
                                card.style.position = 'absolute';
                                card.style.height = '0';
                                card.style.margin = '0';
                                card.style.padding = '0';
                                card.style.pointerEvents = 'none';
                            }
                        }, 300);
                    }
                });
            });
        });
        
        // Add to cart loading state
        document.querySelectorAll('.product-card form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const btn = this.querySelector('button[type="submit"].action-btn');
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    btn.style.background = 'var(--light-color)';
                }
            });
        });
        
        // Keyboard navigation for filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
    });
</script>
@endpush