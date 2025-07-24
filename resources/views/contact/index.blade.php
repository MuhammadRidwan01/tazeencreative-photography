@extends('layouts.app')

@section('title', 'Contact Us')
@section('description', 'Get in touch with TazeenCreative.id for professional photography services. Contact us for bookings, inquiries, and custom photography packages.')

@section('content')
<!-- Hero Section -->
<section class="relative h-64 bg-black flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="/placeholder.svg?height=400&width=1920"
             alt="Contact Us"
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Contact Us</h1>
        <p class="text-xl">Let's discuss your photography needs</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-serif font-bold text-gray-900 mb-6">Send us a Message</h2>
                <form class="space-y-6" data-ajax action="/contact" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                    </div>

                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service Interest</label>
                        <select id="service" name="service"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                            <option value="">Select a service</option>
                            <option value="wedding">Wedding Photography</option>
                            <option value="portrait">Portrait Photography</option>
                            <option value="product">Product Photography</option>
                            <option value="event">Event Photography</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300"
                                  placeholder="Tell us about your photography needs..."></textarea>
                    </div>

                    <button type="submit" class="w-full btn-primary">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-serif font-bold text-gray-900 mb-6">Get in Touch</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Ready to capture your special moments? We'd love to hear from you. Contact us today to discuss your photography needs and get a personalized quote.
                    </p>
                </div>

                <!-- Contact Details -->
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Address</h3>
                            <p class="text-gray-600">Jakarta, Indonesia</p>
                            <p class="text-sm text-gray-500 mt-1">Available for shoots nationwide</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Phone</h3>
                            <a href="tel:+6281234567890" class="text-gold-600 hover:text-gold-700 transition-colors">
                                +62 812-3456-7890
                            </a>
                            <p class="text-sm text-gray-500 mt-1">Available 9 AM - 9 PM</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                            <a href="mailto:hello@tazeencreative.id" class="text-gold-600 hover:text-gold-700 transition-colors">
                                hello@tazeencreative.id
                            </a>
                            <p class="text-sm text-gray-500 mt-1">We'll respond within 24 hours</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gold-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Business Hours</h3>
                            <div class="text-gray-600">
                                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p>Saturday: 10:00 AM - 4:00 PM</p>
                                <p>Sunday: By appointment only</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-gold-100 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-600 hover:text-gold-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-gold-100 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-600 hover:text-gold-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-gold-100 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5 text-gray-600 hover:text-gold-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">Frequently Asked Questions</h2>
            <p class="text-xl text-gray-600">Common questions about our services and booking process</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">How far in advance should I book?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        We recommend booking at least 2-4 weeks in advance, especially for weddings and special events. However, we can sometimes accommodate last-minute bookings depending on availability.
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">Do you travel for shoots?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        Yes! We're available for shoots throughout Indonesia. Travel fees may apply for locations outside Jakarta. Contact us for a detailed quote including travel costs.
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">What happens if it rains during an outdoor shoot?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        We always have backup plans! We can reschedule at no extra charge or move to a covered location. We also bring equipment to work in light rain if you're comfortable with it.
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">Can I request specific editing styles?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        We can discuss your preferred editing style during our consultation. Whether you prefer natural, dramatic, vintage, or modern editing, we'll tailor our post-processing to match your vision.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
