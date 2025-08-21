<?php 
include 'db.php';


session_start();
$is_logged_in = isset($_SESSION['username']);

// Logout handler
if (isset($_GET['logout'])) {
    session_destroy(); // Hapus semua data sesi
    header("Location: index.php"); // Redirect ke halaman utama
    exit;
}

$error_message = null; // Variabel untuk menyimpan pesan kesalahan
$title = 'PT. Ndrella Agro Distribution';  // Judul halaman dinamis
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Start your development with JohnDoe landing page.">
    <meta name="author" content="Devcrud">
    <title>PT. Ndrella Agro Distribution</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + JohnDoe main styles -->
    <link rel="stylesheet" href="assets/css/johndoe.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40">

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
<link rel="stylesheet" href="assets/css/johndoe.css">
    <header class="header">
        <div class="container">
            <ul class="social-icons pt-3">
            <?php if (isset($_SESSION['username'])): ?>
                    <a href="users_history.php"><span >Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span></a>
                    <a href="?logout=true" >Logout</a> 
                    
                <?php else: ?>
                    <a href="login.php" >Login</a> |
                    <a href="register.php" >Register</a>
                <?php endif; ?>
            </ul>  

            <div class="header-content">
                <h4 class="header-subtitle" > </h4>
                <h1 class="header-title">Ndrella Agro Distribution</h1>
                <h6 class="header-mono" >Nurturing Growth, Sustaining Futures.</h6>
                <button class="btn btn-primary btn-rounded"></i>Discover More</button>
            </div>
        </div>
    </header> 
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white" data-spy="affix" data-offset-top="510">
        <div class="container">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse mt-sm-20 navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#resume" class="nav-link">Growth</a>
                    </li>
                </ul>
                <ul class="navbar-nav brand">
                    <img src="assets/imgs/avatar.png" alt="" class="brand-img">
                    <li class="brand-txt">
                        <h5 class="brand-title">Ndrella Agro Distribution</h5>
                        <div class="brand-subtitle">Nurturing Growth, Sustaining Futures.</div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="#portfolio" class="nav-link">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="#blog" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item last-item">
                        <a href="#contact" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div id="about" class="row about-section">
            <div class="col-lg-4 about-card">
                <h3 class="font-weight-light">Who Are We?</h3>
                <span class="line mb-5"></span>
                <h5 class="mb-3">Our Company Established for 10 Years in Agricultural Products.</h5>
                <p class="mt-20">We are committed to being a trusted partner in the distribution of agricultural products. With extensive experience in the industry, we provide a wide range of high-quality products that support sustainability and enhance productivity for farmers.</p>
                <p class="mt-20">We prioritize strong relationships with farmers and business partners, and we are dedicated to innovation in every aspect of our distribution process. At PT. Ndrella Agro Distribution, we believe our success is intertwined with the success of our customers. Together, let’s build a better future for agriculture.</p>
                <button class="btn btn-outline-danger"><i class="icon-down-circled2 "></i>Download Our Company Profile</button>
            </div>
            <div class="col-lg-4 about-card">
                <h3 class="font-weight-light">Contact Information</h3>
                <span class="line mb-5"></span>
                <ul class="mt40 info list-unstyled">
                    <li><span>Established In</span> : 14 February 2014</li>
                    <li><span>Email</span> : support@nad.com</li>
                    <li><span>Phone</span> : + (17) 7710-382</li>
                    <li><span>LinkedIn</span> : Ndrella Agro Distribution </li>
                    <li><span>Instagram</span> : @NdrellaAgroDistribution </li>
                    <li><span>Twitter</span> : @NdrellaAgroDistribution </li>
                    <li><span>Address</span> :  Jl. Jenderal Basuki Rachmat No.1A, Cipinang Besar Sel., Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13410</li>
                </ul>
                <ul class="social-icons pt-3">
                    <li class="social-item"><a class="social-link" href="#"><i class="ti-twitter" aria-hidden="true"></i></a></li>
                    <li class="social-item"><a class="social-link" href="#"><i class="ti-google" aria-hidden="true"></i></a></li>
                    <li class="social-item"><a class="social-link" href="#"><i class="ti-instagram" aria-hidden="true"></i></a></li>
            </div>
            <div class="col-lg-4 about-card">
                <h3 class="font-weight-light">What We Do?</h3>
                <span class="line mb-5"></span>
                <div class="row">
                    <div class="col-1 text-danger pt-1"><i class="ti-widget icon-lg"></i></div>
                    <div class="col-10 ml-auto mr-3">
                        <h6>Agro-Product Distribution</h6>
                        <p class="subtitle">We provides access to high-quality agricultural products, helping farmers and businesses thrive.</p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 text-danger pt-1"><i class="ti-paint-bucket icon-lg"></i></div>
                    <div class="col-10 ml-auto mr-3">
                        <h6>Sustainable Farming Solutions</h6>
                        <p class="subtitle">Our innovative solutions support sustainable farming practices, enhancing both productivity and environmental responsibility.</p>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 text-danger pt-1"><i class="ti-stats-up icon-lg"></i></div>
                    <div class="col-10 ml-auto mr-3">
                        <h6>Agricultural Supply Chain Management</h6>
                        <p class="subtitle">We specialize in streamlining the agricultural supply chain, ensuring efficient delivery of products from farm to market.</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Resume Section-->
    <section class="section" id="resume">
        <div class="container">
            <h2 class="mb-5"><span class="text-danger">Our</span> Growth</h2>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                       <div class="card-header">
                            <div class="mt-2">
                                <h4>Expertise</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="title text-danger">2014 - Present</h6>
                            <P>Agricultural Products Distributor</P>
                            <P class="subtitle">PT. Ndrella Agro Distribution has been operating for over 10 years, since 14 February 2014, specializing in distributing high-quality agricultural products across the region. Our expertise includes sourcing, managing the supply chain, and ensuring sustainable farming practices for a growing network of farmers and businesses.</P>
                            <hr>
                            <h6 class="title text-danger">2017 - 2019</h6>
                            <P>Expansion of Product Line</P>
                            <P class="subtitle">Successfully expanded the product range to include organic and specialty agricultural products, working directly with local farmers to ensure high-quality, fresh goods.</P>
                            <hr>
                            <h6 class="title text-danger">2014 - 2017</h6>
                            <P>Established Key Partnerships</P>
                            <P class="subtitle">Developed essential partnerships with national and regional suppliers, ensuring the seamless flow of agricultural products and building a reputation for reliability and efficiency.</P>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                       <div class="card-header">
                            <div class="mt-2">
                                <h4>Awards & Accomplishments</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="title text-danger">2020 - Present</h6>
                            <P>Sustainability Excellence Award</P>
                            <P class="subtitle">PT. Ndrella Agro Distribution was recognized with a Sustainability Excellence Award for our efforts in promoting eco-friendly agricultural practices. This award reflects our ongoing commitment to reducing environmental impact while supporting local farming communities.</P>
                            <hr>
                            <h6 class="title text-danger">2018 - 2020</h6>
                            <P>Best Agricultural Supply Chain Management Award</P>
                            <P class="subtitle">Acknowledged as a leader in agricultural logistics, PT. Ndrella Agro Distribution received this prestigious award for implementing advanced technologies and processes that optimized our supply chain, reducing lead times and increasing efficiency across all operations.</P>
                            <hr>
                            <h6 class="title text-danger">2016 - 2018</h6>
                            <P>Certified Quality Supplier Accreditation</P>
                            <P class="subtitle">PT. Ndrella Agro Distribution earned the Certified Quality Supplier Accreditation from industry-leading agricultural boards. This accreditation highlights our dedication to maintaining high standards of product quality and compliance with national and international agricultural regulations.</P>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                       <div class="card-header">
                            <div class="pull-left">
                                <h4 class="mt-2">Production Growth</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body pb-2">
                           <h6>Yearly Crop Yield Growth</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 97%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>Product Variety</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>New Markets Penetrated</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>Annual Export Growth</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 90%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>New Suppliers Onboarded</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 88%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                       <div class="card-header">
                            <div class="pull-left">
                                <h4 class="mt-2">Client Satisfaction & Feedback</h4>
                                <span class="line"></span>  
                            </div>
                        </div>
                        <div class="card-body pb-2">
                           <h6>Customer Satisfaction Rate</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>Repeat Clients</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 87%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>Market Share</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6>Client Feedback Incorporated</h6>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-dark text-center">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 col-lg-3">
                    <div class="row ">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-alarm-clock icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">10</h1>
                            <p class="text-light mb-1">Years Distributing Agricultural Products.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-layers-alt icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">50K</h1>
                            <p class="text-light mb-1">Contracts Delivered.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-face-smile icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">200K</h1>
                            <p class="text-light mb-1">Agricultural Partners.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-5 text-right text-light border-right py-3">
                            <div class="m-auto"><i class="ti-heart-broken icon-xl"></i></div>
                        </div>
                        <div class="col-7 text-left py-3">
                            <h1 class="text-danger font-weight-bold font40">2K</h1>
                            <p class="text-light mb-1">Field Visit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="service">
        <div class="container">
            <h2 class="mb-5 pb-4"><span class="text-danger">Our</span> Agricultural Services</h2>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="ti-vector text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">Supply Chain Management</h5>
                            <P class="subtitle">We optimize agricultural supply chains, connecting farmers, distributors, and markets to ensure fast, efficient, and quality delivery of products.</P>
                            <P class="subtitle">Our team works closely with logistics partners to streamline operations, reducing costs and ensuring timely deliveries. This allows you to focus on farming, knowing your produce will reach the market fresh and on time.</P>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="ti-write text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">Regulatory Compliance</h5>
                            <P class="subtitle">Our team ensures compliance with local and international agricultural standards, handling all the necessary paperwork and certifications.</P>
                            <P class="subtitle">We stay updated on the latest regulations to ensure your products meet the strictest safety and quality standards, giving you peace of mind and opening up markets for your agricultural goods.</P>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="ti-package text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">Product Packaging & Distribution</h5>
                            <P class="subtitle">We provide eco-friendly packaging solutions and ensure timely distribution of agricultural products to retailers and markets.</P>
                            <P class="subtitle">By using sustainable materials, we help reduce your environmental footprint while ensuring that your products remain fresh and market-ready during transportation and shelf life.</P>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="ti-map-alt text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">Farm Advisory Services</h5>
                            <P class="subtitle">We offer on-site advisory services to help farmers improve crop yield and farm efficiency through expert guidance.</P>
                            <P class="subtitle">Our agronomists provide tailored advice based on soil tests, climate, and local market conditions, ensuring that your farm operations are optimized for both productivity and sustainability.</P>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="ti-bar-chart text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">Market Analytics</h5>
                            <P class="subtitle">Our market analytics services provide insights into market trends, helping farmers and businesses make informed decisions to maximize profits.</P>
                            <P class="subtitle">Using data-driven analysis, we help you forecast demand, optimize pricing strategies, and identify new market opportunities, giving your business a competitive edge in the agricultural sector.</P>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-5">
                       <div class="card-header has-icon">
                            <i class="ti-support text-danger" aria-hidden="true"></i>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="mb-3 card-title text-dark">Retail Solutions</h5>
                            <P class="subtitle">We offer solutions for retailers, helping them source fresh, quality agricultural products directly from our farmers and distributors.</P>
                            <P class="subtitle">With a robust network of producers, we ensure a consistent supply of top-quality products tailored to your specific needs, helping you meet consumer demands with ease and reliability.</P>
                        </div>
    </section>
    <section class="section bg-custom-gray" id="price">
        <div class="container">
            <h1 class="mb-5"><span class="text-danger">Our</span> Services & Products</h1>
            <div class="row align-items-left">
                <div class="col-md-6 col-lg-3">
                    <div class="price-card text-center mb-4">
                        <h3 class="price-card-title">Raw Plantation Supplies</h3>
                        <div class="price-card-cost">
                            <span class="num">150kg</span>
                            <span class="x">Minimum Order</span>
                        </div>
                        <ul class="list">
                            <li class="list-item">• <span class="text-muted">Custom pricing based on volume and seasonal availability.</span></li>
                            <li class="list-item">• <span class="text-muted">Nationwide delivery options.</span></li>
                            <li class="list-item">• <span class="text-muted">Free initial consultation for buyers on product sourcing and logistics.</span></li>
                        </ul>
                        <?php if ($is_logged_in): ?>
                             <p>Anda sudah login. <a href="form_pesanan.php">Lanjutkan ke Pemesanan</a></p>
                            <?php else: ?>
                            <p><a href="login.php">Login</a> atau <a href="register.php">Daftar</a> untuk melanjutkan ke pemesanan.</p>
                        <?php endif; ?>
                    
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="price-card text-center mb-4">
                        <h3 class="price-card-title">Expert Farm Consultancy</h3>
                        <div class="price-card-cost">
                            <sup class="ti-money"></sup>
                            <span class="num">500</span>
                            <span class="date"> per session</span>
                        </div>
                        <ul class="list">
                            <li class="list-item">• <span class="text-muted">Personalized consultancy for optimizing crop yield and soil health.</span></li>
                            <li class="list-item">• <span class="text-muted">On-site visits or remote consultations with expert agronomists.</span></li>
                            <li class="list-item">• <span class="text-muted">Become a long-term partner for a discounted consultancy and priority access to farming resources.</span></li>
                        </ul>
                        <?php if ($is_logged_in): ?>
                             <p>Anda sudah login. <a href="formconsul.php">Lanjutkan ke Pemesanan</a></p>
                            <?php else: ?>
                            <p><a href="login.php">Login</a> atau <a href="register.php">Daftar</a> untuk melanjutkan ke pemesanan.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="price-card text-center price-card-requried mb-4">
                        <h3 class="price-card-title">Plantation Seeds Supplies</h3>
                        <div class="price-card-cost">
                            <span class="num">100kg</span>
                            <span class="x">Minimum Order</span>
                        </div>
                        <ul class="list">
                            <li class="list-item">• <span class="text-muted">Seeds, fertilizers, and other agricultural supplies</span></li>
                            <li class="list-item">• <span class="text-muted">Pricing available upon request or bulk order discounts</span></li>
                            <li class="list-item">• <span class="text-muted">Expert guidance on selecting the best products for your farm’s conditions</span></li>
                        </ul>
                        <?php if ($is_logged_in): ?>
                             <p>Anda sudah login. <a href="form_bibit.php">Lanjutkan ke Pemesanan</a></p>
                            <?php else: ?>
                            <p><a href="login.php">Login</a> atau <a href="register.php">Daftar</a> untuk melanjutkan ke pemesanan.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="price-card text-center mb-4">
                        <h3 class="price-card-title">Partnership Program</h3>
                        <div class="price-card-cost">
                            <sup class="ti-money"></sup>
                            <span class="num">300</span>
                            <span class="date">month</span>
                        </div>
                        <ul class="list">
                            <li class="list-item">• <span class="text-muted">Tailored support for agricultural enterprises, including bulk supply contracts and joint ventures.</span></li>
                            <li class="list-item">• <span class="text-muted">Priority access to our full range of products, consulting, and bulk purchasing discounts.</span></li>
                            <li class="list-item">• <span class="text-muted">Long-Term Collaboration for Large-Scale Farms.</span></li>
                        </ul>
                        <?php if ($is_logged_in): ?>
                             <p>Anda sudah login. <a href="formconsul.php">Lanjutkan ke Pemesanan</a></p>
                            <?php else: ?>
                            <p><a href="login.php">Login</a> atau <a href="register.php">Daftar</a> untuk melanjutkan ke pemesanan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section bg-dark py-5">
        <div class="container text-center">
            <h2 class="text-light mb-5 font-weight-normal">Tracking Your Package</h2>
           <a href="tracking.php"><button class="btn bg-primary w-lg" >Tracking Bahan Mentah</button></a>
           <a href="trackingbibit.php"><button class="btn bg-primary w-lg" >Tracking Bibit</button></a>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="section bg-custom-gray" id="portfolio">
        <div class="container">
            <h1 class="mb-5"><span class="text-danger">Our</span> Gallery</h1>
            <div class="portfolio">
                <div class="filters">
                    <a href="#" data-filter=".new" class="active">
                        All
                    </a>
                    <a href="#" data-filter=".advertising">
                        Fields
                    </a>
                    <a href="#" data-filter=".branding">
                        Team
                    </a>
                    <a href="#" data-filter=".web">
                        Community
                    </a>
                </div>
                <div class="portfolio-container"> 
                    <div class="col-md-6 col-lg-4 web new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/comm1.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/comm1.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">COMMUNITY</h6>
                                    <p class="subtitle">Making A Dream Community!</p>
                                </div>
                            </div>   
                        </div>             
                    </div>
                    <div class="col-md-6 col-lg-4 web new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/comm2.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/comm2.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">COMMUNITY</h6>
                                    <p class="subtitle">Making A Dream Community!</p>
                                </div>
                            </div> 
                        </div>                         
                    </div>
                    <div class="col-md-6 col-lg-4 advertising new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/field2.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">                         
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/field2.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">FIELDS</h6>
                                    <p class="subtitle">Bringing Fresh Product Just For You!</p>
                                </div>
                            </div>    
                        </div>              
                    </div> 
                    <div class="col-md-6 col-lg-4 web">
                        <div class="portfolio-item">
                            <img src="assets/imgs/comm4.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/comm4.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">COMMUNITY</h6>
                                    <p class="subtitle">Making A Dream Community!</p>
                                </div>
                            </div>
                        </div>                                                     
                    </div>

                    <div class="col-md-6 col-lg-4 advertising"> 
                        <div class="portfolio-item">
                            <img src="assets/imgs/field4.jpg" class="img-fluid">                               
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/field4.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">FIELDS</h6>
                                    <p class="subtitle">Bringing Fresh Product Just For You!</p>
                                </div>
                            </div>
                        </div>                                                       
                    </div> 
                    <div class="col-md-6 col-lg-4 web new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/comm3.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">  
                           <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/comm3.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">COMMUNITY</h6>
                                    <p class="subtitle">Making A Dream Community!</p>
                                </div>
                            </div>
                        </div>                                                     
                    </div>
                    <div class="col-md-6 col-lg-4 advertising new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/field3.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">       
                           <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/field3.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">FIELDS</h6>
                                    <p class="subtitle">Bringing Fresh Product Just For You!</p>
                                </div>
                            </div>
                        </div>                                                       
                    </div> 
                    <div class="col-md-6 col-lg-4 advertising new"> 
                        <div class="portfolio-item">
                            <img src="assets/imgs/field1.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">            
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/field1.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">FIELDS</h6>
                                    <p class="subtitle">Bringing Fresh Product Just For You!</p>
                                </div>
                            </div>
                        </div>
                                
                    </div> 
                    <div class="col-md-6 col-lg-4 branding new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/team1.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">                        
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/team1.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">TEAM</h6>
                                    <p class="subtitle">Working Our Best for You!</p>
                                </div>
                            </div> 
                        </div>
                    </div> 
                    <div class="col-md-6 col-lg-4 branding">
                        <div class="portfolio-item">
                            <img src="assets/imgs/team2.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">  
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/team2.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">TEAM</h6>
                                    <p class="subtitle">Working Our Best for You!</p>
                                </div>
                            </div>
                        </div>                                                     
                    </div> 
                    <div class="col-md-6 col-lg-4 branding new">
                        <div class="portfolio-item">
                            <img src="assets/imgs/team3.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">   
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/team3.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">TEAM</h6>
                                    <p class="subtitle">Working Our Best for You!</p>
                                </div>
                            </div>
                        </div>                                                    
                    </div> 
                    <div class="col-md-6 col-lg-4 branding">
                        <div class="portfolio-item">
                            <img src="assets/imgs/team4.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">                      
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/team4.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">TEAM</h6>
                                    <p class="subtitle">Working Our Best for You!</p>
                                </div>
                            </div>
                        </div>                                                      
                    </div> 
                    <div class="col-md-6 col-lg-4 branding">
                        <div class="portfolio-item">
                            <img src="assets/imgs/team5.jpg" class="img-fluid" alt="Download free bootstrap 4 admin dashboard, free boootstrap 4 templates">          
                            <div class="content-holder">
                                <a class="img-popup" href="assets/imgs/team5.jpg"></a>
                                <div class="text-holder">
                                    <h6 class="title">TEAM</h6>
                                    <p class="subtitle">Working Our Best for You!</p>
                                </div>
                            </div>
                        </div>                                                   
                    </div>
                </div> 
            </div>  
        </div>            
    </section>
    <!-- End of portfolio section -->

    <section class="section" id="blog">
        <div class="container">
            <h2 class="mb-5">Our <span class="text-danger">News</span></h2>
            <div class="row">
                <div class="blog-card">
                    <div class="img-holder">
                        <img src="assets/imgs/on1.jpg">
                    </div>
                    <div class="content-holder">
                        <h6 class="title">Kolaborasi Baru dengan Petani Lokal untuk Peningkatan Produktivitas</h6>

                        <p class="post-details">
                            <a href="#">By: KUMA</a>
                            <a href="#"><i class="ti-heart text-danger"></i> 888</a>
                            <a href="#"><i class="ti-comment"></i> 949</a>
                        </p>
                        
                        <p>PT. Ndrella Agro Distribution baru saja menjalin kerja sama dengan kelompok petani lokal di wilayah Nganjuk, demi memajukan sektor agrikultural yang ada di Indonesia.</p>

                        <p><b>Program ini bertujuan untuk meningkatkan hasil panen melalui pelatihan teknis dan distribusi benih unggul.</b></p>
                        <p>Kami percaya bahwa kolaborasi ini akan membawa manfaat jangka panjang bagi petani lokal dan meningkatkan ketahanan pangan di wilayah tersebut.</p>

                        <a href="#" class="read-more">Read more <i class="ti-angle-double-right"></i></a>
                    </div>
                </div><!-- end of blog wrapper -->

                <!-- blog-card -->
                <div class="blog-card">
                    <div class="img-holder">
                        <img src="assets/imgs/on2.jpg">
                    </div>
                    <div class="content-holder">
                        <h6 class="title">PT. Ndrella Raih Penghargaan Inovasi Agrikultur 2024</h6>

                        <p class="post-details">
                            <a href="#">By: mrxco</a>
                            <a href="#"><i class="ti-heart text-danger"></i> 4.556</a>
                            <a href="#"><i class="ti-comment"></i> 1.264</a>
                        </p>
                        
                        <p>Dengan bangga kami umumkan bahwa PT. Ndrella Agro Distribution telah dianugerahi penghargaan Best Agricultural Innovation 2024. Penghargaan ini merupakan pengakuan atas upaya kami dalam menerapkan teknologi distribusi hasil tani yang inovatif dan efisien. Kami berkomitmen untuk terus menghadirkan solusi terbaik bagi para petani dan pelaku agribisnis di Indonesia.</p>

                        <a href="#" class="read-more">Read more <i class="ti-angle-double-right"></i></a>
                    </div>
                </div><!-- end of blog wrapper -->
                <!-- blog-card -->
                <div class="blog-card">
                    <div class="img-holder">
                        <img src="assets/imgs/on3.jpg">
                    </div>
                    <div class="content-holder">
                        <h4 class="title">Suksesnya Program Edukasi Petani Milenial</h4>

                        <p class="post-details">
                            <a href="#">By: subaru</a>
                            <a href="#"><i class="ti-heart text-danger"></i> 431</a>
                            <a href="#"><i class="ti-comment"></i> 312</a>
                        </p>
                        
                        <p>PT. Ndrella Agro Distribution dengan bangga menyampaikan keberhasilan program edukasi khusus untuk generasi muda. Program ini dirancang untuk membekali petani milenial dengan pengetahuan tentang pertanian berkelanjutan, penggunaan teknologi modern, dan strategi pengelolaan agribisnis. Kami berharap inisiatif ini dapat mendorong lebih banyak anak muda untuk berkontribusi dalam pengembangan sektor agrikultur di Indonesia.</p>

                        <a href="#" class="read-more">Read more <i class="ti-angle-double-right"></i></a>
                    </div>
                </div><!-- end of blog wrapper -->

            </div>
        </div>
    </section>
       
</body>
</html>
<?php include 'footer.php';$conn->close(); ?>
