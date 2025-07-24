@extends('layouts.app')

@section('title', 'About Us - TazeenCreative.id')
@section('description', 'Kenali lebih dekat TazeenCreative.id, tim fotografer profesional yang berdedikasi mengabadikan momen berharga Anda dengan kualitas terbaik.')

@section('content')
<!-- Hero Section -->
<section class="relative py-24 bg-gradient-to-r from-black to-gray-800">
    <div class="container-custom text-center text-white">
        <h1 class="text-5xl md:text-6xl font-serif font-bold mb-6">About Us</h1>
        <p class="text-xl md:text-2xl max-w-3xl mx-auto">
            Passion for capturing life's most precious moments with artistic vision and professional excellence
        </p>
    </div>
</section>

<!-- Story Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-serif font-bold mb-6">Our Story</h2>
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    TazeenCreative.id lahir dari passion mendalam terhadap seni fotografi dan keinginan untuk mengabadikan momen-momen berharga dalam hidup. Dimulai pada tahun 2020, kami telah berkembang menjadi salah satu penyedia layanan fotografi terpercaya di Indonesia.
                </p>
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    Dengan pengalaman lebih dari 4 tahun di industri fotografi, kami telah melayani ratusan klien dari berbagai kalangan, mulai dari pasangan yang merayakan momen pernikahan, keluarga yang ingin mengabadikan kebersamaan, hingga UMKM yang membutuhkan dokumentasi produk berkualitas.
                </p>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Filosofi kami sederhana: setiap foto memiliki cerita, dan tugas kami adalah memastikan cerita tersebut tersampaikan dengan sempurna melalui lensa kamera kami.
                </p>
            </div>
            <div class="relative">
                <img src="/placeholder.svg?height=600&width=500" 
                     alt="Our Story" 
                     class="w-full rounded-2xl shadow-2xl">
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gold-500 rounded-2xl -z-10"></div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-serif font-bold mb-4">Our Vision</h3>
                <p class="text-gray-700 leading-relaxed">
                    Menjadi penyedia layanan fotografi terdepan di Indonesia yang dikenal karena kualitas, kreativitas, dan dedikasi dalam mengabadikan setiap momen berharga dengan sempurna.
                </p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-serif font-bold mb-4">Our Mission</h3>
                <p class="text-gray-700 leading-relaxed">
                    Memberikan layanan fotografi profesional dengan harga terjangkau, mengutamakan kepuasan klien, dan terus berinovasi dalam teknik dan teknologi fotografi untuk hasil yang memukau.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="section-padding">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold mb-4">Our Values</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Nilai-nilai yang menjadi fondasi dalam setiap layanan yang kami berikan
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Quality -->
            <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold mb-4">Quality First</h3>
                <p class="text-gray-700">
                    Kami tidak pernah berkompromi dengan kualitas. Setiap foto yang kami hasilkan melalui proses editing profesional untuk memastikan hasil terbaik.
                </p>
            </div>

            <!-- Creativity -->
            <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold mb-4">Creative Vision</h3>
                <p class="text-gray-700">
                    Setiap proyek adalah kanvas baru bagi kreativitas kami. Kami selalu mencari angle dan komposisi unik untuk menghasilkan foto yang berkesan.
                </p>
            </div>

            <!-- Trust -->
            <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-bold mb-4">Trust & Reliability</h3>
                <p class="text-gray-700">
                    Kepercayaan klien adalah aset terbesar kami. Kami berkomitmen untuk selalu tepat waktu, profesional, dan dapat diandalkan dalam setiap project.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold mb-4">Meet Our Team</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Tim profesional yang berpengalaman dan passionate dalam dunia fotografi
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="text-center">
                <div class="relative mb-6">
                    <img src="/placeholder.svg?height=300&width=300" 
                         alt="Tazeen Ahmad" 
                         class="w-64 h-64 rounded-full mx-auto object-cover shadow-xl">
                    <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-gold-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-serif font-bold mb-2">Tazeen Ahmad</h3>
                <p class="text-gold-600 font-medium mb-4">Lead Photographer & Founder</p>
                <p class="text-gray-700">
                    Dengan pengalaman 8+ tahun di industri fotografi, Tazeen memimpin tim dengan visi kreatif dan standar kualitas tinggi.
                </p>
            </div>

            <!-- Team Member 2 -->
            <div class="text-center">
                <div class="relative mb-6">
                    <img src="/placeholder.svg?height=300&width=300" 
                         alt="Sarah Wijaya" 
                         class="w-64 h-64 rounded-full mx-auto object-cover shadow-xl">
                    <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-gold-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-serif font-bold mb-2">Sarah Wijaya</h3>
                <p class="text-gold-600 font-medium mb-4">Wedding & Portrait Specialist</p>
                <p class="text-gray-700">
                    Spesialis dalam fotografi wedding dan portrait dengan sentuhan artistik yang mampu menangkap emosi dalam setiap frame.
                </p>
            </div>

            <!-- Team Member 3 -->
            <div class="text-center">
                <div class="relative mb-6">
                    <img src="/placeholder.svg?height=300&width=300" 
                         alt="Budi Santoso" 
                         class="w-64 h-64 rounded-full mx-auto object-cover shadow-xl">
                    <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-gold-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-serif font-bold mb-2">Budi Santoso</h3>
                <p class="text-gold-600 font-medium mb-4">Product & Commercial Photographer</p>
                <p class="text-gray-700">
                    Ahli dalam fotografi produk dan komersial dengan keahlian lighting dan komposisi yang membuat produk terlihat menarik.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="section-padding bg-black text-white">
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl md:text-5xl font-bold text-gold-500 mb-2">500+</div>
                <p class="text-gray-300">Happy Clients</p>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold text-gold-500 mb-2">1000+</div>
                <p class="text-gray-300">Projects Completed</p>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold text-gold-500 mb-2">4+</div>
                <p class="text-gray-300">Years Experience</p>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-bold text-gold-500 mb-2">50+</div>
                <p class="text-gray-300">Awards Won</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding">
    <div class="container-custom text-center">
        <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">
            Ready to Work <span class="text-gradient">Together</span>?
        </h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Mari berkolaborasi untuk mengabadikan momen berharga Anda dengan sentuhan profesional dan artistik
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('booking.create') }}" class="btn-primary">
                Start Your Project
            </a>
            <a href="{{ route('contact') }}" class="btn-outline">
                Get In Touch
            </a>
        </div>
    </div>
</section>
@endsection
