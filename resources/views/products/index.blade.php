@extends('layouts.app')

@section('title', 'Index Products')

@section('content')
<style>
    .pv-scope {
        --ink: #16212D;
        --muted: #6B7684;
        --paper: #F4F6F8;
        --surface: #FFFFFF;
        --line: #E1E5EA;
        --accent: #0E7C6B;
        --accent-dark: #0A5F52;
        --amber: #B9720F;
        --danger: #B23A2E;
        --danger-dark: #8F2E24;
        font-family: 'Inter', system-ui, sans-serif;
        color: var(--ink);
        background: var(--paper);
        padding: 2.5rem 1.5rem 4rem;
    }
    .pv-scope * { box-sizing: border-box; }
    .pv-header {
        max-width: 1200px;
        margin: 0 auto 2rem;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        border-bottom: 1px solid var(--line);
        padding-bottom: 1.25rem;
    }
    .pv-header h1 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        margin: 0;
    }
    .pv-eyebrow {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 0.35rem;
    }
    .pv-add-btn {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        background: var(--accent);
        color: #fff;
        border: none;
        padding: 0.7rem 1.3rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: background 0.15s ease;
    }
    .pv-add-btn:hover { background: var(--accent-dark); color: #fff; }
    .pv-flash {
        max-width: 1200px;
        margin: 0 auto 1.5rem;
        background: #E9F5F1;
        border: 1px solid #BFE3D6;
        color: var(--accent-dark);
        padding: 0.75rem 1rem;
        border-radius: 6px;
        font-size: 0.9rem;
    }
    .pv-grid {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.25rem;
    }
    .pv-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .pv-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(22, 33, 45, 0.08);
    }
    .pv-card-img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: cover;
        background: var(--paper);
        display: block;
    }
    .pv-card-img-placeholder {
        width: 100%;
        aspect-ratio: 4 / 3;
        background: var(--paper);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.7rem;
        letter-spacing: 0.08em;
    }
    .pv-card-body {
        padding: 1rem 1.1rem 1.1rem;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        flex: 1;
    }
    .pv-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.05rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.25;
    }
    .pv-tags {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .pv-tag {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.78rem;
        font-variant-numeric: tabular-nums;
        padding: 0.2rem 0.55rem;
        border-radius: 5px;
        border: 1px solid var(--line);
    }
    .pv-tag-price { color: var(--amber); border-color: #ECD5A8; background: #FBF3E6; }
    .pv-tag-stock { color: var(--accent-dark); border-color: #BFE3D6; background: #EAF6F2; }
    .pv-card-actions {
        margin-top: auto;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        padding-top: 0.5rem;
        border-top: 1px solid var(--line);
    }
    .pv-link {
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        color: var(--ink);
    }
    .pv-link:hover { color: var(--accent); }
    .pv-link-danger { color: var(--danger); }
    .pv-link-danger:hover { color: var(--danger-dark); }
    .pv-card-form { margin: 0; display: inline; }
    .pv-card-form button {
        background: none;
        border: none;
        padding: 0;
        font-family: inherit;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--danger);
        cursor: pointer;
    }
    .pv-card-form button:hover { color: var(--danger-dark); }
    .pv-dot { color: var(--line); }
    .pv-cart-btn {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 600;
        font-size: 0.82rem;
        background: var(--accent);
        color: #fff;
        border: none;
        padding: 0.4rem 0.85rem;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        margin-left: auto;
        transition: background 0.15s ease;
    }
    .pv-cart-btn:hover { background: var(--accent-dark); color: #fff; }
</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">

<div class="pv-scope">

    <div class="pv-header">
        <div>
            <div class="pv-eyebrow">Inventory</div>
            <h1>All Products</h1>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('products.create') }}" class="pv-add-btn">+ Add Product</a>
            @endif
        @endauth
    </div>

    @if (session('success'))
        <div class="pv-flash">{{ session('success') }}</div>
    @endif

    <div class="pv-grid">
        @foreach ($products as $product)
            <div class="pv-card">

                @if ($product->image)
                    <img class="pv-card-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="pv-card-img-placeholder">NO IMAGE</div>
                @endif

                <div class="pv-card-body">
                    <h2 class="pv-card-title">{{ $product->name }}</h2>

                    <div class="pv-tags">
                        <span class="pv-tag pv-tag-price">${{ number_format((float) $product->price, 2) }}</span>
                        <span class="pv-tag pv-tag-stock">{{ $product->stock }} in stock</span>
                    </div>

                    <div class="pv-card-actions">
                        <a href="{{ route('products.show', $product->id) }}" class="pv-link">View</a>
                        <a href="{{ route('reviews.index', $product->id) }}" class="pv-link">Reviews</a>

                        @auth
                            @if(auth()->user()->isAdmin())
                                <span class="pv-dot">&middot;</span>
                                <a href="{{ route('products.edit', $product->id) }}" class="pv-link">Edit</a>
                                <span class="pv-dot">&middot;</span>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="pv-card-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
                                    
                                </form>
                            @endif

                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('cart.add', $product->id) }}" class="pv-cart-btn">🛒 Add to Cart</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
