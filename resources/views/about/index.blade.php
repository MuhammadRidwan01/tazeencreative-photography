@extends('layouts.app')

@section('title', 'About Us - Tazeen Creative Photography')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-amber-50">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-amber-900 py-24">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                        Capturing Life's
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-300">
                            Beautiful Moments
                        </span>
                    </h1>
                    <p class="text-xl text-gray-200 mb-8">
                        With over 8 years of experience in photography, we specialize in creating timeless memories that tell your unique story.
                    </p>
                </div>
                <div class="relative">
                    <div class="aspect-square rounded-2xl overflow-hidden shadow-2xl">
                        <img src="/placeholder.svg?height=500&width=500"
                             alt="Tazeen - Professional Photographer"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">{{ $stats['years_experience'] }}+</div>
                    <div class="text-gray-600">Years Experience</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">{{ $stats['projects_completed'] }}+</div>
                    <div class="text-gray-600">Projects Completed</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">{{ $stats['happy_clients'] }}+</div>
                    <div class="text-gray-600">Happy Clients</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">{{ $stats['awards_won'] }}+</div>
                    <div class="text-gray-600">Awards Won</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Story Section -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <div class="prose prose-lg text-gray-600 space-y-6">
                        <p>
                            Photography has always been more than just a profession for us—it's a passion that drives us to capture the essence of every moment. What started as a hobby with a simple camera has evolved into a full-service photography studio dedicated to creating extraordinary visual experiences.
                        </p>
                        <p>
                            We believe that every photograph should tell a story, evoke emotion, and preserve memories that will be cherished for generations. Our approach combines technical expertise with artistic vision to deliver images that are not just beautiful, but meaningful.
                        </p>
                        <p>
                            From intimate portraits to grand celebrations, we bring the same level of dedication and creativity to every project. Our goal is to make you feel comfortable and confident, allowing your true personality to shine through in every shot.
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-[4/5] rounded-2xl overflow-hidden shadow-xl">
                        <img src="/placeholder.svg?height=600&width=480"
                             alt="Behind the scenes photography"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-xl shadow-lg">
                        <div class="text-2xl font-bold text-amber-600">Est. 2016</div>
                        <div class="text-gray-600">Serving clients worldwide</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Preview -->
    @if($services->count() > 0)
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">What We Do</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We offer a comprehensive range of photography services to meet all your visual storytelling needs.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($services as $service)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ $service->image_url ?? '/placeholder.svg?height=300&width=400&query=' . urlencode($service->name) }}"
                             alt="{{ $service->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($service->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-amber-600 font-semibold">${{ number_format($service->base_price) }}+</span>
                            <a href="{{ route('services.show', $service) }}"
                               class="text-amber-600 hover:text-amber-700 font-medium text-sm">
                                Learn More →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Featured Work -->
    @if($featuredWork->count() > 0)
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Work</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    A glimpse into some of our favorite projects that showcase our passion for visual storytelling.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredWork as $work)
                <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ $work->image_url ?? '/placeholder.svg?height=500&width=400&query=' . urlencode($work->title) }}"
                             alt="{{ $work->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-xl font-semibold mb-2">{{ $work->title }}</h3>
                        <p class="text-gray-200 text-sm">{{ $work->category->name ?? 'Photography' }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('portfolio.index') }}"
                   class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-semibold rounded-lg hover:from-amber-700 hover:to-yellow-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    View Full Portfolio
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Philosophy Section -->
    <div class="py-20 bg-gradient-to-r from-slate-900 to-amber-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-8">Our Philosophy</h2>
            <blockquote class="text-2xl text-gray-200 italic max-w-4xl mx-auto mb-8">
                "Every moment is unique and deserves to be captured with the same uniqueness. We don't just take photos; we create visual stories that speak to the heart and stand the test of time."
            </blockquote>
            <div class="text-amber-400 font-semibold">- Tazeen Creative Team</div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Ready to Create Something Beautiful?</h2>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                Let's discuss your vision and bring it to life through the art of photography.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact.index') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-semibold rounded-lg hover:from-amber-700 hover:to-yellow-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    Get In Touch
                </a>
                <a href="{{ route('portfolio.index') }}"
                   class="inline-flex items-center px-8 py-4 border-2 border-amber-600 text-amber-600 font-semibold rounded-lg hover:bg-amber-600 hover:text-white transition-all duration-200">
                    View Our Work
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
