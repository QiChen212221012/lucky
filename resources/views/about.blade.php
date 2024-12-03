<x-app-layout>
    <!-- 动态标题 -->
    <x-slot name="title">About Lucky Blog</x-slot>

    <div class="about-section">
        <div class="container">
            <!-- 页面标题 -->
            <h1 class="section-title">About Lucky Blog</h1>
            <p class="intro-text">
                Welcome to <strong>Lucky Blog</strong>! Our platform is designed to inspire, connect, and empower individuals from all walks of life. Join our vibrant community of storytellers, thinkers, and readers!
            </p>

            <!-- Mission and Vision -->
            <div class="flex-box">
                <div class="card">
                    <h3>Our Mission</h3>
                    <p>
                        At Lucky Blog, our mission is to foster creativity and community by providing a space for everyone to share their unique perspectives and ideas.
                    </p>
                </div>
                <div class="card">
                    <h3>Our Vision</h3>
                    <p>
                        Our vision is to build a global hub for meaningful connections and storytelling, where diversity and creativity thrive.
                    </p>
                </div>
            </div>

            <!-- Core Values -->
            <div class="card full-width mt-4">
                <h3>Core Values</h3>
                <ul class="values-list">
                    <li><strong>Inspiration:</strong> Encouraging creativity and originality.</li>
                    <li><strong>Community:</strong> Building a welcoming environment for all users.</li>
                    <li><strong>Integrity:</strong> Ensuring authenticity and quality in every aspect.</li>
                    <li><strong>Growth:</strong> Empowering our users to grow and achieve their goals.</li>
                </ul>
            </div>

            <!-- Journey -->
            <div class="card full-width mt-4">
                <h3>Our Journey</h3>
                <p>
                    Lucky Blog began in 2023 with a dream to create a platform where voices could be heard and stories shared. Today, we're proud to host thousands of creators worldwide, connecting ideas and inspiration across cultures.
                </p>
            </div>

            <!-- User Testimonials -->
            <div class="card full-width mt-4">
                <h3>What Our Users Say</h3>
                <div class="flex-box">
                    <div class="testimonial-card hover-animated">
                        <p>
                            "Lucky Blog is the perfect place for sharing my thoughts and connecting with others. Highly recommended!"
                        </p>
                        <p><strong>- Emily R.</strong></p>
                    </div>
                    <div class="testimonial-card hover-animated">
                        <p>
                            "The supportive community and beautiful design make Lucky Blog my favorite platform for writing."
                        </p>
                        <p><strong>- Michael T.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
