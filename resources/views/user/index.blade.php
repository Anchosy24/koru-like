@extends('layouts.home')

@push('style')
    <style>
        /* Hero Section */
        .hero {
        position: relative;
        text-align: center;
        padding: 100px 20px;
        overflow: hidden;
        background: #000;
        }

        .hero::before, .hero::after {
        content: "";
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.6;
        animation: floatGlow 8s infinite alternate;
        }
        .hero::before {
        background: rgba(0, 255, 100, 0.7);
        top: -100px;
        left: -100px;
        }
        .hero::after {
        background: rgba(0, 200, 80, 0.6);
        bottom: -100px;
        right: -100px;
        animation-delay: 4s;
        }
        @keyframes floatGlow {
        0% { transform: scale(1) translate(0, 0); }
        100% { transform: scale(1.2) translate(40px, 40px); }
        }

        /* Search Bar */
        .search-bar {
        max-width: 700px;
        }
        .search-bar input {
        border-radius: 0 0 0 0 !important;
        box-shadow: none;
        }
        .search-bar .btn-green {
        background: linear-gradient(90deg, #00c853, #64dd17);
        border-radius: 0 8px 8px 0;
        color: #000;
        font-weight: bold;
        }
        .search-bar .btn-green:hover {
        box-shadow: 0 0 15px rgba(0, 255, 100, 0.6);
        }

        /* Pill Buttons */
        .btn-pill {
        background: #fff;
        color: #000;
        border-radius: 50px;
        padding: 8px 18px;
        font-weight: 500;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        }
        .btn-pill:hover {
        background: #00ff80;
        color: #000;
        box-shadow: 0 0 12px rgba(0, 255, 128, 0.6);
        }

        .fund-progress {
        background: #333;
        border-radius: 5px;
        height: 10px;
        }
        .fund-fill {
        background: #32d14f;
        height: 10px;
        border-radius: 5px;
        }

        /* Card hover neon effect */
        .card {
        background-color: #1c1c1c;
        border: 2px solid transparent;
        border-radius: 12px;
        padding: 20px;
        color: #fff;
        transition: all 0.3s ease;
        }
        .card:hover {
        transform: translateY(-10px);
        border: 2px solid #00ff80;
        box-shadow: 0 0 20px #00ff80, 0 0 40px rgba(0, 255, 128, 0.5);
        }

        /* Buttons */
        .btn-green {
        background-color: #32d14f;
        border: none;
        color: #fff;
        transition: all 0.3s ease;
        }
        .btn-green:hover {
        background-color: #28a745;
        box-shadow: 0 0 10px #32d14f, 0 0 20px rgba(50, 209, 79, 0.5);
        }

        /* Conversation Card */
        .conversation-card {
        background: #111827;
        border: 1px solid #222;
        border-radius: 12px;
        padding: 20px;
        color: #fff;
        transition: all 0.3s ease;
        }
        .conversation-card:hover {
        transform: translateY(-8px);
        border-color: #00ff80;
        box-shadow: 0 0 15px rgba(0, 255, 128, 0.6);
        }

        /* Avatar circle */
        .avatar {
        width: 40px;
        height: 40px;
        background: #32d14f;
        color: #000;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .donation-card {
        background: #111827; /* Dark navy/black */
        border: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        }

        .donation-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 0 15px rgba(0, 255, 100, 0.4);
        }

        .donation-card .badge {
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 50px;
        }

        .progress {
        height: 8px;
        border-radius: 5px;
        background: #333;
        }

        .progress-bar {
        border-radius: 5px;
        }

        .btn-success {
        background: #32cd32;
        border: none;
        }

        .btn-success:hover {
        background: #00ff80;
        box-shadow: 0 0 10px rgba(0, 255, 128, 0.6);
        }

        .btn-outline-light {
        border-radius: 8px;
        border: 1px solid #ccc;
        background: #fff;
        color: #000;
        }

        .btn-outline-light:hover {
        background: #e0e0e0;
        }

        /* Contribution Section */
        .contribution-card {
        background: #0f111a; /* dark navy/black */
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.3s ease;
        }

        .contribution-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 0 18px rgba(0, 255, 128, 0.4);
        }

        /* Icon Box */
        .icon-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        font-size: 28px;
        color: #fff;
        }

        /* Gradient pink icon background */
        .bg-gradient-pink {
        background: linear-gradient(135deg, #ff00cc, #ff66cc);
        }

        .impact-section {
        background: linear-gradient(to right, #00c853, #64dd17);
        color: #000;
        text-align: center;
        padding: 60px 20px;
        border-radius: 12px;
        margin: 40px 0;
        box-shadow: 0 0 20px rgba(0, 255, 100, 0.6);
        }
    </style>    
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center">
        <img src="{{ asset('image/korulogo2.png') }}" alt="Koru -Like Logo" class="rounded-circle me-2 bg-white mb-4" width= 150;>
        <h2 class="fw-bold">KORU-LIKE</h2>
        <p class="text-success mb-2">PROSPERITY FOR ALL</p>
        <p class="lead mb-4">Discover trending conversations and contribute to projects that matter</p>

        <!-- Search Bar -->
        <div class="input-group mx-auto search-bar">
            <span class="input-group-text bg-dark text-light border-0">
            <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control bg-dark text-light border-0" 
                placeholder="Search projects, discussions, or trending topics...">
            <button class="btn btn-green">
            <i class="bi bi-arrow-right"></i>
            </button>
        </div>

        <!-- Options -->
        <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">
            <button class="btn btn-pill"><i class="bi bi-fire me-2 text-warning"></i> Trending Now</button>
            <button class="btn btn-pill"><i class="bi bi-lightbulb me-2 text-warning"></i> Submit Idea</button>
            <button class="btn btn-pill"><i class="bi bi-coin me-2 text-warning"></i> Fund Project</button>
            <button class="btn btn-pill"><i class="bi bi-brush me-2 text-warning"></i> Share Design</button>
        </div>
    </section>


    <!-- Trending Conversations -->
    <div class="container my-5">
    <h3 class="mb-2 text-center">
        <i class="bi bi-graph-up-arrow text-success me-2"></i> Trending Conversations
    </h3>
    <p class="text-center text-light">AI-curated comments that are sparking the most engaging discussions across our community</p>

    <div class="row g-4 mt-4">
        <!-- Card 1 -->
        <div class="col-md-4">
        <div class="card conversation-card h-100">
            <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="avatar">S</div>
                <div class="ms-2">
                <h6 class="mb-0">Satoshi N.</h6>
                <span class="badge bg-secondary">DeFi</span>
                </div>
            </div>
            <i class="bi bi-pin-angle-fill text-success"></i>
            </div>
            <p class="mt-3">The potential for decentralized finance to reshape the global economy is immense. We are at the forefront of a financial revolution.</p>
            <div class="d-flex justify-content-between text-muted mt-3">
            <div><i class="bi bi-graph-up-arrow text-success me-1"></i> 95</div>
            <div><i class="bi bi-chat-left-text me-1"></i> 512</div>
            </div>
        </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
        <div class="card conversation-card h-100">
            <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="avatar">V</div>
                <div class="ms-2">
                <h6 class="mb-0">Vitalik B.</h6>
                <span class="badge bg-secondary">Web3</span>
                </div>
            </div>
            <i class="bi bi-pin-angle-fill text-success"></i>
            </div>
            <p class="mt-3">Web3 is not just about finance; it's about creating a more open, transparent, and user-centric internet for everyone.</p>
            <div class="d-flex justify-content-between text-muted mt-3">
            <div><i class="bi bi-graph-up-arrow text-success me-1"></i> 92</div>
            <div><i class="bi bi-chat-left-text me-1"></i> 488</div>
            </div>
        </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
        <div class="card conversation-card h-100">
            <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="avatar">J</div>
                <div class="ms-2">
                <h6 class="mb-0">Jane Doe</h6>
                <span class="badge bg-secondary">DAOs</span>
                </div>
            </div>
            <i class="bi bi-pin-angle-fill text-success"></i>
            </div>
            <p class="mt-3">DAOs represent a paradigm shift in organizational structure, enabling community-led governance and decision-making.</p>
            <div class="d-flex justify-content-between text-muted mt-3">
            <div><i class="bi bi-graph-up-arrow text-success me-1"></i> 88</div>
            <div><i class="bi bi-chat-left-text me-1"></i> 350</div>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Donation Section -->
    <section class="donation-section py-5 text-center text-light">
    <div class="container">
        <h3 class="mb-2 text-light">
        <i class="bi bi-bookmark-check text-success"></i> Donation USDT
        </h3>
        <p class="mb-5">Support meaningful projects with USDT donations or copy their details to share with AI tools</p>
        
        <div class="row g-4 justify-content-center">
        <!-- Card 1 -->
        @foreach ($donationtype as $row)
        <div class="col-md-4">
            <div class="card donation-card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $row->project }}</h5>
                    <span class="badge bg-secondary text-light">{{ $row->type }}</span>
                    <p class="mt-3">{{ $row->description }}</p>

                    @php
                        $amount  = (int) round($row->amount);
                        $target  = (int) round($row->target);
                        $percent = $target > 0 ? round(($amount / $target) * 100) : 0;
                    @endphp

                    {{-- integer-only figures, extra margin to avoid clash --}}
                    <p class="fw-bold mb-2">
                        Funding Progress
                        <span class="float-end">${{ $amount }} / ${{ $target }}</span>
                    </p>

                    <div class="progress mb-1">
                        <div class="progress-bar bg-success" style="width: {{ $percent }}%"></div>
                    </div>
                    <small class="text-secondary">{{ $percent }}% funded</small>

                    <div class="d-flex gap-2 mt-3">
                        <a type="button" class="btn btn-success flex-fill" data-bs-toggle="modal" data-bs-target="#donate{{ $row->id }}" title="donate">
                            <i class="bi bi-currency-dollar"></i> Donate USDT
                        </a>
                        <button class="btn btn-outline-light flex-fill">Copy Details</button>
                    </div>
                </div>
            </div>
        </div>
        @include('user.modal.donate', array('row' => $row))
        @endforeach
    </section>

    <!-- Contribution Section -->
    <section class="contribution-section py-5 text-center text-light">
    <div class="container">
        <h3 class="fw-bold mb-2">How You Can Contribute</h3>
        <p class="mb-5">Every contribution matters. Choose how you'd like to help make these projects a reality.</p>

        @include('user.modal.form')
        <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-6">
            <div class="contribution-card p-4 h-100" data-bs-toggle="modal" data-bs-target="#fundProject" title="fundProject">
            <div class="icon-box bg-success mb-3"><i class="bi bi-currency-dollar"></i></div>
            <h5 class="fw-bold">Fund Projects</h5>
            <p>Support amazing projects with financial backing</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6">
            <div class="contribution-card p-4 h-100" data-bs-toggle="modal" data-bs-target="#shareIdeas" title="shareIdeas">
            <div class="icon-box bg-warning mb-3"><i class="bi bi-lightbulb"></i></div>
            <h5 class="fw-bold">Share Ideas</h5>
            <p>Contribute innovative concepts and solutions</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-6">
            <div class="contribution-card p-4 h-100" data-bs-toggle="modal" data-bs-target="#submitDesign" title="submitDesign">
            <div class="icon-box bg-gradient-pink mb-3"><i class="bi bi-palette"></i></div>
            <h5 class="fw-bold">Submit Designs</h5>
            <p>Share visual concepts, mockups, and creative assets</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-6">
            <div class="contribution-card p-4 h-100" data-bs-toggle="modal" data-bs-target="#codeContribute" title="codeContribute">
            <div class="icon-box bg-primary mb-3"><i class="bi bi-code-slash"></i></div>
            <h5 class="fw-bold">Code Contributions</h5>
            <p>Help build with technical implementations</p>
            </div>
        </div>
        </div>
    </div>
    </section>

    <!-- Impact Section -->
    <div class="container">
        <div class="impact-section">
            <h3>Ready to Make an Impact?</h3>
            <p>Join our community of innovators, creators, and contributors. Every voice matters.</p>
            <button class="btn btn-dark me-2">Start Contributing</button>
            <button class="btn btn-outline-dark">Explore Projects</button>
        </div>
    </div>
@endsection