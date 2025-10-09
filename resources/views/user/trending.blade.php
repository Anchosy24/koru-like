@extends('layouts.home')

@push('style')
<style>
    /* Filter Section */
    .trending-header .filter-section {
    display: flex;
    align-items: center;
    gap: 0.75rem; /* space between items */
    }

    .trending-header .filter-section i {
    font-size: 1.2rem;
    color: #00ff88; /* neon green filter icon */
    }

    .trending-header .form-select {
    background-color: #0d1117;
    color: #fff;
    border: 1px solid #2a2f3a;
    border-radius: 8px;
    padding: 0.45rem 1.5rem 0.45rem 0.75rem;
    font-size: 0.9rem;
    transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    .trending-header .form-select:focus {
    border-color: #00ff88;
    box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
    outline: none;
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
</style>    
@endpush

@section('content')
<!-- Trending Hero Section -->
<section class="trending-header text-center text-light py-5 mt-5">
  <div class="container">
    <h2 class="fw-bold text-light mb-2">
      <i class="bi bi-graph-up-arrow text-success"></i> Trending Now
    </h2>
    <p class="lead mb-4">Discover the most engaging conversations and trending topics across our community platform</p>
    
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
      <!-- Left Options -->
      <div class="d-flex gap-4">
        <span><i class="bi bi-chat-dots me-2 text-light"></i> Live discussions</span>
        <span><i class="bi bi-share me-2 text-light"></i> Social sharing</span>
      </div>
      
      <!-- Right Filters -->
      <div class="filter-section mt-3 mt-md-0">
        <i class="bi bi-filter"></i>
        <select class="form-select">
            <option>All Topics</option>
            <option>DeFi</option>
            <option>Web3</option>
            <option>DAOs</option>
        </select>
        <select class="form-select">
            <option>Trending Score</option>
            <option>Most Active</option>
            <option>Newest</option>
        </select>
        </div>
    </div>
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
@endsection
