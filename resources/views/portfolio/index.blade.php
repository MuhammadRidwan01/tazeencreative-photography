@extends('layouts.app')

@section('title', 'Portfolio')
@section('description', 'Explore our photography portfolio showcasing wedding, portrait, product, and event photography work.')

@section('content')
<!-- Hero Section -->
<section class="relative h-64 bg-black flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="/placeholder.svg?height=400&width=1920"
             alt="Portfolio"
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Our Portfolio</h1>
        <p class="text-xl">Discover our latest photography work</p>
    </div>
</section>

<!-- Portfolio Content -->
<section class="section-padding">
    <div class="container-custom">
        <!-- Category Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button data-filter="all"
                class="filter-btn bg-black text-white px-6 py-2 rounded-full font-medium transition-all duration-300">
                All
            </button>
            @foreach ($categories as $category)
                <button data-filter="{{ $category->slug }}"
                    class="filter-btn bg-gray-200 text-gray-700 hover:bg-gray-300 px-6 py-2 rounded-full font-medium transition-all duration-300">
                    {{ $category->name }} ({{ $category->portfolios_count }})
                </button>
            @endforeach
        </div>

        <!-- Search -->
        <div class="max-w-md mx-auto mb-12">
            <form method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search portfolio..."
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </form>
        </div>

        <!-- Portfolio Grid -->
        @if($portfolios->count() > 0)
            <div class="masonry" id="portfolio-grid">
                @foreach($portfolios as $portfolio)
                    <div class="masonry-item group" data-category="{{ $portfolio->category->slug }}">
                        <div class="relative overflow-hidden rounded-lg shadow-lg card-hover bg-white">
                            <img src="{{ $portfolio->thumbnail_path ? Storage::url($portfolio->thumbnail_path) : '/placeholder.svg?height=400&width=300' }}"
                                 alt="{{ $portfolio->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110"
                                 data-lightbox="{{ $portfolio->image_path ? Storage::url($portfolio->image_path) : '/placeholder.svg?height=800&width=600' }}">

                            <div class="image-overlay">
                                <div class="text-center text-white">
                                    <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                                    <p class="text-sm opacity-90 mb-4">{{ $portfolio->category->name }}</p>
                                    <div class="flex space-x-2 justify-center">
                                        <button onclick="openLightbox('{{ $portfolio->image_path ? Storage::url($portfolio->image_path) : '/placeholder.svg?height=800&width=600' }}')"
                                                class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-300">
                                            View
                                        </button>
                                        <a href="{{ route('portfolio.show', $portfolio) }}"
                                           class="bg-gold-500 hover:bg-gold-600 text-black px-4 py-2 rounded-lg transition-all duration-300">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @if ($portfolio->is_featured)
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gold-500 text-black">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        Featured
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $portfolios->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No portfolio items found</h3>
                <p class="text-gray-600">Try adjusting your search or filter criteria.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">Like What You See?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Let's create beautiful memories together. Book your photography session today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="btn-primary">
                Get In Touch
            </a>
            <a href="{{ route('booking.create') }}" class="btn-secondary">
                Book Session
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('[data-category]');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;

                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-black', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-black', 'text-white');

                portfolioItems.forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
