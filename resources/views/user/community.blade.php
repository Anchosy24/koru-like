@extends('layouts.home')

@push('style')
<style>
    /* Green icon square */
    .icon-square {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(145deg, #00ff88, #34d058);
    color: #000;
    font-size: 1.5rem;
    }

    /* Stats box */
    .stat-box h5 {
    margin-top: 8px;
    font-size: 1.25rem;
    }

    /* Avatar */
    .circle-avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    font-size: 1.5rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #1a1d29;
    }

    /* Honor Card */
    .honor-card {
    background-color: #0d1117; /* dark background */
    border-radius: 12px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    }
    .honor-card:hover {
    transform: translateY(-5px);
    border-color: #00ff88;
    box-shadow: 0 0 15px rgba(0, 255, 136, 0.4);
    }
    .honor-card.gold:hover {
    border-color: gold;
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
    }
    .honor-card.bronze:hover {
    border-color: #cd7f32;
    box-shadow: 0 0 15px rgba(205, 127, 50, 0.6);
    }

    /* Circle Avatar */
    .circle-avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    font-size: 1.5rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #1a1d29;
    color: #fff;
    }

    /* Contribution cards */
    .contrib-card {
    background: #0f111a;
    border-radius: 12px;
    transition: all 0.3s ease;
    }
    .contrib-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 0 15px rgba(0, 255, 136, 0.3);
    }

    /* Icon box */
    .icon-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 10px;
    font-size: 1.2rem;
    }
    .bg-gradient-pink {
    background: linear-gradient(135deg, #ff00cc, #ff66cc);
    }
    .bg-purple {
    background: linear-gradient(135deg, #6f42c1, #9b59b6);
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
</style>    
@endpush

@section('content')
    <!-- Community Hero Section -->
    <section class="community-header text-center text-light py-5 mt-5">
    <div class="container">
        <!-- Title -->
        <h2 class="fw-bold text-success mb-2 d-flex justify-content-center align-items-center gap-2">
        <span class="icon-square"><i class="bi bi-people-fill"></i></span>
        Community
        </h2>
        <p class="lead mb-5">Meet our amazing contributors and discover how you can be part of building the future</p>

        <!-- Stats -->
        <div class="row justify-content-center text-center g-4">
        <div class="col-md-3">
            <div class="stat-box">
            <div class="icon-square mb-2"><i class="bi bi-heart-fill"></i></div>
            <h5 class="fw-bold">500+</h5>
            <p class="mb-0">Contributors</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
            <div class="icon-square mb-2"><i class="bi bi-shield-check"></i></div>
            <h5 class="fw-bold">1.2k</h5>
            <p class="mb-0">Contributions</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
            <div class="icon-square mb-2"><i class="bi bi-people"></i></div>
            <h5 class="fw-bold">50+</h5>
            <p class="mb-0">Projects</p>
            </div>
        </div>
        </div>
    </div>
    </section>

    <!-- Honor Wall -->
    <section class="honor-wall text-center text-light py-5">
        <div class="container">
            <h3 class="fw-bold mb-2"><i class="bi bi-award text-warning"></i> Honor Wall</h3>
            <p class="mb-5">Celebrating our amazing community members who are making these projects possible</p>
            
            <div class="row g-4 justify-content-center">
            <!-- Vitalik -->
            <div class="col-md-3">
                <div class="honor-card p-4">
                <div class="text-light mb-2"><i class="bi bi-award"></i></div>
                <div class="circle-avatar mx-auto mb-2">V</div>
                <h6 class="fw-bold">Vitalik</h6>
                <div class="d-flex justify-content-center gap-2 mt-2 small">
                    <span class="badge bg-secondary">2 contributions</span>
                    <span class="badge bg-success">$2500 donated</span>
                </div>
                </div>
            </div>
            
            <!-- Satoshi (highlighted gold) -->
            <div class="col-md-3">
                <div class="honor-card gold p-4">
                <div class="text-warning mb-2"><i class="fa-solid fa-crown"></i></div>
                <div class="circle-avatar mx-auto mb-2">S</div>
                <h6 class="fw-bold">Satoshi</h6>
                <div class="d-flex justify-content-center gap-2 mt-2 small">
                    <span class="badge bg-secondary">2 contributions</span>
                    <span class="badge bg-success">$5000 donated</span>
                </div>
                </div>
            </div>
            
            <!-- Jane -->
            <div class="col-md-3">
                <div class="honor-card bronze p-4">
                <div class="text-warning mb-2"><i class="bi bi-award"></i></div>
                <div class="circle-avatar mx-auto mb-2">J</div>
                <h6 class="fw-bold">Jane</h6>
                <div class="d-flex justify-content-center gap-2 mt-2 small">
                    <span class="badge bg-secondary">2 contributions</span>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

    <!-- Recent Contributions -->
    <section class="recent-contributions py-5 text-light">
    <div class="container">
        <h4 class="fw-bold text-center mb-4">Recent Contributions</h4>
        
        <div class="row g-4">
        <div class="col-md-4">
            <div class="card contrib-card p-3 h-100">
            <div class="icon-box bg-success mb-3"><i class="bi bi-gift"></i></div>
            <h6 class="fw-bold text-light">Decentralized Identity Protocol</h6>
            <p class="text-light small">Core protocol development</p>
            <div class="d-flex justify-content-between small">
                <span>Satoshi</span>
                <span class="badge bg-success">$5000</span>
            </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card contrib-card p-3 h-100">
            <div class="icon-box bg-primary mb-3"><i class="bi bi-diagram-3"></i></div>
            <h6 class="fw-bold text-light">DAO Governance Module</h6>
            <p class="text-light small">Smart contract for voting</p>
            <div class="d-flex justify-content-between small">
                <span>Vitalik</span>
            </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card contrib-card p-3 h-100">
            <div class="icon-box bg-gradient-pink mb-3"><i class="bi bi-brush"></i></div>
            <h6 class="fw-bold text-light">Koru Brand Identity</h6>
            <p class="text-light small">Logo and visual guidelines</p>
            <div class="d-flex justify-content-between small">
                <span>Jane</span>
            </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card contrib-card p-3 h-100">
            <div class="icon-box bg-warning text-dark mb-3"><i class="bi bi-lightbulb"></i></div>
            <h6 class="fw-bold text-light">Yield Farming Strategy</h6>
            <p class="text-light small">New strategy for treasury</p>
            <div class="d-flex justify-content-between small">
                <span>Satoshi</span>
            </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card contrib-card p-3 h-100">
            <div class="icon-box bg-purple mb-3"><i class="bi bi-code-slash"></i></div>
            <h6 class="fw-bold text-light">Frontend UI/UX Polish</h6>
            <p class="text-light small">Improving user experience</p>
            <div class="d-flex justify-content-between small">
                <span>Jane</span>
            </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card contrib-card p-3 h-100">
            <div class="icon-box bg-success mb-3"><i class="bi bi-shield-check"></i></div>
            <h6 class="fw-bold text-light">Security Audit Contribution</h6>
            <p class="text-light small">Funding for audit</p>
            <div class="d-flex justify-content-between small">
                <span>Vitalik</span>
                <span class="badge bg-success">$2500</span>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

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
@endsection
