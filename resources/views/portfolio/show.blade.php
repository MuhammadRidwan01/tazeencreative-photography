@extends('layouts.app')

@section('title', $portfolio->title)
@section('description', $portfolio->description ?: 'View this beautiful photography work from TazeenCreative.id portfolio.')

@section('content')
<!-- Portfolio Detail -->
<section class="section-padding">
    <div class="container-custom">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                        <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('portfolio.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Portfolio</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-4 text-sm font-medium text-gray-500">{{ $portfolio->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Image -->
            <div class="lg:col-span-2">
                <div class="relative group">
                    <img src="{{ $portfolio->image_path ? Storage::url($portfolio->image_path) : '/placeholder.svg?height=600&width=800' }}" 
                         alt="{{ $portfolio->title }}" 
                         class="w-full h-auto rounded-lg shadow-xl cursor-pointer transition-transform duration-300 group-hover:scale-105"
                         onclick="openLightbox('{{ $portfolio->image_path ? Storage::url($portfolio->image_path) : '/placeholder.svg?height=600&width=800' }}')">
                    
                    @if($portfolio->is_featured)
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gold-500 text-black">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Featured
                            </span>
                        </div>
                    @endif

                    <!-- Zoom Icon -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-20 rounded-lg">
                        <div class="bg-white bg-opacity-90 p-3 rounded-full">
                            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Info -->
            <div class="space-y-8">
                <!-- Title & Category -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-4">{{ $portfolio->title }}</h1>
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $portfolio->category->name }}
                        </span>
                        <span class="text-sm text-gray-500">{{ $portfolio->created_at->format('M d, Y') }}</span>
                    </div>
                </div>

                <!-- Description -->
                @if($portfolio->description)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">About This Photo</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $portfolio->description }}</p>
                    </div>
                @endif

                <!-- Actions -->
                <div class="space-y-4">
                    <a href="{{ route('booking.create') }}" class="block w-full btn-primary text-center">
                        Book Similar Session
                    </a>
                    <a href="{{ route('contact') }}" class="block w-full btn-outline text-center">
                        Get More Info
                    </a>
                </div>

                <!-- Share -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Share This Photo</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Portfolio -->
@if($relatedPortfolios->count() > 0)
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-center mb-12">More from {{ $portfolio->category->name }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedPortfolios as $related)
                    <div class="group relative overflow-hidden rounded-lg shadow-lg card-hover">
                        <img src="{{ $related->thumbnail_path ? Storage::url($related->thumbnail_path) : '/placeholder.svg?height=300&width=400' }}" 
                             alt="{{ $related->title }}" 
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                        
                        <div class="image-overlay">
                            <div class="text-center text-white">
                                <h3 class="text-lg font-semibold mb-2">{{ $related->title }}</h3>
                                <a href="{{ route('portfolio.show', $related) }}" 
                                   class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition-all duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection
