@extends('layouts.app')

@section('title', 'Professional Photography Services')
@section('description', 'TazeenCreative.id menyediakan layanan fotografi profesional untuk wedding, portrait, product, dan event documentation dengan harga terjangkau di Indonesia.')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="/foto/foto.jpg"
             alt="Professional Photography"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white container-custom" data-animate="fade-in">
        <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6 leading-tight">
            Capture Your
            <span class="text-gradient">Perfect Moments</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed">
            Professional photography services for weddings, portraits, products, and events.
            Creating timeless memories with artistic excellence.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('portfolio.index') }}" class="btn-primary">
                View Portfolio
            </a>
            <a href="{{ route('booking.create') }}" class="btn-secondary">
                Book Session
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Featured Portfolio Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16" data-animate="slide-up">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">Featured Work</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover our latest photography projects showcasing the beauty and emotion of life's most precious moments.
            </p>
        </div>

        @if($featuredPortfolios->count() > 0)
            <div class="masonry" data-animate="fade-in">
                @foreach($featuredPortfolios as $portfolio)
                    <div class="masonry-item group">
                        <div class="relative overflow-hidden rounded-lg shadow-lg card-hover">
                            <img src="{{ $portfolio->thumbnail_path ? Storage::url($portfolio->thumbnail_path) : '/placeholder.svg?height=400&width=300' }}"
                                 alt="{{ $portfolio->title }}"
                                 class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-110"
                                 data-lightbox="{{ $portfolio->image_path ? Storage::url($portfolio->image_path) : '/placeholder.svg?height=800&width=600' }}">

                            <div class="image-overlay">
                                <div class="text-center text-white">
                                    <h3 class="text-xl font-semibold mb-2">{{ $portfolio->title }}</h3>
                                    <p class="text-sm opacity-90">{{ $portfolio->category->name }}</p>
                                    <div class="mt-4">
                                        <button class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-300">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('portfolio.index') }}" class="btn-outline">
                    View All Portfolio
                </a>
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">Portfolio coming soon...</p>
            </div>
        @endif
    </div>
</section>

<!-- Services Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="text-center mb-16" data-animate="slide-up">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">Our Services</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Professional photography packages tailored to meet your specific needs and budget.
            </p>
        </div>

        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden card-hover" data-animate="slide-up">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-2xl font-serif font-bold">{{ $service->name }}</h3>
                                @if($service->is_popular)
                                    <span class="bg-gold-500 text-black text-xs font-bold px-3 py-1 rounded-full">
                                        POPULAR
                                    </span>
                                @endif
                            </div>

                            <div class="mb-6">
                                <span class="text-3xl font-bold text-gold-500">{{ $service->formatted_price }}</span>
                            </div>

                            <p class="text-gray-600 mb-6">{{ Str::limit($service->description, 100) }}</p>

                            <ul class="space-y-2 mb-8">
                                @foreach(array_slice($service->features, 0, 4) as $feature)
                                    <li class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="space-y-3">
                                <a href="{{ route('services.show', $service) }}" class="block w-full text-center btn-outline">
                                    View Details
                                </a>
                                <a href="{{ route('booking.create', ['service' => $service->slug]) }}" class="block w-full text-center btn-primary">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">Services coming soon...</p>
            </div>
        @endif
    </div>
</section>

<!-- Categories Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16" data-animate="slide-up">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">Photography Categories</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Explore our diverse range of photography specializations, each crafted with passion and expertise.
            </p>
        </div>

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('portfolio.index', ['category' => $category->slug]) }}"
                       class="group relative overflow-hidden rounded-lg shadow-lg card-hover" data-animate="zoom-in">
                        <div class="aspect-w-4 aspect-h-5">
                            <img src="{{ $category->image_path ? Storage::url($category->image_path) : '/placeholder.svg?height=400&width=320&query=' . urlencode($category->name . ' photography') }}"
                                 alt="{{ $category->name }}"
                                 class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-xl font-serif font-bold mb-2">{{ $category->name }}</h3>
                            <p class="text-sm opacity-90 mb-2">{{ $category->portfolios_count }} Photos</p>
                            @if($category->description)
                                <p class="text-xs opacity-75">{{ Str::limit($category->description, 60) }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-gray-500 text-lg">Categories coming soon...</p>
            </div>
        @endif
    </div>
</section>

<!-- About Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-animate="slide-up">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">About TazeenCreative</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    With over 5 years of experience in professional photography, we specialize in capturing life's most precious moments with artistic excellence and technical precision.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Our passion lies in creating timeless images that tell your unique story, whether it's your wedding day, a family portrait, or a corporate event.
                </p>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gold-500 mb-2">500+</div>
                        <div class="text-sm text-gray-600">Happy Clients</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gold-500 mb-2">1000+</div>
                        <div class="text-sm text-gray-600">Photos Taken</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gold-500 mb-2">5+</div>
                        <div class="text-sm text-gray-600">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gold-500 mb-2">50+</div>
                        <div class="text-sm text-gray-600">Events Covered</div>
                    </div>
                </div>

                <a href="{{ route('about.index') }}" class="btn-primary">
                    Learn More About Us
                </a>
            </div>

            <div class="relative" data-animate="fade-in">
                <img src="/placeholder.svg?height=600&width=500"
                     alt="Professional Photographer"
                     class="w-full h-auto rounded-lg shadow-xl">

                <!-- Floating Elements -->
                <div class="absolute -top-4 -right-4 bg-gold-500 text-black p-4 rounded-lg shadow-lg">
                    <div class="text-2xl font-bold">5★</div>
                    <div class="text-xs">Rating</div>
                </div>

                <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-lg shadow-lg">
                    <div class="text-2xl font-bold text-gold-500">ISO</div>
                    <div class="text-xs text-gray-600">Certified</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16" data-animate="slide-up">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">What Clients Say</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Don't just take our word for it. Here's what our satisfied clients have to say about our work.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg" data-animate="slide-up">
                <div class="flex items-center mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-6 italic">
                    "TazeenCreative captured our wedding day perfectly. Every moment was beautifully documented and the quality exceeded our expectations."
                </p>
                <div class="flex items-center">
                    <img src="/placeholder.svg?height=50&width=50" alt="Sarah" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <div class="font-semibold">Sarah & John</div>
                        <div class="text-sm text-gray-500">Wedding Photography</div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg" data-animate="slide-up">
                <div class="flex items-center mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-6 italic">
                    "Professional, creative, and reliable. The product photos for our business turned out amazing and really helped boost our sales."
                </p>
                <div class="flex items-center">
                    <img src="/placeholder.svg?height=50&width=50" alt="Michael" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <div class="font-semibold">Michael Chen</div>
                        <div class="text-sm text-gray-500">Product Photography</div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg" data-animate="slide-up">
                <div class="flex items-center mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-6 italic">
                    "The family portrait session was wonderful. They made us feel comfortable and the photos captured our family's personality perfectly."
                </p>
                <div class="flex items-center">
                    <img src="/placeholder.svg?height=50&width=50" alt="Lisa" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <div class="font-semibold">Lisa Rodriguez</div>
                        <div class="text-sm text-gray-500">Family Portrait</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-black text-white">
    <div class="container-custom text-center" data-animate="slide-up">
        <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">Ready to Capture Your Story?</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90">
            Let's create beautiful memories together. Contact us today to discuss your photography needs and book your session.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="btn-secondary">
                Get In Touch
            </a>
            <a href="{{ route('booking.create') }}" class="btn-outline border-white text-white hover:bg-white hover:text-black">
                Book Your Session
            </a>
        </div>
    </div>
</section>
@endsection
